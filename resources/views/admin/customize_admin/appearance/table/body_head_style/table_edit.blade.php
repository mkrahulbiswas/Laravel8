@extends('admin.layouts.app')
@section('content')
        

<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <a href="#" onClick="javascript:window.close('','_parent','');" class="btn closeBtn waves-effect waves-light m-l-15"><i class=""></i> Close</a>
        </div>
        <h4 class="page-title">Edit Customize Table Color</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Customize Admin</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('show.appearance') }}">Appearance</a></li>
            <li class="breadcrumb-item active">Edit Customize Table Color</li>
        </ol>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            <p class="text-muted font-14 m-b-20"></p>
            <form id="updateCustomizeTableForm" action="{{route('update.customizeTable')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="id" value="{{ $data['id'] }}">

                <div class="row">

                    <div class="tableCommon">
                        <div class="col-md-12">
                            <p>Table Head Style:-</p>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="card tableHeadDemo" style="background: rgba({{ $data['headBackColor'] }})">
                                    <p class="text-color text-center m-t-10" style="color: rgba({{ $data['headTextColor'] }})">Take Table Head Backgound Color & Text Color</p>
                                    <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                        <button type="button" class="color-picker-1 btn btn-primary">'Background' color</button>
                                        <button type="button" class="color-picker-2 btn btn-primary">'Text' color</button>
                                        <input type="hidden" name="tableHeadBackColor" value="{{ $data['headBackColor'] }}" id="backColor">
                                        <input type="hidden" name="tableHeadTextColor" value="{{ $data['headTextColor'] }}" id="textColor">
                                    </div>
                                </div>
                            </div>
        
                            <div class="form-group col-md-6">
                                <div class="card tableHeadHoverDemo" style="background: rgba({{ $data['headHoverBackColor'] }})">
                                    <p class="text-color text-center m-t-10" style="color: rgba({{ $data['headHoverTextColor'] }})">Take Table Head Hover Backgound Color & Text Color</p>
                                    <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                        <button type="button" class="color-picker-3 btn btn-primary">'Background' color</button>
                                        <button type="button" class="color-picker-4 btn btn-primary">'Text' color</button>
                                        <input type="hidden" name="tableHeadHoverBackColor" value="{{ $data['headHoverBackColor'] }}" id="backColor">
                                        <input type="hidden" name="tableHeadHoverTextColor" value="{{ $data['headHoverTextColor'] }}" id="textColor">
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
                                <div class="card tableBodyDemo" style="background: rgba({{ $data['bodyBackColor'] }})">
                                    <p class="text-color text-center m-t-10" style="color: rgba({{ $data['bodyTextColor'] }})">Take Table Body Backgound Color & Text Color</p>
                                    <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                        <button type="button" class="color-picker-5 btn btn-primary">'Background' color</button>
                                        <button type="button" class="color-picker-6 btn btn-primary">'Text' color</button>
                                        <input type="hidden" name="tableBodyBackColor" value="{{ $data['bodyBackColor'] }}" id="backColor">
                                        <input type="hidden" name="tableBodyTextColor" value="{{ $data['bodyTextColor'] }}" id="textColor">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="card tableBodyHoverDemo" style="background: rgba({{ $data['bodyHoverBackColor'] }})">
                                    <p class="text-color text-center m-t-10" style="color: rgba({{ $data['bodyHoverTextColor'] }})">Take Table Body Hover Backgound Color & Text Color</p>
                                    <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                        <button type="button" class="color-picker-7 btn btn-primary">'Background' color</button>
                                        <button type="button" class="color-picker-8 btn btn-primary">'Text' color</button>
                                        <input type="hidden" name="tableBodyHoverBackColor" value="{{ $data['bodyHoverBackColor'] }}" id="backColor">
                                        <input type="hidden" name="tableBodyHoverTextColor" value="{{ $data['bodyHoverTextColor'] }}" id="textColor">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <hr>
                
                <div class="form-group text-right m-b-0">
                    <button type="submit" id="updateCustomizeTableBtn"  class="btn saveBtn waves-effect waves-light"><i class=""></i> <span>Save</span></button>
                </div>

            </form>
        </div>
    </div>
</div>



@endsection
