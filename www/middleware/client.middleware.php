<?php

class ClientMiddleware implements Middleware
{
    public function handle()
    {
        if(Session::get('user') && Session::get('role') == 'client'){
            return true;
        }
        return false;
    }
}