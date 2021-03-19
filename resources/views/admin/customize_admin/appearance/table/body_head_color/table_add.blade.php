@extends('admin.layouts.app')
@section('content')
        

<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <a href="#" onClick="javascript:window.close('','_parent','');" class="btn closeBtn waves-effect waves-light m-l-15"><i class=""></i> Close</a>
        </div>
        <h4 class="page-title">Add Customize Table Color</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Customize Admin</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('show.appearance') }}">Appearance</a></li>
            <li class="breadcrumb-item active">Add Customize Table Color</li>
        </ol>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            <p class="text-muted font-14 m-b-20"></p>
            <form id="saveCustomizeTableColorForm" action="{{route('save.customizeTableColor')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="tableCommon">
                        <div class="col-md-12">
                            <p>Table Head Style:-</p>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="card tableHeadDemo">
                                    <p class="text-color text-center m-t-10">Take Table Head Backgound Color & Text Color</p>
                                    <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                        <button type="button" class="color-picker-1 btn btn-primary">'Background' color</button>
                                        <button type="button" class="color-picker-2 btn btn-primary">'Text' color</button>
                                        <input type="hidden" name="tableHeadBackColor" value="40, 70, 155, 1" id="backColor">
                                        <input type="hidden" name="tableHeadTextColor" value="255, 255, 255, 1" id="textColor">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="card tableHeadHoverDemo">
                                    <p class="text-color text-center m-t-10">Take Table Head Hover Backgound Color & Text Color</p>
                                    <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                        <button type="button" class="color-picker-3 btn btn-primary">'Background' color</button>
                                        <button type="button" class="color-picker-4 btn btn-primary">'Text' color</button>
                                        <input type="hidden" name="tableHeadHoverBackColor" value="40, 70, 155, 1" id="backColor">
                                        <input type="hidden" name="tableHeadHoverTextColor" value="255, 255, 255, 1" id="textColor">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tableCommon">
                        <div class="col-md-12">
                            <p>Table Body Style:-</p>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="card tableBodyDemo">
                                    <p class="text-color text-center m-t-10">Take Table Body Backgound Color & Text Color</p>
                                    <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                        <button type="button" class="color-picker-5 btn btn-primary">'Background' color</button>
                                        <button type="button" class="color-picker-6 btn btn-primary">'Text' color</button>
                                        <input type="hidden" name="tableBodyBackColor" value="40, 70, 155, 1" id="backColor">
                                        <input type="hidden" name="tableBodyTextColor" value="255, 255, 255, 1" id="textColor">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="card tableBodyHoverDemo">
                                    <p class="text-color text-center m-t-10">Take Table Body Hover Backgound Color & Text Color</p>
                                    <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                        <button type="button" class="color-picker-7 btn btn-primary">'Background' color</button>
                                        <button type="button" class="color-picker-8 btn btn-primary">'Text' color</button>
                                        <input type="hidden" name="tableBodyHoverBackColor" value="40, 70, 155, 1" id="backColor">
                                        <input type="hidden" name="tableBodyHoverTextColor" value="255, 255, 255, 1" id="textColor">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group text-right m-b-0">
                    <button type="submit" id="saveCustomizeTableColorBtn"  class="btn saveBtn waves-effect waves-light"><i class=""></i> <span>Save</span></button>
                </div>
                {{-- <br>
                <div class="alert alert-danger" id="alert" style="display: none">
                    <center><strong id="validationAlert" style="font-size: 14px; font-weight: 500"></strong></center>
                </div> --}}

            </form>
        </div> <!-- end card-box -->
    </div>
</div>


@endsection