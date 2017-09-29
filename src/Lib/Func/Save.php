<?php
namespace Statpage\Lib\Func;

use ADO\Service\RecordSet;

class Save
{


public function __invoke($obj,$tab_rec,$struct0,$struct2,$tab_name,$const,$row_item,$a,$b,$action)
{



//запись строки
if ($action==-2)
	{
		//$arr=simba::queryOneRecord("select max(id) as id from tovar_category where language=@language");

		$rs=new RecordSet();
		$rs->CursorType = adOpenKeyset;
		$rs->open("SELECT * FROM statpage",$obj->connection);
		
		$rst=new RecordSet();
		$rst->CursorType = adOpenKeyset;
		$rst->open("SELECT * FROM statpage_text where locale='".$obj->pole_dop[0]."' and statpage='".(int)$tab_rec['id'],$obj->connection);
		
		if (empty($tab_rec['id']))
				{
					//	добавление
				$rs->AddNew();
				$rst->AddNew();
				$rs->Fields->Item['sysname']->Value=$tab_rec['sysname'];
				$rs->Fields->Item['name']->Value=$tab_rec['name'];
				$rs->Fields->Item['url']->Value=$tab_rec['url'];
				$rst->Fields->Item['page_type']->Value=$tab_rec['page_type'];
				$rst->Fields->Item['tpl']->Value=$tab_rec['tpl'];
				$rst->Fields->Item['title']->Value=$tab_rec['title'];
				$rst->Fields->Item['description']->Value=$tab_rec['description'];
				$rst->Fields->Item['keywords']->Value=$tab_rec['keywords'];
				$rst->Fields->Item['file_name']->Value=$tab_rec['file_name'];
				$rst->Fields->Item['title']->Value=$tab_rec['title'];
				
				$rst->Fields->Item['description']->Value=$tab_rec['description'];
				
				$rst->Fields->Item['locale']->Value=$obj->pole_dop[0];
				
				$rs->Update();
				$ids=$obj->connection->Execute("select last_insert_id() as id");
				
				$rst->Fields->Item['statpage']->Value=$ids->Fields->Item['id']->Value;
				$rst->Update();
				}
			else
			{
				//редактирвоание
				$rs->Find("id=".(int)$tab_rec['id'],0,adSearchForward);

				if ($rst->EOF) 
					{
						$rst->AddNew();
						$rst->Fields->Item['locale']->Value=$obj->pole_dop[0];
						$rst->Fields->Item['statpage']->Value=$tab_rec['id'];

					}
				$rs->Fields->Item['sysname']->Value=$tab_rec['sysname'];
				$rs->Fields->Item['name']->Value=$tab_rec['name'];
				$rs->Fields->Item['url']->Value=$tab_rec['url'];
				$rst->Fields->Item['page_type']->Value=$tab_rec['page_type'];
				$rst->Fields->Item['tpl']->Value=$tab_rec['tpl'];
				
				$rst->Fields->Item['title']->Value=$tab_rec['title'];
				$rst->Fields->Item['description']->Value=$tab_rec['description'];
				$rst->Fields->Item['keywords']->Value=$tab_rec['keywords'];
				$rst->Fields->Item['file_name']->Value=$tab_rec['file_name'];
	
				$rs->Update();
				$rst->Update();
			}
		
		//print_r($tab_rec);

	}

//удаление строки
if ($action==-3)
	{//$tab_rec - идентификатор строки
	//print_r($tab_rec);
	//simba::query ("delete from users2shop_list where concat(shop_list,'-',users)='$tab_rec'");


	}







return true;
}

}
