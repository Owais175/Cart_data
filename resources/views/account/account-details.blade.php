@extends('layouts.main')


@section('content')
    <section class="dashboard-pg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('account/dashboard-sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="dashborad-main">
                        <h1>Account Details</h1>
                    </div>
                    <div class="details-show">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    @if (session()->has('Success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session()->get('Success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session()->has('Error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session()->get('Error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="last-name" class="required">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="<?php echo Auth::user()->name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="required">Email Addres</label>
                                        <input type="email" class="form-control" name="email"
                                            value="<?php echo Auth::user()->email; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="forg-pasd">
                            <a href="javascript:;" onclick="openchange()">Forget password</a>
                        </div>
                        <form action="{{ route('account.updateaccount') }}" method="POST" id="openform"
                            style="display: none;">
                            @csrf
                            <div class="row">
                                <div class="pass-word">
                                    <h1>Password Change</h1>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="crnt-pwd" class="required">Current
                                            Password</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="new-pwd" class="required">New
                                            Password</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="confirm-pwd" class="required">Confirm
                                            Password</label>
                                        <input type="password" class="form-control" name="new_password_confirmation"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item mb-4 mt-3">
                                <button class="btn btn-success">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script>
        function openchange() {
            document.getElementById('openform').style.display = "block";
        }
    </script>
@endsection
