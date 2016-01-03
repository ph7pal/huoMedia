<?php $this->beginContent('/layouts/common'); ?>
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><?php echo CHtml::link('文章', zmf::config('baseurl'));?></li>
                <li><?php echo CHtml::link('标签', zmf::config('baseurl'));?></li>
                <li><?php echo CHtml::link('足迹', zmf::config('baseurl'));?></li>
                <li><?php echo CHtml::link('关于', zmf::config('baseurl'));?></li>
            </ul>
            <?php if (Yii::app()->user->isGuest) { ?>
            <ul class="nav navbar-nav navbar-right">
              <li><?php echo CHtml::link(zmf::t('login'), array('site/login')); ?></li>
            </ul>
            <?php }else{ ?>
            <ul class="nav navbar-nav navbar-right">
                <li><?php echo CHtml::link('<i class="fa fa-bell-o"></i>', array('users/notice'),array('role'=>'menuitem')); ?></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->userInfo['truename'];?> <span class="caret"></span></a>               
                    <ul class="dropdown-menu">
                        <li><?php echo CHtml::link('新增作品', array('admin/posts/create'),array('role'=>'menuitem')); ?></li>
                        <li class="divider"></li>
                        <li><?php echo CHtml::link('管理中心', array('admin/index/index'),array('role'=>'menuitem')); ?></li>
                        <li><?php echo CHtml::link('退出', array('site/logout'),array('role'=>'menuitem')); ?></li>
                    </ul>
                </li>
            </ul>
            <?php }?>
        </div>
    </div> 
</div>
<?php echo $content; ?>
<?php $this->endContent(); ?>