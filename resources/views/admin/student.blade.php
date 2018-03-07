@extends('layouts.master')

@section('head')

@stop

@section('title')
   List of Student
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">List of Student</a>
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
                    <span class="caption-subject font-white sbold uppercase">List of Student</span>
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
                                <th> Semester </th>
                                <th> Department </th>
                                <th> Course </th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php $count = 1; ?>
                            @foreach($students as $student)
                            <?php $currentPageTotalNumber = ( $students->currentPage() - 1) * 5; ?>
                            <tr>
                                    <td> <input class="single-checkbox" type="checkbox" name="student_id[]" form="form_delete" value="{{ $student->id }}"> </td>
                                <td> {{ $count + $currentPageTotalNumber}} </td>
                                <td> {{ $student->student_name }}</td>
                                <td> {{ $student->student_sem }}</td>
                                <td> {{ $student->student_department }}</td>
                                <td> {{ $student->student_course }}</td>
                                <td> <a href="" class="btn blue editBtn" data-toggle="modal" data-target="#editModal" 
                                            data-id="{{ $student->id }}" 
                                            data-name="{{ $student->student_name }}" 
                                            data-sem="{{ $student->student_sem }}"  
                                            data-department="{{ $student->student_department }}" 
                                            data-course="{{ $student->student_course }}"
                                            >Edit
                                        </a>
                                        <a href="admin-student-subject/{{ $student->id }}" class="btn" style="background-color: #d64635; color:white;"> + Subject </a>
                                    </td>
                            </tr>
                            <?php $count++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminController@deleteStudent'], 'id'=>'form_delete']) !!}
                            <button type="submit" class="btn btn-sm btn-danger deleteBtn">Delete</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $students->render() }}
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
        {!! Form::open(['method'=>'PATCH', 'action'=>'AdminController@updateStudent']) !!}
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Name</label>
                <div class="col-md-8">
                        <input type="text" name="student_name" class="form-control input-line" id="m_name">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Semester</label>
                <div class="col-md-8">
                        <input type="text" name="student_sem" class="form-control input-line" id="m_sem" >
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Department</label>
                <div class="col-md-8">
                        <select name="student_department" class="form-control input-line" id="m_department" >
                            <option value=""></option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                </div>
            </div>
                <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Course</label>
                <div class="col-md-8">
                        <select name="student_course" class="form-control input-line" id="m_course" >
                            <option value=""></option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <input type="hidden" name="id" id="m_student_id">
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
        <h4 class="modal-title">Student Info</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminController@createStudent']) !!}
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Name</label>
                <div class="col-md-8">
                        <input type="text" name="student_name" class="form-control input-line" id="" value="{{ old('student_name') }}">
                </div>
            </div>
        <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Semester</label>
                <div class="col-md-8">
                        <input type="text" name="student_sem" class="form-control input-line" id="" value="{{ old('student_sem') }}">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Department</label>
                <div class="col-md-8">
                    <select name="student_department" class="form-control input-line">
                        <option value=""></option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Course</label>
                <div class="col-md-8">
                        <select name="student_course" class="form-control input-line" id="" >
                            <option value=""></option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
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
                        <input type="text" name="student_name" class="form-control input-line" id="m_name">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Semester</label>
                <div class="col-md-8">
                        <input type="text" name="student_sem" class="form-control input-line" id="m_sem" >
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Department</label>
                <div class="col-md-8">
                    <select name="student_department" class="form-control input-line">
                        <option value=""></option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword1" class="col-md-4 control-label">Course</label>
                <div class="col-md-8">
                    <select name="student_course" class="form-control input-line" id="m_course" >
                        <option value=""></option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" name="id" id="m_student_id">
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
            $("#m_student_id").val($(this).data('id'));
            $("#m_name").val($(this).data('name'));
            $("#m_sem").val($(this).data('sem'));
            $("#m_department").val($(this).data('department'));
            $("#m_course").val($(this).data('course'));
       });

    });
</script>


@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop