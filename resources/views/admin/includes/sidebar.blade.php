<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                @if(!empty($adminDetails))
                    @if($adminDetails->profilePic!='NA')
                    <img src="{{config('constants.baseUrl').config('constants.adminPic').$adminDetails->profilePic}}" alt="user" class="thumb-md rounded-circle">
                    @else
                    <img src="{{config('constants.baseUrl').config('constants.avatar').'admin_avatar.png'}}" alt="user" class="thumb-md rounded-circle">
                    @endif
                @endif
            </div>
            @if(!empty($adminDetails))
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ Illuminate\Support\Str::title($adminDetails->name) }} <span class="caret"></span></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="md md-settings"></i> Settings</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a>
                    </div>
                </div>
                <!-- <p class="text-muted m-0">{{ Illuminate\Support\Str::title($adminDetails->role) }}</p> -->
            </div>
            @endif
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">


            <ul>
                <!-- <li class="text-muted menu-title">Navigation</li> -->
                @foreach($modules as $module)
                @foreach($subModuleGroup as $group)
                @if($module->id==$group->module_id)
                @if($group->count>1)
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="{{$module->icon}}"
                            style="color: #792b91; font-weight: 600"></i> <span> {{$module->name}} </span> <span
                            class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        @foreach($subModules as $subModule)
                        @if($module->id==$subModule->module_id)
                        <li><a href="{{url($subModule->link)}}"><span class="ti-angle-double-right"></span>
                                {{$subModule->name}}</a></li>
                        @endif
                        <!-- <li><a href="{{url('admin/users/merchants')}}">Merchants</a></li>
                        <li><a href="{{url('admin/users/delivery-boys')}}">Delivery Boys</a></li>
                        <li><a href="{{url('admin/users/admins')}}">Admin Users</a></li> -->
                        @endforeach
                    </ul>
                </li>
                @else
                <li>
                    @foreach($subModules as $subModule)
                    @if($module->id==$subModule->module_id)
                    <a href="{{url($subModule->link)}}" class="waves-effect"><i class="{{$module->icon}}"
                            style="color: #792b91; font-weight: 600"></i> <span> {{$subModule->name}} </span>
                        <!-- <span class="menu-arrow"></span> --></a>
                    @endif
                    @endforeach
                </li>
                @endif
                @endif
                @endforeach
                @endforeach

                <!-- <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('admin/category')}}">Category</a></li>
                    </ul>
                </li>
            
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Roles & Permissions </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('admin/roles-permissions/roles')}}">Roles</a></li>
                        <li><a href="{{url('admin/roles-permissions/permissions')}}">Permissions</a></li>
                    </ul>
                </li> -->
            </ul>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
