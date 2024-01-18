@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Orders</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Products</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Total price</th>
                        <th>Payment status</th>
                        <th>Ordered</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td class="table-responsive" style="height: 200px;">
                                @foreach (json_decode($order->products) as $product)
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product.show', $product->id) }}">
                                                        <img src="{{ $product->preview_image }}" alt="{{ $product->title }}"
                                                            width="200">
                                                    </a>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="{{ route('product.show', $product->id) }}">
                                                            {{ $product->title }}
                                                        </a>
                                                    </div>
                                                    <div>
                                                        Price: $ {{ $product->price }}
                                                    </div>
                                                    <div>
                                                        Quantity: {{ $product->qty }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->user->address }}</td>
                            <td>$ {{ $order->total_price }}</td>
                            <td>{{ $order->paymentStatusTitle }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
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
