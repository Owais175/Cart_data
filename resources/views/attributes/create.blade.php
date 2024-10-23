@extends('layouts.main')

@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('attributes.index') }}" class="btn btn-success">User Data</a>
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
                        <form action="{{ route('attributes.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label>Attribute Code</label>
                            <input name="code" class="form-control" id="size" placeholder=""
                                value="{{ old('code') }}" required>
                            @if ($errors->has('code'))
                                <p class="text-warning">
                                    {{ $errors->first('code') }}
                                </p>
                            @endif
                            <label>Attribute Name</label>
                            <input name="name" class="form-control" id="size" placeholder=""
                                value="{{ old('name') }}" required>

                            @if ($errors->has('name'))
                                <p class="text-warning">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
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
