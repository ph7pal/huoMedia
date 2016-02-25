<?php

class IndexController extends Q {

    public function actionIndex() {
        $cacheKey = Posts::cacheKeys('indexPage');
        $expire = Posts::CACHEEXPIRE;
        $data = zmf::getFCache($cacheKey);
        if (!$data) {
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
            zmf::setFCache($cacheKey, $data, $expire);
        }
        $this->pageTitle = zmf::config('sitename');
        $this->render('/index/index', $data);
    }

    public function actionMore() {
        $table = zmf::val('table', 1);
        if (!$table || !in_array($table, array('forum', 'blog', 'media', 'site', 'video'))) {
            $table = 'form';
        }
        $keyword = zmf::val('keyword', 1);
        if ($keyword) {
            $keyword = zmf::subStr($keyword, 10);
        }
        $view = $title = '';
        if ($table == 'forum') {
            $forumClassify = zmf::val('forumClassify', 2);
            $forumForum = zmf::val('forumForum', 2);
            $criteria = new CDbCriteria();
            if ($forumClassify) {
                $criteria->addCondition('classify=:classify');
                $criteria->params[':classify'] = $forumClassify;
            }
            if ($forumForum) {
                $criteria->addCondition('forum=:forum');
                $criteria->params[':forum'] = $forumForum;
            }
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceForums::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceForums::model()->findAll($criteria);
            $view = '/index/_forum';
            $title = '社区';
            $tags = ServiceForums::getTags();
        } elseif ($table == 'blog') {
            $blogType = zmf::val('blogType', 2);
            $blogClassify = zmf::val('blogClassify', 2);
            $criteria = new CDbCriteria();
            if ($blogType) {
                $criteria->addCondition('type=:type');
                $criteria->params[':type'] = $blogType;
            }
            if ($blogClassify) {
                $criteria->addCondition('classify=:classify');
                $criteria->params[':classify'] = $blogClassify;
            }
            if ($keyword) {
                $criteria->addSearchCondition('nickname', $keyword);
            }
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceBlogs::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceBlogs::model()->findAll($criteria);
            $view = '/index/_blog';
            $title = '博客';
            $tags = ServiceBlogs::getTags();
        } elseif ($table == 'media') {
            $mediaClassify = zmf::val('mediaClassify', 2);
            $criteria = new CDbCriteria();
            if ($mediaClassify) {
                $criteria->addCondition('classify=:classify');
                $criteria->params[':classify'] = $mediaClassify;
            }
            if ($keyword) {
                $criteria->addSearchCondition('title', $keyword);
            }
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceMedias::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceMedias::model()->findAll($criteria);
            $view = '/index/_media';
            $title = '媒体';
            $tags = ServiceMedias::getTags();
        } elseif ($table == 'site') {
            $view = '/index/_website';
            $title = '主页';
            $forumClassify = zmf::val('forumClassify', 2);
            $forumForum = zmf::val('forumForum', 2);
            $type = zmf::val('type', 1);
            if (!$type) {
                throw new CHttpException(404, '您所查看的列表不存在.');
            }
            $typeCode = ServiceWebsites::getTypeCode($type);
            if (!$typeCode) {
                throw new CHttpException(404, '您所查看的列表不存在.');
            }
            $criteria = new CDbCriteria();
            if ($forumClassify) {
                $criteria->addCondition('classify=:classify');
                $criteria->params[':classify'] = $forumClassify;
            }
            if ($forumForum) {
                $criteria->addCondition('forum=:forum');
                $criteria->params[':forum'] = $forumForum;
            }
            if ($typeCode) {
                $criteria->addCondition('type=:type');
                $criteria->params[':type'] = $typeCode;
                $title = ServiceWebsites::types($type);
            }
            if ($keyword) {
                $criteria->addSearchCondition('nickname', $keyword);
            }
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceWebsites::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceWebsites::model()->findAll($criteria);
            $tags = ServiceWebsites::getTags();
        } elseif ($table == 'video') {
            $videoType = zmf::val('videoType', 2);
            $videoClassify = zmf::val('videoClassify', 2);
            $videoPosition = zmf::val('videoPosition', 2);
            $criteria = new CDbCriteria();
            if ($videoType) {
                $criteria->addCondition('type=:type');
                $criteria->params[':type'] = $videoType;
            }
            if ($videoClassify) {
                $criteria->addCondition('classify=:classify');
                $criteria->params[':classify'] = $videoClassify;
            }
            if ($videoPosition) {
                $criteria->addCondition('position=:position');
                $criteria->params[':position'] = $videoPosition;
            }
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceVideos::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceVideos::model()->findAll($criteria);
            $view = '/index/_video';
            $title = '视频网站';
            $tags = ServiceVideos::getTags();
        }

        $this->render('more', array(
            'pages' => $pager,
            'posts' => $posts,
            'table' => $table,
            'type' => $type,
            'view' => $view,
            'title' => $title,
            'tags' => $tags,
        ));
    }

}
