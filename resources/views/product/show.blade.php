@extends('adminlte::page')

@section('title', 'Product - ' . $product->title)

@section('content_header')
<h1>product - {{ $product->title }}</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <div class="p-1">
            <a class="btn btn-primary" href="{{ route('product.edit', $product->id) }}">Edit</a>
        </div>
        <div class="p-1">
            <form action="{{ route('product.delete', $product->id) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $product->title }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td>{{ $product->content }}</td>
                </tr>
                <tr>
                    <th>Preview image</th>
                    <td>
                        <img src="{{ Storage::url($product->preview_image) }}" alt="{{ $product->preview_image }}" style="height: 100px;">
                    </td>
                </tr>
                <tr>
                    <th>Detail image</th>
                    <td>
                        <img src="{{ Storage::url($product->detail_image) }}" alt="{{ $product->detail_image }}" style="height: 100px;">
                    </td>
                </tr>
                <tr>
                    <th>Product images</th>
                    <td>
                        <img src="{{ Storage::url($product->productImages[0]->file_path) }}" alt="{{ $product->productImages[0]->file_path }}" style="height: 100px;">
                        <img src="{{ Storage::url($product->productImages[1]->file_path) }}" alt="{{ $product->productImages[1]->file_path }}" style="height: 100px;">
                        <img src="{{ Storage::url($product->productImages[2]->file_path) }}" alt="{{ $product->productImages[2]->file_path }}" style="height: 100px;">
                    </td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <th>Count</th>
                    <td>{{ $product->count }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $product->category->title }}</td>
                </tr>
                <tr>
                    <th>Group</th>
                    <td>{{ $product->group->title }}</td>
                </tr>
                <tr>
                    <th>Tags</th>
                    <td>
                        @foreach ($product->tags as $tag)
                        <div class="badge badge-primary">{{ $tag->title }}</div>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td>
                        @foreach ($product->colors as $color)
                        <div class="badge" style="background-color: #{{ $color->title }}; border: solid 1px black;">
                            #{{ $color->title }}
                        </div>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Published</th>
                    <td>{{ $product->published }}</td>
                </tr>
                <tr>
                    <th>Created</th>
                    <td>{{ $product->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated</th>
                    <td>{{ $product->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@endsection

@section('js')
<script src="{{ asset('/js/admin_custom.js') }}"></script>
@endsection