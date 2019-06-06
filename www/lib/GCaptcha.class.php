<?php

class GCaptcha
{
    private const siteVerifyUrl = 'https://www.google.com/recaptcha/api/siteverify?';

    private $privateKey;

    public function __construct()
    {
        $this->privateKey = Config::get('re_captcha')['private_key'];
    }

    private function encodeQS($data)
    {
        $req = "";
        foreach ($data as $key => $value)
            $req .= $key . '=' . urlencode(stripslashes($value)) . '&';

        $req = substr($req, 0, strlen($req) - 1);
        return $req;
    }

    private function submitHTTPGet($path, $data)
    {
        $req      = $this->encodeQS($data);
        $response = file_get_contents($path . $req);
        return $response;
    }

    public function verifyResponse($remoteIp, $response): ResponseGCaptcha
    {
        if ($response == null || strlen($response) == 0)
        {
            return new ResponseGCaptcha(false, "missing-input");
        }
        $getResponse = $this->submitHTTPGet(
            self::siteVerifyUrl,
            array(
                'secret' => $this->privateKey,
                'remoteip' => $remoteIp,
                'response' => $response
            )
        );
        $answers     = json_decode($getResponse, true);
        if (trim($answers ['success']) == true)
            return new ResponseGCaptcha(true, null);
        else
            return new ResponseGCaptcha(false, $answers["error-codes"]);
    }
}