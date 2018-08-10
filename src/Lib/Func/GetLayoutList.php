<?php
/*
* читает из конфига настройки с ключем layout для получения списка макетов
*/

namespace Mf\Statpage\Lib\Func;


class GetLayoutList
{

function __invoke($obj,$infa,$struct_arr,$pole_type,$pole_dop,$tab_name,$idname,$const,$id,$action)
{

$obj->dop_sql['name']=[];
$obj->dop_sql['id']=[];
foreach ($obj->config["statpage"]["layout"] as $tpl=>$name) {
    $obj->dop_sql['name'][]=$name;
    $obj->dop_sql['id'][]=$tpl;
}

return $infa;

}

}