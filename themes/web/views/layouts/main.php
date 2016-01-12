<?php $this->beginContent('/layouts/common'); ?>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a href="<?php echo zmf::config('baseurl');?>"><div class="header-logo"></div></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li<?php echo $this->selectNav=='posts' ? ' class="active"' : '';?>><?php echo CHtml::link('文章', array('index/index'));?></li>
                <li<?php echo $this->selectNav=='tags' ? ' class="active"' : '';?>><?php echo CHtml::link('标签', array('index/tags'));?></li>
                <li<?php echo $this->selectNav=='map' ? ' class="active"' : '';?>><?php echo CHtml::link('足迹', array('index/map'));?></li>
                <li<?php echo $this->selectNav=='about' ? ' class="active"' : '';?>><?php echo CHtml::link('关于', array('site/info','code'=>'about'));?></li>
            </ul>
            <?php if(!$this->uid) { ?>
            <ul class="nav navbar-nav navbar-right">
                <li><?php echo CHtml::link('登录', array('site/login')); ?></li>
            </ul>
            <?php }else{ $noticeNum=  Notification::getNum();if($noticeNum>0){$_notice='<span class="top-nav-count">'.$noticeNum.'</span>';}else{$_notice='';}?>
            <ul class="nav navbar-nav navbar-right">
                <li><?php echo CHtml::link('<i class="fa fa-bell-o unread-bell"></i>'.$_notice, array('users/notice'),array('role'=>'menuitem')); ?></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->userInfo['truename'];?> <span class="caret"></span></a>               
                    <ul class="dropdown-menu">                        
                        <?php if($this->userInfo['isAdmin']){?>
                        <li><?php echo CHtml::link('新增文章', array('admin/posts/create'),array('role'=>'menuitem')); ?></li>
                        <li class="divider"></li>
                        <li><?php echo CHtml::link('管理中心', array('admin/index/index'),array('role'=>'menuitem')); ?></li>
                        <?php }?>
                        <li><?php echo CHtml::link('退出', array('site/logout'),array('role'=>'menuitem')); ?></li>
                    </ul>
                </li>
            </ul>
            <?php }?>
        </div>
    </div> 
</div>
<?php echo $content; ?>
<div class="clearfix"></div>
<div class="footer">
    <div class="wrapper">
        <p><?php echo CHtml::link(zmf::config('sitename'),zmf::config('baseurl'));?><span class="pull-right">Copyright&copy;<?php echo date('Y');?></span></p>
    </div>
</div>
<div class="side-fixed back-to-top"><a href="#top" title="返回顶部"><span class="fa fa-angle-up"></span></a></div>
<div class="side-fixed feedback"><a href="javascript:;" title="意见反馈" action="feedback"><span class="fa fa-comment"></span></a></div>
<?php $this->endContent(); ?>