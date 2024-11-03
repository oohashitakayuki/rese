<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store($shopId)
    {
        $user = \Auth::User();
        if (!$user->is_favorite($shopId)) {
            $user->favorites()->create([
                'shop_id' => $shopId,
            ]);
        }

        return back();
    }

    public function destroy($shopId)
    {
        $user = \Auth::User();
        $favorite = Favorite::where('shop_id', $shopId)->where('user_id', $user->id)->first();
        if($favorite) {
            $favorite->delete();
        }

        return back();
    }
}
