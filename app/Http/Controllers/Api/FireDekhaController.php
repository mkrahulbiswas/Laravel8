<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Traits\CommonTrait;
use App\Traits\FileTrait;
use App\Traits\ValidationTrait;

use App\Admin;
use App\FireDekha;
use App\PageTitle;

use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class FireDekhaController extends Controller
{
    use ValidationTrait, FileTrait, CommonTrait;
    public $platform = 'app';


    public function getFireDekha()
    {
        try {
            $data = array();
            $pageTitle=PageTitle::where('pageType', config('constants.phireDekha'))->first();
            if($pageTitle)
            {
                $pageTitle=$pageTitle->pageTitle;
            }
            else
            {
                $pageTitle='NA';
            }

            $fireDekha = FireDekha::where('status', '1')->get();
            foreach ($fireDekha as $temp) {
                $data[] = array(
                    'id' => $temp->id,
                    'title' => $temp->title,
                    'image' => $this->picUrl($temp->image, 'fireDekhaPic', $this->platform),
                );
            }

            $per_page = config('constants.perPage20');
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $collection = new Collection($data);
            $currentPageResults = $collection->slice(($currentPage - 1) * $per_page, $per_page)->values();
            $data['results'] = new LengthAwarePaginator($currentPageResults, count($collection), $per_page);
            $data = $data['results'];

            return response()->json(['status' => 1, 'msg' => config('constants.successMsg'), 'payload' => ['pageTitle'=>$pageTitle,'data' => $data]], config('constants.ok'));
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }
    
}
