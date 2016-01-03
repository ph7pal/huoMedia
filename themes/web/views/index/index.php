<style>
    .post-item-footer{
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f8f8f8;
        padding-bottom: 25px
    }
    .post-item-footer .left-actions{
        float: left
    }
    .post-item-footer .left-actions span{
        margin-right: 15px
    }
    .post-item-footer .right-actions{
        float: right
    }
    .post-list-tags a{
        margin-right: 10px;
    }
</style>
<div class="main-part">        
    <?php if(!empty($posts)){?>
    <?php foreach($posts as $post){?>
    <?php $this->renderPartial('/posts/_item',array('data'=>$post));?>
    <?php }?>
    <?php }?>
</div>