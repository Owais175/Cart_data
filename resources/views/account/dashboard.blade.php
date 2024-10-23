@extends('layouts.main')

@section('content')
    <section class="dashboard-pg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('Success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('Success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-lg-3">
                    @include('account/dashboard-sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="dashborad-main">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
