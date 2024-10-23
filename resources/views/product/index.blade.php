@extends('layouts.main')


@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('product.create') }}" class="btn btn-success">User Create</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="table_data">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session()->has('Success'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('Success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Product Description</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Productmodel as $items)
                                <tr>
                                    <td>{{ $items->product_title }}</td>
                                    <td>{{ $items->product_price }}</td>
                                    <td>{{ $items->product_qty }}</td>
                                    <td>{{ $items->product_description }}</td>
                                    <td><img src="{{ asset('assets/image/' . $items->product_image) }}" alt=""
                                            style="width: 50px", height="50px">
                                    </td>
                                    <td>
                                        <div class="d-inline">
                                            <a href="{{ route('product.edit', $items->id) }}"
                                                class="btn btn-success">Edit</a>
                                            <form action="{{ route('product.delete', $items->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
