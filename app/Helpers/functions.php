<?php
use App\BasicSetting;
use App\PaymentMethod;
use App\PaymentLog;


 function getPaymentAction($id){

    
    $trans = PaymentLog::find($id);
    $gateway = PaymentMethod::find($trans->payment_type);
    $basic = BasicSetting::first();
    $deposit_fund_route = route('deposit-fund');

    if($gateway->id==1){
        
        $ipn = route('paypal-ipn');
        
        $paypal = '<form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="pament_form">
                        <input type="hidden" name="cmd" value="_xclick" />
                        <input type="hidden" name="business" value="'.$gateway->val1.'" />
                        <input type="hidden" name="cbt" value="'.$basic->title.'" />
                        <input type="hidden" name="currency_code" value="USD" />
                        <input type="hidden" name="quantity" value="1" />
                        <input type="hidden" name="item_name" value="Add Fund to '.$basic->title.'" />
                        <!-- Custom value you want to send and process back in the IPN -->
                        <input type="hidden" name="custom" value="'.$trans->custom.'" />
                        <input name="amount" type="hidden" value="'.$trans->usd.'">
                        <input type="hidden" name="return" value="'.$deposit_fund_route.'"/>
                        <input type="hidden" name="cancel_return" value="'.$deposit_fund_route.'" />
                        <!-- Where to send the PayPal IPN to. -->
                        <input type="hidden" name="notify_url" value="'.$ipn.'" />
                    </form>';
    return $paypal; 

    }else if($gateway->id==2){
        
        $ipn = route('perfect-ipn');

        $perfect = ' <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="pament_form">
                        <input type="hidden" name="PAYEE_ACCOUNT" value="'.$gateway->val1.'">
                        <input type="hidden" name="PAYEE_NAME" value="'.$basic->title.'">
                        <input type="hidden" name="PAYMENT_ID" value="'.$trans->custom.'">
                        <input type="hidden" name="PAYMENT_AMOUNT"  value="'.round($trans->usd,2).'">
                        <input type="hidden" name="PAYMENT_UNITS" value="USD">
                        <input type="hidden" name="STATUS_URL" value="'.$ipn.'">
                        <input type="hidden" name="PAYMENT_URL" value="'.$deposit_fund_route.'">
                        <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">
                        <input type="hidden" name="NOPAYMENT_URL" value="'.$deposit_fund_route.'">
                        <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">
                        <input type="hidden" name="SUGGESTED_MEMO" value="'.$basic->title.'">
                        <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
                    </form>';
         return $perfect; 
    }else if($gateway->id==7){
             $ipn = route('skrill-ipn');
             $img = asset('assets/images/logo/logo.png');
        $money = '<form action="https://www.moneybookers.com/app/payment.pl" method="post" id="pament_form">
                        <input name="pay_to_email" value="'.$gateway->val1.'" type="hidden">
                        <input name="transaction_id" value="'.$trans->custom.'" type="hidden">
                        <input name="return_url" value="'.$deposit_fund_route.'" type="hidden">
                        <input name="return_url_text" value="Return '.$basic->title.'" type="hidden">
                        <input name="cancel_url" value="'.$deposit_fund_route.'" type="hidden">
                        <input name="status_url" value="'.$ipn.'" type="hidden">
                        <input name="language" value="EN" type="hidden">
                        <input name="amount" value="'.$trans->usd.'" type="hidden">
                        <input name="currency" value="USD" type="hidden">
                        <input name="detail1_description" value="'.$basic->title.'" type="hidden">
                        <input name="detail1_text" value="Add Fund To '.$basic->title.'" type="hidden">
                        <input name="logo_url" value="'.$img.'" type="hidden">
                   </form>';
        return $money;
    }else{
        return false;
    }


}


// For Paytm
if(!function_exists("encrypt_e")) {
    function encrypt_e($input, $ky) {
        $key   = html_entity_decode($ky);
        $iv = "@@@@&&&&####$$$$";
        $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
        return $data;
    }
}

if(!function_exists("decrypt_e")) {
    function decrypt_e($crypt, $ky) {
        $key   = html_entity_decode($ky);
        $iv = "@@@@&&&&####$$$$";
        $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
        return $data;
    }
}

if(!function_exists("pkcs5_pad_e")) {
    function pkcs5_pad_e($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
}

if(!function_exists("pkcs5_unpad_e")) {
    function pkcs5_unpad_e($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        return substr($text, 0, -1 * $pad);
    }
}

if(!function_exists("generateSalt_e")) {
    function generateSalt_e($length) {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }
}


if(!function_exists("checkString_e")) {
    function checkString_e($value) {
        $myvalue = ltrim($value);
        $myvalue = rtrim($myvalue);
        if ($myvalue == 'null')
            $myvalue = '';
        return $myvalue;
    }
}

if(!function_exists("getChecksumFromArray")) {
    function getChecksumFromArray($arrayList, $key, $sort = 1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str         = getArray2Str($arrayList);
        $salt        = generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash        = hash("sha256", $finalString);
        $hashString  = $hash . $salt;
        $checksum    = encrypt_e($hashString, $key);
        return $checksum;
    }
}

if(!function_exists("verifychecksum_e")) {
    function verifychecksum_e($arrayList, $key, $checksumvalue) {
        $arrayList = removeCheckSumParam($arrayList);
        ksort($arrayList);
        $str        = getArray2StrForVerify($arrayList);
        $paytm_hash = decrypt_e($checksumvalue, $key);
        $salt       = substr($paytm_hash, -4);

        $finalString = $str . "|" . $salt;

        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;

        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            $validFlag = "TRUE";
        } else {
            $validFlag = "FALSE";
        }
        return $validFlag;
    }
}

if(!function_exists("getArray2Str")) {
    function getArray2Str($arrayList) {
        $findme   = 'REFUND';
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            $pos = strpos($value, $findme);
            $pospipe = strpos($value, $findmepipe);
            if ($pos !== false || $pospipe !== false)
            {
                continue;
            }

            if ($flag) {
                $paramStr .= checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . checkString_e($value);
            }
        }
        return $paramStr;
    }
}

if(!function_exists("getArray2StrForVerify")) {
    function getArray2StrForVerify($arrayList) {
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            if ($flag) {
                $paramStr .= checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . checkString_e($value);
            }
        }
        return $paramStr;
    }
}

if(!function_exists("redirect2PG")) {
    function redirect2PG($paramList, $key) {
        $hashString = getchecksumFromArray($paramList);
        $checksum   = encrypt_e($hashString, $key);
    }
}


if(!function_exists("removeCheckSumParam")) {
    function removeCheckSumParam($arrayList) {
        if (isset($arrayList["CHECKSUMHASH"])) {
            unset($arrayList["CHECKSUMHASH"]);
        }
        return $arrayList;
    }
}

if(!function_exists("getTxnStatus")) {
    function getTxnStatus($requestParamList) {
        return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
    }
}

if(!function_exists("initiateTxnRefund")) {
    function initiateTxnRefund($requestParamList) {
        $CHECKSUM                     = getChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
        $requestParamList["CHECKSUM"] = $CHECKSUM;
        return callAPI(PAYTM_REFUND_URL, $requestParamList);
    }
}

if(!function_exists("callAPI")) {
    function callAPI($apiURL, $requestParamList) {
        $jsonResponse      = "";
        $responseParamList = array();
        $JsonData          = json_encode($requestParamList);
        $postData          = 'JsonData=' . urlencode($JsonData);
        $ch                = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postData)
        ));
        $jsonResponse      = curl_exec($ch);
        $responseParamList = json_decode($jsonResponse, true);
        return $responseParamList;
    }
}

if(!function_exists("sanitizedParam")) {
    function sanitizedParam($param) {
        $pattern[0]     = "%,%";
        $pattern[1]     = "%#%";
        $pattern[2]     = "%\(%";
        $pattern[3]     = "%\)%";
        $pattern[4]     = "%\{%";
        $pattern[5]     = "%\}%";
        $pattern[6]     = "%<%";
        $pattern[7]     = "%>%";
        $pattern[8]     = "%`%";
        $pattern[9]     = "%!%";
        $pattern[10]    = "%\\$%";
        $pattern[11]    = "%\%%";
        $pattern[12]    = "%\^%";
        $pattern[13]    = "%=%";
        $pattern[14]    = "%\+%";
        $pattern[15]    = "%\|%";
        $pattern[16]    = "%\\\%";
        $pattern[17]    = "%:%";
        $pattern[18]    = "%'%";
        $pattern[19]    = "%\"%";
        $pattern[20]    = "%;%";
        $pattern[21]    = "%~%";
        $pattern[22]    = "%\[%";
        $pattern[23]    = "%\]%";
        $pattern[24]    = "%\*%";
        $pattern[25]    = "%&%";
        $sanitizedParam = preg_replace($pattern, "", $param);
        return $sanitizedParam;
    }
}

if(!function_exists("callNewAPI")) {
    function callNewAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData))
        );
        $jsonResponse = curl_exec($ch);
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }
}
// For Paytm

