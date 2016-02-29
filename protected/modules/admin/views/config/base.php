<?php echo CHtml::hiddenField('type',$type);?>
<p><label>应用环境：</label>
    <select name="appStatus" id="appStatus">
        <option value="1" <?php if($c['appStatus']=='1'){?>selected="selected"<?php }?>>本地开发</option>
        <option value="2" <?php if($c['appStatus']=='2'){?>selected="selected"<?php }?>>线上测试</option>
        <option value="3" <?php if($c['appStatus']=='3'){?>selected="selected"<?php }?>>线上正式</option>
    </select>
</p>
<p><label>缓存状态：</label>
    <select name="fileCache" id="fileCache">
        <option value="0" <?php if($c['fileCache']=='1'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['fileCache']=='2'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>