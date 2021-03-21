<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PujaList;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;
use App\Traits\ValidationTrait;

use App\PujaSubZone;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class DDDAdminController extends Controller
{
    use ValidationTrait, FileTrait, CommonTrait;
    public $platform = 'backend';


    /*------ ( Puja Sub Zone ) -------*/
    public function getSubZone($zoneId)
    {
        try {
            $data = array();
            $pujaSubZone = PujaSubZone::select('id', 'subZoneName')->where([['status', '=', '1'], ['zoneId', '=', $zoneId]])->get();

            foreach ($pujaSubZone as $temp) {
                $data[] = array(
                    'id' => $temp->id,
                    'subZoneName' => $temp->subZoneName,
                );
            }
            return Response()->Json(['status' => 1, 'msg' => config('constants.successMsg'), 'data' => $data], config('constants.ok'));
        } catch (Exception $e) {
            return Response()->Json(['status' => 0, 'msg' => config('constants.serverErrMsg')], config('constants.ok'));
        }
    }
}
