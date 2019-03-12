<?php

namespace qcth\laravel_alipay\plug;

//同步通知或异步通知
use qcth\laravel_alipay\plug_trait\ResultCheckTrait;

class Result{
    use ResultCheckTrait;

    //配置项数组
    protected $config;
    public function __construct($config=null){
        $this->config=$config;
    }

    public function check($data=null){
        if(empty($data)){
            return '参数必传，参数是 $_GET或$_POST';
        }
        //配置项不能为空
        if(empty($this->config)){
            return '支付宝配置数组不能为空';
        }

        return $this->result_check($data);
    }

}