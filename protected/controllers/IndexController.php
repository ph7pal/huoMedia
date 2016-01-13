<?php

class IndexController extends Q {

    public function actionIndex() {
        $tagid=  zmf::val('tagid',2);
        $tagInfo=array();
        $default=true;
        if($tagid){
            $tagInfo=  Tags::getByIds($tagid);
            if($tagInfo){
                $default=false;
                $tagInfo=$tagInfo[0];
                $sql="SELECT p.id,p.uid,p.title,p.faceimg,p.content,p.tagids,p.comments,p.favorite FROM {{posts}} p,{{tag_relation}} tr WHERE tr.tagid='{$tagid}' AND tr.classify='posts' AND tr.logid=p.id AND p.`status`=".Posts::STATUS_PASSED." ORDER BY p.cTime DESC";
            }
        }
        if($default){
            $sql = 'SELECT id,uid,title,faceimg,content,tagids,comments,favorite FROM {{posts}} WHERE `status`=1 ORDER BY cTime DESC';
        }
        Posts::getAll(array('sql' => $sql), $pages, $posts);
        $size=640;
        if($this->isMobile){
            $size=240;
        }
        foreach ($posts as $k => $val) {
            if ($val['tagids'] != '') {
                $_tags = Tags::getByIds($val['tagids']);
                $posts[$k]['tagids'] = $_tags;
            }
            $posts[$k]['faceimg'] = Attachments::faceImg($val, $size);
        }
        $this->pageTitle = '文章 - '.zmf::config('sitename');
        $this->selectNav = 'posts';
        $data = array(
            'posts' => $posts,
            'tagInfo' => $tagInfo,
            'pages' => $pages,
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
        $this->pageTitle = '标签 - '.zmf::config('sitename');
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
            'postJson' => CJSON::encode($posts),
            'loadMap'=>  empty($posts) ? false : true
        );
        $this->pageTitle = '足迹 - '.zmf::config('sitename');
        $this->selectNav = 'map';
        $this->render('/index/map', $data);
    }

}
