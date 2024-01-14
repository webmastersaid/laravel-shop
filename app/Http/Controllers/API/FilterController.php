<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Tag;

class FilterController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $colors = Color::all();
        $tags = Tag::all();
        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;
        $result = [
            'categories' => $categories,
            'colors' => $colors,
            'tags' => $tags,
            'price' => [
                'min' => $minPrice,
                'max' => $maxPrice,
            ],
        ];
        return response()->json($result);
    }
}
