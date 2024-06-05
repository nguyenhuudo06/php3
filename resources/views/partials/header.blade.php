<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">90 Ha Huy Tap</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">nguyenhuudo1206@gmail.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('users.home') }}" class="navbar-brand">
                <h1 class="text-primary display-6">Do Shop</h1>
            </a>

            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>

            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('users.home') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route('users.products.index') }}" class="nav-item nav-link">Product</a>
                </div>
                @if(Auth::id() > 0)
                
                <div class="navbar-nav ml-auto">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-shopping-cart"
                            aria-hidden="true"></i></a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-user" aria-hidden="true"></i></a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0 end-0">
                            <a href="#" class="dropdown-item">Cart</a>
                            <a href="#" class="dropdown-item">Order</a>
                            <a href="#" class="dropdown-item">Information</a>
                            <a href="{{ route('auth.logout') }}" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="navbar-nav ml-auto">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-shopping-cart"
                            aria-hidden="true"></i></a>
                    <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                </div>
                @endif
            </div>
        </nav>
    </div>
</div>
