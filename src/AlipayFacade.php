<?php

namespace qcth\laravel_alipay;

use Illuminate\Support\Facades\Facade;

class WechatFacade extends  Facade
{
    protected static  function  getFacadeAccessor()
    {
        return 'Alipay';
    }
}