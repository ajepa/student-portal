@extends('layouts.master')

@section('head')

@stop

@section('title')
   Subject : <b> {{ $subject->subject_name }}</b>
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">Subject  : <b> {{ $subject->subject_name }}</b></a>
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
	                <span class="caption-subject font-white sbold uppercase">Subject  : <b> {{ $subject->subject_name }}</b></span>
	            </div>
	        </div>
                
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                            <th> # </th>
	                            <th> Student Name </th>
                              	<th> Quiz </th>
                              	<th> Midterm </th>
                              	<th> Assignment </th>
                              	<th> Mini Project </th>
                              	<!-- <th> Total / 100 </th> -->
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
                          <?php $count = 1; ?>
	                        @foreach($student_assessments as $student_assessment)
	                        <?php $total = 0; $total = (($student_assessment->quiz + $student_assessment->midterm + $student_assessment->assignment + $student_assessment->mini_project) / 400) * 100; ?>
	                        <tr>
	                            <td> {{ $count }} </td>
	                            <td> {{ $student_assessment->student_name }}</td>
	                            <td>
                                	<input form="form_create" type="text" class="form-control input-line" style="width: 50px;" name="quiz[<?php echo $count; ?>]" value="{{ $student_assessment->quiz }}">
                              	</td>
                              	<td>
                                	<input form="form_create" type="text" class="form-control input-line" style="width: 50px;" name="midterm[<?php echo $count; ?>]" value="{{ $student_assessment->midterm }}">
                              	</td>
                              	<td>
                                	<input form="form_create" type="text" class="form-control input-line" style="width: 50px;" name="assignment[<?php echo $count; ?>]" value="{{ $student_assessment->assignment }}">
                              	</td>
                              	<td>
                                	<input form="form_create" type="text" class="form-control input-line" style="width: 50px;" name="mini_project[<?php echo $count; ?>]" value="{{ $student_assessment->mini_project }}">
                              	</td>
                              	<!-- <td>
                                	<input type="text" class="form-control input-line" style="width: 80px;" value="{{ $total }}" readonly="">
                              	</td> -->
	                        </tr>

	                        <input form="form_create" type="hidden" name="sm_ids[<?php echo $count; ?>]" value="{{ $student_assessment->subject_marks_id }}">
                            <input form="form_create" type="hidden" name="s_id[<?php echo $count; ?>]" value="{{ $student_assessment->student_id }}">

	                        <?php $count++ ?>

	                        
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>

	            <div class="row">
		        	<div class="col-md-12">
		        		{!! Form::open(['method'=>'POST', 'action'=>['LecturerController@processStudentSubjectMarks'], 'id'=>'form_create']) !!}
                  			<input form="form_create" type="hidden" name="subject_id" value="{{ $subject->id }}">
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