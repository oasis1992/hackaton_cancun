<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 21/06/2016
 * Time: 2:52
 */

namespace App;
use Parse\ParseClient;

final class ParseInit
{
    public function parseInit()
    {
        ParseClient::initialize( env('APP_ID'), '', env('MASTER_KEY'));
        ParseClient::setServerURL(env('URL_PARSE'));
    }
}
