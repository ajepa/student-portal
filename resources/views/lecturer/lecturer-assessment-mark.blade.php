@extends('layouts.master')

@section('head')

@stop

@section('title')
   Assessment : <b> {{ $assessment->assessment_name }}</b>
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">Assessment  : <b> {{ $assessment->assessment_name }}</b></a>
    </li>
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet box portlet-style">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-white" style="color:white;"></i>
	                <span class="caption-subject font-white sbold uppercase">Assessment  : <b> {{ $assessment->assessment_name }}</b></span>
	            </div>
	        </div>
                
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                            <th> # </th>
	                            <th> Student Name </th>
                              <th> Marks </th>
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
                          <?php $count = 1; ?>
	                        @foreach($student_assessments as $student_assessment)
	                        <tr>
	                            <td> {{ $count }} </td>
	                            <td> {{ $student_assessment->student_name }}</td>
	                            <td>
                                <input form="form_create" type="text" class="form-control input-line" style="width: 50px;" name="marks[<?php echo $count; ?>]" value="{{ $student_assessment->marks }}">
                                <input form="form_create" type="hidden" name="sa_ids[<?php echo $count; ?>]" value="{{ $student_assessment->student_assessment_id }}">
                                <input form="form_create" type="hidden" name="s_id[<?php echo $count; ?>]" value="{{ $student_assessment->student_id }}">
                              </td>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>

	            <div class="row">
		        	<div class="col-md-12">
		        		{!! Form::open(['method'=>'POST', 'action'=>['LecturerController@processStudentMarks'], 'id'=>'form_create']) !!}
                  <input form="form_create" type="hidden" name="assessment_id" value="{{ $assessment->id }}">
		        			<button type="submit" class="btn btn-sm green pull-right">Save</button>
		        		{!! Form::close() !!}
		        	</div>
		        </div>
	        </div>
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
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
       		$("#m_assessment_id").val($(this).data('id'));
            $("#m_name").val($(this).data('name'));
            $("#m_created_at").val($(this).data('created_at'));
       });

    });
</script>


@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop