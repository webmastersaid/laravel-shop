@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Products</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('product.create') }}">Add</a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Content</th>
                        <th>Preview image</th>
                        <th>Detail image</th>
                        <th>Price</th>
                        <th>Count</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Color</th>
                        <th>Published</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><a href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a></td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->content }}</td>
                            <td>
                                <img src="{{ Storage::url($product->preview_image) }}" alt="{{ $product->preview_image }}"
                                    style="width: 100%; height: 16px;">
                            </td>
                            <td>
                                <img src="{{ Storage::url($product->detail_image) }}" alt="{{ $product->detail_image }}"
                                    style="width: 100%; height: 16px;">
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->count }}</td>
                            <td>{{ $product->category->title }}</td>
                            <td>
                                <div class="row">
                                    @foreach ($product->tags as $tag)
                                        <div class="col badge badge-primary mb-1">{{ $tag->title }}</div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    @foreach ($product->colors as $color)
                                        <div class="col badge mb-1"
                                            style="background-color: #{{ $color->title }}; border: solid 1px black;">
                                            #{{ $color->title }}</div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $product->published }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                        </tr>
                    @endforeach
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
