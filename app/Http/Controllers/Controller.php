<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

use App\Models\Logo;
use App\Models\CustomizeButton;
use App\Models\CustomizeTable;
use App\Models\CustomizeLoader;

use App\Traits\FileTrait;

use Illuminate\Routing\Controller as BaseController;

use function GuzzleHttp\json_decode;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FileTrait;
    public $platform = 'backend';

    public function __construct()
    {
        // $url = url()->current();
        // $data = explode('/', $url);

        // if (in_array("admin", $data)) {
        // } else {
        //     view()->share([
        //         'contactFooter' => DB::table('contact')->where('contactType', 'registered')->first(),
        //         'aboutUs' => DB::table('about_us')->first(),
        //         'productCategory' => DB::table('product_category')->get(),
        //         'productSubCategory' => DB::table('product_sub_category')->get(),
        //         'productList' => DB::table('product_list')->where('status', '1')->get(),
        //     ]);
        // }

        $customizeButton = array();
        $customizeTable = array();

        foreach (CustomizeButton::where('status', '1')->get() as $temp) {
            $customizeButton[] = array(
                'backColor' => $temp->backColor,
                'textColor' => $temp->textColor,
                'backHoverColor' => $temp->backHoverColor,
                'textHoverColor' => $temp->textHoverColor,
                'btnIcon' => $temp->btnIcon,
                'btnFor' => $temp->btnFor
            );
        }

        $customizeTable = CustomizeTable::where('status', '1')->first();
        $customizeTable = array(
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

        $customizeLoader = CustomizeLoader::where('status', '1')->get();

        $logo = Logo::where('status', '1')->first();

        $data = array(
            'appName' => str_replace('_', ' ', config('app.name')),
            'bigLogo' => $this->picUrl($logo->bigLogo, 'bigLogoPic', $this->platform),
            'smallLogo' => $this->picUrl($logo->smallLogo, 'smallLogoPic', $this->platform),
            'favIcon' => $this->picUrl($logo->favIcon, 'favIconPic', $this->platform),
            'customizeButton' => $customizeButton,
            'customizeTable' => $customizeTable,

            'customizeLoader' => $customizeLoader,
        );
        
        View::share('reqData', $data);
    }
}
