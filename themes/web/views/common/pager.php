<?php

//分页widget代码: 
$this->widget('CLinkPager', array(
    'header' => '',
    'prevPageLabel' => '上一页',
    'nextPageLabel' => '下一页',
    'firstPageLabel' => '',
    'lastPageLabel' => '',
    'maxButtonCount' => 5,
    'pages' => $pages,
        )
);
?>