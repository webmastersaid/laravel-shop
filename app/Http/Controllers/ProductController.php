<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductImage;
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
        $groups = Group::all();
        return view('product.create', compact('tags', 'colors', 'categories', 'groups'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if (isset($data['preview_image']))
            $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
        if (isset($data['detail_image']))
            $data['detail_image'] = Storage::disk('public')->put('/images/detail', $data['detail_image']);
        $productImages = isset($data['product_images']) ? $data['product_images'] : [];
        $tagIds = isset($data['tags']) ? $data['tags'] : [];
        $colorIds = isset($data['colors']) ? $data['colors'] : [];
        unset($data['tags'], $data['colors'], $data['product_images']);
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
        foreach ($productImages as $productImage) {
            $imageCount = ProductImage::where('product_id', $product->id)->count();
            if ($imageCount > 3) break;
            $filePath = Storage::disk('public')->put('/images/product', $productImage);
            ProductImage::firstOrCreate([
                'product_id' => $product->id,
                'file_path' => $filePath,
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
        $groups = Group::all();
        return view('product.edit', compact('product', 'tags', 'colors', 'categories', 'groups'));
    }
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        if (isset($data['preview_image']))
            $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
        if (isset($data['detail_image']))
            $data['detail_image'] = Storage::disk('public')->put('/images/detail', $data['detail_image']);
        $productImages = isset($data['product_images']) ? $data['product_images'] : [];
        $tagIds = isset($data['tags']) ? $data['tags'] : [];
        $colorIds = isset($data['colors']) ? $data['colors'] : [];
        unset($data['tags'], $data['colors'], $data['product_images']);
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
        foreach ($productImages as $productImage) {
            $imageCount = ProductImage::where('product_id', $product->id)->count();
            if ($imageCount > 3) break;
            $filePath = Storage::disk('public')->put('/images/product', $productImage);
            ProductImage::firstOrCreate([
                'product_id' => $product->id,
                'file_path' => $filePath,
            ]);
        }
        $product->update($data);
        return view('product.show', compact('product'));
    }
    public function delete(Product $product)
    {
        $product->category()->dissociate();
        $product->group()->dissociate();
        $product->tags()->detach();
        $product->colors()->detach();
        $product->delete();
        return redirect()->route('product.index');
    }
}
