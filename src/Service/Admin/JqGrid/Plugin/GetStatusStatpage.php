<?php


namespace Mf\Statpage\Service\Admin\JqGrid\Plugin;

use Admin\Service\JqGrid\Plugin\AbstractPlugin;


class GetStatusStatpage extends AbstractPlugin
{

    protected $config;
    
    public function __construct($config)
    {
        $this->config=$config;
    }
    
    /**
    * преобразование элементов colModel, например, для генерации списков
    * $colModel - элемент $colModel из конфигурации
    * возвращает тот же $colModel, с внесенными изменениями
    */
    public function colModel(array $colModel, array $toolbarData=[])
    {
        $config=$this->config["status"];
        $rez=[];
        if (is_array($config)){
            foreach ($config as $status=>$v){
                $rez[]=$status.":".$v;
            }
        }
        $colModel["editoptions"]["value"]=implode(";",$rez);
        
        return $colModel;
    }



}