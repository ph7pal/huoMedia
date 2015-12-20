<?php $this->beginContent('/layouts/common'); ?>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">导航条</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><?php echo CHtml::link('首页', zmf::config('baseurl'));?></li>
            </ul>
            <?php if (Yii::app()->user->isGuest) { ?>
            <ul class="nav navbar-nav navbar-right">
              <li><?php echo CHtml::link(zmf::t('login'), array('site/login')); ?></li>
            </ul>
            <?php }else{ ?>
            <ul class="nav navbar-nav navbar-right">
                <li><?php echo CHtml::link('上传作品', array('posts/create'),array('role'=>'menuitem')); ?></li>
                <li><?php echo CHtml::link('提醒', array('users/notice'),array('role'=>'menuitem')); ?></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->userInfo['truename'];?> <span class="caret"></span></a>               
                    <ul class="dropdown-menu">
                      <li><?php echo CHtml::link(zmf::t('homepage'), array('users/index', 'id' => $this->uid),array('role'=>'menuitem')); ?></li>
                      <li><?php echo CHtml::link(zmf::t('setting'), array('users/config'),array('role'=>'menuitem')); ?></li>
                      <li><?php echo CHtml::link(zmf::t('logout'), array('site/logout'),array('role'=>'menuitem')); ?></li>
                    </ul>
                </li>
            </ul>
            <?php }?>
        </div>
    </div> 
</div>
<?php echo $content; ?>
<?php $this->endContent(); ?>