@extends('layouts.main')


@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('Coupons.index') }}" class="btn btn-success">Back</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="coupons_sec pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="create_form">
                        <form action="{{ route('Coupons.update', $Coupons->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="fom-group">
                                        <label>Code</label>
                                        <input type="text" class="form-control" name="code"
                                            value="{{ $Coupons->code }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="fom-group">
                                        <label>Disconut</label>
                                        <input type="number" class="form-control" name="discount"
                                            value="{{ $Coupons->discount }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="fom-group">
                                        <label>Expire</label>
                                        <input type="date" class="form-control" name="expire_at"
                                            value="{{ $Coupons->expire_at }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="btn-div">
                                        <button class="btn btn-danger" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
