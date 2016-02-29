<?php echo CHtml::hiddenField('type',$type);?>
<p><label>网站标题：</label><input class="form-control" name="sitename" id="sitename" value="<?php echo $c['sitename'];?>"/></p>
<p><label>简短标题：</label><input class="form-control" name="shortTitle" id="shortTitle" value="<?php echo $c['shortTitle'];?>"/></p>
<p><label>网站域名：</label><input class="form-control" name="domain" id="domain" value="<?php echo $c['domain'];?>"/></p>
<p><label>网站根目录：</label><input class="form-control" name="baseurl" id="baseurl" value="<?php echo $c['baseurl'];?>"/></p>
<p><label>网站关键字：</label><textarea class="form-control" name="siteKeywords"><?php echo $c['siteKeywords'];?></textarea></p>
<p><label>网站描述：</label><textarea class="form-control" name="siteDesc" rows="5"><?php echo $c['siteDesc'];?></textarea></p>


<p><label>联系人：</label><input class="form-control" name="contactName" id="contactName" value="<?php echo $c['contactName'];?>"/></p>
<p><label>联系电话：</label><input class="form-control" name="contactPhone" id="contactPhone" value="<?php echo $c['contactPhone'];?>"/></p>
<p><label>QQ：</label><input class="form-control" name="contactQQ" id="contactQQ" value="<?php echo $c['contactQQ'];?>"/></p>
<p><label>微信：</label><input class="form-control" name="contactWeixin" id="contactWeixin" value="<?php echo $c['contactWeixin'];?>"/></p>