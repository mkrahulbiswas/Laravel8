@extends('admin.layouts.app')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        @if($itemPermission['add_item']=='1')
        <div class="btn-group pull-right m-t-15">
            <button type="button" data-toggle="modal" data-target="#con-add-modal"  class="btn btn-primary waves-effect waves-light"><i class="ion-plus-circled"></i> Add Banner</button>
        </div>
        @endif
        <h4 class="page-title">Banner</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">CMS</a></li>
            <li class="breadcrumb-item active">Banner</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title">Banner List</h4>
            <p class="text-muted font-14 m-b-30"> </p>

            <table id="cms-banner-listing" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead style="background-color: #00496d; color:white">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div id="con-add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Banner</h4>
                        <button type="button" class="close Close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="saveBannerForm" action="{{ route('save.banner') }}" method="post" enctype="multipart/form-data" novalidate="">
                        
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12">
                                                <label for="file"><strong>Note:&nbsp;</strong> Image Size should be 1MB to 2MB<span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-lg-12 grid-margin stretch-card">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <input type="file" name="file" id="file" class="dropify">
                                                            </div>
                                                            <span role="alert" id="fileErr" style="color:red;font-size: 12px"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger" id="alert" style="display: none">
                            <center><strong id="validationAlert"></strong></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect Close" data-dismiss="modal">Close</button>
                            <button type="submit" id="saveBannerBtn"  class="btn btn-primary waves-effect waves-light"><i class="ti-save"></i> <span>Save</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div id="con-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Banner</h4>
                        <button type="button" class="close Close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="updateBannerForm" action="{{ route('update.banner') }}" method="post" enctype="multipart/form-data" novalidate="">
                        
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <input type="hidden" name="id" id="id" value="">

                                    <div class="form-group">
                                        <label for="file"><strong>Note:&nbsp;</strong> Image Size should be 1MB to 2MB<span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-lg-6 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <input type="file" name="file" id="file" class="dropify">
                                                    </div>
                                                    <span role="alert" id="fileErr" style="color:red;font-size: 12px"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 grid-margin stretch-card">
                                                <img src="" class="img-responsive img-thumbnail" style="height: 240px">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger" id="alert" style="display: none">
                            <center><strong id="validationAlert"></strong></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect Close" data-dismiss="modal">Close</button>
                            <button type="submit" id="updateBannerBtn" class="btn btn-primary waves-effect waves-light"><i class="ti-save"></i> <span>Update</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection