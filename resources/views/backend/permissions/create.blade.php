@extends('layouts.adminlayout')

@section('content')



        <section class="main-wrapper">
            <div class="page-color">
                <div class="page-header">
                    <div class="page-title">
                    Create Permission</span>
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
                        <form  method="Post" action="{{ route('permission.store') }}" >
                        @csrf
                            <div class="form-group">
                                <label> Permission Name</label>
                                <input type="text"  name="name" 
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
                          
                                <input type="checkbox" value="{{ $role->name }}"  name="selectedroles[]" 
                                class="">
                                <span class="text-sm">
                                        {{ $role->name }}
                                    </span>
                              
                                @endforeach

                            </div>
                           
                            <div class="btn btn-box">
                                
                                <input type="submit" class="login-btn" value="Create Permission">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
<div class="page-table" id="">
        <table id="" class="table tabel-res  " style="width:100%;">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Permission</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody id="result">
                @php $i = 0; @endphp
                @foreach ($permissions as $permission)
                <tr>
                    <td>@php echo ++$i @endphp</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <div class="d-flex">
                            <button class="edit-btn">
                                <a class="" href="{{ route('permission.edit',$permission->id) }}">
                                    <img src="{{url('/')}}/assets/image/feather-edit.svg" width="16px" alt=""></a>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </section>

@endsection