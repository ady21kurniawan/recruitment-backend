<?php

function custom_response($status = true, $message = "success", $error ="", $data = [] )
{
    $response = [
        "status" => $status,
        "message" => $message,
    ];

    if(! $status)
    {
        unset($response["message"]);
        $response["error"] = $error;
    }

    $response["data"] = $data;
    if( array_keys($data) && count($data) == 1 )
    {
        $object = new \stdClass();
        foreach($data[0] as $key => $value)
        {
            $object->$key = $value;
        }
        $response["data"] = $object;
    }
    
    
    return json_encode($response);
}