<h3>上传基本设置</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p><label>图片允许同时上传张数：</label><input class="form-control" name="imgUploadNum" id="imgUploadNum" value="<?php echo $c['imgUploadNum'];?>"/></p>
<p><label>图片最小宽度：</label><input class="form-control" name="imgMinWidth" id="imgMinWidth" value="<?php echo $c['imgMinWidth'];?>"/></p>
<p><label>图片最小高度：</label><input class="form-control" name="imgMinHeight" id="imgMinHeight" value="<?php echo $c['imgMinHeight'];?>"/></p>
<p><label>图片允许格式：</label><input class="form-control" name="imgAllowTypes" id="imgAllowTypes" value="<?php echo $c['imgAllowTypes'];?>"/></p>
<p><label>图片缩略图尺寸（请以英文“,”隔开）：</label><input class="form-control" name="imgThumbSize" id="imgThumbSize" value="<?php echo $c['imgThumbSize'];?>"/></p>
<p><label>单张图片最大尺寸（'B'）：</label><input class="form-control" name="imgMaxSize" id="imgMaxSize" value="<?php echo $c['imgMaxSize'];?>"/></p>
<p><label>图片压缩质量：</label><input class="form-control" name="imgQuality" id="imgQuality" value="<?php echo $c['imgQuality'];?>"/></p>
<p><label>图片访问地址：</label><input class="form-control" name="imgVisitUrl" id="imgVisitUrl" value="<?php echo $c['imgVisitUrl'];?>"/></p>
<h3>FTP设置</h3>
<p><label>开启远程图片：</label>
    <select name="ftpon" id="ftpon">
        <option value="0" <?php if($c['ftpon']=='0'){?>selected="selected"<?php }?>>关闭</option>
        <option value="1" <?php if($c['ftpon']=='1'){?>selected="selected"<?php }?>>开启</option>
    </select>
</p>
<p><label>远程地址：</label><input class="form-control" name="ftp_host" id="ftp_host" value="<?php echo $c['ftp_host'];?>"/></p>
<p><label>远程用户名：</label><input class="form-control" name="ftp_username" id="ftp_username" value="<?php echo $c['ftp_username'];?>"/></p>
<p><label>远程密码：</label><input class="form-control" name="ftp_password" id="ftp_password" value="<?php echo $c['ftp_password'];?>"/></p>
<p><label>远程目录：</label><input class="form-control" name="ftp_attachdir" id="ftp_attachdir" value="<?php echo $c['ftp_attachdir'];?>"/></p>
<p><label>上传远程图片后删除本地文件：</label>
    <select name="ftp_deluploaded" id="ftp_deluploaded">
        <option value="0" <?php if($c['ftp_deluploaded']=='0'){?>selected="selected"<?php }?>>否</option>
        <option value="1" <?php if($c['ftp_deluploaded']=='1'){?>selected="selected"<?php }?>>是</option>
    </select>
</p>
