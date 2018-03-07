@extends('layouts.master')

@section('head')

@stop

@section('title')
   List of Subject
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">List of Subject</a>
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
                    <span class="caption-subject font-white sbold uppercase">List of Subject</span>
                </div>
            </div>
                
            <div class="portlet-body">
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr class="uppercase">
                                <th> # </th>
                                <th> Subject Name </th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php $count = 1; ?>
                            @foreach($subjects as $subject)
                            <?php $currentPageTotalNumber = ( $subjects->currentPage() - 1) * 5; ?>
                            <tr>
                                <td> {{ $count + $currentPageTotalNumber}} </td>
                                <td> {{ $subject->subject_name }}</td>
                                <td> 
                                    <a href="{{ route('lecturer.showStudentSubjectMarks', $subject->subject_id ) }}" class="btn" style="background-color: #d64635; color:white;"> Manage Marks</a>
                                    <a href="lecturer-list-student/{{ $subject->subject_id }}" class="btn" style="background-color: #d64635; color:white;"> View Student</a>
                                </td>
                            </tr>
                            <?php $count++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $subjects->render() }}
                        </div>
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