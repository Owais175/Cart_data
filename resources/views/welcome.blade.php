@extends('layouts.main')


@section('content')
    <section class="product_add">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home_product">
                        <h1>Products</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta quas magni expedita quo
                            accusantium totam!</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    @if (!empty($query))
                        <div class="btn_show">
                            <a href="{{ route('index') }}" class="btn btn-danger">Back</a>
                        </div>
                    @endif
                </div>
                @if ($Productmodel->isEmpty())
                    <div class="machimg_product">
                        <p>No Product Found.</p>
                    </div>
                @else
                    @foreach ($Productmodel as $item)
                        <div class="col-lg-3">
                            <div class="main-product">
                                <figure>
                                    <img src="{{ asset('assets/image/' . $item->product_image) }}" class="img-fluid"
                                        alt="">
                                </figure>
                                <div class="product_info">
                                    <h5>{{ $item->product_title }}</h5>
                                    <p>Price: {{ $item->product_price }}$</p>
                                </div>
                                <div class="links_tags">
                                    <a href="{{ route('productdetails', $item->id) }}" class="btn btn-danger">View
                                        Product</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="pagination_product">
                    {{ $Productmodel->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
@endsection
