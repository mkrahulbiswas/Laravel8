<!-- Page-Title -->
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive boder" style="border-top-left-radius: 0; border-top-right-radius: 0; margin-bottom: 0px;">

            <div class="row">
                <div class="col-sm-12">
                    @if($itemPermission['add_item']=='1')
                    <div class="btn-group pull-right">
                        <button type="button" data-toggle="modal" data-target="#con-add-modal-button"  class="btn addBtn waves-effect waves-light"><i class=""></i> Add Customize Button</button>
                    </div>
                    @endif
                    <h4 class="header-title">Customize Button List</h4>
                </div>
            </div>

            <p class="text-muted font-14 m-b-30">
                {{-- <div class="alert alert-danger" id="alert" style="display: none">
                    <center><strong id="validationAlert" style="font-size: 14px; font-weight: 500"></strong></center>
                </div> --}}
            </p>

            <form id="filterCustomizeButtonForm" method="POST" action="{{ route('admin.get.customizeButton') }}" class="m-b-20">
                @csrf

                <div class="row" style="background-color: #fff; padding-top: 20px; box-shadow: 0 5px 10px #bfbfbf; margin: 0; padding: 0;">

                    <div class="col-md-12 p-t-10 m-b-10">
                        <p style="color: #000 !important; text-decoration: underline; font-size: 18px;">Filter Your Table Data:-</p>
                    </div>

                    <div class="col-md-3">
                        <select name="buttonType" id="buttonTypeFilter" class="advance-select-button">
                            <option value="">Select Button Type</option>
                            <option value="{{ config('constants.addBtn') }}">{{ config('constants.addBtn') }}</option>
                            <option value="{{ config('constants.saveBtn') }}">{{ config('constants.saveBtn') }}</option>
                            <option value="{{ config('constants.updateBtn') }}">{{ config('constants.updateBtn') }}</option>
                            <option value="{{ config('constants.closeBtn') }}">{{ config('constants.closeBtn') }}</option>
                            <option value="{{ config('constants.searchBtn') }}">{{ config('constants.searchBtn') }}</option>
                            <option value="{{ config('constants.reloadBtn') }}">{{ config('constants.reloadBtn') }}</option>
                            <option value="{{ config('constants.backBtn') }}">{{ config('constants.backBtn') }}</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="buttonStatus" id="buttonStatusFilter" class="advance-select-status">
                            <option value="">Select Status</option>
                            <option value="1">1</option>
                            <option value="2">0</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="fromDate" id="buttonFromDateFilter" placeholder="From Date" class="form-control date-picker" value="">
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="toDate" id="buttonToDateFilter" placeholder="To Date" class="form-control date-picker" value="">
                    </div>

                    <div class="col-md-3">
                        <div class="form-group d-flex flex-row justify-content-around">
                          <button class="btn searchBtn filterCustomizeButtonBtn" title="Search" type="button"><i class=""></i> Search</button>
                          <button class="btn reloadBtn filterCustomizeButtonBtn" title="Reload" type="button"><i class=""></i> Reload</button>
                        </div>
                      </div>

                </div>
            </form>

            <table id="customizeAdmin-button-listing" class="tableStyle table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Button</th>
                        <th>Hover Button</th>
                        <th>Icon</th>
                        <th>Buton For</th>
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
        <div id="con-add-modal-button" data-type="customizeButton" class="con-add-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Customize Button Style</h4>
                        <button type="button" class="close Close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="saveCustomizeButtonForm" action="{{ route('admin.save.customizeButton') }}" method="POST" enctype="multipart/form-data" novalidate="">
                        @csrf

                        <div class="modal-body">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="buttonTypeAdd">Button Type List<span class="text-danger">*</span></label>
                                        <select name="buttonType" id="buttonTypeAdd" class="advance-select-button">
                                            <option value="">Select Button Type</option>
                                            <option value="{{ config('constants.addBtn') }}">{{ config('constants.addBtn') }}</option>
                                            <option value="{{ config('constants.saveBtn') }}">{{ config('constants.saveBtn') }}</option>
                                            <option value="{{ config('constants.updateBtn') }}">{{ config('constants.updateBtn') }}</option>
                                            <option value="{{ config('constants.closeBtn') }}">{{ config('constants.closeBtn') }}</option>
                                            <option value="{{ config('constants.searchBtn') }}">{{ config('constants.searchBtn') }}</option>
                                            <option value="{{ config('constants.reloadBtn') }}">{{ config('constants.reloadBtn') }}</option>
                                            <option value="{{ config('constants.backBtn') }}">{{ config('constants.backBtn') }}</option>
                                        </select>
                                        <span role="alert" id="buttonTypeErr" style="color:red;font-size: 12px"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="buttonIconAdd">Button Type Icon List<span class="text-danger">*</span></label>
                                        <select name="buttonIcon" id="buttonIconsAdd" class="advance-select-icon">
                                            <option value="">Select Button Icon</option>
                                        </select>
                                        <span role="alert" id="buttonIconErr" style="color:red;font-size: 12px"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="card btnDemo">
                                        <p class="text-color text-center m-t-10">Take Button Backgound Color & Button Text Color</p>
                                        <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                            <button type="button" class="color-picker-1 btn btn-primary">'Background' color</button>
                                            <button type="button" class="color-picker-2 btn btn-primary">'Text' color</button>
                                            <input type="hidden" name="btnBackColor" value="40, 70, 155, 1" id="btnBackColor">
                                            <input type="hidden" name="btnTextColor" value="255, 255, 255, 1" id="btnTextColor">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="card btnHoverDemo">
                                        <p class="text-color text-center m-t-10">Take Button Hover Backgound Color & Button Text Color</p>
                                        <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                            <button type="button" class="color-picker-3 btn btn-primary">'Background' color</button>
                                            <button type="button" class="color-picker-4 btn btn-primary">'Text' color</button>
                                            <input type="hidden" name="btnHoverBackColor" value="40, 70, 155, 1" id="btnHoverBackColor">
                                            <input type="hidden" name="btnHoverTextColor" value="255, 255, 255, 1" id="btnHoverTextColor">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="alert alert-danger" id="alert" style="display: none">
                            <center><strong id="validationAlert"></strong></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn closeBtn waves-effect Close" data-dismiss="modal"><i class=""></i> Close</button>
                            <button type="submit" id="saveCustomizeButtonBtn"  class="btn saveBtn waves-effect waves-light"><i class=""></i> <span>Save</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12">
        <div id="con-edit-modal-button" data-type="customizeButton" class="con-edit-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Customize Button Style</h4>
                        <button type="button" class="close Close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="updateCustomizeButtonForm" action="{{ route('admin.update.customizeButton') }}" method="POST" enctype="multipart/form-data" novalidate="">
                        @csrf

                        <div class="modal-body">
                            <div class="col-md-12">

                                <input type="hidden" name="id" id="id" value="">
                                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="buttonTypeEdit">Button Type List<span class="text-danger">*</span></label>
                                        <select name="buttonType" id="buttonTypeEdit" class="advance-select-button">
                                            <option value="">Select Button Type</option>
                                            <option value="{{ config('constants.addBtn') }}">{{ config('constants.addBtn') }}</option>
                                            <option value="{{ config('constants.saveBtn') }}">{{ config('constants.saveBtn') }}</option>
                                            <option value="{{ config('constants.updateBtn') }}">{{ config('constants.updateBtn') }}</option>
                                            <option value="{{ config('constants.closeBtn') }}">{{ config('constants.closeBtn') }}</option>
                                            <option value="{{ config('constants.searchBtn') }}">{{ config('constants.searchBtn') }}</option>
                                            <option value="{{ config('constants.reloadBtn') }}">{{ config('constants.reloadBtn') }}</option>
                                            <option value="{{ config('constants.backBtn') }}">{{ config('constants.backBtn') }}</option>
                                        </select>
                                        <span role="alert" id="buttonTypeErr" style="color:red;font-size: 12px"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="buttonIconEdit">Button Type Icon List<span class="text-danger">*</span></label>
                                        <select name="buttonIcon" id="buttonIconEdit" class="advance-select-icon">
                                            <option value="">Select Button Icon</option>
                                        </select>
                                        <span role="alert" id="buttonIconErr" style="color:red;font-size: 12px"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="card btnDemo" style="">
                                        <p class="text-color text-center m-t-10" style="">Take Button Backgound Color & Button Text Color</p>
                                        <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                            <button type="button" class="color-picker-1 btn btn-primary">'Background' color</button>
                                            <button type="button" class="color-picker-2 btn btn-primary">'Text' color</button>
                                            <input type="hidden" name="btnBackColor" value="40, 70, 155, 1" id="btnBackColor">
                                            <input type="hidden" name="btnTextColor" value="255, 255, 255, 1" id="btnTextColor">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="card btnHoverDemo" style="">
                                        <p class="text-color text-center m-t-10" style="">Take Button Hover Backgound Color & Button Text Color</p>
                                        <div class="row d-flex flex-row justify-content-around" style="width: 80%; background-color: white; margin: 0 auto 10px auto; padding: 10px 0;">
                                            <button type="button" class="color-picker-3 btn btn-primary">'Background' color</button>
                                            <button type="button" class="color-picker-4 btn btn-primary">'Text' color</button>
                                            <input type="hidden" name="btnHoverBackColor" value="40, 70, 155, 1" id="btnHoverBackColor">
                                            <input type="hidden" name="btnHoverTextColor" value="255, 255, 255, 1" id="btnHoverTextColor">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="alert alert-danger" id="alert" style="display: none">
                            <center><strong id="validationAlert"></strong></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn closeBtn waves-effect Close" data-dismiss="modal"><i class=""></i> Close</button>
                            <button type="submit" id="updateCustomizeButtonBtn"  class="btn updateBtn waves-effect waves-light"><i class=""></i> <span>Update</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12">
        <div id="con-detail-modal-button" class="con-detail-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Details Of Customize Button Style</h4>
                        <button type="button" class="close Close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                        <div class="col-md-12">

                            <div class="common" id="buttonType">
                                <label>Button Type:- </label>
                                <span></span>
                            </div>

                            <div class="common" id="btnBackColor">
                                <label>Button Color:- </label>
                                <span></span>
                            </div>

                            <div class="common" id="btnTextColor">
                                <label>Button Text Color:- </label>
                                <span></span>
                            </div>

                            <div class="common" id="btnHoverBackColor">
                                <label>Button Hover Color:- </label>
                                <span></span>
                            </div>

                            <div class="common" id="btnHoverTextColor">
                                <label>Button Text Hover Color:- </label>
                                <span></span>
                            </div>

                            <hr>

                            <div class="btnDemo" id="btnDemo">
                                <label class="col-md-12">Demo Of Button Style</label>
                                <div class="col-md-12 text-center m-t-20">
                                    <button type="button" class="btn waves-effect waves-light col-md-6"><i class=""></i> <span></span></button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>