<?php

namespace qcth\laravel_alipay;

/**
 * 微信插件统一入口
 */
class Index{
    
    //插件对象
    private $link=[];

    /**
     * @param $plug_name 插件名,类名 Pay
     * @param null $arguments, 第一个为配置数组，第二个可选项(true或false)，默认为true单例模式，如果不想要单例模式，可以传false
     * @return 错误时，返出字符串（错误消息）正常返出 对象
     */
    public function __call($plug_name, $arguments=null){

        //参数个数
        switch (count($arguments)){
            case 1:
                $config=$arguments[0];
                $shared=true;
                break;
            case 2:
                $config=$arguments[0];
                $shared=$arguments[1];
                break;
            default:
                return '错误：第一个参数为配置项数组，第二个为可选参数，是否为单例模式';
        }


        $class_name='\qcth\laravel_alipay\plug\\'.ucfirst(trim($plug_name));


        if(empty($this->link[$class_name])){

            return $this->link[$class_name]=new $class_name(...$arguments);
        }

        if(!$shared){

            return new $class_name(...$arguments);
        }

        return $this->link[$class_name];
    }
}

