<?php

class IndexController extends Q {

    public function actionIndex() {
        
        $this->pageTitle = '文章 - '.zmf::config('sitename');
        $this->selectNav = 'posts';
        $data = array(
            'posts' => $posts,
        );
        $this->render('/index/index', $data);
    }

}
