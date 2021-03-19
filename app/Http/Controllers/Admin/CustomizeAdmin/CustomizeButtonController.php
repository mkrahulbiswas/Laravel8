<?php

namespace App\Http\Controllers\Admin\CustomizeAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;
use App\Traits\ValidationTrait;

use App\CustomizeButton;

use League\Flysystem\Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class CustomizeButtonController extends Controller
{
    use FileTrait, CommonTrait, ValidationTrait;
    public $platform = 'backend';




    /*------- ( Customize Apperance Index ) -------*/
    public function showAppearance()
    {
        try {
            return view('admin.customize_admin.appearance.index');
        } catch (Exception $e) {
            abort(500);
        }
    }


    public function ajaxGetCustomizeButton(Request $request)
    {
        try {
            $buttonType = $request->buttonType;
            $buttonStatus = $request->buttonStatus;
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;

            $field = 'created_at';
            $query = "`backColor` != 'null'";

            if (!empty($buttonType)) {
                $query .= " and `btnFor` = '$buttonType'";
            }

            if (!empty($buttonStatus)) {
                $buttonStatus = ($buttonStatus == 2) ? '0' : $buttonStatus;
                $query .= " and `status` = '$buttonStatus'";
            }

            if (!empty($fromDate) && !empty($toDate)) {
                $fromDate = date('Y-m-d', strtotime($fromDate)) . ' 00:00:01';
                $toDate = date('Y-m-d', strtotime($toDate)) . ' 23:59:59';
                $query .= " and $field BETWEEN '$fromDate' AND '$toDate'";
            }

            $customizeButton = CustomizeButton::orderBy('id', 'desc')->whereRaw($query)->select('id', 'btnIcon', 'backColor', 'textColor', 'backHoverColor', 'textHoverColor', 'btnFor', 'status');

            return Datatables::of($customizeButton)
                ->addIndexColumn()
                ->addColumn('backColor', function ($data) {
                    if ($data->btnFor == config('constants.addBtn')) {
                        $backColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backColor . '); color:rgba(' . $data->textColor . ');">Normaly</button>';
                    } else if ($data->btnFor == config('constants.saveBtn')) {
                        $backColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backColor . '); color:rgba(' . $data->textColor . ');">Normaly</button>';
                    } else if ($data->btnFor == config('constants.updateBtn')) {
                        $backColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backColor . '); color:rgba(' . $data->textColor . ');">Normaly</button>';
                    } else if ($data->btnFor == config('constants.searchBtn')) {
                        $backColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backColor . '); color:rgba(' . $data->textColor . ');">Normaly</button>';
                    } else if ($data->btnFor == config('constants.reloadBtn')) {
                        $backColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backColor . '); color:rgba(' . $data->textColor . ');">Normaly</button>';
                    } else {
                        $backColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backColor . '); color:rgba(' . $data->textColor . ');">Normaly</button>';
                    }
                    return $backColor;
                })
                ->addColumn('backHoverColor', function ($data) {
                    if ($data->btnFor == config('constants.addBtn')) {
                        $backHoverColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backHoverColor . '); color:rgba(' . $data->textHoverColor . ');">On Hover</button>';
                    } else if ($data->btnFor == config('constants.saveBtn')) {
                        $backHoverColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backHoverColor . '); color:rgba(' . $data->textHoverColor . ');">On Hover</button>';
                    } else if ($data->btnFor == config('constants.updateBtn')) {
                        $backHoverColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backHoverColor . '); color:rgba(' . $data->textHoverColor . ');">On Hover</button>';
                    } else if ($data->btnFor == config('constants.searchBtn')) {
                        $backHoverColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backHoverColor . '); color:rgba(' . $data->textHoverColor . ');">On Hover</button>';
                    } else if ($data->btnFor == config('constants.reloadBtn')) {
                        $backHoverColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backHoverColor . '); color:rgba(' . $data->textHoverColor . ');">On Hover</button>';
                    } else {
                        $backHoverColor = '<button type="button" class="btn waves-effect waves-light" style="background-color:rgba(' . $data->backHoverColor . '); color:rgba(' . $data->textHoverColor . ');">On Hover</button>';
                    }
                    return $backHoverColor;
                })
                ->addColumn('btnIcon', function ($data) {
                    $btnIcon = '<i class="' . $data->btnIcon . '" style="font-size: 20px;"></i>';
                    return $btnIcon;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == '0') {
                        $status = '<span class="label statusBlocked">Blocked</span>';
                    } else {
                        $status = '<span class="label statusActive">Active</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($data) {

                    $itemPermission = $this->itemPermission();

                    $dataArray = [
                        'id' => encrypt($data->id),
                        'btnIcon' => $data->btnIcon,
                        'backColor' => $data->backColor,
                        'textColor' => $data->textColor,
                        'backHoverColor' => $data->backHoverColor,
                        'textHoverColor' => $data->textHoverColor,
                        'btnFor' => $data->btnFor
                    ];

                    if ($itemPermission['status_item'] == '1') {
                        if ($data->status == "0") {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="unblock" data-action="' . route('status.customizeButton') . '/' . $dataArray['id'] . '/' . $dataArray['btnFor'] . '" class="actionDatatable" title="Block"><i class="md md-lock" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        } else {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="block" data-action="' . route('status.customizeButton') . '/' . $dataArray['id'] . '/' . $dataArray['btnFor'] . '" class="actionDatatable" title="Unblock"><i class="md md-lock-open" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        }
                    } else {
                        $status = '';
                    }

                    if ($itemPermission['edit_item'] == '1') {
                        $edit = '<a href="JavaScript:void(0);" data-type="edit" data-array=\'' . json_encode($dataArray) . '\' title="Edit" class="actionDatatable"><i class="md md-edit" style="font-size: 20px;"></i></a>';
                    } else {
                        $edit = '';
                    }

                    if ($itemPermission['delete_item'] == '1') {
                        $delete = '<a href="JavaScript:void(0);" data-type="delete" data-action="' . route('delete.customizeButton') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Delete"><i class="md md-delete" style="font-size: 20px; color: red;"></i></a>';
                    } else {
                        $delete = '';
                    }

                    if ($itemPermission['details_item'] == '1') {
                        $detail = '<a href="JavaScript:void(0);" data-type="detail" data-array=\'' . json_encode($dataArray) . '\' title="Details" class="actionDatatable"><i class="md md-visibility" style="font-size: 20px; color: green;"></i></a>';
                    } else {
                        $detail = '';
                    }

                    return $status . ' ' . $edit . ' ' . $delete . ' ' . $detail;
                })
                ->rawColumns(['backColor', 'backHoverColor', 'btnIcon', 'status', 'action'])
                ->make(true);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function saveCustomizeButton(Request $request)
    {
        try {
            $values = $request->only('buttonType', 'buttonIcon', 'btnBackColor', 'btnTextColor', 'btnHoverBackColor', 'btnHoverTextColor');
            //--Checking The Validation--//

            $validator = $this->isValid($request->all(), 'saveCustomizeButton', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {

                $customizeButton = new CustomizeButton;
                $customizeButton->btnIcon =  $values['buttonIcon'];
                $customizeButton->backColor = str_replace(" ", "", $values['btnBackColor']);
                $customizeButton->textColor = str_replace(" ", "", $values['btnTextColor']);
                $customizeButton->backHoverColor = str_replace(" ", "", $values['btnHoverBackColor']);
                $customizeButton->textHoverColor = str_replace(" ", "", $values['btnHoverTextColor']);
                $customizeButton->btnFor = $values['buttonType'];

                if ($customizeButton->save()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Button type "' . $values['buttonType'] . '" successfully saved.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function updateCustomizeButton(Request $request)
    {
        $values = $request->only('id', 'buttonType', 'buttonIcon', 'btnBackColor', 'btnTextColor', 'btnHoverBackColor', 'btnHoverTextColor');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $validator = $this->isValid($request->all(), 'updateCustomizeButton', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {
                $customizeButton = CustomizeButton::find($id);

                $customizeButton->btnIcon =  $values['buttonIcon'];
                $customizeButton->backColor = str_replace(" ", "", $values['btnBackColor']);
                $customizeButton->textColor = str_replace(" ", "", $values['btnTextColor']);
                $customizeButton->backHoverColor = str_replace(" ", "", $values['btnHoverBackColor']);
                $customizeButton->textHoverColor = str_replace(" ", "", $values['btnHoverTextColor']);
                $customizeButton->btnFor = $values['buttonType'];

                if ($customizeButton->update()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Button type "' . $values['buttonType'] . '" Successfully updated.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function statusCustomizeButton($id, $btnFor)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            if (DB::table('customizebutton')->where('btnFor', $btnFor)->update(array('status' => '0'))) {
                $result = $this->changeStatus($id, 'CustomizeButton');
                if ($result === true) {
                    return response()->Json(['status' => 1, 'msg' => 'Status successfully changed.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            } else {
                return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function deleteCustomizeButton($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $customizeButton = CustomizeButton::find($id);
            if ($customizeButton->status == '1') {
                return Response()->Json(['status' => 0, 'msg' => 'You cant delete this active style'], config('constants.ok'));
            } else {
                if ($customizeButton->delete()) {
                    return response()->Json(['status' => 1, 'msg' => 'Successfully style Deleted.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }
}
