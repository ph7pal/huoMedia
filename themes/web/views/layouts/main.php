<?php $this->beginContent('/layouts/common'); ?>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li<?php echo $this->selectNav=='posts' ? ' class="active"' : '';?>><?php echo CHtml::link('文章', array('index/index'));?></li>
                <li<?php echo $this->selectNav=='tags' ? ' class="active"' : '';?>><?php echo CHtml::link('标签', array('index/tags'));?></li>
                <li<?php echo $this->selectNav=='map' ? ' class="active"' : '';?>><?php echo CHtml::link('足迹', array('index/map'));?></li>
                <li<?php echo $this->selectNav=='about' ? ' class="active"' : '';?>><?php echo CHtml::link('关于', array('site/about'));?></li>
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