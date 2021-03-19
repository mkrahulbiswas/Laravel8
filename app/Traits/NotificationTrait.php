<?php
namespace app\Traits;
use Illuminate\Support\Facades\Auth;

use Exception;
use Carbon\Carbon;
use DB;

trait NotificationTrait
{

    function sendNotificationToCustomer($deviceType,$deviceToken,$notifyType,$notifyDetails) 
    {
        if($notifyType==config('constants.accepted'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        elseif($notifyType==config('constants.rejected'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        elseif($notifyType==config('constants.visited'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        elseif($notifyType==config('constants.finished'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        
        $headers = array(
            config('constants.fcmKey'),
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        
        curl_close( $ch );
        //return $result;
        if($result === false)
        {
            return false;
        }
        else
        {
            return true;
        }
            
    }

	function sendNotificationToDoctor($deviceType,$deviceToken,$notifyType,$notifyDetails) 
    {
        if($notifyType==config('constants.requested'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'fromTime'=>$notifyDetails['fromTime'],'toTime'=>$notifyDetails['toTime'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'fromTime'=>$notifyDetails['fromTime'],'toTime'=>$notifyDetails['toTime'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        elseif($notifyType==config('constants.canceled'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'fromTime'=>$notifyDetails['fromTime'],'toTime'=>$notifyDetails['toTime'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'fromTime'=>$notifyDetails['fromTime'],'toTime'=>$notifyDetails['toTime'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        
        $headers = array(
            config('constants.fcmKey'),
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        
        curl_close( $ch );
        //return $result;
        if($result === false)
        {
            return false;
        }
        else
        {
            return true;
        }
            
    }

    function sendNotificationToNurse($deviceType,$deviceToken,$notifyType,$notifyDetails) 
    {
        if($notifyType==config('constants.requested'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        elseif($notifyType==config('constants.canceled'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        
        $headers = array(
            config('constants.fcmKey'),
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        
        curl_close( $ch );
        //return $result;
        if($result === false)
        {
            return false;
        }
        else
        {
            return true;
        }
            
    }

    function sendNotificationToDc($deviceType,$deviceToken,$notifyType,$notifyDetails) 
    {
        if($notifyType==config('constants.requested'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'type'=>$notifyDetails['type'],'itemName'=>$notifyDetails['itemName'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'type'=>$notifyDetails['type'],'itemName'=>$notifyDetails['itemName'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        if($notifyType==config('constants.canceled'))
        {
            if($deviceType==config('constants.android'))
            {
                $fields = array(
                    'registration_ids'=>[$deviceToken],
                    'priority' => 'high',
                    'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'type'=>$notifyDetails['type'],'itemName'=>$notifyDetails['itemName'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
            else
            {
                $fields = array(
                  'registration_ids'=>[$deviceToken],
                  'priority' => 'high',
                  'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'type'=>$notifyDetails['type'],'itemName'=>$notifyDetails['itemName'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
                );
            }
        }
        // elseif($notifyType==config('constants.canceled'))
        // {
        //     if($deviceType==config('constants.android'))
        //     {
        //         $fields = array(
        //             'registration_ids'=>[$deviceToken],
        //             'priority' => 'high',
        //             'data'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'fromTime'=>$notifyDetails['fromTime'],'toTime'=>$notifyDetails['toTime'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
        //         );
        //     }
        //     else
        //     {
        //         $fields = array(
        //           'registration_ids'=>[$deviceToken],
        //           'priority' => 'high',
        //           'notification'=>['title' => $notifyDetails['title'],'message' => $notifyDetails['msg'],'userId'=>$notifyDetails['userId'],'userType'=>$notifyDetails['userType'],'appointmentId'=>$notifyDetails['appointmentId'],'appointmentNo'=>$notifyDetails['appointmentNo'],'appointmentDate'=>$notifyDetails['appointmentDate'],'fromTime'=>$notifyDetails['fromTime'],'toTime'=>$notifyDetails['toTime'],"notifyType"=>$notifyType,'sound' => 'default',"content_available" => true]
        //         );
        //     }
        // }
        
        $headers = array(
            config('constants.fcmKey'),
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        
        curl_close( $ch );
        //return $result;
        if($result === false)
        {
            return false;
        }
        else
        {
            return true;
        }
            
    }

}