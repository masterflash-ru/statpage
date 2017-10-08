<?php
namespace Statpage\Lib\Func;

class GetPageType
{

	protected static $cache;

public function __invoke($obj,$infa,$struct_arr,$col_number,$pole_dop,$tab_name,$idname,$const,$id,$action)
{
	if (isset(self::$cache)) {
		$obj->dop_sql=self::$cache;
		return ;
	}

	$s=$obj->config["statpage"]["status"];
	
	foreach ($obj->config["statpage"]["status"] as $status=>$name)
		{
			$obj->dop_sql['name'][]=$name;		
			$obj->dop_sql['id'][]=$status;
		}
	self::$cache=$obj->dop_sql;
}
}