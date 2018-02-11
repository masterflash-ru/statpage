<?php
namespace Mf\Statpage\Lib\Func;


class GetTplList
{


function __invoke($obj,$infa,$struct_arr,$pole_type,$pole_dop,$tab_name,$idname,$const,$id,$action)

{
if (!is_readable($obj->config["statpage"]["tpl_folder"]) )
	{
		//если папок нет, создаем
		mkdir($obj->config["statpage"]["tpl_folder"],0777,true);
	}


$p=$obj->config["statpage"]["tpl_folder"];


$obj->dop_sql['name']=array();
$obj->dop_sql['id']=array();
$k=scandir($p);
foreach ($k as $d)
	{
		if (!in_array($d,array(".","..")))
			{
					$obj->dop_sql['name'][]=$d;
					$obj->dop_sql['id'][]=$d;
			}
	}
return $infa;

}



}