<?php

return array(
    'urlFormat' => 'path', //get
    'showScriptName' => false, //隐藏index.php   
    'urlSuffix' => '', //后缀   
    'rules' => array(
        'map' => 'index/map',
        'tags' => 'index/tags',
        'post/<id:\d+>' => 'posts/view',
        'tag/<tagid:\d+>' => 'index/index',
        'login' => 'site/login',
        'logout' => 'site/logout',
        'site/<code:\w+>' => 'site/info',
        'posts' => 'index/index',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',        
    )
);
?>
