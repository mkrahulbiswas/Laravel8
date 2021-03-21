<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\SubModule;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;
use App\Traits\ValidationTrait;

use League\Flysystem\Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class RoleAdminController extends Controller
{

    use FileTrait, CommonTrait, ValidationTrait;
    public $platform = 'backend';


    /*-----( Role )------*/
    public function showRole()
    {
        $role = Role::all();
        // $role=Role::where('id','!=',1)->get();
        return view('admin.role_permission.roles', ['role' => $role]);
    }

    public function getRole()
    {
        try {
            $role = Role::orderBy('id', 'desc')->select('id', 'role', 'description', 'status');

            return Datatables::of($role)
                ->addIndexColumn()
                ->addColumn('description', function ($data) {
                    $description = $this->substarString(20, $data->description, '...');
                    return $description;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == '0') {
                        $status = '<span class="label label-danger">Blocked</span>';
                    } else {
                        $status = '<span class="label label-success">Active</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($data) {

                    $itemPermission = $this->itemPermission();

                    $dataArray = [
                        'id' => encrypt($data->id),
                        'role' => $data->role,
                        'description' => $data->description,
                    ];

                    if ($itemPermission['status_item'] == '1') {
                        if ($data->status == "0") {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="unblock" data-action="' . route('admin.status.roles') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Block"><i class="md md-lock" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        } else {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="block" data-action="' . route('admin.status.roles') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Unblock"><i class="md md-lock-open" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        }
                    } else {
                        $status = '';
                    }

                    if ($itemPermission['edit_item'] == '1') {
                        $edit = '<a href="JavaScript:void(0);" data-type="edit" data-array=\'' . json_encode($dataArray, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) . '\' title="Edit" class="actionDatatable"><i class="md md-edit" style="font-size: 20px;"></i></a>';
                    } else {
                        $edit = '';
                    }

                    if ($itemPermission['details_item'] == '1') {
                        $detail = '<a href="JavaScript:void(0);" data-type="detail" data-array=\'' . json_encode($dataArray, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) . '\' title="Details" class="actionDatatable"><i class="md md-visibility" style="font-size: 20px; color: green;"></i></a>';
                    } else {
                        $detail = '';
                    }

                    return $status . ' ' . $edit . ' ' . $detail;
                })
                ->rawColumns(['description', 'status', 'action'])
                ->make(true);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function saveRole(Request $request)
    {
        try {
            $values = $request->only('role', 'description');
            $validator = $this->isValid($request->all(), 'saveRole', 0, $this->platform);
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'type'=>"error", 'title' => "Validation", 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {
                $role = new Role;
                $role->role = $values['role'];
                $role->description = $values['description'];
                if ($role->save()) {
                    $role_id = $role->id;
                    $sub_module = SubModule::all();
                    //print_r($sub_module); exit();

                    foreach ($sub_module as $temp) {
                        //echo $temp->id;
                        $permission = new RolePermission;
                        $permission->role_id = $role_id;
                        $permission->module_id = $temp->module_id;
                        $permission->sub_module_id = $temp->id;
                        $permission->module_access = 0;
                        $permission->sub_module_access = 0;
                        $permission->access_item = 0;
                        $permission->add_item = 0;
                        $permission->edit_item = 0;
                        $permission->details_item = 0;
                        $permission->delete_item = 0;
                        $permission->status_item = 0;
                        $permission->save();
                    }

                    return response()->json(['status' => 1, 'type'=>"success", 'title' => "Add Role", 'msg' => 'Banner Successfully saved.'], config('constants.ok'));
                } else {
                    return response()->json(['status' => 0, 'type'=>"warning", 'title' => "Add Role", 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'type'=>"error", 'title' => "Validation", 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function updateRole(Request $request)
    {
        $values = $request->only('id', 'role', 'description');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

        try {
            //--Checking The Validation--//
            $validator = $this->isValid($request->all(), 'updateRole', 0, $this->platform);
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'type'=>"error", 'title' => "Add Role", 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {
                $role = Role::find($id);
                $role->role = $values['role'];
                $role->description = $values['description'];

                if ($role->update()) {
                    return response()->json(['status' => 1, 'type'=>"success", 'title' => "Update Role", 'msg' => 'Role Successfully updated.'], config('constants.ok'));
                } else {
                    return response()->json(['status' => 0, 'type'=>"warning", 'title' => "Update Role", 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'type'=>"error", 'title' => "Update Role", 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function statusRole($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $result = $this->changeStatus($id, 'Role');
            if ($result === true) {
                return response()->json(['status' => 1, 'type'=>"success", 'title' => "Change Role Status", 'msg' => 'Status successfully changed.'], config('constants.ok'));
            } else {
                return Response()->json(['status' => 0, 'type'=>"warning", 'title' => "Change Role Status", 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
            }
        } catch (Exception $e) {
            return Response()->json(['status' => 0, 'type'=>"error", 'title' => "Change Role Status", 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }



    //////////////Permissions///////////////
    public function showPermission()
    {
        $role = Role::all();
        // $role = Role::where('id', '!=', 1)->get();

        return view('admin.role_permission.permissions', ['role' => $role]);
    }

    public function showEditPermission($id)
    {
        //$user = auth()->guard('admin')->user();

        $permissions = DB::table('role_permission')
            ->join('module', 'module.id', '=', 'role_permission.module_id')
            ->join('sub_module', 'sub_module.id', '=', 'role_permission.sub_module_id')
            ->select('role_permission.*', 'module.name as module_name', 'sub_module.name as sub_module_name', 'sub_module.add_action', 'sub_module.edit_action', 'sub_module.details_action', 'sub_module.delete_action', 'sub_module.status_action')
            ->where('role_permission.role_id', $id)
            ->get();

        return view('admin.role_permission.edit_permissions', ['permissions' => $permissions]);
    }

    public function updatePermission(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $ids = $request->get('id');
        $role_id = $request->get('role_id');
        //print_r($ids); exit();
        //for($i=$ids[0]; $i<=count($ids); $i++)
        foreach ($ids as $i) {
            $access_item = $request->get('access_item' . $i);
            $add_item = $request->get('add_item' . $i);
            $edit_item = $request->get('edit_item' . $i);
            $details_item = $request->get('details_item' . $i);
            $delete_item = $request->get('delete_item' . $i);
            $status_item = $request->get('status_item' . $i);

            $permission = RolePermission::find($i);
            if (!empty($access_item)) {
                $permission->access_item = $access_item;
            } else {
                $permission->access_item = 0;
            }
            if (!empty($add_item)) {
                $permission->add_item = $add_item;
            } else {
                $permission->add_item = 0;
            }
            if (!empty($edit_item)) {
                $permission->edit_item = $edit_item;
            } else {
                $permission->edit_item = 0;
            }
            if (!empty($details_item)) {
                $permission->details_item = $details_item;
            } else {
                $permission->details_item = 0;
            }
            if (!empty($delete_item)) {
                $permission->delete_item = $delete_item;
            } else {
                $permission->delete_item = 0;
            }
            if (!empty($status_item)) {
                $permission->status_item = $status_item;
            } else {
                $permission->status_item = 0;
            }


            $permission->update();

            ///check all permission like access add etc of a sub module. because if all permission is 0 then sub module access permission is 0.
            $permissions = RolePermission::find($i);
            if ($permissions->access_item == 0) {
                $permissions->sub_module_access = 0;
            } else {
                $permissions->sub_module_access = 1;
            }
            $permissions->update();
        }

        ////check all sub_module_access permission. Because if all sub_module_access permission is 0 then module_access permission is 0 
        $module_id = 0;
        foreach ($ids as $i) {
            $permissions = RolePermission::find($i);
            if ($permissions->module_id != $module_id) {
                $module_id = $permissions->module_id;
                $sub_module_permission = RolePermission::where('module_id', $module_id)->where('role_id', $role_id)->select('sub_module_access')->distinct()->get();
                //echo json_encode($sub_module_permission);exit();
                $arr = array();
                foreach ($sub_module_permission as $temp) {
                    array_push($arr, $temp->sub_module_access);
                    if (in_array(1, $arr)) {
                        DB::table('role_permission')->where('module_id', $module_id)->where('role_id', $role_id)->update(['module_access' => 1]);
                    } else {
                        DB::table('role_permission')->where('module_id', $module_id)->where('role_id', $role_id)->update(['module_access' => 0]);
                    }
                }
            }
        }


        return redirect('admin/roles-permissions/permissions/edit/' . $role_id)->with('success', 'Permission successfully updated.');
        //$permissions=RolePermission::where('role_id',$user->role);
    }
}
