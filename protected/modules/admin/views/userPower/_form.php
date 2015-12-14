<div class="form">

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'groupid'); ?>
		<?php echo $form->textField($model,'groupid',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'groupid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addPost'); ?>
		<?php echo $form->dropDownlist($model,'addPost',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'addPost'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'postNum'); ?>
		<?php echo $form->textField($model,'postNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'postNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addQuestion'); ?>
		<?php echo $form->dropDownlist($model,'addQuestion',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'addQuestion'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'questionNum'); ?>
		<?php echo $form->textField($model,'questionNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'questionNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addAnswer'); ?>
		<?php echo $form->dropDownlist($model,'addAnswer',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'addAnswer'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'answerNum'); ?>
		<?php echo $form->textField($model,'answerNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'answerNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addPoiPost'); ?>
		<?php echo $form->dropDownlist($model,'addPoiPost',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'addPoiPost'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'poiPostNum'); ?>
		<?php echo $form->textField($model,'poiPostNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'poiPostNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addPoiTips'); ?>
		<?php echo $form->dropDownlist($model,'addPoiTips',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'addPoiTips'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'poiTipsNum'); ?>
		<?php echo $form->textField($model,'poiTipsNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'poiTipsNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addImage'); ?>
		<?php echo $form->dropDownlist($model,'addImage',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'addImage'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'imageNum'); ?>
		<?php echo $form->textField($model,'imageNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'imageNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addComment'); ?>
		<?php echo $form->dropDownlist($model,'addComment',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'addComment'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'commentNum'); ?>
		<?php echo $form->textField($model,'commentNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'commentNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addPlan'); ?>
		<?php echo $form->dropDownlist($model,'addPlan',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'addPlan'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'planNum'); ?>
		<?php echo $form->textField($model,'planNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'planNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'yueban'); ?>
		<?php echo $form->dropDownlist($model,'yueban',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'yueban'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'yuebanNum'); ?>
		<?php echo $form->textField($model,'yuebanNum',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'yuebanNum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'favor'); ?>
		<?php echo $form->dropDownlist($model,'favor',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'favor'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'favorite'); ?>
		<?php echo $form->dropDownlist($model,'favorite',tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'favorite'); ?>
	</div>
</div><!-- form -->