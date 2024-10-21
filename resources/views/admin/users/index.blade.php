@extends('admin.inc.sidebar')
@section('title', 'Users')

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
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content p-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="usersTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            <a
                                                href="{{ route('users.index', ['sort' => 'id', 'direction' => ($sortField === 'id' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                <span>ID</span>
                                            </a>
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            <a
                                                href="{{ route('users.index', ['sort' => 'name', 'direction' => ($sortField === 'name' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                <span>Name</span>
                                            </a>
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            <a
                                                href="{{ route('users.index', ['sort' => 'email', 'direction' => ($sortField === 'email' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                <span>Email</span>
                                            </a>
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            <a
                                                href="{{ route('users.index', ['sort' => 'phone', 'direction' => ($sortField === 'phone' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                <span>Phone</span>
                                            </a>
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            <a
                                                href="{{ route('users.index', ['sort' => 'address', 'direction' => ($sortField === 'address' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                <span>Address</span>
                                            </a>
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            <a
                                                href="{{ route('users.index', ['sort' => 'role', 'direction' => ($sortField === 'role' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                <span>Role</span>
                                            </a>
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="align-middle">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $user->id }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('users.show', $user->id) }}">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->name }}</span>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $user->email }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $user->userMeta->phone ?? '' }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $user->userMeta->address ?? '' }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $user->userMeta->role ?? '' }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('users.edit', $user->id) }}" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    <button class="button-warning"><i class="fa fa-edit"></i></button>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="button-danger" type="submit" data-toggle="tooltip"
                                                        data-original-title="Delete user"
                                                        onclick="return confirm('Are you sure you want to delete this user?');">
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
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div>
                            {{ $users->links('pagination::bootstrap-5') }} <!-- Pagination -->
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
        email: 1,
        phone: 1,
        address: 1,
        role: 1
    };

    function sortTable(column) {
        const table = document.getElementById('usersTable');
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
            } else if (column === 'email') {
                tdA = a.getElementsByTagName('td')[2].innerText;
                tdB = b.getElementsByTagName('td')[2].innerText;
            } else if (column === 'phone') {
                tdA = a.getElementsByTagName('td')[3].innerText;
                tdB = b.getElementsByTagName('td')[3].innerText;
            } else if (column === 'address') {
                tdA = a.getElementsByTagName('td')[4].innerText;
                tdB = b.getElementsByTagName('td')[4].innerText;
            } else if (column === 'role') {
                tdA = a.getElementsByTagName('td')[5].innerText;
                tdB = b.getElementsByTagName('td')[5].innerText;
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