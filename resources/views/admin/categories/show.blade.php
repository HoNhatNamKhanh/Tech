@extends('admin.inc.sidebar')
@section('title', 'Category Products')

@section('content')

<div class="main">
    <nav class="navbar navbar-expand px-3 border-bottom">
        <button class="btn" id="sidebar-toggle" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                        <img src="{{ asset('image/profile.jpg') }}" class="avatar img-fluid rounded"
                            alt="Profile Picture">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Setting</a>
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <main class="content p-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-secondary">{{ $category->name }}</h2>
                <p>{{ $category->description }}</p>

                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h5>Products in this Category: </h5>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Product ID</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Product Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Price</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->products as $product)
                                        <tr>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $product->id }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $product->name }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $product->price }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $product->created_at->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('products.edit', $product->id) }}" data-toggle="tooltip"
                                                    data-original-title="Edit product">
                                                    <button class="button-warning"><i class="fa fa-edit"></i></button>
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="button-danger" type="submit" data-toggle="tooltip"
                                                        data-original-title="Delete product"
                                                        onclick="return confirm('Are you sure you want to delete this product?');">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <a href="#" class="theme-toggle">
        <i class="fa-regular fa-moon"></i>
        <i class="fa-regular fa-sun"></i>
    </a>
</div>

@endsection