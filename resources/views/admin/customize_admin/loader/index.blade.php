@extends('admin.layouts.app')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Loader</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Customize Admin</a></li>
            <li class="breadcrumb-item active">Loader</li>
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
                <a href="#tabOne" data-toggle="tab" aria-expanded="true" class="nav-link active show">Page Loader</a>
            </li>
            <li class="nav-item tab">
                <a href="#tabTwo" data-toggle="tab" aria-expanded="false" class="nav-link show">Internal Loader</a>
            </li>
        </ul>
        
        <div class="tab-content" style="padding: 0;">

            <div class="tab-pane active" id="tabOne">
                <div class="col-sm-12" style="padding: 0; background: linear-gradient(180deg, transparent, #0797dd );">
                    <ol class="breadcrumb" style="padding: 25px 0 2px 20px; margin-bottom: 0;">
                        <li class="breadcrumb-item">Customize Admin</li>
                        <li class="breadcrumb-item">Loader</li>
                        <li class="breadcrumb-item active">Page Loader</li>
                    </ol>
                </div>
                @include('admin.customize_admin.loader.page_loader.page_loader_list')
            </div>
            

            <div class="tab-pane" id="tabTwo">
                <div class="col-sm-12" style="padding: 0; background: linear-gradient(180deg, transparent, #0797dd );">
                    <ol class="breadcrumb" style="padding: 25px 0 2px 20px; margin-bottom: 0;">
                        <li class="breadcrumb-item">Customize Admin</li>
                        <li class="breadcrumb-item">Loader</li>
                        <li class="breadcrumb-item active">Internal Loader</li>
                    </ol>
                </div>
                @include('admin.customize_admin.loader.internal_loader.internal_loader_list')
            </div>
            

        </div>

    </div>
</div>



<div class="row">
    <div class="col-12">
        <div id="con-add-modal" data-type="customizeLoader" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Customize Loader</h4>
                        <button type="button" class="close Close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="saveCustomizeLoaderForm" action="{{ route('save.customizeLoader') }}" method="POST" enctype="multipart/form-data" novalidate="">
                        @csrf

                        <div class="modal-body">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="loaderForAdd">Loader For<span class="text-danger">*</span></label>
                                    <select name="loaderFor[]" id="loaderForAdd" class="advance-select-loaderFor" multiple>
                                        <option value="2">For Internal Load</option>
                                        <option value="1">For Page Load</option>
                                    </select>
                                    <span role="alert" id="loaderForErr" style="color:red;font-size: 12px"></span>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="html">HTML<span class="text-danger">*</span></label>
                                        <textarea name="html" id="html" placeholder="HTML" cols="5" rows="4" class="form-control"></textarea>
                                        <span role="alert" id="htmlErr" style="color:red;font-size: 12px"></span>
                                    </div>
    
                                    <div class="form-group col-md-6">
                                        <label for="css">CSS<span class="text-danger">*</span></label>
                                        <textarea name="css" id="css" placeholder="CSS" cols="5" rows="4" class="form-control"></textarea>
                                        <span role="alert" id="cssErr" style="color:red;font-size: 12px"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="js">JS<span class="text-danger">*</span></label>
                                    <textarea name="js" id="js" placeholder="JS" cols="5" rows="4" class="form-control"></textarea>
                                    <span role="alert" id="jaErr" style="color:red;font-size: 12px"></span>
                                </div>

                            </div>
                        </div>

                        <div class="alert alert-danger" id="alert" style="display: none">
                            <center><strong id="validationAlert"></strong></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn closeBtn waves-effect Close" data-dismiss="modal"><i class=""></i> Close</button>
                            <button type="submit" id="saveCustomizeLoaderBtn"  class="btn saveBtn waves-effect waves-light"><i class=""></i> <span>Save</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12">
        <div id="con-edit-modal" data-type="customizeLoader" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Customize Loader</h4>
                        <button type="button" class="close Close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="updateCustomizeLoaderForm" action="{{ route('update.customizeLoader') }}" method="POST" enctype="multipart/form-data" novalidate="">
                        @csrf

                        <div class="modal-body">
                            <div class="col-md-12">

                                <input type="hidden" name="id" id="id" value="">
                                
                                <div class="form-group">
                                    <label for="loaderForEdit">Loader For<span class="text-danger">*</span></label>
                                    <select name="loaderFor" id="loaderForEdit" class="advance-select-loaderFor">
                                        <option value="2">For Internal Load</option>
                                        <option value="1">For Page Load</option>
                                    </select>
                                    <span role="alert" id="loaderForErr" style="color:red;font-size: 12px"></span>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="html">HTML<span class="text-danger">*</span></label>
                                        <textarea name="html" id="html" placeholder="HTML" cols="5" rows="4" class="form-control"></textarea>
                                        <span role="alert" id="htmlErr" style="color:red;font-size: 12px"></span>
                                    </div>
    
                                    <div class="form-group col-md-6">
                                        <label for="css">CSS<span class="text-danger">*</span></label>
                                        <textarea name="css" id="css" placeholder="CSS" cols="5" rows="4" class="form-control"></textarea>
                                        <span role="alert" id="cssErr" style="color:red;font-size: 12px"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="js">JS<span class="text-danger">*</span></label>
                                    <textarea name="js" id="js" placeholder="JS" cols="5" rows="4" class="form-control"></textarea>
                                    <span role="alert" id="jaErr" style="color:red;font-size: 12px"></span>
                                </div>

                            </div>
                        </div>

                        <div class="alert alert-danger" id="alert" style="display: none">
                            <center><strong id="validationAlert"></strong></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn closeBtn waves-effect Close" data-dismiss="modal"><i class=""></i> Close</button>
                            <button type="submit" id="updateCustomizeLoaderBtn"  class="btn updateBtn waves-effect waves-light"><i class=""></i> <span>Update</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection