<?php $this->beginContent('/layouts/common'); ?>
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo zmf::config('baseurl');?>">
                <img alt="Brand" src="<?php echo zmf::config('baseurl');?>common/images/logo.png">
            </a>
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?php echo $_GET['table']=='forum' ? 'active' : '';?>"><?php echo CHtml::link('<i class="fa fa-users"></i> 社区',array('index/more','table'=>'forum'));?></li>
                <li class="<?php echo $_GET['table']=='blog' ? 'active' : '';?>"><?php echo CHtml::link('<i class="fa fa-user"></i> 博客',array('index/more','table'=>'blog'));?></li>
                <li class="<?php echo $_GET['table']=='media' ? 'active' : '';?>"><?php echo CHtml::link('<i class="fa fa-bullhorn"></i> 媒体',array('index/more','table'=>'media'));?></li>
                <li class="<?php echo $_GET['table']=='video' ? 'active' : '';?>"><?php echo CHtml::link('<i class="fa fa-play-circle"></i> 视频',array('index/more','table'=>'video'));?></li>
                <li class="<?php echo $_GET['table']=='weibo' ? 'active' : '';?>"><?php echo CHtml::link('<i class="fa fa-weibo"></i> 微博',array('index/more','table'=>'weibo'));?></li>                
                <li class="<?php echo $_GET['table']=='weixin' ? 'active' : '';?>"><?php echo CHtml::link('<i class="fa fa-weixin"></i> 微信',array('index/more','table'=>'weixin'));?></li>                
                <li class="<?php echo $_GET['table']=='qzone' ? 'active' : '';?>"><?php echo CHtml::link('<i class="fa fa-qq"></i> QQ空间',array('index/more','table'=>'qzone'));?></li>                
            </ul>
        </div>
    </div>
</nav>
<?php echo $content; ?>
<div class="footer">
    <div class="container text-center">
        <p>Copyright &copy; <?php echo CHtml::link(zmf::config('sitename'),  zmf::config('baseurl'));?> All Right reserved.</p>
    </div>
</div>
<div class="fixedContacter hidden-xs">
    <div class="row">
        <div class="col-xs-8 col-sm-8">
            <div class="contact-items">
                <p><i class="fa fa-user"></i> <?php echo zmf::config('contactName');?></p>
                <p><i class="fa fa-phone"></i> <?php echo zmf::config('contactPhone');?></p>
                <p><i class="fa fa-qq"></i> <?php echo zmf::config('contactQQ');?></p>
                <p><i class="fa fa-wechat"></i> <?php echo zmf::config('contactWeixin');?></p>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 pull-right">
            <div class="contact-tips">
                <p><i class="fa fa-user"></i></p>
                <p>联系我们</p> 
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>