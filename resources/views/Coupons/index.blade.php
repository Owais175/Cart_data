@extends('layouts.main')


@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('Coupons.create') }}" class="btn btn-success">Create</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="table_data pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Expire</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Coupons as $code)
                                <tr>
                                    <td>{{ $code->id }}</td>
                                    <td>{{ $code->code }}</td>
                                    <td>{{ $code->discount }}</td>
                                    <td>{{ $code->expire_at }}</td>
                                    <td>
                                        <a href="{{ route('Coupons.edit', $code->id) }}" class="btn btn-success">Edit</a>
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
