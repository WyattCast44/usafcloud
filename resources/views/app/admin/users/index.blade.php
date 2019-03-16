@extends('app.admin.layout.base')

@section('admin-page-content')

<div class="card">

    <div class="card-header flex justify-content-between align-items-center">
        <span class="text-xl">Manage Users</span>
        <div>
            <button class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#createNewPermissionModal">
                Create New User
            </button>
        </div>
    </div>

    <div class="p-4 border-b border-grey-light border-solid">
        <input type="text" placeholder="Search users..." class="form-control">
    </div>

    <div class="card-body">

        <ul class="list-group list-group-flush">

            @forelse ($users as $user)
            <li class="list-group-item">
                <div class="flex justify-content-between align-items-center">
                    <p class="text-xl m-0 text-grey-darker">{{ $user->name }}</p>
                    <div>
                        <button class="btn btn-sm btn-outline-primary btn-rounded" type="button" data-toggle="collapse"
                            data-target="#user-view-{{ $user->id }}" aria-expanded="false">
                            View Details
                        </button>
                    </div>
                </div>
                <div class="collapse mt-3" id="user-view-{{ $user->id }}">
                    <div class="card">
                        <div class="card-body">
                            <p>First Name: <span class="underline">{{ $user->first_name }}</span></p>
                            <p>Last Name: <span class="underline">{{ $user->last_name }}</span></p>
                            <p>Nickname: <span class="underline">{{ $user->nickname }}</span></p>
                            <p>Organization: <span class="underline">Active Duty USAF</span></p>
                            <p>Email Address:
                                <span class="underline">
                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </span>
                            </p>
                            <p>G-Suite Enabled: <span class="underline">No</span></p>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <li class="list-group-item">
                No items added yet
            </li>
            @endforelse

        </ul>

    </div>

</div>

@endsection
