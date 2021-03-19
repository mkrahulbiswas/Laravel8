<?php

namespace App\Http\Controllers\Admin\CustomizeAdmin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;
use App\Traits\ValidationTrait;

use App\CustomizeTable;

use League\Flysystem\Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class CustomizeTableController extends Controller
{
    use FileTrait, CommonTrait, ValidationTrait;
    public $platform = 'backend';




    /*------- ( Customize Table Methodes ) -------*/
    public function ajaxGetCustomizeTable(Request $request)
    {
        try {
            $tableStatus = $request->tableStatus;
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;

            $field = 'created_at';
            $query = "`headBackColor` != 'null'";

            if (!empty($tableStatus)) {
                $tableStatus = ($tableStatus == 2) ? '0' : $tableStatus;
                $query .= " and `status` = '$tableStatus'";
            }

            if (!empty($fromDate) && !empty($toDate)) {
                $fromDate = date('Y-m-d', strtotime($fromDate)) . ' 00:00:01';
                $toDate = date('Y-m-d', strtotime($toDate)) . ' 23:59:59';
                $query .= " and $field BETWEEN '$fromDate' AND '$toDate'";
            }

            $customizeTable = CustomizeTable::orderBy('id', 'desc')->whereRaw($query)->select('id', 'headBackColor', 'headTextColor', 'headHoverBackColor', 'headHoverTextColor', 'bodyBackColor', 'bodyTextColor', 'bodyHoverBackColor', 'bodyHoverTextColor', 'status');

            return Datatables::of($customizeTable)
                ->addIndexColumn()
                ->addColumn('checkBox', function ($data) {
                    $checkBox = '<input type="checkbox" name="customizeTableCheckbox[]" class="customizeTableCheckbox" value="' . encrypt($data->id) . '">';
                    return $checkBox;
                })
                ->addColumn('tableHead', function ($data) {
                    $tableHead = '<button type="button" class="btn" style="background-color:rgba(' . $data->headBackColor . '); color:rgba(' . $data->headTextColor . ');"> Normaly</button> &nbsp; <button type="button" class="btn" style="background-color:rgba(' . $data->headHoverBackColor . '); color:rgba(' . $data->headHoverTextColor . ');"> On Hover</button>';
                    return $tableHead;
                })
                ->addColumn('tableBody', function ($data) {
                    $tableBody = '<button type="button" class="btn" style="background-color:rgba(' . $data->bodyBackColor . '); color:rgba(' . $data->bodyTextColor . ');"> On Hover</button>&nbsp; <button type="button" class="btn" style="background-color:rgba(' . $data->bodyHoverBackColor . '); color:rgba(' . $data->bodyHoverTextColor . ');"> On Hover</button>';
                    return $tableBody;
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
                    ];

                    if ($itemPermission['status_item'] == '1') {
                        if ($data->status == "0") {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="unblock" data-action="' . route('status.customizeTable') . '/' . $dataArray['id'] . '/' . '" class="actionDatatable" title="Block"><i class="md md-lock" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        } else {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="block" data-action="' . route('status.customizeTable') . '/' . $dataArray['id'] . '/' . '" class="actionDatatable" title="Unblock"><i class="md md-lock-open" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        }
                    } else {
                        $status = '';
                    }

                    if ($itemPermission['edit_item'] == '1') {
                        $edit = '<a href="' . route('edit.customizeTableColor') . '/' . $dataArray['id'] . '" target="_blank" title="Update"><i class="md md-edit" style="font-size: 20px;"></i></a>';
                    } else {
                        $edit = '';
                    }

                    if ($itemPermission['delete_item'] == '1') {
                        $delete = '<a href="JavaScript:void(0);" data-type="delete" data-action="' . route('delete.customizeTable') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Delete"><i class="md md-delete" style="font-size: 20px; color: red;"></i></a>';
                    } else {
                        $delete = '';
                    }

                    if ($itemPermission['details_item'] == '1') {
                        $detail = '<a href="' .  route('details.customizeTable') . '/' . $dataArray['id'] . '" target="_blank" title="Details"><i class="md md-visibility" style="font-size: 20px; color: green;"></i></a>';
                    } else {
                        $detail = '';
                    }

                    return $status . ' ' . $edit . ' ' . $delete . ' ' . $detail;
                })
                ->rawColumns(['checkBox', 'tableHead', 'tableBody', 'status', 'action'])
                ->make(true);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }



    public function addCustomizeTableColor()
    {
        try {
            return view('admin.customize_admin.appearance.table.body_head_color.table_add');
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function saveCustomizeTableColor(Request $request)
    {
        try {
            $values = $request->only('tableHeadBackColor', 'tableHeadTextColor', 'tableHeadHoverBackColor', 'tableHeadHoverTextColor', 'tableBodyBackColor', 'tableBodyTextColor', 'tableBodyHoverBackColor', 'tableBodyHoverTextColor');
            //--Checking The Validation--//

            $validator = $this->isValid($request->all(), 'saveCustomizeTable', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {

                $customizeTable = new CustomizeTable;

                $customizeTable->headBackColor = str_replace(" ", "", $values['tableHeadBackColor']);
                $customizeTable->headTextColor = str_replace(" ", "", $values['tableHeadTextColor']);
                $customizeTable->headHoverBackColor = str_replace(" ", "", $values['tableHeadHoverBackColor']);
                $customizeTable->headHoverTextColor = str_replace(" ", "", $values['tableHeadHoverTextColor']);
                $customizeTable->bodyBackColor = str_replace(" ", "", $values['tableBodyBackColor']);
                $customizeTable->bodyTextColor = str_replace(" ", "", $values['tableBodyTextColor']);
                $customizeTable->bodyHoverBackColor = str_replace(" ", "", $values['tableBodyHoverBackColor']);
                $customizeTable->bodyHoverTextColor = str_replace(" ", "", $values['tableBodyHoverTextColor']);

                $dataOne = array(
                    'fontType' => '"Roboto", sans-serif',
                    'fontStyle' => 'normal',
                    'fontWeight' => 'normal',
                    'fontSize' => '14',

                    'decorationType' => 'underline',
                    'decorationStyle' => 'dashed',
                    'decorationColor' => '0,0,0,0',
                    'decorationSize' => '1',
                );
                $dataTwo = array(
                    'fontType' => '"Roboto", sans-serif',
                    'fontStyle' => 'normal',
                    'fontWeight' => 'normal',
                    'fontSize' => '14',

                    'decorationType' => 'underline',
                    'decorationStyle' => 'dashed',
                    'decorationColor' => '0,0,0,0',
                    'decorationSize' => '1',
                );
                $customizeTable->headTableStyle = json_encode($dataOne);
                $customizeTable->bodyTableStyle = json_encode($dataTwo);

                if ($customizeTable->save()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Background and Text color of table "BODY" & "HEAD" successfully saved.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function editCustomizeTableColor($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $customizeTable = CustomizeTable::findOrFail($id);
            $data = array(
                'id' => encrypt($customizeTable->id),
                'headBackColor' => $customizeTable->headBackColor,
                'headTextColor' => $customizeTable->headTextColor,
                'headHoverBackColor' => $customizeTable->headHoverBackColor,
                'headHoverTextColor' => $customizeTable->headHoverTextColor,
                'bodyBackColor' => $customizeTable->bodyBackColor,
                'bodyTextColor' => $customizeTable->bodyTextColor,
                'bodyHoverBackColor' => $customizeTable->bodyHoverBackColor,
                'bodyHoverTextColor' => $customizeTable->bodyHoverTextColor,
            );
            return view('admin.customize_admin.appearance.table.body_head_color.table_edit', ['data' => $data]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function updateCustomizeTableColor(Request $request)
    {
        $values = $request->only('id', 'tableHeadBackColor', 'tableHeadTextColor', 'tableHeadHoverBackColor', 'tableHeadHoverTextColor', 'tableBodyBackColor', 'tableBodyTextColor', 'tableBodyHoverBackColor', 'tableBodyHoverTextColor');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $validator = $this->isValid($request->all(), 'updateCustomizeTable', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {
                $customizeTable = CustomizeTable::find($id);

                $customizeTable->headBackColor = str_replace(" ", "", $values['tableHeadBackColor']);
                $customizeTable->headTextColor = str_replace(" ", "", $values['tableHeadTextColor']);
                $customizeTable->headHoverBackColor = str_replace(" ", "", $values['tableHeadHoverBackColor']);
                $customizeTable->headHoverTextColor = str_replace(" ", "", $values['tableHeadHoverTextColor']);
                $customizeTable->bodyBackColor = str_replace(" ", "", $values['tableBodyBackColor']);
                $customizeTable->bodyTextColor = str_replace(" ", "", $values['tableBodyTextColor']);
                $customizeTable->bodyHoverBackColor = str_replace(" ", "", $values['tableBodyHoverBackColor']);
                $customizeTable->bodyHoverTextColor = str_replace(" ", "", $values['tableBodyHoverTextColor']);

                if ($customizeTable->update()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Background and Text color of table "BODY" & "HEAD" successfully updated.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }



    public function addCustomizeTableStyle($id)
    {
        try {
            return view('admin.customize_admin.appearance.table.body_head_style.table_add', compact('id'));
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function saveCustomizeTableStyle(Request $request)
    {
        $values = $request->only('id', 'headFontType', 'headFontStyle', 'headFontWeight', 'headFontSize', 'bodyFontType', 'bodyFontStyle', 'bodyFontWeight', 'bodyFontSize', 'headDecorationType', 'headDecorationStyle', 'headDecorationColor', 'headDecorationSize', 'bodyDecorationType', 'bodyDecorationStyle', 'bodyDecorationColor', 'bodyDecorationSize');

        try {
            foreach (explode(',', $values['id']) as $temp) {
                $id[] = decrypt($temp);
            }
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            //--Checking The Validation--//

            // $validator = $this->isValid($request->all(), 'saveCustomizeTable', 0, $this->platform);
            // if ($validator->fails()) {
            //     return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            // } else {
            foreach ($id as $temp) {
                $customizeTable = CustomizeTable::findOrFail($temp);
                $dataOne = array(
                    'fontType' => ($values['headFontType'] == '') ? '"Roboto", sans-serif' : $values['headFontType'],
                    'fontStyle' => ($values['headFontStyle'] == '') ? 'normal' : $values['headFontStyle'],
                    'fontWeight' => ($values['headFontWeight'] == '') ? 'normal' : $values['headFontWeight'],
                    'fontSize' => ($values['headFontSize'] == '') ? '14' : $values['headFontSize'],

                    'decorationType' => ($values['headDecorationType'] == '') ? 'underline' : $values['headDecorationType'],
                    'decorationStyle' => ($values['headDecorationStyle'] == '') ? 'dashed' : $values['headDecorationStyle'],
                    'decorationColor' => ($values['headDecorationColor'] == '') ? '0,0,0,0' : str_replace(" ", "", $values['headDecorationColor']),
                    'decorationSize' => ($values['headDecorationSize'] == '') ? '1' : $values['headDecorationSize'],
                );
                $dataTwo = array(
                    'fontType' => ($values['bodyFontType'] == '') ? '"Roboto", sans-serif' : $values['bodyFontType'],
                    'fontStyle' => ($values['bodyFontStyle'] == '') ? 'normal' : $values['bodyFontStyle'],
                    'fontWeight' => ($values['bodyFontWeight'] == '') ? 'normal' : $values['bodyFontWeight'],
                    'fontSize' => ($values['bodyFontSize'] == '') ? '14' : $values['bodyFontSize'],

                    'decorationType' => ($values['bodyDecorationType'] == '') ? 'underline' : $values['bodyDecorationType'],
                    'decorationStyle' => ($values['bodyDecorationStyle'] == '') ? 'dashed' : $values['bodyDecorationStyle'],
                    'decorationColor' => ($values['bodyDecorationColor'] == '') ? '0,0,0,0' : str_replace(" ", "", $values['bodyDecorationColor']),
                    'decorationSize' => ($values['bodyDecorationSize'] == '') ? '1' : $values['bodyDecorationSize'],
                );
                $customizeTable->headTableStyle = json_encode($dataOne);
                $customizeTable->bodyTableStyle = json_encode($dataTwo);

                $success = $customizeTable->update();
            }

            if ($success) {
                return Response()->Json(['status' => 1, 'msg' => 'Table "BODY" & "HEAD" style successfully saved.'], config('constants.ok'));
            } else {
                return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
            }
            // }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }



    public function statusCustomizeTable($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            if (DB::table('customizetable')->update(array('status' => '0'))) {
                $result = $this->changeStatus($id, 'CustomizeTable');
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

    public function deleteCustomizeTable($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $customizeTable = CustomizeTable::find($id);
            if ($customizeTable->status == '1') {
                return Response()->Json(['status' => 0, 'msg' => 'You cant delete this active style'], config('constants.ok'));
            } else {
                if ($customizeTable->delete()) {
                    return response()->Json(['status' => 1, 'msg' => 'Successfully style Deleted.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function detailsCustomizeTable($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

        try {
            $customizeTable = CustomizeTable::where('id', $id)->first();

            $data = array(
                'headBackColor' => $customizeTable->headBackColor,
                'headTextColor' => $customizeTable->headTextColor,
                'headHoverBackColor' => $customizeTable->headHoverBackColor,
                'headHoverTextColor' => $customizeTable->headHoverTextColor,
                'bodyBackColor' => $customizeTable->bodyBackColor,
                'bodyTextColor' => $customizeTable->bodyTextColor,
                'bodyHoverBackColor' => $customizeTable->bodyHoverBackColor,
                'bodyHoverTextColor' => $customizeTable->bodyHoverTextColor,

                'headTableStyle' => json_decode($customizeTable->headTableStyle),
                'bodyTableStyle' => json_decode($customizeTable->bodyTableStyle),
            );

            return view('admin.customize_admin.appearance.table.table_detail')->with('data', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
