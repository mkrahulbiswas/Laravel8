@extends('admin.layouts.app')
@section('content')
        

<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <a href="#" onClick="javascript:window.close('','_parent','');" class="btn closeBtn waves-effect waves-light m-l-15"><i class=""></i> Close</a>
        </div>
        <h4 class="page-title">Loader Details</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Customize Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.show.customizeLoader') }}">Loader</a></li>
            <li class="breadcrumb-item active">Loader Details</li>
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
        <ul class="nav nav-pills mb-3 Appearance">
            <li class="nav-item tab">
                <a href="#tabOne" data-toggle="tab" aria-expanded="true" class="nav-link active show">Code View</a>
            </li>
            <li class="nav-item tab">
                <a href="#tabTwo" data-toggle="tab" aria-expanded="false" class="nav-link show">Update Code Advance-Way</a>
            </li>
            <li class="nav-item tab">
                <a href="#tabThree" data-toggle="tab" aria-expanded="false" class="nav-link show">Loader View</a>
            </li>
        </ul>
        
        <div class="tab-content" style="padding: 0;">

            <div class="tab-pane active" id="tabOne">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box m-b-0">
                            
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <div class="accordion" id="accordionOne">
                                        
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h6 class="m-0">
                                                    <a href="#collapseOne" class="collapsed text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">Loader HTML</a>
                                                </h6>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionOne">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">HTML: &nbsp;&nbsp;</lable>
                                                                {{ $data['html'] }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h6 class="m-0">
                                                    <a href="#collapseTwo" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">Loader CSS</a>
                                                </h6>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionOne">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">CSS: &nbsp;&nbsp;</lable>
                                                                {{ $data['css'] }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h6 class="m-0">
                                                    <a href="#collapseThree" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">Loader JS</a>
                                                </h6>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionOne">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">JS: &nbsp;&nbsp;</lable>
                                                                {{ $data['js'] }}
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
            

            <div class="tab-pane" id="tabTwo">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box m-b-0">
                            
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <div class="accordion" id="accordionTwo">
                                        
                                        <form id="updateCustomizeLoaderForm" action="{{ route('admin.update.customizeLoader') }}" method="POST" enctype="multipart/form-data" novalidate="">
                                            @csrf
                
                                            <input type="hidden" name="id" id="id" value="{{ $data['id'] }}">
                                            <input type="hidden" name="loaderFor" id="loaderFor" value="{{ $data['loaderFor'] }}">
            
                                            <div class="card">
                                                <div class="card-header" id="headingFour">
                                                    <h6 class="m-0">
                                                        <a href="#collapseFour" class="collapsed text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapseFour">Loader HTML</a>
                                                    </h6>
                                                </div>
                                                <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionTwo">
                                                    <div class="card-body p-0">
                                                        <textarea type="text" name="html" class="loader-details form-control">{{ $data['html'] }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="card">
                                                <div class="card-header" id="headingFive">
                                                    <h6 class="m-0">
                                                        <a href="#collapseFive" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFive">Loader CSS</a>
                                                    </h6>
                                                </div>
                                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionTwo">
                                                    <div class="card-body p-0">
                                                        <textarea type="text" name="css" class="loader-details form-control">{{ $data['css'] }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="card">
                                                <div class="card-header" id="headingSix">
                                                    <h6 class="m-0">
                                                        <a href="#collapseSix" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSix">Loader JS</a>
                                                    </h6>
                                                </div>
                                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionTwo">
                                                    <div class="card-body p-0">
                                                        <textarea type="text" name="js" class="loader-details form-control">{{ $data['js'] }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="modal-footer">
                                                <button type="submit" id="updateCustomizeLoaderBtn"  class="btn updateBtn waves-effect waves-light"><i class=""></i> <span>Update</span></button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="tab-pane" id="tabThree">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box m-b-0">
                            
                            <div id={{ ($data['loaderFor'] == 1) ? "pageLoader" : "internalLoader" }} style="position: relative !important;">
                                {!! $data['html'] !!}
                            </div>
                           <style>{!! $data['css'] !!}</style>
                           {!! $data['js'] !!}
                            
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>


@endsection
