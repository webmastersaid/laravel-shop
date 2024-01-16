@extends('adminlte::page')

@section('title', 'Edit product - ' . $product->title)

@section('content_header')
    <h1>Edit product - {{ $product->title }}</h1>
@endsection

@section('content')
    <div class="card card-primary">
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group col-md-6">
                    <label for="productName">Name</label>
                    <input type="text" value="{{ old('title', $product->title) }}" name="title" class="form-control"
                        id="productName" placeholder="{{ old('title', $product->title) }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="productDescription">Description</label>
                    <input type="text" value="{{ old('description', $product->description) }}" name="description"
                        class="form-control" id="productDescription"
                        placeholder="{{ old('description', $product->description) }}">
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="productContent">Content</label>
                    <textarea name="content" class="form-control" id="productContent" placeholder="{{ old('content', $product->content) }}">
                        {{ old('content', $product->content) }}
                    </textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputFile">Preview image</label>
                    <div>
                        <img src="{{ Storage::url($product->preview_image) }}" alt="{{ $product->preview_image }}"
                            height="100">
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" value="{{ old('preview_image', $product->preview_image) }}"
                                name="preview_image" class="custom-file-input" id="previewImage"
                                placeholder="{{ old('preview_image', $product->preview_image) }}">
                            <label class="custom-file-label"
                                for="previewImage">{{ old('preview_image', $product->preview_image) }}</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    @error('preview_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputFile">Detail image</label>
                    <div>
                        <img src="{{ Storage::url($product->detail_image) }}" alt="{{ $product->detail_image }}"
                            height="100">
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" value="{{ old('detail_image', $product->detail_image) }}"
                                name="detail_image" class="custom-file-input" id="detailImage"
                                placeholder="{{ old('detail_image', $product->detail_image) }}">
                            <label class="custom-file-label"
                                for="detailImage">{{ old('detail_image', $product->detail_image) }}</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    @error('detail_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Product images</label>
                    @foreach ($product->productImages as $key => $productImage)
                        <div>
                            <img src="{{ Storage::url($productImage->file_path) }}"
                                alt="{{ $productImage->file_path }}" height="100">
                            <span>{{ old('product_images['.$key.']', $productImage->file_path) }}</span>
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file"
                                    value="{{ old('product_images['.$key.']', $productImage->file_path) }}"
                                    name="product_images[{{$key}}]" class="custom-file-input" id="productImage_{{ $productImage->id }}"
                                    placeholder="{{ old('product_images['.$key.']', $productImage->file_path) }}">
                                <label class="custom-file-label" for="productImage_{{ $productImage->id }}">
                                    Choose image
                                </label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    @endforeach
                    @error('detail_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="productPrice">Price</label>
                    <input type="text" value="{{ old('price', $product->price) }}" name="price" class="form-control"
                        id="productPrice" placeholder="{{ old('price', $product->price) }}">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="productCount">Count</label>
                    <input type="text" value="{{ old('count', $product->count) }}" name="count" class="form-control"
                        id="productCount" placeholder="{{ old('count', $product->count) }}">
                    @error('count')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option selected disabled>Not selected</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Group</label>
                    <select class="form-control" name="group_id">
                        <option selected disabled>Not selected</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}"
                                {{ old('group_id', $product->group_id) == $group->id ? 'selected' : '' }}>
                                {{ $group->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('group_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Tags</label>
                    <select class="form-control" name="tags[]" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @foreach ($product->tags as $productTags)
                                {{ $tag->id == $productTags->id ? 'selected' : '' }} @endforeach>
                                {{ $tag->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('tags')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Colors</label>
                    <select class="form-control" name="colors[]" multiple>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}" style="border-left: solid 21px #{{ $color->title }};"
                                @foreach ($product->colors as $productColor)
                                {{ $color->id == $productColor->id ? 'selected' : '' }} @endforeach>
                                #{{ $color->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('colors')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Published</label>
                    <select class="form-control" name="is_published">
                        <option value="1" {{ $product->published == 'Yes' ? 'selected' : '' }}>
                            Yes
                        </option>
                        <option value="0" {{ $product->published == 'No' ? 'selected' : '' }}>
                            No
                        </option>
                    </select>
                    @error('is_published')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/admin_custom.js') }}"></script>
@endsection
