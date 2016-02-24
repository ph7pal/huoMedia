<?php

/**
 * @filename _area.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-2-24  10:24:58 
 */
?>
<button type="button" class="btn btn-default <?php echo $extraCss;?>" data-toggle="modal" data-target="#myModal" id="selectedAreaTitle"><?php echo !empty($areaInfo) ? '已选：'.$areaInfo['title'] : '选择地区';?></button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">选择地区</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-xs-4 col-sm-4">
                  <?php echo CHtml::dropDownList('area', $model->area, Area::getFirst(),array('class'=>'form-control','empty'=>'--请选择--','onchange'=>'getAreaChildren();'));?>
              </div>
              <div class="col-xs-4 col-sm-4" id="areaFirstDiv"></div>
              <div class="col-xs-4 col-sm-4" id="areaSecondDiv"></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<script>
    var getAreaChildrenUrl='<?php echo Yii::app()->createUrl('/ajax/areaChildren');?>';
    var selectArea='<?php echo CHtml::activeId($model, 'area');?>';
    function getAreaChildren(type){
        if(!type){
            type='area';
        }
        var theHolder='';
        if(type=='area'){
            theHolder='areaFirstDiv';
        }else{
            theHolder='areaSecondDiv';
        }
        var area=$('#'+type).val();
        if(!area){
            if(type=='area'){
                $('#areaFirstDiv').html('');
                $('#areaSecondDiv').html('');
            }else if(type=='areaFirst'){
                $('#areaSecondDiv').html('');
            }
            $('#'+selectArea).val('');
            $('#selectedAreaTitle').html('选择地区');
            return false;
        }
        $('#'+selectArea).val(area);
        //$('#selectedAreaTitle').val($('#'+area+' option:selected').text());
        if(type=='areaSecond'){
            return false;
        }
        $.post(getAreaChildrenUrl, {areaid: area,type:type, YII_CSRF_TOKEN: zmf.csrfToken}, function(result) {
            result = eval('(' + result + ')');
            if(result['status']=='0'){
                alert(result['msg']);
                return false;
            }else{
                $('#'+theHolder).html(result['msg']);
                if(type=='area'){
                    $('#areaSecondDiv').html('');
                }                
            }
        });
    }
</script>