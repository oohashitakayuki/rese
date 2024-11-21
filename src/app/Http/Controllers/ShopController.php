<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index', ['shops' => $shops, 'areas' => $areas, 'genres' => $genres]);
    }

    public function search(Request $request)
    {
        $shops = Shop::with(['area', 'genre'])->AreaSearch($request->area_id)->GenreSearch($request->genre_id)
                ->KeywordSearch($request->keyword)->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact('shops', 'areas', 'genres'));
    }

    public function show(Request $request, $id)
    {
        $shop = Shop::where('id',$id)->first();

        $previousUrl = $request->headers->get('referer') ?? route('index');
        if (strpos($previousUrl, url('/')) === false) {
            $previousUrl = route('index');
        }

        return view('detail', compact('shop', 'previousUrl'));
    }
}
