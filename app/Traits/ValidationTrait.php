<?php

namespace app\Traits;

use App\Rules\UniqueEmail;
use App\Rules\UniquePhone;

use Validator;

trait ValidationTrait
{
    public function isValid($input, $case = 'create', $id = 0, $platform)
    {
        if ($platform == 'backend') {
            $validator = Validator::make($input, $this->vRulesBackend($input, $case, $id, 'rule'), $this->vRulesBackend($input, $case, $id, 'message'));

            return $validator;
        } elseif ($platform == 'web') {
            $validator = Validator::make($input, $this->vRulesWeb($input, $case, $id));

            return $validator;

            // if($validation->passes()) return true;
            // $this->vErrors = $validation->messages();

            // return false;
        } elseif ($platform == 'app') {
            $validator = Validator::make($input, $this->vRulesApp($input, $case, $id));
            if ($validator->passes()) {
                return true;
            }
            $this->vErrors = $validator->messages();
            return false;
        } else {
        }
        //$validation->setAttributeNames(static::$niceNames);
    }

    public function vRulesBackend($input, $case = 'create', $id = 0, $type)
    {
        $rules = [];
        $messages = [];

        switch ($case) {

                //AuthController
            case 'checkLogin':
                $rules = [
                    'password' => 'required',
                    'email' => 'required|email|max:100',
                ];
                break;

            case 'saveForgotPassword':
                $rules = [
                    'email' => 'required|email|max:100',
                ];
                break;

            case 'updateResetPassword':
                $rules = [
                    'otp' => 'required|digits:6',
                    'password' => 'required|min:6',
                    'confirmPassword' => 'required|same:password|min:6',
                ];
                break;


            case 'updateProfile':
                $rules = [
                    'file' => 'image|mimes:jpeg,jpg,png',
                    'name' => 'required|max:255|unique:admins,name,' . $id,
                    'phone' => 'required|digits:10|unique:admins,phone,' . $id,
                    'email' => 'required|email|max:100|unique:admins,email,' . $id,
                ];
                break;

            case 'changePassword':
                $rules = [
                    'currentPassword' => 'required',
                    'password_confirmation' => 'required',
                    'password' => 'required|min:6|max:20|confirmed',
                ];
                break;


                /*------ ( Role Permissions Start ) ------*/
                //-------Role
            case 'saveRole':
                $rules = [
                    'role' => 'required|max:255',
                    'description' => 'required',
                ];
                break;

            case 'updateRole':
                $rules = [
                    'role' => 'required|max:255',
                    'description' => 'required',
                ];
                break;
                /*------ ( Role Permissions End ) ------*/


            case 'saveBanner':
                $rules = [
                    'file' => 'required|image|mimes:jpeg,jpg,png',
                ];
                break;

            case 'updateBanner':
                $rules = [
                    'file' => 'image|mimes:jpeg,jpg,png',
                ];
                break;


            case 'saveLogo':
                $rules = [
                    'bigLogo' => 'required|mimes:jpeg,jpg,png,ico',
                    'smallLogo' => 'mimes:jpeg,jpg,png,ico',
                    'favIcon' => 'mimes:jpeg,jpg,png,ico',
                ];
                break;

            case 'updateLogo':
                $rules = [
                    'bigLogo' => 'mimes:jpeg,jpg,png,ico',
                    'smallLogo' => 'mimes:jpeg,jpg,png,ico',
                    'favIcon' => 'mimes:jpeg,jpg,png,ico',
                ];
                break;


                /*------ ( Admin ) ------*/
            case 'saveAdmin':
                $rules = [
                    'file' => 'image|mimes:jpeg,jpg,png',
                    'email' => 'required|email|max:100|unique:admins',
                    'phone' => 'required|max:100|unique:admins|digits:10',
                    'name' => 'required|max:255',
                ];
                break;

            case 'updateAdmin':
                $rules = [
                    'file' => 'image|mimes:jpeg,jpg,png',
                    'email' => 'required|email|max:100|unique:admins,email,' . $id,
                    'phone' => 'required|max:100|digits:10|unique:admins,phone,' . $id,
                    'name' => 'required|max:255',
                ];
                break;


                /*------ ( Admin Customize Button ) ------*/
            case 'saveCustomizeButton':
                $rules = [
                    'buttonType' => 'required',
                    'buttonIcon' => 'required',
                ];

                $messages = [
                    'buttonType.required' => 'Customize Button Type Is Required.',
                    'buttonIcon.required' => 'Customize Button Icon Is Required.',
                ];
                break;

            case 'updateCustomizeButton':
                $rules = [
                    'buttonType' => 'required',
                    'buttonIcon' => 'required',
                ];

                $messages = [
                    'buttonType.required' => 'Customize Button Type Is Required.',
                    'buttonIcon.required' => 'Customize Button Icon Is Required.',
                ];
                break;


                /*------ ( Admin Customize Table ) ------*/
            case 'saveCustomizeTable':
                $rules = [
                    // 'tableType' => 'required',
                ];

                $messages = [
                    // 'tableType.required' => 'Customize Table Type Is Required.',
                ];
                break;

            case 'updateCustomizeTable':
                $rules = [
                    // 'tableType' => 'required',
                ];

                $messages = [
                    // 'tableType.required' => 'Customize Button Type Is Required.',
                ];
                break;


                /*------ ( Admin Customize Loader ) ------*/
            case 'saveLoader':
                $rules = [
                    'loaderFor' => 'required',
                    'html' => 'required',
                    'css' => 'required',
                    // 'js' => 'required',
                ];
                break;

            case 'updateLoader':
                $rules = [
                    'loaderFor' => 'required',
                    'html' => 'required',
                    'css' => 'required',
                    // 'js' => 'required',
                ];
                break;


            case 'emailLogin':
            default:
                $rules = [
                    'email' => [
                        'required',
                        // Rule::exists('tbl_user', 'username')->where(function ($query) {
                        //  $query->where('is_email_verified', '=', 'Yes')
                        //          ->where('is_phone_verified', '=', 'Yes');
                        // }),
                    ],
                    'password' => 'required',
                ];
                break;
        }

        if ($type == 'rule') {
            return $rules;
        } else {
            return $messages;
        }
    }

    public function vRulesWeb($input, $case = 'create', $id = 0)
    {
        $rules = [];

        switch ($case) {

                //AuthController
            case 'emailLogin':
                $rules = [
                    'email' => 'required',
                    'password' => 'required',
                ];
                break;

            case 'emailLogin':
            default:
                $rules = [
                    'email' => [
                        'required',
                        // Rule::exists('tbl_user', 'username')->where(function ($query) {
                        //  $query->where('is_email_verified', '=', 'Yes')
                        //          ->where('is_phone_verified', '=', 'Yes');
                        // }),
                    ],
                    'password' => 'required',
                ];
                break;
        }
        return $rules;
    }

    public function vRulesApp($input, $case = 'create', $id = 0)
    {
        $rules = [];

        switch ($case) {

                //AuthController
            case 'register':
                $rules = [
                    'name' => 'required|max:100',
                    'email' => 'required|email|max:100|unique:users,email',
                    'phone' => 'required|integer|unique:users,phone',
                    'password' => 'required|min:6|max:20',
                ];
                break;

            case 'updateProfile':
                $rules = [
                    'name' => 'required|max:100',
                    'phone' => 'required|integer|unique:users,phone,' . $id,
                    'email' => 'required|email|max:100|unique:users,email,' . $id,
                    'city' => 'max:255',
                ];
                break;

            case 'uploadProfilePic':
                $rules = [
                    'profilePic' => 'required',
                ];
                break;

            case 'login':
                $rules = [
                    'email' => 'required',
                    'password' => 'required',
                ];
                break;

            case 'updateDeviceToken':
                $rules = [
                    'deviceType' => 'required',
                    'deviceToken' => 'required',
                ];
                break;


            case 'forgotPassword':
                $rules = [
                    'email' => 'required|email',
                ];
                break;

            case 'resetPassword':
                $rules = [
                    'userId' => 'required|min:1|integer',
                    'password' => 'required|min:6|max:20',
                ];
                break;

            case 'changePassword':
                $rules = [
                    'oldPassword' => 'required',
                    'password' => 'required|min:6|max:20',
                ];
                break;

                //ContestController    
            case 'checkAlreadyParticipate':
                $rules = [
                    'contestId' => 'required|min:1|integer',
                ];
                break;

                // case 'getContestSponsor':
                //     $rules = [
                //         'contestId' => 'required|min:1|integer',
                //     ];
                //     break;

            case 'saveGoodWishesContest':
                $rules = [
                    'contestId' => 'required|min:1|integer',
                    'message' => 'required|max:400',
                ];
                break;




            case 'login':
            default:
                $rules = [
                    'email' => [
                        'required',
                        // Rule::exists('tbl_user', 'username')->where(function ($query) {
                        //  $query->where('is_email_verified', '=', 'Yes')
                        //          ->where('is_phone_verified', '=', 'Yes');
                        // }),
                    ],
                    'password' => 'required',
                ];
                break;
        }

        return $rules;
    }

    public function getVErrorMessages($vErrors)
    {
        $ret = [];
        $messages = $vErrors->getMessages();
        if (is_array($messages) && count($messages) > 0) {
            foreach ($messages as $k => $v) {
                if (is_array($v) && array_key_exists(0, $v)) {
                    //$ret[$k] = $v[0];
                    return $v[0];
                }
            }
        }
        //return $ret;
    }
}
