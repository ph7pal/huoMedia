<?php $this->beginContent('/layouts/common'); ?>
<!--<div class="navbar navbar-default" role="navigation">
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
                <li><?php echo CHtml::link('首页', ['/site/index']);?></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                
            </ul>
        </div>/.nav-collapse 
    </div> 
</div>-->
<?php echo $content; ?>
<?php $this->endContent(); ?>