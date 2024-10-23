@extends('layouts.main')


@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('product.index') }}" class="btn btn-success">Back</a>
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
                        <form action="{{ route('product.update', $Productmodel->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <label>Product Name</label>
                            <input type="text" name="product_title" class="form-control"
                                value="{{ $Productmodel->product_title }}">
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control">
                            <img src="{{ asset('assets/image/' . $Productmodel->product_image) }}" alt=""
                                style="width: 100px", height="100px">
                            <label>Product Price</label>
                            <input type="text" name="product_price" class="form-control"
                                value="{{ $Productmodel->product_price }}">
                            <label>Product Description</label>
                            <textarea name="product_description" id="textarea" class="form-control" cols="30" rows="5">{{ $Productmodel->product_description }}</textarea>
                            <label>Product Quantity</label>
                            <div class="plus-minus counter">
                                <button type="button" class="counter-span decrement"><i
                                        class="fa-solid fa-minus"></i></button>
                                <input class="counter-span count" name="product_qty"
                                    value="{{ $Productmodel->product_qty }}" min="1" readonly>
                                <button type="button" class="counter-span increment"><i
                                        class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="btn-div">
                                <button class="btn btn-danger" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
