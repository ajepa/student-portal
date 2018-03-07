@extends('layouts.master')

@section('head')

@stop

@section('title')
   List of User
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">List of User</a>
    </li>
@stop

@section('content')

<div class="row">
        <div class="col-md-12 ">
            <a href="" class="btn yellow pull-right addBtn" data-toggle="modal" data-target="#addModal" style="margin-bottom: 15px;">Add</a>
        </div>
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box portlet-style">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-calendar font-white" style="color:white;"></i>
                    <span class="caption-subject font-white sbold uppercase">List of User</span>
                </div>
            </div>
                
            <div class="portlet-body">
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr class="uppercase">
                                    <th> <input id="checkall-checkbox" type="checkbox"> </th>
                                <th> # </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Department </th>
                                <th> Role </th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php $count = 1; ?>
                            @foreach($users as $user)
                            <?php $currentPageTotalNumber = ( $users->currentPage() - 1) * 5; ?>
                            <tr>
                                    <td> <input class="single-checkbox" type="checkbox" name="user_id[]" form="form_delete" value="{{ $user->id }}"> </td>
                                <td> {{ $count + $currentPageTotalNumber}} </td>
                                <td> {{ $user->name }}</td>
                                <td> {{ $user->email }}</td>
                                <td> {{ $user->department }}</td>
                                <td> <?php if($user->roles == 1){ echo 'Admin'; } else { echo "Lecturer"; } ?></td>
                                <td> <a href="" class="btn blue editBtn" data-toggle="modal" data-target="#editModal" 
                                            data-id="{{ $user->id }}" 
                                            data-name="{{ $user->name }}" 
                                            data-email="{{ $user->email }}"  
                                            data-department="{{ $user->department }}" 
                                            data-roles="{{ $user->roles }}"
                                            >Edit
                                        </a>
                                        @if($user->roles == 2)
                                        <a href="admin-lecturer-subject/{{ $user->id }}" class="btn" style="background-color: #d64635; color:white;"> + Subject </a>
                                        @endif
                                    </td>
                            </tr>
                            <?php $count++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminController@deleteUser'], 'id'=>'form_delete']) !!}
                            <button type="submit" class="btn btn-sm btn-danger deleteBtn">Delete</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $users->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Info</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        {!! Form::open(['method'=>'PATCH', 'action'=>'AdminController@updateUser']) !!}
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Name</label>
                <div class="col-md-8">
                        <input type="text" name="name" class="form-control input-line" id="m_name">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Email</label>
                <div class="col-md-8">
                        <input type="text" name="email" class="form-control input-line" id="m_email" >
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Department</label>
                <div class="col-md-8">
                        <input type="text" name="department" class="form-control input-line" id="m_department" >
                </div>
            </div>
                <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Role</label>
                <div class="col-md-8">
                        <select name="roles" class="form-control input-line" id="m_roles_id" >
                                <option value="1">Admin</option>
                                <option value="2">Lecturer</option>
                            </select>
                </div>
            </div>
            <input type="hidden" name="id" id="m_user_id">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>

<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Info</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminController@createUser']) !!}
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Name</label>
                <div class="col-md-8">
                        <input type="text" name="name" class="form-control input-line" id="" value="{{ old('name') }}">
                </div>
            </div>
        <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Email</label>
                <div class="col-md-8">
                        <input type="text" name="email" class="form-control input-line" id="" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Department</label>
                <div class="col-md-8">
                        <input type="text" name="fakulti" class="form-control input-line" id="" value="{{ old('fakulti') }}">
                </div>
            </div>
                <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Role</label>
                <div class="col-md-8">
                        <select name="roles" class="form-control input-line" id="" >
                                <option value="0"></option>
                                <option value="1">Admin</option>
                                <option value="2">Lecturer</option>
                            </select>
                </div>
            </div>
                <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Password</label>
                <div class="col-md-8">
                        <input type="password" name="password" class="form-control input-line" id="" >
                </div>
            </div>
                <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-8">
                        <input type="password" name="password_confirmation" class="form-control input-line" id="" >
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>

<div id="addSubject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Info</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Name</label>
                <div class="col-md-8">
                        <input type="text" name="name" class="form-control input-line" id="m_name">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Email</label>
                <div class="col-md-8">
                        <input type="text" name="email" class="form-control input-line" id="m_email" >
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Department</label>
                <div class="col-md-8">
                        <input type="text" name="department" class="form-control input-line" id="m_department" >
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Role</label>
                <div class="col-md-8">
                        <select name="roles" class="form-control input-line" id="m_roles_id" >
                                <option value="1">Admin</option>
                                <option value="2">Lecturer</option>
                            </select>
                </div>
            </div>
            <input type="hidden" name="id" id="m_user_id">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>

  </div>
</div>
@stop

@section('script')

<script src="../../assets/global/plugins/icheck/icheck.min.js"></script>

<script src="../../assets/admin/pages/scripts/form-icheck.js"></script>

<script> FormiCheck.init();  </script>

<script>
    $(document).ready(function(){
       $('#checkall-checkbox').click(function(){
            if(this.checked){
                $('.checker').find('span').addClass('checked');
                $("input.single-checkbox").prop('checked', true).show();
            }
            else{
                $('.checker').find('span').removeClass('checked');
                $("input.single-checkbox").prop('checked', false);
            }
       });

       $('.editBtn').click(function(){
            $("#m_user_id").val($(this).data('id'));
            $("#m_name").val($(this).data('name'));
            $("#m_email").val($(this).data('email'));
            $("#m_department").val($(this).data('department'));
            $("#m_roles").val($(this).data('roles'));
       });

    });
</script>


@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop