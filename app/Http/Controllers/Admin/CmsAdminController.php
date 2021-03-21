<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;
use App\Traits\ValidationTrait;

use App\Banner;
use App\Logo;
use App\PrivacyPolicy;
use App\TermsCondition;
use App\AboutUs;
use App\Faq;
use App\Offer;

use League\Flysystem\Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class CmsAdminController extends Controller
{
    use FileTrait, CommonTrait, ValidationTrait;
    public $platform = 'backend';



    ////Banner////
    public function showBanner()
    {
        return view('admin.cms.banner.banner');
    }

    public function ajaxGetBanner()
    {
        try {
            $banner = Banner::orderBy('id', 'desc')->select('id', 'image', 'status');

            return Datatables::of($banner)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $image = '<img src="' . $this->picUrl($data->image, 'bannerPic', $this->platform) . '" class="img-fluid rounded" width="100"/>';
                    return $image;
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
                        'image' => $this->picUrl($data->image, 'bannerPic', $this->platform)
                    ];

                    if ($itemPermission['status_item'] == '1') {
                        if ($data->status == "0") {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="unblock" data-action="' . route('status.banner') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Block"><i class="md md-lock" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        } else {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="block" data-action="' . route('status.banner') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Unblock"><i class="md md-lock-open" style="font-size: 20px; color: #2bbbad;"></i></a>';
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
                        $delete = '<a href="JavaScript:void(0);" data-action="' . route('delete.banner') . '/' . $dataArray['id'] . '" data-type="delete" class="actionDatatable" title="Delete"><i class="md md-delete" style="font-size: 20px; color: red;"></i></a>';
                    } else {
                        $delete = '';
                    }

                    return $status . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function saveBanner(Request $request)
    {
        try {
            $file = $request->file('file');

            //--Checking The Validation--//

            $validator = $this->isValid($request->all(), 'saveBanner', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {

                //--Insert Banner--//
                if (!empty($file)) {
                    $image = $this->uploadPicture($file, '', $this->platform, 'bannerPic');
                    if ($image === false) {
                        return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                    }
                } else {
                    $image = "NA";
                }

                $banner = new Banner;
                $banner->image = $image;

                if ($banner->save()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Banner Successfully saved.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function updateBanner(Request $request)
    {
        $values = $request->only('id');
        $file = $request->file('file');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

        try {
            //--Checking The Validation--//
            $validator = $this->isValid($request->all(), 'updateBanner', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {

                $banner = Banner::find($id);

                if (!empty($file)) {
                    $image = $this->uploadPicture($file, $banner->image, $this->platform, 'bannerPic');
                    if ($image === false) {
                        return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                    } else {
                        $banner->image = $image;
                    }
                }

                if ($banner->update()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Banner Successfully updated.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function statusBanner($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $result = $this->changeStatus($id, 'Banner');
            if ($result === true) {
                return response()->Json(['status' => 1, 'msg' => 'Status successfully changed.'], config('constants.ok'));
            } else {
                return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function deleteBanner($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $result = $this->deleteItem($id, 'Banner', config('constants.bannerPic'));
            if ($result === true) {
                return response()->Json(['status' => 1, 'msg' => 'Successfully data Deleted.'], config('constants.ok'));
            } else {
                return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }



    ////Logo////
    public function showLogo()
    {
        try {
            return view('admin.cms.logo.logo_list');
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function ajaxGetLogo()
    {
        try {
            $logo = Logo::orderBy('id', 'desc')->select('id', 'bigLogo', 'smallLogo', 'favIcon', 'status');

            return Datatables::of($logo)
                ->addIndexColumn()
                ->addColumn('bigLogo', function ($data) {
                    $bigLogo = '<img src="' . $this->picUrl($data->bigLogo, 'bigLogoPic', $this->platform) . '" class="img-fluid rounded" width="100"/>';
                    return $bigLogo;
                })
                ->addColumn('smallLogo', function ($data) {
                    $smallLogo = '<img src="' . $this->picUrl($data->smallLogo, 'smallLogoPic', $this->platform) . '" class="img-fluid rounded" width="100"/>';
                    return $smallLogo;
                })
                ->addColumn('favIcon', function ($data) {
                    $favIcon = '<img src="' . $this->picUrl($data->favIcon, 'favIconPic', $this->platform) . '" class="img-fluid rounded" width="100"/>';
                    return $favIcon;
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
                        'bigLogo' => $this->picUrl($data->bigLogo, 'bigLogoPic', $this->platform),
                        'smallLogo' => $this->picUrl($data->smallLogo, 'smallLogoPic', $this->platform),
                        'favIcon' => $this->picUrl($data->favIcon, 'favIconPic', $this->platform)
                    ];

                    if ($itemPermission['status_item'] == '1') {
                        if ($data->status == "0") {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="unblock" data-action="' . route('status.logo') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Block"><i class="md md-lock" style="font-size: 20px; color: #2bbbad;"></i></a>';
                        } else {
                            $status = '<a href="JavaScript:void(0);" data-type="status" data-status="block" data-action="' . route('status.logo') . '/' . $dataArray['id'] . '" class="actionDatatable" title="Unblock"><i class="md md-lock-open" style="font-size: 20px; color: #2bbbad;"></i></a>';
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
                        $delete = '<a href="JavaScript:void(0);" data-action="' . route('delete.logo') . '/' . $dataArray['id'] . '" data-type="delete" class="actionDatatable" title="Delete"><i class="md md-delete" style="font-size: 20px; color: red;"></i></a>';
                    } else {
                        $delete = '';
                    }

                    return $status . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['bigLogo', 'smallLogo', 'favIcon', 'status', 'action'])
                ->make(true);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function saveLogo(Request $request)
    {
        try {
            $bigLogo = $request->file('bigLogo');
            $smallLogo = $request->file('smallLogo');
            $favIcon = $request->file('favIcon');
            //--Checking The Validation--//

            $validator = $this->isValid($request->all(), 'saveLogo', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {

                //--Insert Banner--//
                if (!empty($bigLogo)) {
                    $bigLogo = $this->uploadPicture($bigLogo, '', $this->platform, 'bigLogoPic');
                    if ($bigLogo === false) {
                        return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                    }
                } else {
                    $bigLogo = "NA";
                }

                if (!empty($smallLogo)) {
                    $smallLogo = $this->uploadPicture($smallLogo, '', $this->platform, 'smallLogoPic');
                    if ($smallLogo === false) {
                        return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                    }
                } else {
                    $smallLogo = "NA";
                }

                if (!empty($favIcon)) {
                    $favIcon = $this->uploadPicture($favIcon, '', $this->platform, 'favIconPic');
                    if ($favIcon === false) {
                        return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                    }
                } else {
                    $favIcon = "NA";
                }

                $logo = new Logo;
                $logo->bigLogo = $bigLogo;
                $logo->smallLogo = $smallLogo;
                $logo->favIcon = $favIcon;

                if ($logo->save()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Logo Successfully saved.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function updateLogo(Request $request)
    {
        $values = $request->only('id');
        $bigLogo = $request->file('bigLogo');
        $smallLogo = $request->file('smallLogo');
        $favIcon = $request->file('favIcon');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $validator = $this->isValid($request->all(), 'updateLogo', 0, $this->platform);
            if ($validator->fails()) {
                return Response()->Json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'errors' => $validator->errors()], config('constants.ok'));
            } else {
                $logo = Logo::find($id);

                if (!empty($bigLogo)) {
                    $image = $this->uploadPicture($bigLogo, $logo->bigLogo, $this->platform, 'bigLogoPic');
                    if ($image === false) {
                        return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                    } else {
                        $logo->bigLogo = $image;
                    }
                }

                if (!empty($smallLogo)) {
                    $image = $this->uploadPicture($smallLogo, $logo->smallLogo, $this->platform, 'smallLogoPic');
                    if ($image === false) {
                        return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                    } else {
                        $logo->smallLogo = $image;
                    }
                }

                if (!empty($favIcon)) {
                    $image = $this->uploadPicture($favIcon, $logo->favIcon, $this->platform, 'favIconPic');
                    if ($image === false) {
                        return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                    } else {
                        $logo->favIcon = $image;
                    }
                }

                if ($logo->update()) {
                    return Response()->Json(['status' => 1, 'msg' => 'Logo Successfully updated.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function statusLogo($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $logo = Logo::find($id);
            if ($logo->status == '1') {
                return Response()->Json(['status' => 0, 'msg' => 'You cant change the status of this active logo'], config('constants.ok'));
            } else {
                foreach (Logo::get() as $temp) {
                    $logo = Logo::find($temp->id);
                    $logo->status = '0';
                    $logo->update();
                }

                $result = $this->changeStatus($id, 'Logo');
                if ($result === true) {
                    return response()->Json(['status' => 1, 'msg' => 'Status successfully changed.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }

    public function deleteLogo($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }

        try {
            $logo = Logo::find($id);
            if ($logo->status == '1') {
                return Response()->Json(['status' => 0, 'msg' => 'You cant delete this active logo'], config('constants.ok'));
            } else {
                if ($logo->bigLogo != 'NA') {
                    unlink(config('constants.bigLogoPic') . $logo->bigLogo);
                }
                if ($logo->smallLogo != 'NA') {
                    unlink(config('constants.smallLogoPic') . $logo->smallLogo);
                }
                if ($logo->favIcon != 'NA') {
                    unlink(config('constants.favIconPic') . $logo->favIcon);
                }
                if ($logo->delete()) {
                    return response()->Json(['status' => 1, 'msg' => 'Successfully logo Deleted.'], config('constants.ok'));
                } else {
                    return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
                }
            }
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }





    /*------*/
    public function showPrivacyPolicy()
    {
        try {
            $privacyPolicy = DB::table('privacy_policy')->first();
            return view('admin.cms.privacy_policy.privacy_policy', ['privacyPolicy' => $privacyPolicy]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function savePrivacyPolicy(Request $request)
    {
        $values = $request->only('id', 'privacyPolicy');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

        try {

            $privacyPolicy = PrivacyPolicy::find($id);

            $privacyPolicy->privacyPolicy = $values['privacyPolicy'];

            if ($privacyPolicy->save()) {
                return redirect()->back()->with('success', 'Privacy Policy successfully save.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function showTermsConditions()
    {
        try {
            $termsCondition = DB::table('terms_condition')->first();
            return view('admin.cms.terms_conditions.terms_conditions', ['termsCondition' => $termsCondition]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function saveTermsConditions(Request $request)
    {
        $values = $request->only('id', 'termsCondition');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

        try {

            $termsCondition = TermsCondition::find($id);

            $termsCondition->termsCondition = $values['termsCondition'];

            if ($termsCondition->save()) {
                return redirect()->back()->with('success', 'Terms Condition successfully save.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }


    public function showaboutUs()
    {
        try {
            $aboutUs = DB::table('about_us')->first();
            return view('admin.cms.about_us.about_us', ['aboutUs' => $aboutUs]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function saveaboutUs(Request $request)
    {
        $values = $request->only('id', 'aboutUs');

        try {
            $id = decrypt($values['id']);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

        try {
            $aboutUs = AboutUs::find($id);
            $aboutUs->aboutUs = $values['aboutUs'];

            if ($aboutUs->save()) {
                return redirect()->back()->with('success', 'About Us successfully save.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
