<?php

namespace App\Traits;

// use 

trait generalTrait
{
    public function getCUrrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($errNum, $msg)
    {
        return response()->json([

            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg,

        ]);
    }

    public function returnSuccessMessage($errNum = 'S0', $msg = '')
    {
        return response()->json([

            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg,

        ]);
    }

    public function returnValidationError($code = 'E001', $Validator)
    {
        //
    }



    public function returnData($key, $value, $msg = '', $errNum = 'S0')
    {
        return response()->json([

            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg,
            $key => $value,

        ]);
    }
}
