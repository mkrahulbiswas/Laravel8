@extends('admin.layouts.app')
@section('content')
        

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15"></div>
        <h4 class="page-title">{{ $reqData['appName'] }} Dashboard</h4>
        <p class="text-muted page-title-alt">Welcome to {{ $reqData['appName'] }} admin panel !</p>
    </div>
</div>


{{-- <div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
    <a href="{{ route('show.customer') }}">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-success pull-left">
                <i class="fas fa-users" style="color: white"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><span class="counter">{{ $data['customer'] }}</span></h3>
                <p class="text-muted mb-0">New Customer Join Today</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </a>
    </div>


    <div class="col-md-6 col-lg-6 col-xl-3">
    <a href="{{ route('show.serviceRequest') }}">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-primary pull-left">
                <i class="fas fa-taxi" style="color: white"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><span class="counter">{{ $data['serviceRequest'] }}</span></h3>
                <p class="text-muted mb-0">New Service Request Today</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </a>
    </div>


    <div class="col-md-6 col-lg-6 col-xl-3">
    <a href="{{ route('show.feedback') }}">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-purple pull-left">
                <i class="fas fa-phone-volume" style="color: white"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><span class="counter">{{ $data['feedback'] }}</span></h3>
                <p class="text-muted mb-0">New Feedback Today</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </a>
    </div>
</div> --}}

@endsection
