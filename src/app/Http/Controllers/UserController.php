<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $reservations = $user->reservations()->get();
        $favorites = $user->favorites()->get();

        return view('mypage', compact('reservations', 'favorites'));
    }
}
