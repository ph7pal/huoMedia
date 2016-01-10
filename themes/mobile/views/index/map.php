<?php

/**
 * @filename map.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-1-5  15:01:59 
 */
?>


<?php $this->renderPartial('/index/showMapinfo',array('postJson'=>$postJson));?>
<script>
    $(document).ready(function() {
        showMap();
        loadScript();
    });
    $(window).resize(function() {
            showMap();
        });
    function showMap(){
        var w=$(window).width();
        var h=$(window).height();
        $('#map-canvas').css({
            width:w,
            height:h
        });
    }
</script>