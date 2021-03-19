@extends('admin.layouts.app')
@section('content')
        

<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Users List</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Users</li>
            <li class="breadcrumb-item active">Users List</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title">Users List</h4>
            <p class="text-muted font-14 m-b-30"> </p>

            <table id="user-customer-listing" class="Logo table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead style="background-color: #00496d; color:white">
                    <tr>
                        <th>#</th>
                        <td>Image</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Country</td>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>


                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
