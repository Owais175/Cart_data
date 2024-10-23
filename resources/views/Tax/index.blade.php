@extends('layouts.main')


@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('tax.create') }}" class="btn btn-success">Create</a>
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
                                <th>Tax</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tax as $taxes)
                                <tr>
                                    <td>{{ $taxes->id }}</td>
                                    <td>{{ $taxes->tax }}</td>
                                    <td>
                                        <a href="{{ route('tax.edit', $taxes->id) }}" class="btn btn-success">Edit</a>
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
