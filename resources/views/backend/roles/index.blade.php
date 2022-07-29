@extends('layouts.adminlayout')

@section('content')
<div class="page-inner ad-inr">
    
<section class="main-wrapper">
    <div class="page-color">
        <div class="page-header">
            <div class="page-title">
                <span>Roles &amp; Permissions</span>
            </div>


            <div class="page-btn">
                <a href="{{ route('role.create') }}" class="add-btn">Add Role</a>
            </div>
            <div class="page-btn">
                <a href="{{ route('permission.create') }}" class="add-btn">Add Permission</a>
            </div>
        </div>
    
    <div class="page-table" id="">
        <table id="example" class="table-bordered  " style="width:100%;">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody id="result">
                @php $i = 0; @endphp
                @foreach ($roles as $role)
                <tr>
                    <td>@php echo ++$i @endphp</td>
                    <td>{{ $role->name }}</td>
                    @foreach ($role->permissions as $permission)
                    <td class="sorting_1">{{ $permission->name }}</td>
                    @endforeach
                    <td>
                        <div class="d-flex">
                            <button class="edit-btn">
                                <a class="" href="{{ route('role.edit',$role->id) }}">
                                    <img src="{{url('/')}}/assets/image/feather-edit.svg" width="16px" alt=""></a>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</section>
@endsection