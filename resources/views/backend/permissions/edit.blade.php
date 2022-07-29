@extends('layouts.adminlayout')

@section('content')
        <section class="main-wrapper">
            <div class="page-color">
                <div class="page-header">
                    <div class="page-title">
                    Edit Permission</span>
                    </div>
                    <div class="page-btn">
                        <a href="{{ route('roles-permissions') }}" class="add-btn">
                            <span>
                                    <img src="{{url('/')}}/assets/image/Icon-arrow-back.svg" class="btn-arrow-show" alt="">
                                    <img src="{{url('/')}}/assets/image/Icon-arrow-back-2.svg" class="btn-arrow-hide" alt="">
                                </span>
                            <span>Back</span>
                        </a>
                        <a href="{{ route('role.create') }}" class="add-btn">
                            <span>
                                    <img src="{{url('/')}}/assets/image/Icon-arrow-back.svg" class="btn-arrow-show" alt="">
                                    <img src="{{url('/')}}/assets/image/Icon-arrow-back-2.svg" class="btn-arrow-hide" alt="">
                                </span>
                            <span>Role</span>
                        </a>
                    </div>
                </div>
                <div class="profile-box">
                    <div class="short-code">
                        <form  action="{{ route('permission.update',$permission->id) }}" method="POST" >
                        @csrf
                @method('PUT')
                            <div class="form-group">
                                <label> Permission Name</label>
                                <input type="text"  name="name" value="{{ $permission->name }}"
                                class="form-control">
                                @error('name')
                            <label class="error" role="alert">
                                <strong>{{ $message }}</strong>
                            </label>
                            @enderror
                            </div>
                            <div class="">
                                <label>Roles</label>
                                @foreach ($roles as $role)
                            <div class="flex items-center">
                                <label>
                                    <input name="selectedroles[]" class="mr-2 leading-tight" type="checkbox" value="{{ $role->name }}"
                                        @foreach ($permission->roles as $item)
                                            {{ ($item->id === $role->id) ? 'checked' : '' }}
                                        @endforeach
                                    >
                                    <span class="text-sm">
                                        {{ $role->name }}
                                    </span>
                                </label>
                            </div>
                        @endforeach
                            </div>
                           
                            <div class="btn btn-box">
                                <input type="submit" value=" Update Permission"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </section>

@endsection
