<style>
    body{
        background: rgba(229,229,229,.95);
    }
    .container{
        position: relative;
        margin-top: 45px;
    }
    .colorful-bg{
        position: fixed;
        width: 100%;
        height: 300px;
        top: 200px;
        left: 0;
/*        background: #e1e8e5;*/
        z-index: -2
    }
    .author-avatar-box{
        width: 278px;
        height: 278px;
        -webkit-transition: opacity .4s ease-in-out;
        -moz-transition: opacity .4s ease-in-out;
        -o-transition: opacity .4s ease-in-out;
        box-shadow: 0 1px 3px rgba(0,0,0,.3);
        -moz-box-shadow: 0 1px 3px rgba(0,0,0,.3);
        -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.3);
    }
    .main-part .post-item{
        background: #fff;
    }
    .main-part .post-item img{
        max-width: 100%;
    }
    .main-part .module{
        
        padding: 16px 20px;
        box-shadow: 0 1px 3px rgba(34,25,25,.4);
        margin-bottom: 16px;
    }
    .fixed-side-part{
        position: fixed;
        top: 45px;
        left: 50%;
        margin-left: 202px;
    }
    .fixed-side-part .module{
        background: #fff;
        padding: 16px 20px;
        box-shadow: 0 1px 3px rgba(34,25,25,.4);
        margin-bottom: 16px;
    }
</style>
<div class="container">
    <div class="main-part">
        <div class="post-item">
            <img src="http://img.inwedding.cn/posts/2015/12/11/BE2F80B8-DF16-FB5E-49E3-10D392705616.jpg/c650"/>
            <div class="module">
                一点点内容
            </div>
        </div>
        <div class="post-item">
            <img src="http://img.inwedding.cn/posts/2015/12/11/C48E58A4-5020-CDFA-BCD1-8E2038878982.jpg/c650"/>
            <div class="module">
                一点点内容
            </div>
        </div>
        <div class="post-item">
            <img src="http://img.inwedding.cn/posts/2015/12/11/F2D52488-8819-E85F-138E-A260A602FB3B.jpg/c650"/>
            <div class="module">
                一点点内容
            </div>
        </div>
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