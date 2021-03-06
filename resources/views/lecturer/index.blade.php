@extends('layouts.master')

@section('head')
    <style type="text/css">
        .padding-top-0{
            padding-top: 0 !important;
        }
    </style>
@stop

@section('title')
    Dashboard
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">Dashboard</a>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-6 col-md-offset-2 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="{{ route('lecturer.lecturer-list-subject') }}">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="desc"> Manage </div>
                        <div class="number padding-top-0">
                            <span data-counter="counterup" data-value="1349">Subject</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        
        
    </div>
@stop

@section('script')

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
    });

</script>

@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop