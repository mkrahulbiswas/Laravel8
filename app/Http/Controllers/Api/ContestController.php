<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Traits\FileTrait;
use App\Traits\ValidationTrait;
use App\Traits\CommonTrait;

use App\Admin;
use App\ContestList;
use App\ContestSponsor;
use App\ContestDetails;

use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class ContestController extends Controller
{
    use ValidationTrait, FileTrait, CommonTrait;
    public $platform = 'app';


    public function getContestList(Request $request)
    {
        try {
            $timeZone=$request->header('TimeZone');

            $data = array();
            $dataTwo = array();
            $contestList = ContestList::where('status', '1')->where('contestType', config('constants.goodWishes'))->get();

            foreach ($contestList as $temp) {

                $contestStartDate=$this->convertDateTimeByTimeZone($temp->timeZone, $timeZone, $temp->contestStartDate);
                $contestEndDate=$this->convertDateTimeByTimeZone($temp->timeZone, $timeZone, $temp->contestEndDate);

                if($contestStartDate>Carbon::now($timeZone) || ($contestStartDate<=Carbon::now($timeZone) && $contestEndDate>=Carbon::now($timeZone)))
                {
                    $contestSponsor = ContestSponsor::where('contestId', $temp->id)->get();
                    foreach ($contestSponsor as $tempTwo) {
                        $dataTwo[] = array(
                            'contestSponsorId' => $tempTwo->id,
                            'sponsorName' => $tempTwo->sponsorName,
                            'sponsorTagLine' => $tempTwo->sponsorTagLine,
                            'sponsorDescription' => $tempTwo->sponsorDescription,
                            'sponsorVideo' => $tempTwo->sponsorVideo
                        );
                    }

                    $data[] = array(
                        'contestId' => $temp->id,
                        'contestType' => $temp->contestType,
                        'contestTitle' => $temp->contestTitle,
                        'contestDescription' => $temp->contestDescription,
                        'contestInstuction' => $temp->contestInstuction,
                        'contestStartDate' => $contestStartDate,
                        'contestEndDate' => $contestEndDate,
                        'countryId' => $temp->countryId,
                        'timeZone' => $temp->timeZone,
                        'image' => $this->picUrl($temp->image, 'contestListPic', $this->platform),
                        'imageCaption' => $temp->imageCaption,
                        'contestSponsor' => $dataTwo,
                        'contestPageTitle' => $temp->contestPageTitle
                    );

                    $dataTwo = array();
                }

            }
            return response()->json(['status' => 1, 'msg' => config('constants.successMsg'), 'payload' => ['data' => $data]], config('constants.ok'));
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }

    public function checkAlreadyParticipate(Request $request)
    {
        //Parameter: contestId
        try{
            if (!$this->isValid($request->all(), 'checkAlreadyParticipate', 0, $this->platform))
            {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0, 'msg' => $vErrors, 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
            }

            $values = json_decode($request->getContent());
            $userId=Auth::user()->id;

            $contest=ContestDetails::where('userId', $userId)->where('contestId', $values->contestId)->count();
            if($contest>0)
            {
                $alreadyParticipate='1';
            }
            else
            {
                $alreadyParticipate='0';
            }

            return response()->json(['status' => 1, 'msg' => config('constants.successMsg'), 'payload' => ['alreadyParticipate'=>$alreadyParticipate]], config('constants.ok'));
        }
        catch(Exception $e)
        {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }

    // public function getContestSponsor(Request $request)
    // {
    //     try {
    //         $values = json_decode($request->getContent());

    //         if (!$this->isValid($request->all(), 'getContestSponsor', 0, $this->platform)) {
    //             $vErrors = $this->getVErrorMessages($this->vErrors);
    //             return response()->json(['status' => 0, 'msg' => config('constants.vErrMsg'), 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
    //         } else {

    //             $data = array();

    //             $count = ContestList::where([
    //                 ['status', '=', '1'],
    //                 ['contestStartDate', '>=', Carbon::now()],
    //                 ['id', '=', $values->contestId]
    //             ])->count();

    //             if ($count > 0) {
    //                 $contestSponsor = ContestSponsor::where('contestId', $values->contestId)->get();
    //                 foreach ($contestSponsor as $temp) {
    //                     $data[] = array(
    //                         'contestSponsorId' => $temp->id,
    //                         'sponsorName' => $temp->sponsorName,
    //                         'sponsorDescription' => $temp->sponsorDescription,
    //                         'sponsorVideo' => $temp->sponsorVideo
    //                     );
    //                 }

    //                 return response()->json(['status' => 1, 'msg' => config('constants.successMsg'), 'payload' => ['data' => $data]], config('constants.ok'));
    //             } else {
    //                 return response()->json(['status' => 0, 'msg' => "Contest is over.", 'payload' => (object)[]], config('constants.ok'));
    //             }
    //         }
    //     } catch (Exception $e) {
    //         return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
    //     }
    // }

    public function saveGoodWishesContest(Request $request)
    {
        //Parameter: contestId, message
        try {
            if (!$this->isValid($request->all(), 'saveGoodWishesContest', 0, $this->platform))
            {
                $vErrors = $this->getVErrorMessages($this->vErrors);
                return response()->json(['status' => 0, 'msg' => $vErrors, 'payload' => ['verrors' => $vErrors]], config('constants.vErr'));
            } 
            $values = json_decode($request->getContent());

            $userId = Auth::user()->id;
            $contest = ContestList::where('id', $values->contestId)->first();
            $timeZone = $contest->timeZone;

            $currentTime=Carbon::now($timeZone);
            if($currentTime > $contest->contestEndDate )
            {
                return response()->json(['status' => 0, 'msg' => 'The contest is over. You cannot participate in this contest.', 'payload' => (object)[]], config('constants.ok'));
            }

            if($currentTime < $contest->contestStartDate)
            {
                return response()->json(['status' => 0, 'msg' => 'The contest has not started yet. You cannot participate in the contest now.', 'payload' => (object)[]], config('constants.ok'));
            }

            $contestDetails = new ContestDetails;
            $contestDetails->userId = $userId;
            $contestDetails->contestId = $values->contestId;
            $contestDetails->message = urldecode($values->message);
            $contestDetails->contestType = $contest->contestType;
            if ($contestDetails->save()) {
                return response()->json(['status' => 1, 'msg' => 'Your good wishes has been sent successfully.', 'payload' => ['message' => $values->message]], config('constants.ok'));
            } else {
                return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
            }
            
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'msg' => config('constants.serverErrMsg'), 'payload' => (object)[]], config('constants.serverErr'));
        }
    }
}
