<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }
    public function create()
    {
        $tags = Tag::all();
        $colors = Color::all();
        $categories = Category::all();
        return view('product.create', compact('tags', 'colors', 'categories'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if (isset($data['preview_image']))
            $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
        if (isset($data['detail_image']))
            $data['detail_image'] = Storage::disk('public')->put('/images/detail', $data['detail_image']);
        $tagIds = isset($data['tags']) ? $data['tags'] : [];
        $colorIds = isset($data['colors']) ? $data['colors'] : [];
        unset($data['tags'], $data['colors']);
        $product = Product::firstOrCreate([
            'title' => $data['title']
        ], $data);
        foreach ($tagIds as $tagId) {
            ProductTag::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $tagId,
            ]);
        }
        foreach ($colorIds as $colorId) {
            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorId,
            ]);
        }
        return redirect()->route('product.index');
    }
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }
    public function edit(Product $product)
    {
        $tags = Tag::all();
        $colors = Color::all();
        $categories = Category::all();
        return view('product.edit', compact('product', 'tags', 'colors', 'categories'));
    }
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        if (isset($data['preview_image']))
            $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
        if (isset($data['detail_image']))
            $data['detail_image'] = Storage::disk('public')->put('/images/detail', $data['detail_image']);
        
        $tagIds = isset($data['tags']) ? $data['tags'] : [];
        $colorIds = isset($data['colors']) ? $data['colors'] : [];
        unset($data['tags'], $data['colors']);
        $product = Product::firstOrCreate([
            'title' => $data['title']
        ], $data);
        foreach ($tagIds as $tagId) {
            ProductTag::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $tagId,
            ]);
        }
        foreach ($colorIds as $colorId) {
            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorId,
            ]);
        }
        $product->update($data);
        return view('product.show', compact('product'));
    }
    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
