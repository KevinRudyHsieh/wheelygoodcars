<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount(['cars as total_stock' => function ($query) {
            $query->whereNull('sold_at'); // Voorraad
        },
        'cars as total_sold' => function ($query) {
            $query->whereNotNull('sold_at'); // Verkocht
        }
        ])->get();

        return view('tags.index', compact('tags'));
    }
}
