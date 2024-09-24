<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'News Website')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">CodzSword</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('admin.index')}}" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Categories
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{route('categories.index')}}" class="sidebar-link"><i
                                        class="fa-solid fa-file-lines pe-2"></i>
                                    List Categories
                                </a>
                            </li>
                            <li class="sidebar-item">
                               <a href="{{route('categories.create')}}" class="sidebar-link"><i
                                        class="fa-solid fa-file-lines pe-2"></i>
                                    Create Category
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('categories.index')}}" class="sidebar-link">
                            <i class="fa-solid fa-product-hunt pe-2"></i>
                            Products
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('categories.index')}}" class="sidebar-link">
                            <i class="fa-solid fa-user pe-2"></i>
                            Users
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('categories.index')}}" class="sidebar-link">
                            <i class="fa-solid fa-shopping-cart pe-2"></i>
                            Orders
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        @yield('content')

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>