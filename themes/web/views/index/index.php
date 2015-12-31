<div class="main-part">        
    <?php if(!empty($posts)){?>
    <?php foreach($posts as $post){?>
    <?php $this->renderPartial('/posts/_item',array('data'=>$post));?>
    <?php }?>
    <?php }?>
</div>
<div class="colorful-bg">

</div>