<?php echo CHtml::hiddenField('type',$type);?>
<p><label>敏感词("#"隔开)：</label><textarea class="form-control" name="badwords"><?php echo $c['badwords'];?></textarea></p>
<p><label>注册保留关键词("#"隔开)：</label><textarea class="form-control" name="limitUsernames"><?php echo $c['limitUsernames'];?></textarea></p>
<p><label>异步推送HOST：</label><input class="form-control" name="async_push_host" id="async_push_host" value="<?php echo $c['async_push_host'];?>"/></p>
<p><label>处理异步的地址：</label><input class="form-control" name="async_push_path" id="async_push_path" value="<?php echo $c['async_push_path'];?>"/></p>
<p><label>应用环境：</label>
    <select name="appStatus" id="appStatus">
        <option value="1" <?php if($c['appStatus']=='1'){?>selected="selected"<?php }?>>本地开发</option>
        <option value="2" <?php if($c['appStatus']=='2'){?>selected="selected"<?php }?>>线上测试</option>
        <option value="3" <?php if($c['appStatus']=='3'){?>selected="selected"<?php }?>>线上正式</option>
    </select>
</p>
<p><label>开启手机网页版：</label>
    <select name="mobile" id="mobile">
        <option value="0" <?php if($c['mobile']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['mobile']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>开启APP访问日志：</label>
    <select name="appRuntimeLog" id="appRuntimeLog">
        <option value="0" <?php if($c['appRuntimeLog']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['appRuntimeLog']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>APP访问日志记录类型：</label>
    <select name="appLogType" id="appRuntimeLog">
        <option value="1" <?php if($c['appLogType']=='1'){?>selected="selected"<?php }?>>简单信息</option>
        <option value="2" <?php if($c['appLogType']=='2'){?>selected="selected"<?php }?>>详细信息</option>
    </select>
</p>
<p><label>百川应用APPKEY：</label><input class="form-control" name="baichuan_appkey" id="baichuan_appkey" value="<?php echo $c['baichuan_appkey'];?>"/></p>
<p><label>百川应用APPSECRET：</label><input class="form-control" type="password" name="baichuan_secret" id="baichuan_secret" value="<?php echo $c['baichuan_secret'];?>"/></p>
<p><label>客服ID：</label><input class="form-control" type="text" name="serviceUid" id="serviceUid" value="<?php echo $c['serviceUid'];?>"/></p>
<p><label>后台消息客服ID：</label><input class="form-control" type="text" name="houtaiServiceUid" id="houtaiServiceUid" value="<?php echo $c['houtaiServiceUid'];?>"/></p>

<p><label>后台登录允许尝试次数：</label><input class="form-control" name="adminErrorTimes" id="adminErrorTimes" value="<?php echo $c['adminErrorTimes'];?>"/></p>
<p><label>后台登录安全码：</label><input class="form-control" type="password" name="adminSafeCode" id="adminSafeCode" value="<?php echo $c['adminSafeCode'];?>"/></p>

<p><label>强制更新档期的时间：</label><input class="form-control" name="updateScheduleTime" id="updateScheduleTime" value="<?php echo $c['updateScheduleTime'];?>"/></p>
<p class="help-block">仅用来同步1.3版本以后的档期创建者</p>
<p><label>开启云通讯：</label>
    <select name="yuntongxun" id="yuntongxun">
        <option value="0" <?php if($c['yuntongxun']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['yuntongxun']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>云通讯回调地址：</label><input class="form-control" type="text" name="yuntongCallback" id="yuntongCallback" value="<?php echo $c['yuntongCallback'];?>"/></p>
<p><label>短信发送平台：</label>
    <select name="sendMsgType" id="sendMsgType">
        <option value="56dxw" <?php if($c['sendMsgType']=='56dxw'){?>selected="selected"<?php }?>>56短信网</option>
        <option value="yuntongxun" <?php if($c['sendMsgType']=='yuntongxun'){?>selected="selected"<?php }?>>云通讯</option>
    </select>
</p>

<p><label>档期查询时地区用户数分水岭：</label><input class="form-control" type="text" name="queryScheduleUserLimit" id="queryScheduleUserLimit" value="<?php echo $c['queryScheduleUserLimit'];?>"/></p>
<p><label>较多用户的地区的档期数：</label><input class="form-control" type="text" name="queryScheduleMaxLimit" id="queryScheduleMaxLimit" value="<?php echo $c['queryScheduleMaxLimit'];?>"/></p>
<p><label>较少用户的地区的档期数：</label><input class="form-control" type="text" name="queryScheduleMinLimit" id="queryScheduleMinLimit" value="<?php echo $c['queryScheduleMinLimit'];?>"/></p>

<p><label>微信AK：</label><input class="form-control" type="text" name="weixin_app_id" id="weixin_app_id" value="<?php echo $c['weixin_app_id'];?>"/></p>
<p><label>微信SK：</label><input class="form-control" type="text" name="weixin_app_key" id="weixin_app_key" value="<?php echo $c['weixin_app_key'];?>"/></p>
<p><label>微信回调地址：</label><input class="form-control" type="text" name="weixin_app_callback" id="weixin_app_callback" value="<?php echo $c['weixin_app_callback'];?>"/></p>