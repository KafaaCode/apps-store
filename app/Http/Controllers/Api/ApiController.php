<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Game;
use App\Models\Order;
use App\Models\Package;
use App\Models\Provider;
use App\Http\Controllers\Front\ProvidersController;

class ApiController extends Controller
{
    public function profile(Request $request)
    {
        return response()->json([
            'success' => true,
            'email' => $request->user()->email,
            'balance' => $request->user()->user_balance,
            'currency' => $request->user()->currency->code,
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'package_id' => 'nullable|exists:packages,id',
            'playerid' => 'required|string|max:255',
            'playername' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
        ]);
        DB::beginTransaction();

        try {
            $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $user_id = $request->user()->id;
            $invoice_no = 'ZM' . $randomNumber . $user_id;
            $game = Game::where('id', $request->game_id)->first();

            // Get base price and quantity
            if ($game->have_packages) {
                $package = Package::where('id', $request->package_id)->first();
                $qty_item = $package->quantity;
                $price_item = $package->price;
                $base_total = $request->qty * $package->price;
            } else {
                $qty_item = $game->min_qty;
                $price_item = $game->price_qty;
                $base_total = $request->qty * $game->price_qty;
            }

            // Calculate profit based on user's level
            $user = $request->user();
            $profit_percentage = $user->level ? $user->level->profit_percentage : 0;
            $profit_amount = ($base_total * $profit_percentage) / 100;
            $final_total = $base_total + $profit_amount;

            if ($user->user_balance < $final_total) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'translation.Your current balance is not enough, please top up and try again'
                ], 400);
            } else {
                $user->increment('amount_orders', $final_total);
                $user->decrement('user_balance', $final_total);
            }

            $orderId = null;
            $sprice = null;
            $providerId = null;
            // check if game is from provider
            if ($game->provider_id) {
                $provider = Provider::where('id', $game->provider_id)->first();
            
                $method = $provider->name;
                if (method_exists(ProvidersController::class, $method)) {
                    $resault = ProvidersController::$method($game, $request, $provider->api_key);
            
                    if ($resault['success']) {
                        $providerId = $provider->id;
            
                        if ($method == 'soud' || $method == 'yassen') {
                            $orderId = $resault['res']->json('data.order_id');
                            $sprice = $resault['res']->json('data.price');
                        }
                    } else {
                        Log::error("فشل تنفيذ الطلب من المزود", [
                            'game_id' => $game->id,
                            'provider' => $method,
                            'message' => $resault['message'] ?? 'لا يوجد رسالة'
                        ]);
                    }
                } else {
                    Log::warning("الميثود غير موجود في ProviderController: {$method}", [
                        'provider' => $method,
                        'game_id' => $game->id,
                    ]);
                }
            }
            // check if game is from provider

            $data = [
                'user_id' => $user_id,
                'game_id' => $request->game_id,
                'package_id' => $request->package_id,
                'invoice_no' => $invoice_no,
                'player_id' => $request->playerid,
                'player_name' => $request->playername,
                'qty' => $request->qty,
                'qty_item' => $qty_item,
                'price_item' => $price_item,
                'base_total' => $base_total,
                'profit_percentage' => $profit_percentage,
                'profit' => $profit_amount,
                'final_total' => $final_total,
                'details' => 'From API',
                'provider_order_id' => $orderId,
                'provider_id' => $providerId,
            ];

            $order = Order::create($data);

            DB::commit();
            return response()->json([
                'success' => true,
                'invoice_no' => $invoice_no,
                'game_name' => $game->name,
                'price' => $final_total,
                'status' => $order->status,
                'note' => $order->note,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'error occurred while processing your request. Please try again later.'
            ], 500);
        }
    }

    public function orderShow(Request $request)
    {
        // Validate the order ID
        $invoice_no = $request->invoice_no;
        if (!$invoice_no) {
            return response()->json(['success' => false, 'message' => 'Invoice number is required'], 400);
        }
        $order = Order::where('invoice_no', $invoice_no)->first();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }
        return response()->json([
            'success' => true,
            'status' => $order->status,
            'note' => $order->note,
        ]);
        
    }

    public function products(Request $request)
    {
        $games = Game::where('is_active', 1)
            ->where('is_show', 1)
            ->with(['packages' => function ($q) {
                $q->where('is_active', 1)
                ->select('id', 'game_id', 'price', 'quantity');
            }])
            ->get([
                'id',
                'slug',
                'have_packages',
                'need_name_player',
                'need_id_player',
                'price_qty',
                'min_qty',
                'labelText',
                'description',
                'image'
            ])
            ->map(function ($game) {
                return [
                    'id' => $game->id,
                    'slug' => $game->slug,
                    'label' => $game->labelText,
                    'description' => $game->description,
                    'image' => $game->image ? asset('storage/' . $game->image) : null,
                    'price_qty' => (float) $game->price_qty,
                    'min_qty' => (int) $game->min_qty,
                    'have_packages' => (bool) $game->have_packages,
                    'need_name_player' => (bool) $game->need_name_player,
                    'need_id_player' => (bool) $game->need_id_player,
                    'packages' => $game->have_packages
                        ? $game->packages->map(function ($pkg) {
                            return [
                                'id' => $pkg->id,
                                'price' => (float) $pkg->price,
                                'quantity' => (int) $pkg->quantity,
                            ];
                        })
                        : [],
                ];
            });

        return response()->json([
            'success' => true,
            'games' => $games,
        ]);
    }

}
