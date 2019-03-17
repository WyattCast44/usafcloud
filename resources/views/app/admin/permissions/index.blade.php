@extends('app.admin.layout.base')

@section('admin-page-content')

<div class="card">

    <div class="card-header flex justify-content-between align-items-center">
        <span class="text-xl">Manage Permissions</span>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewPermissionModal">
                Create Permission
            </button>
        </div>
    </div>

    <div class="p-4 border-b border-grey-light border-solid">
        <input type="text" placeholder="Search permissions..." class="form-control">
    </div>

    <div class="card-body">

        <ul class="list-group list-group-flush">

            @forelse ($permissions as $permission)
            <li class="list-group-item">
                <div class="flex justify-content-between align-items-center">
                    <p class="text-xl m-0 text-grey-darker">{{ $permission->name }}</p>
                    <div>
                        <button class="btn btn-sm btn-outline-primary btn-rounded mr-1" type="button" data-toggle="collapse"
                            data-target="#permission-edit-{{ $permission->id }}" aria-expanded="false">
                            Edit Permission
                        </button>
                        <button class="btn btn-sm btn-outline-primary btn-rounded" type="button" data-toggle="collapse"
                            data-target="#permission-roles-{{ $permission->id }}" aria-expanded="false">
                            View Roles
                        </button>
                    </div>
                </div>
                <div class="collapse mt-3" id="permission-edit-{{ $permission->id }}">
                    <div class="card card-body">

                        <form action="{{ route('app.admin.acl.permissions.update', $permission) }}" method="POST" class="form-inline">

                            @csrf
                            @method('PATCH')

                            <label class="mr-2">Permission Name</label>
                            <input class="form-control form-control-sm mr-2" type="text" name="name" value="{{ $permission->name }}"
                                required>

                            <button type="submit" class="btn btn-primary btn-sm">Update</button>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif

                        </form>

                    </div>
                </div>
                <div class="collapse mt-3" id="permission-roles-{{ $permission->id }}">
                    <div class="card card-body">
                        <div>
                            @forelse ($permission->roles as $role)
                            <span class="badge badge-primary font-light p-2">{{ $role->name }}</span>
                            @empty
                            Not Attached to any Roles
                            @endforelse
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

<!-- Create New Permissions Modal -->
<div class="modal fade" id="createNewPermissionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form action="{{ route('app.admin.acl.permissions.store') }}" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create New Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="form-group">
                        <label class="mr-2">Permission Name</label>
                        <input class="form-control" type="text" name="name" placeholder="resource:action" required
                            autocomplete="false">
                    </div>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="resource_permission">
                        <label class="form-check-label" name="resource_permission">Resourceful Permission</label>
                        <small class="block mt-1">Creates all CRUD actions (create, view, update, destroy) for a
                            resource.</small>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
