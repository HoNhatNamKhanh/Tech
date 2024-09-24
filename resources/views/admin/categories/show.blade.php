<div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed
                    </th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="{{ $user->avatar }}" class="avatar avatar-sm me-3" alt="{{ $user->name }}">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                            <p class="text-xs text-secondary mb-0">{{ $user->department }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span
                                class="badge badge-sm {{ $user->status === 'Online' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                {{ $user->status }}
                            </span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $user->employed_date }}</span>
                        </td>
                        <td class="align-middle">
                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                data-original-title="Edit user">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>#
</div>