<?php  
Yii::app()->clientScript->registerCss('sortable', "  
#sortable ,#relatives,#hotcols,#coltags_diqu,#coltags_dibiao,#coltags_caixi {list-style-type: none; margin: 0; padding: 0; width: 60%;}  
#sortable li ,#relatives li ,#hotcols li,#coltags_diqu li,#coltags_dibiao li,#coltags_caixi li{margin: 2px; padding: 4px;border: 1px solid #e3e3e3; background: #f7f7f7;cursor:move}  

", 'screen', CClientScript::POS_HEAD);  
?>  
<?php if(!empty($areas)){?>
<?php 
$this->widget('zii.widgets.jui.CJuiSortable', array(
    'id'=>'sortable',
    'items'=>$areas,
    'options'=>array(
        'delay'=>'300',
    ),
));
?>
<a href="javascript:;" onclick="changeOrder()" class="btn btn-primary btn-xs">地区排序</a> 
<script>
function changeOrder() {
    var ids = '';
    $('#sortable li').each(function () {
        ids += $(this).attr('id') + '#';
    });
    $.ajax({
        type: "POST",
        url: '<?php echo Yii::app()->createUrl('admin/area/changeOrder');?>',
        data: "ids=" + ids + "&YII_CSRF_TOKEN=" + csrfToken,
        success: function (result) {
            result = eval('(' + result + ')');
            if (result['status'] == '1') {
                alert(result['msg']);
                window.location.reload();
            } else {
                alert(result['msg']);
            }
        }
    });
}
</script>
<?php }?>