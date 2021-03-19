<?php

namespace app\Traits;

use Illuminate\Support\Facades\Auth;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;

use App\User;
use App\Country;

use Exception;

trait ProfileTrait
{
    use CommonTrait, FileTrait;


    public function getProfileInfo($userId, $platform)
    {
        try {
            $user = User::findOrFail($userId);
            $data = array(
                'userId' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'countryId' => $user->countryId,
                'countryName' => Country::where('id', $user->countryId)->value('name'),
                'city' => $user->city,
                'isdCode' => $user->isdCode,
                'profilePic' => $this->picUrl($user->profilePic, 'profilePic', $platform)
            );
            return $data;
        } catch (Exception $e) {
            return false;
        }
    }

}
