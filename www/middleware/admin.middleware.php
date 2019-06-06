<?php

class AdminMiddleware implements Middleware
{
    public function handle()
    {
        if(Session::get('user') && Session::get('role') == 'admin'){
            return true;
        }
        return false;
    }
}