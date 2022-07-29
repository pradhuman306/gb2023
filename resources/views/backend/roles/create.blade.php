@extends('layouts.adminlayout')

@section('content')

<section class="main-wrapper">
    <div class="page-color">
        <div class="page-header">
            <div class="page-title">
                <span>Create Role</span>
            </div>
            <div class="page-btn">
                <a href="{{ route('roles-permissions') }}" class="add-btn">Back</a>
            </div>
            <div class="page-btn">
                <a href="{{ route('permission.create') }}" class="add-btn">Add Permission</a>
            </div>
       
    </div>
            <div class="profile-box">
                <div class="short-code">
                    <form action="{{ route('role.store') }}" method="POST" class="">
                        @csrf
                        <div class="form-group">
                            <label> Role Name</label>
                            <input type="text" placeholder="" name="name" id="" class="form-control">
                            @error('name')
                            <label class="error" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                            @enderror
                        </div>
                        <label> Permissions</label>
                        @foreach ($permissions as $permission)
                        <div class="flex items-center">
                            <label>
                                <input name="selectedpermissions[]" class="mr-2 leading-tight" type="checkbox" value="{{ $permission->name }}">
                                <span class="text-sm">
                                    {{ $permission->name }}
                                </span>
                            </label>
                        </div>
                        @endforeach

                        <div class="btn btn-box">
                            <input type="submit" class="login-btn" value="Create Role">
                        </div>
                    </form>
                </div>
            </div>
        
</section>
@endsection