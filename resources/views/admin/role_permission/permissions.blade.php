@extends('admin.layouts.app')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12"><h4 class="page-title">Permissions</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Roles & Permissions</a></li>
            <li class="breadcrumb-item active">Permissions</li>
        </ol>

    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title">Permission Lists</h4>
            <p class="text-muted font-14 m-b-30">
                <!-- Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table. -->
            </p>

            <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead style="background-color: #00496d; color:white">
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>


                <tbody>
                @php $i=1; @endphp   
                @foreach($role as $temp)    
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$temp->role}}</td>
                    <td>
                        @if($itemPermission['edit_item']=='1')
                        <a href="{{url('admin/roles-permissions/permissions/edit/'.$temp->id)}}" title="Edit"><i class="md md-edit" style="font-size: 20px"></i></a>
                        @endif
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->
@endsection



                   