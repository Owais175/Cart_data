@extends('layouts.main')


@section('content')
    <section class="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="link_page">
                        <ul>
                            <li>
                                <a href="{{ route('attributesvalues.create') }}" class="btn btn-success">User Create</a>
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
                <div class="col-lg-12">
                    @if (session()->has('Success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('Success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="main_attributes_table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Attribute Id</th>
                                    <th>Attribute Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attributesvalues as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->attributes_id }}</td>
                                        <td>{{ $value->value }}</td>
                                        <td>
                                            <div class="d-inline">
                                                <a href="{{ route('attributesvalues.edit', $value->id) }}"
                                                    class="btn btn-success">Edit</a>
                                                <form action="{{ route('attributesvalues.delete', $value->id) }}"
                                                    method="POST" class="d-inline">
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
        </div>
    </section>
@endsection
