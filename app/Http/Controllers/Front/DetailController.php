<?php

namespace App\Http\Controllers\Front;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailController extends Controller
{   
    public function index($slug)
    {
        $item = Item::with(['type', 'brand'])->whereSlug($slug)->firstOrFail();
        $similiarItems = Item::with(['type', 'brand'])
            // ->where('type_id', $item->type_id)
            ->where('id', '!=', $item->id)
            ->get();

        return view('detail', [
            'item' => $item,
            'similiarItems' => $similiarItems
        ]);
    }
}
