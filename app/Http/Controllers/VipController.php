<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Vip;
use App\Models\VipPackage;
use Illuminate\Http\Request;

class VipController extends Controller
{
    public function index()
    {
        $games = Game::where('vip', true)->latest()->paginate(10);
        return view('admin.vip.index', compact('games'));
    }

    public function userPackages()
    {
        $vips = Vip::with('user')->latest()->paginate(15);
        return view('admin.vip.userPackages', compact('vips'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:vip_packages,id',
        ]);

        $user_id = $request->user_id ?? auth()->id();

        $hasActiveVip = Vip::where('user_id', $user_id)
            ->where('is_active', true)
            ->where('end_at', '>', now())
            ->exists();

        if ($hasActiveVip) {
            return back()->with('error', 'لديك اشتراك VIP لم ينتهِ بعد.');
        }

        $package = VipPackage::findOrFail($request->package_id);

        $start = now();
        $end = $start->copy()->addDays($package->duration_days);

        Vip::create([
            'user_id' => $user_id,
            'price' => $package->price,
            'duration_days' => $package->duration_days,
            'start_at' => $start,
            'end_at' => $end,
            'is_active' => true,
        ]);

        return back()->with('success', 'تم الاشتراك بنجاح ✅');
    }


    public function front()
    {
        $user = auth()->user();

        // if (!$user || !$user->isVipActive()) {
        //     return redirect()->route('index')->with('error', 'يجب أن تكون مشتركًا في VIP للدخول.');
        // }

        $allGames = Game::IsShow()->get();
        $games = $allGames->where('vip', true);

        return view('front.vip', compact('games'));
    }

    public function addGame()
    {
        return view('admin.vip.addGame');
    }
}
