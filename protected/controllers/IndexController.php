<?php

class IndexController extends Q {

    public function actionIndex() {
        $limit = 10;
        //社区
        $forums = ServiceForums::model()->findAll(array(
            'condition' => 'status=' . Posts::STATUS_PASSED,
            'limit' => $limit,
            'order' => 'cTime ASC'
        ));
        //博客
        $blogs = ServiceBlogs::model()->findAll(array(
            'condition' => 'status=' . Posts::STATUS_PASSED,
            'limit' => $limit,
            'order' => 'cTime ASC'
        ));
        //媒体
        $medias = ServiceMedias::model()->findAll(array(
            'condition' => 'status=' . Posts::STATUS_PASSED,
            'limit' => $limit,
            'order' => 'cTime ASC'
        ));
        //视频
        $videos = ServiceVideos::model()->findAll(array(
            'condition' => 'status=' . Posts::STATUS_PASSED,
            'limit' => $limit,
            'order' => 'cTime ASC'
        ));
        //美丽说
        $meilis = ServiceWebsites::model()->findAll(array(
            'condition' => 'type=:type AND status=' . Posts::STATUS_PASSED,
            'limit' => $limit,
            'order' => 'cTime ASC',
            'params' => array(
                ':type' => ServiceWebsites::getTypeCode('meilishuo')
            )
        ));
        //蘑菇街
        $mogus = ServiceWebsites::model()->findAll(array(
            'condition' => 'type=:type AND status=' . Posts::STATUS_PASSED,
            'limit' => $limit,
            'order' => 'cTime ASC',
            'params' => array(
                ':type' => ServiceWebsites::getTypeCode('mogu')
            )
        ));
        //人人
        $renrens = ServiceWebsites::model()->findAll(array(
            'condition' => 'type=:type AND status=' . Posts::STATUS_PASSED,
            'limit' => $limit,
            'order' => 'cTime ASC',
            'params' => array(
                ':type' => ServiceWebsites::getTypeCode('renren')
            )
        ));
        //豆瓣
        $doubans = ServiceWebsites::model()->findAll(array(
            'condition' => 'type=:type AND status=' . Posts::STATUS_PASSED,
            'limit' => $limit,
            'order' => 'cTime ASC',
            'params' => array(
                ':type' => ServiceWebsites::getTypeCode('douban')
            )
        ));

        $this->pageTitle = '文章 - ' . zmf::config('sitename');
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

    public function actionMore() {
        $table = zmf::val('table', 1);
        if (!$table || !in_array($table, array('forum', 'blog', 'media', 'site', 'video'))) {
            $table = 'form';
        }
        $view = $title='';
        if ($table == 'forum') {
            $criteria = new CDbCriteria();
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceForums::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceForums::model()->findAll($criteria);
            $view = '/index/_forum';
            $title='社区';
            $tags=  ServiceForums::getTags();
        } elseif ($table == 'blog') {
            $criteria = new CDbCriteria();
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceBlogs::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceBlogs::model()->findAll($criteria);
            $view = '/index/_blog';
            $title='博客';
            $tags=  ServiceBlogs::getTags();
        } elseif ($table == 'media') {
            $criteria = new CDbCriteria();
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceMedias::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceMedias::model()->findAll($criteria);
            $view = '/index/_media';
            $title='媒体';
            $tags=  ServiceMedias::getTags();
        } elseif ($table == 'site') {
            $criteria = new CDbCriteria();
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceWebsites::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceWebsites::model()->findAll($criteria);
            $view = '/index/_website';
            $title='主页';
            $tags=  ServiceWebsites::getTags();
        } elseif ($table == 'video') {
            $criteria = new CDbCriteria();
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceVideos::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceVideos::model()->findAll($criteria);
            $view = '/index/_video';
            $title='视频网站';
            $tags=  ServiceVideos::getTags();
        }

        $this->render('more', array(
            'pages' => $pager,
            'posts' => $posts,
            'table' => $table,
            'view' => $view,
            'title' => $title,
            'tags' => $tags,
        ));
    }

}
