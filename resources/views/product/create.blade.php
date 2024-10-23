@extends('layouts.main')


@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('product.index') }}" class="btn btn-success">User Data</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product_create">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session()->has('Success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('Success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="create_form">
                        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label>Product Name</label>
                            <input type="text" name="product_title" class="form-control"
                                value="{{ old('product_title') }}">
                            @if ($errors->has('product_title'))
                                <p class="text-warning">
                                    {{ $errors->first('product_title') }}
                                </p>
                            @endif
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control">
                            @if ($errors->has('product_image'))
                                <p class="text-warning">
                                    {{ $errors->first('product_image') }}
                                </p>
                            @endif
                            <label>Product Price</label>
                            <input type="text" name="product_price" class="form-control"
                                value="{{ old('product_price') }}">
                            @if ($errors->has('product_price'))
                                <p class="text-warning">
                                    {{ $errors->first('product_price') }}
                                </p>
                            @endif
                            <label>Product Description</label>
                            <textarea name="product_description" id="textarea" class="form-control" cols="30" rows="5">{{ old('product_description') }}</textarea>
                            @if ($errors->has('product_description'))
                                <p class="text-warning">
                                    {{ $errors->first('product_description') }}
                                </p>
                            @endif
                            <label>Product Quantity</label>
                            <div class="plus-minus counter">
                                <button type="button" class="counter-span decrement"><i
                                        class="fa-solid fa-minus"></i></button>
                                <input class="counter-span count" name="product_qty" value="{{ old('product_qty') }}"
                                    min="1" readonly>
                                <button type="button" class="counter-span increment"><i
                                        class="fa-solid fa-plus"></i></button>
                                @if ($errors->has('product_qty'))
                                    <p class="text-warning">
                                        {{ $errors->first('product_qty') }}
                                    </p>
                                @endif
                            </div>
                            <div class="btn-div">
                                <button class="btn btn-danger" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
