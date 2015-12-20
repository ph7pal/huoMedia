<?php

class IndexController extends Q {

    public function actionIndex() {
        $sql='SELECT id,title,faceimg,content FROM {{posts}} WHERE `status`=1';
        Posts::getAll(array('sql'=>$sql), $pages, $posts);
        $data=array(
            'posts'=>$posts
        );
        $this->render('/index/index',$data);
    }

}
