@extends('admin.layouts.app')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Appearance</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Customize Admin</a></li>
            <li class="breadcrumb-item active">Appearance</li>
        </ol>
    </div>
</div>




<div class="row">
    <p class="text-muted font-14 m-b-30">
        <div class="alert alert-danger" id="alert" style="display: none">
            <center><strong id="validationAlert" style="font-size: 14px; font-weight: 500"></strong></center>
        </div>
    </p>
    <div class="col-lg-12 m-b-20">
        {{-- <ul class="nav nav-pills navtab-bg nav-justified"> --}}
        {{-- <ul class="nav nav-pills navtab-bg nav-justified"> --}}
        {{-- <ul class="nav nav-tabs tabs navtab-bg nav-justified"> --}}
        <ul class="nav nav-pills mb-3 Appearance">
            <li class="nav-item tab">
                <a href="#tabOne" data-toggle="tab" aria-expanded="true" class="nav-link active show">Customize Button</a>
            </li>
            <li class="nav-item tab">
                <a href="#tabTwo" data-toggle="tab" aria-expanded="false" class="nav-link show">Customize Table</a>
            </li>
            <li class="nav-item tab">
                <a href="#tabThree" data-toggle="tab" aria-expanded="false" class="nav-link show">Report Image</a>
            </li>
        </ul>
        
        <div class="tab-content" style="padding: 0;">

            <div class="tab-pane active" id="tabOne">
                <div class="col-sm-12" style="padding: 0; background: linear-gradient(180deg, transparent, #0797dd );">
                    <ol class="breadcrumb" style="padding: 25px 0 2px 20px; margin-bottom: 0;">
                        <li class="breadcrumb-item">Customize Admin</li>
                        <li class="breadcrumb-item">Appearance</li>
                        <li class="breadcrumb-item active">Button</li>
                    </ol>
                </div>
                @include('admin.customize_admin.appearance.button.button_list')
            </div>
            

            <div class="tab-pane" id="tabTwo">
                <div class="col-sm-12" style="padding: 0; background: linear-gradient(180deg, transparent, #0797dd );">
                    <ol class="breadcrumb" style="padding: 25px 0 2px 20px; margin-bottom: 0;">
                        <li class="breadcrumb-item">Customize Admin</li>
                        <li class="breadcrumb-item">Appearance</li>
                        <li class="breadcrumb-item active">Table</li>
                    </ol>
                </div>
                @include('admin.customize_admin.appearance.table.table_list')
            </div>
            

            <div class="tab-pane" id="tabThree">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <div id="accordion">
                                        
                                       
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h6 class="m-0">
                                                    <a href="#collapseOne" class="collapsed text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">Doctor Appointments Details</a>
                                                </h6>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">

                                                    DD

                                                </div>
                                            </div>
                                        </div>


                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h6 class="m-0">
                                                    <a href="#collapseTwo" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">Prescription & Report Image</a>
                                                </h6>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            HH

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

@endsection
