<?php

class ReportsController extends H {

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order = 'cTime DESC';
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if(!$type){
            $type='all';
        }
        if ($type === 'poipost') {
            $title = '举报的点评';
            $manageArr[] = array('type' => 'valid', 'title' => '有效举报');
            $manageArr[] = array('type' => 'read', 'title' => '忽略');        
            $criteria->addCondition('status=2 AND (classify="poipost" OR classify="poitips")');
        } elseif ($type === 'posts') {
            $title = '文章';
            $manageArr[] = array('type' => 'valid', 'title' => '有效举报');
            $manageArr[] = array('type' => 'read', 'title' => '忽略');     	
            $criteria->addCondition('status=2 AND classify="posts"');    
        } elseif ($type === 'comments') {
            $title = '举报评论';
            $manageArr[] = array('type' => 'valid', 'title' => '有效举报');
            $manageArr[] = array('type' => 'read', 'title' => '忽略');     	
            $criteria->addCondition('status=2 AND classify="comments"');
        } elseif ($type === 'img') {
            $title = '举报图片';
            $manageArr[] = array('type' => 'valid', 'title' => '有效举报');
            $manageArr[] = array('type' => 'read', 'title' => '忽略');        	
            $criteria->addCondition('status=2 AND classify="attachments"');
        } elseif ($type === 'all') {
            $title = '所有未处理举报';
            $manageArr[] = array('type' => 'valid', 'title' => '有效举报');
            $manageArr[] = array('type' => 'read', 'title' => '忽略');     	
            $criteria->addCondition('status=2');
        } elseif ($type === 'read') {
            $title = '所有已处理举报';
            $manageArr[] = array('type' => 'valid', 'title' => '有效举报');
            $manageArr[] = array('type' => 'read', 'title' => '忽略');    	
            $criteria->addCondition('`status`=1');
        } elseif ($type === 'question') {
            $title = '问题';
            $manageArr[] = array('type' => 'valid', 'title' => '有效举报');
            $manageArr[] = array('type' => 'read', 'title' => '忽略');
            $criteria->addCondition('status=2 AND classify="question"');
        } elseif ($type === 'answer') {
            $title = '回答';
            $manageArr[] = array('type' => 'valid', 'title' => '有效举报');
            $manageArr[] = array('type' => 'read', 'title' => '忽略');
            $criteria->addCondition('status=2 AND classify="answer"');
        } else {
            
        }

        $count = Reports::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $artList = Reports::model()->findAll($criteria);
        $data = array(
            'title' => $title,
            'pages' => $pager,
            'posts' => $artList,
            'manageArr' => $manageArr,
            'sscnum' => $sscnum,
            'cscnum' => $cscnum,
            'imgnum' => $imgnum,
            'total' => $total,
            'readnum' => $readnum
        );
        $this->render('all', $data);
    }

    public function actionManage() {
        $reportid = zmf::filterInput($_POST['reportid']);
        if (!isset($reportid) OR ! is_numeric($reportid)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        $type = zmf::filterInput($_POST['type'], 't', 1);
        if ($type === 'read') {
            $attr = array('status' => '1');
            $pmmess = Yii::t('default', 'readreport');
        } elseif ($type === 'valid') {
            $attr = array('status' => '1');
            $pmmess = Yii::t('default', 'validreport');
        } elseif ($type === 'bad') {
            $pmmess = Yii::t('default', 'badreport');
        } elseif ($type === 'del') {
            $this->actionDelete($reportid);
            Yii::app()->end();
        } else {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        //PowerController::checkPower($type . 'report', true);
        $sinfo = Reports::model()->findByPk($reportid);
        if (empty($sinfo)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if ($sinfo['classify'] == 'posts') {
            $model = new Posts;
            $_title='文章';
        }elseif ($sinfo['classify'] == 'comments') {
            $model = new Comments;
            $_title='评论';
        } elseif ($sinfo['classify'] == 'attachments') {
            $model = new Attachments;
            $_title='图片';
        } elseif ($sinfo['classify'] == 'poipost') {
            $model = new PoiPost();
            $_title='点评';
        } elseif ($sinfo['classify'] == 'poitips') {
            $model = new PoiTips(); 
            $_title='短评';
        } elseif ($sinfo['classify'] == 'question') {
            $model = new Question();
            $_title='问题';
        } elseif ($sinfo['classify'] == 'answer') {
            $model = new Answer();
            $_title='回答';
        } else {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        $notNotice = false;
        $theinfo = $model->findByPk($sinfo['logid']);
        if (!$theinfo) {
            $notNotice = true;
        }
        if($sinfo['classify']=='posts'){
            $text=$theinfo['title'];
        }elseif($sinfo['classify']=='question'){
            $text=$theinfo['title'];
        }elseif ($sinfo['classify'] != 'attachments') {
            $text = zmf::subStr($theinfo['content']);
        } else {
            $text = $theinfo['fileDesc'];
        }
        $content = '您举报的'.$_title.'【' . $text . '】，举报原因：【' . $sinfo['desc'] . '】，处理结果：【' . $pmmess . '】';
        if (Reports::model()->updateByPk($reportid, $attr)) {
            //UserController::recordAction($reportid, $type . 'report', 'report');
            if (!$notNotice) {
                if (zmf::uid() != $sinfo['uid']) {
                    $_noticedata = array(
                        'uid' => $sinfo['uid'],
                        'authorid' => zmf::uid(),
                        'content' => $content,
                        'new' => 1,
                        'type' => 'report',
                        'cTime' => zmf::now(),
                        'from_id' => $sinfo['id'],
                        'from_num' => 1
                    );
                    Notification::add($_noticedata);
                } else {
                    $info = '对自己的操作，不发通知消息';
                }
            }
            $this->jsonOutPut(1, '操作成功！' . $info);
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

    public function actionDelete($reportid) {
        if (!isset($reportid) OR ! is_numeric($reportid)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        PowerController::checkPower('shiftDelreport', true);
        if (Reports::model()->deleteAll('id=:attachid', array(':attachid' => $reportid))) {
            $this->jsonOutPut(1, '操作成功！');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

}
