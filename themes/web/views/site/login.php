<div class="container">
    <div class="login-form">
        <div class="module">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true
            )); ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'username'); ?>
                    <?php echo $form->textField($model,'username', array('class'=>'form-control','placeholder'=>'邮箱/用户名')); ?> <?php echo $form->error($model,'username'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'password'); ?>
                    <?php echo $form->passwordField($model,'password', array('class'=>'form-control','placeholder'=>'请输入密码')); ?> <?php echo $form->error($model,'password'); ?>
                </div>
                <?php $cookieInfo=zmf::getCookie('checkWithCaptcha');if($cookieInfo=='1'){?>
                <div class="form-group">        
                    <?php echo $form->textField($model,'verifyCode', array('class'=>'form-control verify-code')); ?>
                    <?php echo $form->error($model,'verifyCode'); ?>
                    <?php $this->widget ( 'CCaptcha', array ('showRefreshButton' => true, 'clickableImage' => true, 'buttonType' => 'link', 'buttonLabel' => zmf::t('change_verify'), 'imageOptions' => array ('alt' => zmf::t('change_verify'), 'align'=>'absmiddle'  ) ) );?>
                </div>
                <?php }?>
                <div class="checkbox"><label><?php echo $form->checkBox($model, 'rememberMe', array('class' => 'remember')); ?> <?php echo zmf::t('remember_me');?></label></div>
                <div class="form-group">
                  <input type="submit" name="login" class="btn btn-success" value="Login"/>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>