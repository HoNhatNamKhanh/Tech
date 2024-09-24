@extends('admin.inc.sidebar')
@section('title', 'Categor')

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
                        <img src="{{ asset('image/profile.jpg') }}" class="avatar img-fluid rounded" alt="">
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
    <main class="content px-3 py-2">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="categoriesTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <a
                                                href="{{ route('categories.index', ['sort' => 'id', 'direction' => ($sortField === 'id' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                ID
                                            </a>
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            <a
                                                href="{{ route('categories.index', ['sort' => 'name', 'direction' => ($sortField === 'name' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                Name
                                            </a>
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <a
                                                href="{{ route('categories.index', ['sort' => 'parent_id', 'direction' => ($sortField === 'parent_id' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                Parent Category
                                            </a>
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <a
                                                href="{{ route('categories.index', ['sort' => 'created_at', 'direction' => ($sortField === 'created_at' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                Created At
                                            </a>
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $category->id }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $category->name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $category->description }}</p>
                                            </td>
                                            <td class="align-middle">
                                                {{ $category->parent ? $category->parent->name : 'N/A' }}
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $category->created_at->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit category">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div>
                            {{ $categories->links('pagination::bootstrap-5') }} <!-- Phân trang -->
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

<script>
    let sortDirection = {
        id: 1,
        name: 1,
        parent: 1,
        created_at: 1
    };

    function sortTable(column) {
        const table = document.getElementById('categoriesTable');
        const tbody = table.getElementsByTagName('tbody')[0];
        const rows = Array.from(tbody.getElementsByTagName('tr'));

        rows.sort((a, b) => {
            let tdA, tdB;

            if (column === 'id') {
                tdA = parseInt(a.getElementsByTagName('td')[0].innerText);
                tdB = parseInt(b.getElementsByTagName('td')[0].innerText);
            } else if (column === 'name') {
                tdA = a.getElementsByTagName('td')[1].innerText;
                tdB = b.getElementsByTagName('td')[1].innerText;
            } else if (column === 'parent') {
                tdA = a.getElementsByTagName('td')[3].innerText;
                tdB = b.getElementsByTagName('td')[3].innerText;
            } else if (column === 'created_at') {
                tdA = new Date(a.getElementsByTagName('td')[4].innerText.split('/').reverse().join('-'));
                tdB = new Date(b.getElementsByTagName('td')[4].innerText.split('/').reverse().join('-'));
            }

            if (tdA < tdB) return -1 * sortDirection[column];
            if (tdA > tdB) return 1 * sortDirection[column];
            return 0;
        });

        sortDirection[column] *= -1;

        rows.forEach(row => tbody.appendChild(row));
    }
</script>

@endsection