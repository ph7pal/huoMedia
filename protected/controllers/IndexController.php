<?php

class IndexController extends Q {

    public function actionIndex() {
        $sql = 'SELECT id,uid,title,faceimg,content,tagids,comments,favorite FROM {{posts}} WHERE `status`=1 ORDER BY cTime DESC';
        Posts::getAll(array('sql' => $sql), $pages, $posts);
        foreach ($posts as $k => $val) {
            if ($val['tagids'] != '') {
                $_tags = Tags::getByIds($val['tagids']);
                $posts[$k]['tagids'] = $_tags;
            }
            $posts[$k]['faceimg'] = Attachments::faceImg($val, '640');
        }
        $this->pageTitle = '文章';
        $this->selectNav = 'posts';
        $data = array(
            'posts' => $posts
        );
        $this->render('/index/index', $data);
    }

    public function actionTags() {
        $sql = "SELECT id,title FROM {{tags}} WHERE classify='posts' AND `status`=1 ORDER BY cTime DESC";
        Posts::getAll(array('sql' => $sql), $pages, $posts);
        foreach ($posts as $k => $val) {
            $_posts = Posts::getTopsByTag($val['id']);
            $posts[$k]['posts'] = $_posts;
        }
        $data = array(
            'posts' => $posts,
            'pages' => $pages,
        );
        $this->pageTitle = '标签';
        $this->selectNav = 'tags';
        $this->render('/index/tags', $data);
    }

    public function actionMap() {
        $this->layout='common';
        $sql = "SELECT id,title,lat,`long`,comments,favorite,cTime FROM {{posts}} WHERE lat!='' AND `long`!='' AND `status`=1 ORDER BY cTime ASC";
        Posts::getAll(array('sql' => $sql, 'pageSize' => 100), $pages, $posts);
        foreach ($posts as $k=>$val){
            $posts[$k]['href']= Yii::app()->createUrl('posts/view',array('id'=>$val['id']));
            $posts[$k]['cTime']=  zmf::formatTime($val['cTime']);
        }
        $posts = !empty($posts) ? $posts : array();
        $data = array(
            'postJson' => CJSON::encode($posts)
        );
        $this->pageTitle = '足迹';
        $this->selectNav = 'map';
        $this->render('/index/map', $data);
    }

}
