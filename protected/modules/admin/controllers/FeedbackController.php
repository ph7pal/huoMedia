<?php

class FeedbackController extends H {
    public function actionIndex() {
        $type = zmf::filterInput($_GET['type'], 't', 1);
        if (!$type || !in_array($type, array('staycheck', 'deled'))) {
            $type = 'staycheck';
        }
        if ($type == 'staycheck') {
            $condition = 'status=' . Posts::STATUS_STAYCHECK;
        } else {
            $condition = 'status!=' . Posts::STATUS_STAYCHECK;
        }
        $criteria = new CDbCriteria();
        $criteria->condition = $condition;
        $criteria->order = 'cTime DESC';
        $count = Feedback::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $artList = Feedback::model()->findAll($criteria);
        $data = array(
            'pages' => $pager,
            'posts' => $artList
        );
        $this->render('all', $data);
    }

    public function actionAddNotice() {
        $touid = zmf::filterInput($_POST['touid']);
        $keyid = zmf::filterInput($_POST['keyid']);
        $content = zmf::filterInput($_POST['content'], 't', 1);
        if (!$touid) {
            $this->jsonOutPut(0, '对话对象不能为空');
        }
        if (!$content) {
            $this->jsonOutPut(0, '消息内容不能为空');
        }
        if (!$keyid) {
            $this->jsonOutPut(0, '反馈内容不存在');
        }
        $info = Feedback::model()->findByPk($keyid);
        if (!$info) {
            $this->jsonOutPut(0, '反馈内容不存在');
        }
        $content = '反馈回复：'.$content.' 您的反馈原文：'.$info['content'];        
        $_noticedata = array(
            'uid' => $touid,
            'authorid' => zmf::uid(),
            'content' => $content,
            'new' => 1,
            'type' => 'feedback',
            'cTime' => zmf::now(),
            'from_id' => $info->id,
            'from_num' => 1
        );        
        if (Notification::add($_noticedata)) {
            Feedback::model()->updateByPk($keyid, array('status' => Posts::STATUS_DELED));
            $this->jsonOutPut(1, '已发送');
        } else {
            $this->jsonOutPut(0, '发送失败，错误码：' . $state);
        }
    }

    public function actionManage() {
        $scenicid = zmf::filterInput($_POST['feedid']);
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (!isset($scenicid) OR ! is_numeric($scenicid)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        $type = zmf::filterInput($_POST['type'], 't', 1);
        if ($type === 'del') {
            $status = Posts::STATUS_DELED;
        } else {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        $sinfo = Feedback::model()->findByPk($scenicid);
        if (empty($sinfo)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if (Feedback::model()->updateByPk($scenicid, array('status' => $status))) {
            $this->jsonOutPut(1, '操作成功！');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

}
