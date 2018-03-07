@extends('layouts.master')

@section('head')

@stop

@section('title')
   Department
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">Department List</a>
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
	                <span class="caption-subject font-white sbold uppercase">Department List</span>
	            </div>
	        </div>
                
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
                                    <th> <input id="checkall-checkbox" type="checkbox"> </th>
	                            <th> # </th>
	                            <th> Department Name </th>
                                <th> Created At </th>
                                <th>  </th>
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
                            <?php $count = 1; ?>
	                        @foreach($departments as $department)
	                        <?php $currentPageTotalNumber = ( $departments->currentPage() - 1) * 5; ?>
	                        <tr>
                                <td> <input class="single-checkbox" type="checkbox" name="department_id[]" form="form_delete" value="{{ $department->id }}"> </td>
	                            <td> {{ $count + $currentPageTotalNumber}} </td>
	                            <td> {{ $department->department_name }}</td>
	                            <td> {{ $department->created_at }}</td>
	                            <td> <a href="" class="btn blue editBtn" data-toggle="modal" data-target="#editModal" 
                                            data-id="{{ $department->id }}" 
                                            data-name="{{ $department->department_name }}" 
                                            data-created_at="{{ $department->created_at }}"
                                            >Edit
                                        </a>
                                    </td>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>

	            <div class="row">
		        	<div class="col-md-6">
		        		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminController@deleteDepartment'], 'id'=>'form_delete']) !!}
		        			<button type="submit" class="btn btn-sm btn-danger deleteBtn">Delete</button>
		        		{!! Form::close() !!}
		        	</div>
		        	<div class="col-md-6">
		        		<div class="pull-right">
		        			{{ $departments->render() }}
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
        <h4 class="modal-title">Update Department</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      	{!! Form::open(['method'=>'PATCH', 'action'=>'AdminController@updateDepartment']) !!}
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Department Name</label>
	            <div class="col-md-8">
	                    <input type="text" name="name" class="form-control input-line" id="m_name">
	            </div>
	        </div>
			<div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Created at</label>
	            <div class="col-md-8">
	                    <input type="text" name="" class="form-control input-line" id="m_created_at" disabled="disabled">
	            </div>
	        </div>
	        
	        <input type="hidden" name="id" id="m_department_id">
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
        <h4 class="modal-title">Department Info</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      	{!! Form::open(['method'=>'POST', 'action'=>'AdminController@createDepartment']) !!}
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Department Name</label>
	            <div class="col-md-8">
                        <input type="text" name="department_name" class="form-control input-line" id="" value="">
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
       		$("#m_department_id").val($(this).data('id'));
            $("#m_name").val($(this).data('name'));
            $("#m_created_at").val($(this).data('created_at'));
       });

    });
</script>


@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop