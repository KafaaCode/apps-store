<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProvidersController extends Controller
{
    public static function getToken($providerName)
    {
        $provider = Provider::where('name', $providerName)->first();
        if ($provider) {
            return $provider->api_key;
        } else {
            return null; // or handle the error as needed
        }
    }

    public static function soud($game, $req, $token)
    {
        $url = 'https://api.soud-card.com/client/api/newOrder/' . $game->provider_game_id . '/params';
        $parameters = [
            'qty' => $req->qty,
            'order_uuid' => Str::uuid(),
            'playerID' => $req->playerid,
        ];

        $headers = [
            'api-token' => $token,
        ];

        $response = Http::withHeaders($headers)
            ->timeout(60)
            ->get($url, $parameters);
        if ($response->successful() && $response->json('status') === 'OK') {
            return ["success" => true, "res" => $response, "withPrice" => true];
        } else {
            return ["success" => false, "res" => $response, "withPrice" => false];
        }
    
    }

    
}
