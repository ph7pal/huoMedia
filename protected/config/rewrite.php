<?php

return array(
    'urlFormat' => 'path', //get
    'showScriptName' => false, //隐藏index.php   
    'urlSuffix' => '', //后缀   
    'rules' => array(
        '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    )
);
?>
