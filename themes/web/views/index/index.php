<div class="container content">    
    <div class="main-part">        
        <?php if(!empty($posts)){?>
        <?php foreach($posts as $post){?>
        <?php $this->renderPartial('/posts/_item',array('data'=>$post));?>
        <?php }?>
        <?php }?>
    </div>
    <div class="fixed-side-part">
        <div class="author-avatar-box" style="background:url(http://img.inwedding.cn/posts/2015/12/11/F2D52488-8819-E85F-138E-A260A602FB3B.jpg/c650) no-repeat center"></div>
        <div class="module">
            一点点内容
        </div>
        <div class="module">
            一点点内容
        </div>
    </div>
</div>
<div class="colorful-bg">

</div>