<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ route('index') }}">Logo</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Blogs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('contact')}}">Contact</a>
                                </li>
                            </ul>
                            <form class="d-flex font-icon">
                                <a href="javascript:;" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"><i class="fa-solid fa-magnifying-glass"></i></a>
                                <a href="{{ route('cart.cart') }}"><i class="fa-solid fa-cart-shopping"></i>
                                    @php
                                        $count = Session::get('cart');
                                    @endphp
                                    @if ($count && count($count) > 0)
                                        <span>{{ count($count) }}</span>
                                    @endif
                                </a>
                                {{-- <a href="javascript:;" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                                        class="fa-solid fa-cart-shopping"></i>
                                    @php
                                        $count = Session::get('cart');
                                    @endphp
                                    @if ($count && count($count) > 0)
                                        <span>{{ count($count) }}</span>
                                    @endif
                                </a> --}}
                                @if (auth()->check())
                                    <a href="{{ route('account.dashboard') }}"><i class="fa-solid fa-user"></i></a>
                                @else
                                    <a href="{{ route('account.signup') }}"><i class="fa-solid fa-user-plus"></i></a>
                                @endif
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
