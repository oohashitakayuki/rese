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
            $user->favorite_shops()->attach($shopId);
        }

        return back();
    }

    public function destroy($shopId)
    {
        $user = \Auth::User();
        if ($user->is_favorite($shopId)) {
            $user->favorite_shops()->detach($shopId);
        }

        return back();
    }
}
