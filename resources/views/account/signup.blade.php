@extends('layouts.main')


@section('content')
    <section class="sign-user">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('Success'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('Success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="signin-account">
                        <h1>Sign Up</h1>
                        <form action="{{ route('account.signin') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="btn-para">
                                        <button class="btn btn-danger">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="signin-account">
                        <h1>Log In</h1>
                        <form action="{{ route('account.login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>User Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="btn-para">
                                        <button class="btn btn-danger">Log In</button>
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
