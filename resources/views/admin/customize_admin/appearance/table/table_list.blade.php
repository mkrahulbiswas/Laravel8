<!-- Page-Title -->
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive boder" style="border-top-left-radius: 0; border-top-right-radius: 0; margin-bottom: 0px;">

            <div class="row">
                <div class="col-sm-12">
                    @if($itemPermission['add_item']=='1')
                    <div class="btn-group pull-right">
                        <button type="button" data-toggle="modal" data-target="#con-add-modal-table"  class="btn addBtn waves-effect waves-light"><i class=""></i> Add Customize Table</button>
                        {{-- <a href="{{ route('add.customizeTable') }}" target="_blank" class="btn addBtn waves-effect waves-light"><i class=""></i> Add Customize Table</a> --}}
                    </div>
                    @endif
                    <h4 class="header-title">Customize Table</h4>
                </div>
            </div>

            <p class="text-muted font-14 m-b-30"></p>

            <form id="filterCustomizeTableForm" method="POST" action="{{ route('get.customizeTable') }}" class="m-b-20">
                @csrf

                <div class="row" style="background-color: #fff; padding-top: 20px; box-shadow: 0 5px 10px #bfbfbf; margin: 0; padding: 0;">

                    <div class="col-md-12 p-t-10 m-b-10">
                        <p style="color: #000 !important; text-decoration: underline; font-size: 18px;">Filter Your Table Data:-</p>
                    </div>

                    <div class="col-md-3">
                        <select name="tableStatus" id="tableStatusFilter" class="advance-select-status">
                            <option value="">Select Status</option>
                            <option value="1">1</option>
                            <option value="2">0</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="fromDate" id="tableFromDateFilter" placeholder="From Date" class="form-control date-picker" value="">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="toDate" id="tableToDateFilter" placeholder="To Date" class="form-control date-picker" value="">
                    </div>

                    <div class="col-md-3">
                        <div class="form-group d-flex flex-row justify-content-around">
                          <button class="btn searchBtn FilterCustomizeTableBtn" title="Search" type="button"><i class=""></i> Search</button>
                          <button class="btn reloadBtn FilterCustomizeTableBtn" title="Reload" type="button"><i class=""></i> Reload</button>
                        </div>
                      </div>

                </div>
            </form>

            <table id="customizeAdmin-table-listing" class="tableStyle table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Check</th>
                        <th>Table Head</th>
                        <th>Table Body</th>
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
        <div id="con-add-modal-table" data-type="customizeTable" class="con-add-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Open Page For Customize Table Style</h4>
                        <button type="button" class="close Close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="addCustomizeTableForm" novalidate="">
                        @csrf

                        <div class="modal-body">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <label for="customizeTableAdd">Table Customize Type List<span class="text-danger">*</span></label>
                                    <select class="selectpicker" name="customizeTableAdd" id="customizeTableAdd" data-style="btn-primary btn-custom">
                                        <option value="">Select Customize Type</option>
                                        <option value="1" data-action="{{ route('add.customizeTableColor') }}">Add Table Body & Head Color</option>
                                        <option value="2" data-action="{{ route('add.customizeTableStyle') }}">Apply Table Body & Head Style</option>
                                        <option value="3" data-action="{{ route('add.customizeTableStyle') }}">Apply Table Body Style</option>
                                    </select>
                                    <span role="alert" id="customizeTableAddErr" style="color:red;font-size: 12px"></span>
                                </div>

                            </div>
                        </div>

                        <div class="alert alert-danger" id="alert" style="display: none">
                            <center><strong id="validationAlert"></strong></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn closeBtn waves-effect Close" data-dismiss="modal"><i class=""></i> Close</button>
                            <button type="submit" id="addCustomizeButtonBtn"  class="btn addBtn waves-effect waves-light"><i class=""></i> <span>Open Page</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>