<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request, $shopId)
    {
        $user = \Auth::User();
        if (!$user->is_reservation($shopId)) {
            $user->reservations()->create([
                'shop_id' => $shopId,
                'date'    => $request->input('date'),
                'time'    => $request->input('time'),
                'number'  => $request->input('number'),
            ]);
        }

        return view('done');
    }

    public function destroy($shopId)
    {
        $user = \Auth::User();
        $reservation = Reservation::where('shop_id', $shopId)->where('user_id', $user->id)->first();
        if ($reservation) {
            $reservation->delete();
        }

        return back();
    }

    public function update(ReservationRequest $request, $shopId)
    {
        $reservation = Reservation::find($shopId);
        $reservation->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number' => $request->input('number'),
        ]);

        return redirect()->route('mypage');
    }
}
