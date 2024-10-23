@extends('layouts.main')

@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('attributesvalues.index') }}" class="btn btn-success">User Data</a>
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
                        <form action="{{ route('attributesvalues.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label>Attribute Id</label>
                            <select type="text" class="form-control" name="attributes_id" required>
                                <option value="">Select Value</option>
                                <option value="Color">Color</option>
                                <option value="Size">Size</option>
                            </select>
                            @if ($errors->has('attributes_id'))
                                <p class="text-warning">
                                    {{ $errors->first('attributes_id') }}
                                </p>
                            @endif
                            <label>Attribute Value</label>
                            <input type="text" class="form-control" name="value" placeholder="Attribute Value"
                                required>
                            @if ($errors->has('value'))
                                <p class="text-warning">
                                    {{ $errors->first('value') }}
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
