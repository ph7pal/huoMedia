<?php
//$manageArr[0]=array('type'=>'notpassed','title'=>'禁止');
$manageArr[1]=array('type'=>'passed','title'=>'恢复');
//$manageArr[2]=array('type'=>'staycheck','title'=>'等待审核');
$manageArr[3]=array('type'=>'del','title'=>'删除');
//$manageArr[4]=array('type'=>'shiftDel','title'=>'彻底删除');
unset($manageArr[$status]);
if(empty($table)){
    echo 'Table do not exists';exit;
}
foreach($manageArr as $ma){
 echo CHtml::ajaxLink(
         $ma['title'],
         Yii::app()->createUrl("admin/manage/table"),
         array(
             'type'=>'POST',
             'success' => "function( data ){"
             . "data = eval('('+data+')');"
             . "if(data['status']){ "
             //. "$('#item".$keyid."').fadeOut();"
             . "alert(data['msg']);"
             . "}else{"
             . "alert(data['msg']);}}",
             'data'=>array(
                 'table'=>$table,
                 'type'=>$ma['type'],
                 'id'=>$keyid,
                 'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken)),
         array('href' => Yii::app()->createUrl( "admin/manage/table"))).'&nbsp;&nbsp;';
 }