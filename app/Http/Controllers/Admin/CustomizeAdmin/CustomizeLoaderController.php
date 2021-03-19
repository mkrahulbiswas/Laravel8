<?php

namespace App\Http\Controllers\Admin\CustomizeAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;
use App\Traits\ValidationTrait;

use App\CustomizeLoader;

use League\Flysystem\Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class CustomizeLoaderController extends Controller
{
    use FileTrait, CommonTrait, ValidationTrait;
    public $platform = 'backend';


    /*------- ( Customize Loader Index ) -------*/
    public function showCustomizeLoader()
    {
        try {
            return view('admin.customize_admin.loader.index');
        } catch (Exception $e) {
            abort(500);
        }
    }


    /*------- ( Customize Table Methodes ) -------*/
    public function ajaxGetInternalLoader(Request $request)
    {
        try {
            $customizeLoader = CustomizeLoader::orderBy('id', 'desc')->where('loaderFor', '2')->select('id', 'loaderFor', 'html', 'css', 'js', 'status');

            return Datatables::of($customizeLoader)
                ->addIndexColumn()
                ->addColumn('html', function ($data) {
                    $html = '<!--' . substr($data->html, 0, 30) . '-->...';
                    return $html;
                })
                ->addColumn('css', function ($data) {
                    $css = '<!--' . substr($data->css, 0, 30) . '...';
                    return $css;
                })
                ->addColumn('js', function ($data) {
                    $js = '<!--' . substr($data->js, 0, 30) . '...';
                    return $js;
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
                        'loaderFor' => $data->loaderFor,
                        'html' => $data->html,
                        'css' => $data->css,
                        'js' => $data->js,
                    ];

                    if ($itemPermission['status_item'] == '1') {
                        if ($data->status == "0") {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="unblock" data-action="' . route('status.customizeLoader') . '/' . $dataArray['id'] . '/' . '" class="actionDatatable" title="Block"><i class="md md-lock" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        } else {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="block" data-action="' . route('status.customizeLoader') . '/' . $dataArray['id'] . '/' . '" class="actionDatatable" title="Unblock"><i class="md md-lock-open" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        }
                    } else {
                        $status = '';
                    }

                    if ($itemPermission['edit_item'] == '1') {
                        $edit = '<a href="JavaScript:void(0);" data-type="edit" data-array=\'' . json_encode($dataArray, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) . '\' title="Edit" class="actionDatatable"><i class="md md-edit" style="font-size: 20px;"></i></a>';
                    } else {
                        $edit = '';
                    }

                    if ($itemPermission['delete_item'] == '1') {
                        $delete = '<a href="JavaScript:void(0);" data-type="delete" data-action="' . route('delete.customizeLoader') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Delete"><i class="md md-delete" style="font-size: 20px; color: red;"></i></a>';
                    } else {
                        $delete = '';
                    }

                    if ($itemPermission['details_item'] == '1') {
                        $detail = '<a href="' .  route('details.customizeLoader') . '/' . $dataArray['id'] . '" target="_blank" title="Details" class="actionDatatable"><i class="md md-visibility" style="font-size: 20px; color: green;"></i></a>';
                    } else {
                        $detail = '';
                    }

                    return $status . ' ' . $edit . ' ' . $delete . ' ' . $detail;
                })
                ->rawColumns(['html', 'css', 'js', 'status', 'action'])
                ->make(true);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function ajaxGetPageLoader(Request $request)
    {
        try {
            $customizeLoader = CustomizeLoader::orderBy('id', 'desc')->where('loaderFor', '1')->select('id', 'loaderFor', 'html', 'css', 'js', 'status');

            return Datatables::of($customizeLoader)
                ->addIndexColumn()
                ->addColumn('html', function ($data) {
                    $html = substr($data->html, 0, 30) . '...';
                    return $html;
                })
                ->addColumn('css', function ($data) {
                    $css = substr($data->css, 0, 30) . '...';
                    return $css;
                })
                ->addColumn('js', function ($data) {
                    $js = substr($data->js, 0, 30) . '...';
                    return $js;
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
                        'loaderFor' => $data->loaderFor,
                        'html' => $data->html,
                        'css' => $data->css,
                        'js' => $data->js,
                    ];

                    if ($itemPermission['status_item'] == '1') {
                        if ($data->status == "0") {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="unblock" data-action="' . route('status.customizeLoader') . '/' . $dataArray['id'] . '/' . '" class="actionDatatable" title="Block"><i class="md md-lock" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        } else {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="block" data-action="' . route('status.customizeLoader') . '/' . $dataArray['id'] . '/' . '" class="actionDatatable" title="Unblock"><i class="md md-lock-open" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        }
                    } else {
                        $status = '';
                    }

                    if ($itemPermission['edit_item'] == '1') {
                        $edit = '<a href="JavaScript:void(0);" data-type="edit" data-array=\'' . json_encode($dataArray, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) . '\' title="Edit" class="actionDatatable"><i class="md md-edit" style="font-size: 20px;"></i></a>';
                    } else {
                        $edit = '';
                    }

                    if ($itemPermission['delete_item'] == '1') {
                        $delete = '<a href="JavaScript:void(0);" data-type="delete" data-action="' . route('delete.customizeLoader') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Delete"><i class="md md-delete" style="font-size: 20px; color: red;"></i></a>';
                    } else {
                        $delete = '';
                    }

                    if ($itemPermission['details_item'] == '1') {
                        $detail = '<a href="' .  route('details.customizeLoader') . '/' . $dataArray['id'] . '" target="_blank" title="Details" class="actionDatatable"><i class="md md-visibility" style="font-size: 20px; color: green;"></i></a>';
                    } else {
                        $detail = '';
                    }

                    return $status . ' ' . $edit . ' ' . $delete . ' ' . $detail;
                })
                ->rawColumns(['html', 'css', 'js', 'status', 'action'])
                ->make(true);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function saveCustomizeLoader(Request $request)
    {
        try {
            $values = $request->only('loaderFor', 'html', 'css', 'js');
            //--Checking The Validation--//

            $validator = $this->isValid($request->all(), 'saveLoader', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {

                foreach ($values['loaderFor'] as $temp) {
                    $customizeLoader = new CustomizeLoader;

                    $customizeLoader->html = $values['html'];
                    $customizeLoader->css = $values['css'];
                    $customizeLoader->js = $values['js'];
                    $customizeLoader->loaderFor = $temp;

                    $success = $customizeLoader->save();
                }
                if ($success) {
                    return Response()->Json(['status' => 1, 'msg' => 'Loader successfully saved.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function updateCustomizeLoader(Request $request)
    {
        $values = $request->only('id', 'loaderFor', 'html', 'css', 'js');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $validator = $this->isValid($request->all(), 'updateLoader', $id, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {
                $customizeLoader = CustomizeLoader::find($id);

                $customizeLoader->html = $values['html'];
                $customizeLoader->css = $values['css'];
                $customizeLoader->js = $values['js'];
                $customizeLoader->loaderFor = $values['loaderFor'];

                if ($customizeLoader->update()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Loader successfully updated.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function statusCustomizeLoader($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $loaderFor = CustomizeLoader::find($id)->loaderFor;

            if (DB::table('customizeloader')->where('loaderFor', $loaderFor)->update(array('status' => '0'))) {
                $result = $this->changeStatus($id, 'CustomizeLoader');
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

    public function deleteCustomizeLoader($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $customizeLoader = CustomizeLoader::find($id);
            if ($customizeLoader->status == '1') {
                return Response()->Json(['status' => 0, 'msg' => 'You cant delete this active style'], config('constants.ok'));
            } else {
                if ($customizeLoader->delete()) {
                    return response()->Json(['status' => 1, 'msg' => 'Successfully style Deleted.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function detailsCustomizeLoader($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

        try {
            $customizeLoader = CustomizeLoader::where('id', $id)->first();

            $data = array(
                'id' => encrypt($customizeLoader->id),
                'html' => $customizeLoader->html,
                'css' => $customizeLoader->css,
                'js' => $customizeLoader->js,
                'loaderFor' => $customizeLoader->loaderFor,
            );

            return view('admin.customize_admin.loader.loader_detail')->with('data', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
