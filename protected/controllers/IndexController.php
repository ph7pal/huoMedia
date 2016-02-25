<?php

class IndexController extends Q {

    public function actionIndex() {
        $limit=10;
        //社区
        $forums=  ServiceForums::model()->findAll(array(
            'condition'=> 'status='.Posts::STATUS_PASSED,
            'limit'=>$limit,
            'order'=>'cTime ASC'
        ));
        //博客
        $blogs= ServiceBlogs::model()->findAll(array(
            'condition'=> 'status='.Posts::STATUS_PASSED,
            'limit'=>$limit,
            'order'=>'cTime ASC'
        ));
        //媒体
        $medias= ServiceMedias::model()->findAll(array(
            'condition'=> 'status='.Posts::STATUS_PASSED,
            'limit'=>$limit,
            'order'=>'cTime ASC'
        ));
        //视频
        $videos= ServiceVideos::model()->findAll(array(
            'condition'=> 'status='.Posts::STATUS_PASSED,
            'limit'=>$limit,
            'order'=>'cTime ASC'
        ));
        //美丽说
        $meilis= ServiceWebsites::model()->findAll(array(
            'condition'=> 'type=:type AND status='.Posts::STATUS_PASSED,
            'limit'=>$limit,
            'order'=>'cTime ASC',
            'params'=>array(
                ':type'=>ServiceWebsites::getTypeCode('meilishuo')
            )
        ));
        //蘑菇街
        $mogus= ServiceWebsites::model()->findAll(array(
            'condition'=> 'type=:type AND status='.Posts::STATUS_PASSED,
            'limit'=>$limit,
            'order'=>'cTime ASC',
            'params'=>array(
                ':type'=>ServiceWebsites::getTypeCode('mogu')
            )
        ));
        //人人
        $renrens= ServiceWebsites::model()->findAll(array(
            'condition'=> 'type=:type AND status='.Posts::STATUS_PASSED,
            'limit'=>$limit,
            'order'=>'cTime ASC',
            'params'=>array(
                ':type'=>ServiceWebsites::getTypeCode('renren')
            )
        ));
        //豆瓣
        $doubans= ServiceWebsites::model()->findAll(array(
            'condition'=> 'type=:type AND status='.Posts::STATUS_PASSED,
            'limit'=>$limit,
            'order'=>'cTime ASC',
            'params'=>array(
                ':type'=>ServiceWebsites::getTypeCode('douban')
            )
        ));
        
        $this->pageTitle = '文章 - '.zmf::config('sitename');
        $this->selectNav = 'posts';
        $data = array(
            'forums' => $forums,
            'blogs' => $blogs,
            'medias' => $medias,
            'meilis' => $meilis,
            'mogus' => $mogus,
            'videos' => $videos,
            'renrens' => $renrens,
            'doubans' => $doubans,
        );
        $this->render('/index/index', $data);
    }

}
