<h3>微博登录</h3>
<?php echo CHtml::hiddenField('type',$type);?>
<p><label>Weibo APPID：</label><input class="form-control" name="weibo_app_id" id="weibo_app_id" value="<?php echo $c['weibo_app_id'];?>"/></p>
<p><label>Weibo APPKEY：</label><input class="form-control" name="weibo_app_key" id="weibo_app_key" value="<?php echo $c['weibo_app_key'];?>"/></p>
<p><label>回调地址：</label><input class="form-control" name="weibo_app_callback" id="weibo_app_callback" value="<?php echo $c['weibo_app_callback'];?>"/></p>
<h3>QQ登录</h3>
<p><label>QQ APPID：</label><input class="form-control" name="qq_app_id" id="qq_app_id" value="<?php echo $c['qq_app_id'];?>"/></p>
<p><label>QQ APPKEY：</label><input class="form-control" name="qq_app_key" id="qq_app_key" value="<?php echo $c['qq_app_key'];?>"/></p>
<p><label>回调地址：</label><input class="form-control" name="qq_app_callback" id="qq_app_callback" value="<?php echo $c['qq_app_callback'];?>"/></p>
<h3>微信登录</h3>
<p><label>微信APPID：</label><input class="form-control" name="weixin_app_id" id="weixin_app_id" value="<?php echo $c['weixin_app_id'];?>"/></p>
<p><label>微信APPKEY：</label><input class="form-control" name="weixin_app_key" id="weixin_app_key" value="<?php echo $c['weixin_app_key'];?>"/></p>
<p><label>回调地址：</label><input class="form-control" name="weixin_app_callback" id="weixin_app_callback" value="<?php echo $c['weixin_app_callback'];?>"/></p>