<?php

namespace qcth\laravel_alipay\facade;

use Illuminate\Support\Facades\Facade;

class Alipay extends  Facade
{
    protected static  function  getFacadeAccessor()
    {
        return 'Alipay';
    }
}