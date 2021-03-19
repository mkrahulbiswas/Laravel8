<!-- Page-Title -->
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive boder" style="border-top-left-radius: 0; border-top-right-radius: 0; margin-bottom: 0px;">

            <div class="row">
                <div class="col-sm-12">
                    @if($itemPermission['add_item']=='1')
                    <div class="btn-group pull-right">
                        <button type="button" data-toggle="modal" data-target="#con-add-modal"  class="btn addBtn waves-effect waves-light"><i class=""></i> Add New Loader</button>
                    </div>
                    @endif
                    <h4 class="header-title">Customize Internal Loader List</h4>
                </div>
            </div>

            <p class="text-muted font-14 m-b-30">
                {{-- <div class="alert alert-danger" id="alert" style="display: none">
                    <center><strong id="validationAlert" style="font-size: 14px; font-weight: 500"></strong></center>
                </div> --}}
            </p>

            <table id="customizeAdmin-internalLoader-listing" class="tableStyle table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Html</th>
                        <th>Css</th>
                        <th>Js</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>