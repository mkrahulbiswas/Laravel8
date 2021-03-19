<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;
use App\Traits\ValidationTrait;

use App\Country;

use Illuminate\Support\Carbon;
use League\Flysystem\Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class SettingContolller extends Controller
{
    use FileTrait, CommonTrait, ValidationTrait;
    public $platform = 'app';


    public function getCountry()
    {
        try {
            $data = array();
            $country = Country::get();
            foreach ($country as $temp) {
                $data[] = array(
                    'countryId' => $temp->id,
                    'name' => $temp->name,
                    'shortName' => $temp->shortName,
                    'isdCode' => $temp->isdCode,
                );
            }
            return response()->json(['status' => 1, 'msg' => config('constants.successMsg'), "payload" => ['data' => $data]], config('constants.ok'));
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }
}
