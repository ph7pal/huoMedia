<h3>网站运行基本设置</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p><label>全站通知：</label><textarea class="form-control" name="noticeall"><?php echo $c['noticeall'];?></textarea></p>
<p><label>站点状态：</label>
    <select name="closeSite" id="closeSite">
        <option value="0" <?php if($c['closeSite']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['closeSite']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>关闭原因：</label><textarea class="form-control" name="closeSiteReason"><?php echo $c['closeSiteReason'];?></textarea></p>	
<p><label>开启手机端：</label>
    <select name="mobile" id="mobile">
        <option value="0" <?php if($c['mobile']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['mobile']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>新用户默认组别：</label>
    <?php echo CHtml::dropDownList('userDefaultGroup',$c['userDefaultGroup'], UserGroup::getGroups(true),array('options' => array($info['userDefaultGroup']=>array('selected'=>true)),'empty'=>'--请选择--')); ?>
</p>
<p><label>后台用户组：</label>
    <?php 
    if($c['adminGroupIds']!=''){
        $arr=  explode(',', $c['adminGroupIds']);
        $_adArr=array();
        foreach($arr as $v){
            $_adArr[$v]=array('selected'=>true);
        }
    }
    echo CHtml::dropDownList('adminGroupIds',$c['adminGroupIds'],UserGroup::getGroups(true),array('options' => $_adArr,'class'=>'form-control','multiple'=>'true')); ?>
</p>
<div class="form-group"><label>默认通知用户：</label><input class="form-control" name="defaultNoticeUid" id="defaultNoticeUid" value="<?php echo $c['defaultNoticeUid'];?>"/><p class="help-block">用来接收新意见反馈的提醒</p></div>
<p><label>未登陆使用用户ID：</label><input class="form-control" name="officalUid" id="officalUid" value="<?php echo $c['officalUid'];?>"/></p>
<p><label>验证用户邮箱：</label>
    <select name="validateEmail" id="validateEmail">
        <option value="0" <?php if($c['validateEmail']=='0'){?>selected="selected"<?php }?>>否</option>
        <option value="1" <?php if($c['validateEmail']=='1'){?>selected="selected"<?php }?>>是</option>
    </select>
</p>
<p><label>验证邮箱后的用户组：</label>
    <?php echo CHtml::dropDownList('validateEmailGroup',$c['validateEmailGroup'], UserGroup::getGroups(true),array('options' => array($info['validateEmailGroup']=>array('selected'=>true)),'empty'=>'--请选择--')); ?>
</p>
<p><label>开启Elasticsearch搜索：</label>
    <select name="elasticsearch" id="elasticsearch">
        <option value="0" <?php if($c['elasticsearch']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['elasticsearch']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>Elasticsearch Host地址：</label><input class="form-control" name="elastichost" id="elastichost" value="<?php echo $c['elastichost'];?>"/></p>
<p><label>搜索关键词("#"隔开)：</label><textarea class="form-control" name="hotsearchs"><?php echo $c['hotsearchs'];?></textarea></p>
<p><label>开启敏感词过滤：</label>
    <select name="checkBadWords" id="checkBadWords">
        <option value="0" <?php if($c['checkBadWords']=='0'){?>selected="selected"<?php }?>>否</option>
        <option value="1" <?php if($c['checkBadWords']=='1'){?>selected="selected"<?php }?>>是</option>
    </select>
</p>
<div class="form-group"><label>敏感词触发处理方式：</label>
    <select name="badwordsHandleStyle" id="badwordsHandleStyle">
        <option  value='filter' <?php if($c['badwordsHandleStyle']=='filter'){?>selected="selected"<?php }?>>仅过滤</option>
        <option  value='notice' <?php if($c['badwordsHandleStyle']=='notice'){?>selected="selected"<?php }?>>仅通知</option> 
        <option  value='filterNotice' <?php if($c['badwordsHandleStyle']=='filterNotice'){?>selected="selected"<?php }?>>过滤通知</option>
        <option  value='forbidden' <?php if($c['badwordsHandleStyle']=='forbidden'){?>selected="selected"<?php }?>>禁止通过</option>
    </select>
</div>
<p><label>敏感词("#"隔开)：</label><textarea class="form-control" name="badwords"><?php echo $c['badwords'];?></textarea></p>
<p><label>注册保留关键词("#"隔开)：</label><textarea class="form-control" name="limitUsernames"><?php echo $c['limitUsernames'];?></textarea></p>
<p><label>短链接保留域名("#"隔开)：</label><textarea class="form-control" name="notShortUrls"><?php echo $c['notShortUrls'];?></textarea></p>
 <div class="form-group"><label>短链接的长度：</label><input class="form-control" name="shortUrlsLen" id="shortUrlsLen" value="<?php echo $c['shortUrlsLen'];?>"/><p class="help-block">生成短链后链接码的长度，整数，默认为4</p></div>
<p><label>异步推送HOST：</label><input class="form-control" name="async_push_host" id="async_push_host" value="<?php echo $c['async_push_host'];?>"/></p>
<p><label>处理异步的地址：</label><input class="form-control" name="async_push_path" id="async_push_path" value="<?php echo $c['async_push_path'];?>"/></p>
<p><label>反馈必须已经登录：</label>
    <select name="fbLoginOnly" id="fbLoginOnly">
        <option value="0" <?php if($c['fbLoginOnly']=='0'){?>selected="selected"<?php }?>>否</option>
        <option value="1" <?php if($c['fbLoginOnly']=='1'){?>selected="selected"<?php }?>>是</option>
    </select>
</p>
<div class="form-group"><label>意见反馈次数/每分钟：</label><input class="form-control" name="fbTimesLimit" id="fbTimesLimit" value="<?php echo $c['fbTimesLimit'];?>"/><p class="help-block">每分钟累计可反馈次数,不填或0为不限制</p></div>
<div class="form-group"><label>指定显示的地区的ID：</label><input class="form-control" name="selectedArea" id="selectedArea" value="<?php echo $c['selectedArea'];?>"/><p class="help-block">即单一地区模式，设置后导航条将只显示该地区的下级地区</p></div>
<div class="form-group"><label>谷歌地图访问地址：</label><input class="form-control" name="googleMapUrl" id="googleMapUrl" value="<?php echo $c['googleMapUrl'];?>"/><p class="help-block">中国区：http://ditu.google.cn；默认为http://maps.googleapis.com</p></div>
<div class="form-group"><label>谷歌地图默认缩放级别：</label><input class="form-control" name="mapZoomLevel" id="mapZoomLevel" value="<?php echo $c['mapZoomLevel'];?>"/><p class="help-block">默认为14</p></div>
<div class="form-group"><label>谷歌地图ApiKey：</label><input class="form-control" name="googleApiKey" id="googleApiKey" value="<?php echo $c['googleApiKey'];?>"/><p class="help-block">需要到谷歌地图官网申请</p></div>
<div class="form-group"><label>谷歌静态地图ApiKey：</label><input class="form-control" name="googleImageApiKey" id="googleImageApiKey" value="<?php echo $c['googleImageApiKey'];?>"/><p class="help-block">需要到谷歌地图官网申请</p></div>

<div class="form-group"><label>CODE FOR WHO：</label><input class="form-control" name="codeForWho" id="codeForWho" value="<?php echo $c['codeForWho'];?>"/><p class="help-block">code for somebody</p></div>

<div class="form-group"><label>css js访问地址：</label><input class="form-control" name="cssJsStaticUrl" id="cssJsStaticUrl" value="<?php echo $c['cssJsStaticUrl'];?>"/><p class="help-block">用来加速css js加载速度，同根域名一样的层级</p></div>