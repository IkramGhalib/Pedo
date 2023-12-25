<?php

   /**
    * Success response method
    *
    * @param $result
    * @param $message
    * @return \Illuminate\Http\JsonResponse
    */
    function success($message,$result=[])
   {
       $response = [
           'success' => true,
           'message' => $message,
           'data'    => $result,
       ];

       return response()->json($response, 200);
   }

   function get_reg_no($number)
   {
    //    return  'QCA/Reg/'.$number;
   }
   function get_group_no($number)
   {
    //    return $number;
    //    return  'QCA-'.$number;
   }
   

   /**
    * Return error response
    *
    * @param       $error
    * @param array $errorMessages
    * @param int   $code
    * @return \Illuminate\Http\JsonResponse
    */
   function error($error, $errorMessages = [], $code = 404)
   {
       $response = [
           'success' => false,
           'message' => $error,
       ];

       !empty($errorMessages) ? $response['data'] = $errorMessages : null;

       return response()->json($response, $code);
   }


   function sendNotification($toToken, $title, $message)
{
    // $firebaseToken = 'dRNkdtTiQnuDIoGzdncwpx:APA91bGrnpWnagzYkD3t8q3YlG4HyWZhbM_l2BnXvV4OJxRV345IR1wxERiTS0g-MhUHPPl4xV1yErpbvZ2m-Gn_rPKh2xMcyYJWZbqoV16meDgNadSyUHsWs7wfVZGa0xK_UCDr3FFo';
    $SERVER_API_KEY = 'AAAARhqbVCE:APA91bHG2tsbyuZCXbMedpOXX33C9dqifIayJJHGxEqUHW_E3pRn5eFGB36tfcYeApvni2ZStvAxuOrB8bTjAKzHH53gQ8cLfCAqVjhZLp4-BJWMgCKxJ0QKLtxOg2PrXQpiEVFlKj2L';

    // $dataString = array(
    //     'to' => $toToken,
    //     "title" => $title,
    //     "body" => $message,
    // );
    $data=    ["to"=>$toToken,
    "notification"=> [
        "title"=> $title,
        // "text"=> $message,
        "body"=>$message,
        "click_action"=> "OPEN_ACTIVITY_1",
        "priority"=> "high",
        "channel_id" => "high_importance_channel",
        "sound"=> "notification_sound"
    ],
     "data"=> [
        "order_id"=> "132"
     ]
    ];

        // pr(json_encode($data));
    // print_r($dataString);
    // die;
    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    if ($response === false) {
        // throw new Exception('Curl error: ' . curl_error($crl));
        //print_r('Curl error: ' . curl_error($crl));
        $result_noti = 0;
    } else {

        $result_noti = 1;
    }

    return $result_noti;
}

function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die;

}
function prp()
{
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    die;
}
function prs()
{
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    die;
}


function app_month_format($date)
{
    return date('F Y',strtotime($date));
}

function db_date_format($date)
{
    return date('y-m-d',strtotime($date));
}

function app_date_format($date)
{
    return date('d-m-y',strtotime($date));
}
