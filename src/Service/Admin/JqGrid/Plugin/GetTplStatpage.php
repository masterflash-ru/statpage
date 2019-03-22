<?php


namespace Mf\Statpage\Service\Admin\JqGrid\Plugin;

use Admin\Service\JqGrid\Plugin\AbstractPlugin;


class GetTplStatpage extends AbstractPlugin
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
    public function colModel(array $colModel)
    {
        $config=$this->config["tpl"];
        $rez=["0:ПУСТО"];
        if (is_array($config)){
            foreach ($config as $status=>$v){
                $rez[]=$status.":".$v;
            }
        }
        $colModel["editoptions"]["value"]=implode(";",$rez);
        
        return $colModel;
    }



}