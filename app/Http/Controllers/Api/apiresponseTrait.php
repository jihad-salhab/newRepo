<?php
namespace App\Http\Controllers\Api;



trait apiresponseTrait
{

    public function apiRes($data=null,$msg=null,$status=null){

        $array=[
            'data' => $data,
            'message'=>$msg,
            'status'=>$status
         ];
       return response($array,$status); 

    }
}