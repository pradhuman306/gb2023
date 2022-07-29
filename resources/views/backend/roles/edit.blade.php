@extends('layouts.adminlayout')

@section('content')
<section class="main-wrapper">
    <div class="page-color">
        <div class="page-header">
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Edit Role</h2>
            </div>
            <div class="page-btn">
                        <a href="{{ route('roles-permissions') }}" class="">
                            <span>
                                    <img src="{{url('/')}}/assets/image/Icon-arrow-back.svg" class="btn-arrow-show" alt="">
                                    <img src="{{url('/')}}/assets/image/Icon-arrow-back-2.svg" class="btn-arrow-hide" alt="">
                                </span>
                            <span>Back</span>
                        </a>
                    </div>
    
                <a href="{{ route('role.create') }}" class="">
                <span>
                Role
                   </span>
                </a>
                <a href="{{ route('permission.create') }}" class="">
                <span>
                Permission
                   </span>
                </a>
            </div>
        </div>

        <div class="profile-box">
        <div class="short-code">
            <form action="{{ route('role.update',$role->id) }}" method="POST" class="">
            @csrf
                @method('PUT')
                <div class="form-group">
                                <label> Role Name</label>
                                <input type="text" placeholder="" name="name" id=""
                                class="form-control" value="{{ $role->name }}">
                                @error('name')
                            <label class="error" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                            @enderror
                            </div>
                            <label>  Permissions</label>
                            @foreach ($permissions as $permission)
                            <div class="flex items-center">
                            <label>
                                    <input name="selectedpermissions[]" class="mr-2 leading-tight" type="checkbox" value="{{ $permission->name }}"
                                        @foreach ($role->permissions as $item)
                                            {{ ($item->id === $permission->id) ? 'checked' : '' }}
                                        @endforeach
                                    >
                                    <span class="text-sm">
                                        {{ $permission->name }}
                                    </span>
                                </label>
                                </div>
                        @endforeach
                    </div>
                    <div class="btn btn-box">
                                <button type="submit" class="cstm-btn margin-top-15">   Update Role</button>
                            </div>
                        </form>
                
   
@endsection