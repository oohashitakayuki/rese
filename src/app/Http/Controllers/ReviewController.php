<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request, $shopId)
    {
        $user = \Auth::User();
        if (!$user->is_review($shopId)) {
            $user->reviews()->create([
                'shop_id' => $shopId,
                'star'    => $request->input('star'),
                'comment' => $request->input('comment'),
            ]);
        }

        return redirect()->route('mypage');
    }
}