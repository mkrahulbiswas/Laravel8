<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Mail\MailAccountCredential;
use Illuminate\Support\Facades\Mail;

use App\Traits\ValidationTrait;
use App\Traits\ProfileTrait;

use App\User;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    use ValidationTrait, ProfileTrait;
    public $platform = 'app';


    public function register(Request $request)
    {
        //Parameter: name,email,phone,password
        try {
            $values = json_decode($request->getContent());

            $name = $values->name;
            $email = $values->email;
            $phone = $values->phone;
            $password = $values->password;
            $countryId = $values->countryId;
            $isdCode = $values->isdCode;


            if (!$this->isValid($request->all(), 'register', 0, $this->platform)) {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0, 'msg' => $vErrors, 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
            } else {

                $user = new User;
                $user->name = $name;
                $user->email = trim($email);
                $user->phone = trim($phone);
                $user->password = Hash::make($password);
                $user->countryId = $countryId;
                $user->isdCode = $isdCode;

                if ($user->save()) {
                    $token =  $user->createToken('user' . $user->id)->accessToken;
                    if ($token) {
                        Auth::loginUsingId($user->id);
                        $user = Auth::user();
                        $data = $this->getProfileInfo($user->id, $this->platform);
                        if ($data === false) {
                            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
                        } else {
                            return response()->json(['status' => 1, 'msg' => 'Successfully registered', "payload" => ['tokenType' => 'Bearer', 'token' => $token, 'user' => $data]], config('constants.ok'));
                        }
                    } else {
                        return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.ok'));
                    }
                } else {
                    return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
                }
            }
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }

    public function login(Request $request)
    {
        //Parameter: userType, email/phone, password
        try {
            $values = json_decode($request->getContent());
            $loginId = $values->loginId;
            $password = $values->password;

            // if (is_numeric($loginId)) {
            //     $msg = 'Invalid phone number or password.';
            //     $credentials = ['phone' => $loginId, 'password' => $password];
            // } elseif (filter_var($loginId, FILTER_VALIDATE_EMAIL)) {
            //     $msg = 'Invalid email or password.';
            //     $credentials = ['email' => $loginId, 'password' => $password];
            // }


            $isBlocked = User::where('email', $loginId)->where('status', '0')->get();
            if ($isBlocked->count() > 0) {
                return response()->json([
                    'status' => 0,
                    'msg' => config('constants.blockMsg'),
                    'payload' => (object)[]
                ], config('constants.ok'));
            }

            $msg = 'Invalid email or password.';
            $credentials = ['email' => $loginId, 'password' => $password];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('user' . $user->id)->accessToken;
                if ($token) {
                    $data = $this->getProfileInfo($user->id, $this->platform);
                    if ($data === false) {
                        return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]],  config('constants.ok'));
                    } else {
                        return response()->json(['status' => 1, 'msg' => 'Successfully logged in.', "payload" => ['tokenType' => 'Bearer', 'token' => $token, 'user' => $data]], config('constants.ok'));
                    }
                } else {
                    return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.ok'));
                }
            } else {
                return response()->json(['status' => 0, 'msg' => $msg, 'payload' => (object)[]],  config('constants.ok'));
            }
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong'], 200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 1,
            'msg' => 'Successfully logged out.',
            'payload' => (object)[],
        ], config('constants.ok'));
    }

    public function updateProfile(Request $request)
    {
        //Parameter: name, phone, email, city
        try {
            $userId = Auth::user()->id;

            if (!$this->isValid($request->all(), 'updateProfile', $userId, $this->platform)) {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0,  'msg' => $vErrors, 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
            }

            $values = json_decode($request->getContent());
            $name = $values->name;
            $phone = $values->phone;
            $email = $values->email;
            $city = $values->city;

            $user = User::findOrFail($userId);
            $user->name = $name;
            $user->phone = $phone;
            $user->email = $email;
            $user->city = $city;

            if ($user->update()) {
                $data = $this->getProfileInfo($user->id, $this->platform);
                if ($data === false) {
                    return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
                } else {
                    return response()->json(['status' => 1, 'msg' => 'Profile successfully saved.', 'payload' => ['user' => $data]], config('constants.ok'));
                }
            } else {
                return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
            }
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }

    public function getProfile()
    {
        try {
            $user = Auth::user();
            $data = $this->getProfileInfo($user->id, $this->platform);
            if($data===false)
            {
                return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
            }
            return response()->json(['status' => 1, 'msg' => config('constants.successMsg'), 'payload' => ['user' => $data]], config('constants.ok'));
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }

    public function uploadProfilePic(Request $request)
    {
        //Parameter: profilePic
        try {
            $values = json_decode($request->getContent());
            $img = $values->profilePic;

            if (!$this->isValid($request->all(), 'uploadProfilePic', 0, $this->platform)) {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0,  'msg' => $vErrors, 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
            }

            $user = Auth::user();

            $uploadDir = config('constants.profilePic');
            $path = config('constants.baseUrl') . config('constants.profilePic');

            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $fileName = md5(microtime()) . '.png';
            $file = $uploadDir . $fileName;
            $success = file_put_contents($file, $image);

            if ($user->profilePic != 'NA') {
                unlink($uploadDir . $user->profilePic);
            }

            if ($success) {
                $userInfo = User::findOrFail($user->id);
                $userInfo->profilePic = $fileName;
                if ($userInfo->update()) {
                    $img = $fileName;
                    return response()->json(['status' => 1, 'msg' => config('constants.successMsg'), 'payload' => ['profilePic' => $path . $img]], config('constants.ok'));
                } else {
                    return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
                }
            } else {
                return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
            }
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }

    public function forgotPassword(Request $request)
    {
        //Parameter: email
        try {
            if (!$this->isValid($request->all(), 'forgotPassword', 0, $this->platform)) {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0, 'msg' => $vErrors, 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
            }

            $values = json_decode($request->getContent());

            $user = User::where('email', $values->email)->get();

            if ($user->count() > 0) {
                if ($user[0]->status == '0') {
                    return response()->json(['status' => 0, 'msg' => 'You are blocked by admin.', 'payload' => (object)[]], config('constants.ok'));
                } else {
                    if ($user[0]->password != null) {
                        // $otp = mt_rand(1000, 9999);
                        $otp = '1234';

                        $userUpdate = User::findOrFail($user[0]->id);
                        $userUpdate->otp = $otp;
                        $userUpdate->otp_time = Carbon::now();
                        $userUpdate->update();

                        $msg = 'Your Otp Is';
                        $data = array("otp" => $otp, 'name' => $user[0]->name, 'msg' => $msg);

                        Mail::to($values->email)->send(new MailAccountCredential($data));
                        if (Mail::failures()) {
                            return Response()->Json(['status' => 0, 'msg' => 'Failed to sent OTP to your e-mail.'], config('constants.ok'));
                        } else {
                            return response()->json(['status' => 1, 'msg' => config('constants.successMsg'), 'payload' => ["userId" => $user[0]->id, 'otp' => $otp]], config('constants.ok'));
                        }
                    } else {
                        return response()->json(['status' => 0, 'msg' => 'Looks like you are registered with your social account. Please try to login with your social account.', 'payload' => (object)[]], config('constants.ok'));
                    }
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'This email is not registered.', 'payload' => (object)[]], config('constants.ok'));
            }
        } catch (Exception $e) {
            dd($e);
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }

    public function resetPassword(Request $request)
    {
        //Parameter: userId, password
        try{
            $values = json_decode($request->getContent());

            if(!$this->isValid($request->all(), 'resetPassword', 0, $this->platform))
            {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0,'msg' => $vErrors,'payload' => [ 'verrors' => $vErrors ]], config('constants.vErr') );
            }

            $user=User::find($values->userId);
            $user->password=Hash::make($values->password);
            if($user->update())
            {
                return response()->json(['status'=>1,'msg'=>'Password has been successfully reset.','payload'=>(object)[]], config('constants.ok'));
            }
            else
            {
                return response()->json(['status'=>0,'msg'=>'Failed to reset your password.','payload'=>(object)[]], config('constants.ok'));
            }
        }
        catch(Exception $e)
        {
            return response()->json(['status'=>0,'msg'=>config('constants.serverErrMsg'),'payload'=>(object)[]], config('constants.serverErr'));
        }
    }

    public function changePassword(Request $request)
    {
        //Parameter: currentPassword, newPassword
        try {
            $values = json_decode($request->getContent());
            $oldPassword = urldecode($values->oldPassword);
            $newPassword = urldecode($values->password);

            if (!$this->isValid($request->all(), 'changePassword', 0, $this->platform)) {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0, 'msg' => $vErrors, 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
            }


            if (Hash::check($oldPassword, Auth::user()->password)) {
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($newPassword);
                if ($user->update()) {
                    return response()->json(['status' => 1, 'msg' => 'Password has been successfully change.', 'payload' => (object)[]], config('constants.ok'));
                } else {
                    return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Current password does not match.', 'payload' => (object)[]], config('constants.ok'));
            }
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }

    public function updateDeviceToken(Request $request)
    {
        //Parameter: deviceType, deviceToken
        try {
            $values = json_decode($request->getContent());

            if (!$this->isValid($request->all(), 'updateDeviceToken', 0, $this->platform)) {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0, 'msg' => $vErrors, 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
            }

            $userInfo = Auth::user();

            $user = User::findOrFail($userInfo->id);
            $user->deviceType = $values->deviceType;
            $user->deviceToken = $values->deviceToken;
            if ($user->update()) {
                return response()->json(['status' => 1, 'msg' => 'Device token successfully updated.', 'payload' => (object)[]], config('constants.ok'));
            } else {
                return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
            }
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }
}
