<?php
namespace Statpage\Lib\Func;


class ClearContent

{
	
public function __invoke($obj,$infa,$struct_arr,$pole_type,$pole_dop,$tab_name,$pole_id,$const,$id,$action)
{

if (empty($infa)){return $infa;}
$f=$const[1].DIRECTORY_SEPARATOR.$infa;
$data=file_get_contents($f);

$data=$this->strip_only($data,'<font>',false);

file_put_contents($f,$data);

return $infa;

}





protected function strip_only($str, $tags, $stripContent = false) {
    $content = '';
    if(!is_array($tags)) {
        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
        if(end($tags) == '') array_pop($tags);
    }
	
    foreach($tags as $tag) {
        if ($stripContent)
             $content = '(.+</'.$tag.'[^>]*>|)';
         $str = preg_replace('#</?'.$tag.'[^>]*>'.$content.'#isu', '', $str);
    }
    return $str;
} 


}