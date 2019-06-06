<?php

class ResponseGCaptcha
{
    protected $success;
    protected $errorCodes;

    public function __construct(bool $success, $errorCodes)
    {
        $this->success = $success;
        $this->errorCodes = $errorCodes;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getErrorCodes()
    {
        return $this->errorCodes;
    }
}