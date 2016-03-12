<?php

class IndexController extends Q {

    private $download = false;
    private $downloadCode = '';

    public function init() {
        parent::init();
        $downloadCode = zmf::val('download', 1);
        $str = zmf::jieMi($downloadCode);
        $arr = explode('#', $str);
        //zmf#download#ctime
        $ctime = zmf::now();
        if (count($arr) == 3 && $arr[0] == 'zmf' && $arr[1] == 'download' && ($ctime - $arr[2] < 86400)) {
            $this->download = true;
            $this->downloadCode = $downloadCode;
        }
    }

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
            //微博
            $weibos = ServiceWeibo::model()->findAll(array(
                'condition' => 'status=' . Posts::STATUS_PASSED,
                'limit' => $limit,
                'order' => 'cTime ASC'
            ));
            //微信
            $weixins = ServiceWeixin::model()->findAll(array(
                'condition' => 'status=' . Posts::STATUS_PASSED,
                'limit' => $limit,
                'order' => 'cTime ASC'
            ));
            //空间
            $qzones = ServiceQzone::model()->findAll(array(
                'condition' => 'status=' . Posts::STATUS_PASSED,
                'limit' => $limit,
                'order' => 'cTime ASC'
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
                'weibos' => $weibos,
                'weixins' => $weixins,
                'qzones' => $qzones,
            );
            zmf::setFCache($cacheKey, $data, $expire);
        }
        $this->pageTitle = zmf::config('sitename');
        $this->render('/index/index', $data);
    }

    public function actionMore() {
        $table = zmf::val('table', 1);
        if (!$table || !in_array($table, array('forum', 'blog', 'media', 'site', 'video','weibo','weixin','qzone'))) {
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
            $level = zmf::val('level', 2);
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
            if($level){
                $criteria->addCondition('level=:level');
                $criteria->params[':level'] = $level;
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
            $websiteClassify = zmf::val('websiteClassify', 2);
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
            if ($websiteClassify) {
                $criteria->addCondition('classify=:classify');
                $criteria->params[':classify'] = $websiteClassify;
            }
            if ($typeCode) {
                $criteria->addCondition('type=:type');
                $criteria->params[':type'] = $typeCode;
                $title = ServiceWebsites::types($typeCode);
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
        }elseif ($table == 'weibo') {
            $weiboClassify = zmf::val('weiboClassify', 2);
            $criteria = new CDbCriteria();
            if ($weiboClassify) {
                $criteria->addCondition('classify=:classify');
                $criteria->params[':classify'] = $weiboClassify;
            }
            if ($keyword) {
                $criteria->addSearchCondition('nickname', $keyword);
            }
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceWeibo::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceWeibo::model()->findAll($criteria);
            $view = '/index/_weibo';
            $title = '微博';
            $tags = ServiceWeibo::getTags();
        }elseif ($table == 'weixin') {
            $weixinClassify = zmf::val('weixinClassify', 2);
            $criteria = new CDbCriteria();
            if ($weixinClassify) {
                $criteria->addCondition('classify=:classify');
                $criteria->params[':classify'] = $weixinClassify;
            }
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceWeixin::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceWeixin::model()->findAll($criteria);
            $view = '/index/_weixin';
            $title = '微信';
            $tags = ServiceWeixin::getTags();
        }elseif ($table == 'qzone') {
            $criteria = new CDbCriteria();            
            $criteria->addCondition('status=' . Posts::STATUS_PASSED);
            $criteria->order = 'cTime DESC';
            $count = ServiceQzone::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 30;
            $pager->applyLimit($criteria);
            $posts = ServiceQzone::model()->findAll($criteria);
            $view = '/index/_qzone';
            $title = 'QQ空间';
        }
        if(!$view){
            throw new CHttpException(404, '您所查看的页面不存在.');
        }
        $this->pageTitle = $title . ' - ' . zmf::config('sitename');
        $now = zmf::now();
        $downloadCode = zmf::jiaMi('zmf#download#' . $now);
        Yii::app()->session[$table . 'DownloadCode'] = $downloadCode;
        $this->render('more', array(
            'pages' => $pager,
            'posts' => $posts,
            'table' => $table,
            'type' => $type,
            'view' => $view,
            'title' => $title,
            'tags' => $tags,
            'downloadCode' => $downloadCode,
        ));
    }

    public function actionDownload() {
        if (!$this->download || !Yii::app()->request->isPostRequest) {
            throw new CHttpException(404, '链接已失效.');
        }
        $table = zmf::val('table', 1);
        $codeFromSession = Yii::app()->session[$table . 'DownloadCode'];
        if ($codeFromSession != $this->downloadCode) {
            throw new CHttpException(404, '请勿重复刷新页面.');
        }
        if (!$table || !in_array($table, array('forum', 'blog', 'media', 'site', 'video','weibo','weixin','qzone'))) {
            throw new CHttpException(404, '不允许的分类.');
        }
        $selected = $_POST['selected'];
        $idsArr = array_unique(array_filter($selected));
        if (empty($idsArr)) {
            throw new CHttpException(404, '请选择想要导出的数据.');
        }
        $idsStr = join(',', $idsArr);
        if (!$idsStr) {
            throw new CHttpException(404, '请选择想要导出的数据.');
        }

        $sitename = zmf::config('sitename');
        $filename = $sitename . '-' . uniqid();
        Yii::import('application.vendors.phpexcel.*');
        require_once 'PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator($sitename)
                ->setLastModifiedBy($sitename)
                ->setTitle($sitename);
        $charterArr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        if ($table == 'forum') {
            $selectAttr = 'classify,forum,type,url,forDigest,forDay,forWeek,forTwoWeek,forMonth,forQuarter,forHalfYear,forYear';
            $model = new ServiceForums();
            $posts = $model->findAll(array(
                'condition' => "id IN ({$idsStr})",
                'select' => $selectAttr
            ));
        } elseif ($table == 'blog') {
            $selectAttr = 'type,url,nickname,hits,classify,level,location,price';
            $model = new ServiceBlogs();
            $posts = $model->findAll(array(
                'condition' => "id IN ({$idsStr})",
                'select' => $selectAttr
            ));
        } elseif ($table == 'media') {
            $selectAttr = 'classify,title,url,isSource,hasLink,price';
            $model = new ServiceMedias();
            $posts = $model->findAll(array(
                'condition' => "id IN ({$idsStr})",
                'select' => $selectAttr
            ));
        } elseif ($table == 'site') {
            $selectAttr = 'type,classify,nickname,url,favors,price';
            $model = new ServiceWebsites();
            $posts = $model->findAll(array(
                'condition' => "id IN ({$idsStr})",
                'select' => $selectAttr
            ));
        } elseif ($table == 'video') {
            $selectAttr = 'type,classify,position,url,stayTime,price';
            $model = new ServiceVideos();
            $posts = $model->findAll(array(
                'condition' => "id IN ({$idsStr})",
                'select' => $selectAttr
            ));
        }elseif ($table == 'weibo') {
            $selectAttr = 'classify,nickname,url,favors,shenfen,location,ptzhuanfa,ptzhifa,ygzhuanfa,ygzhifa';
            $model = new ServiceWeibo();
            $posts = $model->findAll(array(
                'condition' => "id IN ({$idsStr})",
                'select' => $selectAttr
            ));
        }elseif ($table == 'weixin') {
            $selectAttr = 'classify,nickname,account,favors,danTuwen,duoTuwen,renzhen';
            $model = new ServiceWeixin();
            $posts = $model->findAll(array(
                'condition' => "id IN ({$idsStr})",
                'select' => $selectAttr
            ));
        }elseif ($table == 'qzone') {
            $selectAttr = 'nickname,url,favors,shuoshuo';
            $model = new ServiceQzone();
            $posts = $model->findAll(array(
                'condition' => "id IN ({$idsStr})",
                'select' => $selectAttr
            ));
        }
        if (empty($posts)) {
            throw new CHttpException(404, '没有数据需要导出.');
        }
        $attrKeys = explode(',', $selectAttr);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '序号');
        foreach ($attrKeys as $k => $_attr) {
            $_char = $charterArr[$k + 1];
            $_extra = '';
            if (in_array($_attr, array('price', 'forDigest', 'forDay', 'forWeek', 'forTwoWeek', 'forMonth', 'forQuarter', 'forHalfYear', 'forYear','ptzhuanfa','ptzhifa','ygzhuanfa','ygzhifa','danTuwen','duoTuwen','shuoshuo'))) {
                $_extra = '（元）';
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($_char . '1', $model->getAttributeLabel($_attr) . $_extra);
        }
        foreach ($posts as $pk => $pv) {
            foreach ($attrKeys as $k => $_attr) {
                if ($k == 0) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . ($pk + 2), $pk + 1);
                }
                $_char = $charterArr[$k + 1];
                if (in_array($_attr, array('type', 'classify', 'forum', 'position'))) {
                    if($table=='site' && $_attr=='type'){
                        $_value=  ServiceWebsites::types($pv->$_attr);
                    }else{
                        $_battr = $_attr . 'Info';
                        $_value = $pv->$_battr->title;
                    }
                } else {
                    $_value = $pv[$_attr];
                }
                if ($_attr == 'level') {
                    $_value = ServiceBlogs::level($_value);
                } elseif ($_attr == 'isSource') {
                    $_value = ServiceMedias::isSource($_value);
                } elseif ($_attr == 'hasLink') {
                    $_value = ServiceMedias::hasLink($_value);
                }
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($_char . ($pk + 2), $_value);
            }
        }
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //unset(Yii::app()->session[$table . 'DownloadCode']);
        //$this->redirect($this->referer);
        exit;
    }
}
