<?php

class AjaxController extends Q {

    public function init() {
        parent::init();
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
    }

    private function checkLogin() {
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
    }

    public function actionAddComment() {
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(2, Yii::t('default', 'loginfirst'));
        } else {
            $uid = zmf::uid();
        }
        $keyid = zmf::val('k', 2);
        $to = zmf::val('to', 2);
        $type = zmf::val('t', 1);
        $content = zmf::val('c', 1);
        if (!isset($type) OR ! in_array($type, array('posts'))) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (!isset($keyid) OR ! is_numeric($keyid)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if (!$content) {
            $this->jsonOutPut(0, '评论不能为空哦~');
        }
        $status = Posts::STATUS_STAYCHECK;
        //处理文本
        $filter = Posts::handleContent($content);
        $content = $filter['content'];
        $model = new Comments();
        $toNotice = true;
        if ($to) {
            $comInfo = Posts::getSimpleInfo(array('keyid' => $to, 'origin' => 'comments'));
            if (!$comInfo || $comInfo['status'] != Posts::STATUS_PASSED) {
                $to = '';
            } elseif ($comInfo['uid'] == $uid) {
                $toNotice = false;
            } else {
                $touid = $comInfo['uid'];
                $toNotice = true;
            }
        }
        $intoData = array(
            'logid' => $keyid,
            'uid' => $uid,
            'content' => $content,
            'cTime' => zmf::now(),
            'classify' => $type,
            'platform' => '', //$this->platform
            'tocommentid' => $to,
            'status' => $status
        );
        unset(Yii::app()->session['checkHasBadword']);
        $model->attributes = $intoData;
        if ($model->validate()) {
            if ($model->save()) {
                if ($type == 'posts') {
                    $_url = CHtml::link('查看详情', array('posts/index', 'id' => $keyid, '#' => 'pid-' . $model->id));
                    Posts::model()->updateCounters(array('comments' => 1), 'id=:id', array(':id' => $keyid));
                    $_content = '您的文章有了新的评论,' . $_url;
                }
                if ($to && $_url) {
                    $_content = '您的评论有了新的回复,' . $_url;
                }
                if ($toNotice) {
                    $_noticedata = array(
                        'uid' => $touid,
                        'authorid' => $uid,
                        'content' => $_content,
                        'new' => 1,
                        'type' => 'comment',
                        'cTime' => zmf::now(),
                        'from_id' => $model->id,
                        'from_num' => 1
                    );
                    Notification::add($_noticedata);
                }
                $html = $this->renderPartial('/posts/_comment', array('data' => $model), true);
                $this->jsonOutPut(1, $html);
            } else {
                $this->jsonOutPut(0, '新增评论失败');
            }
        } else {
            $this->jsonOutPut(0, '新增评论失败');
        }
    }

}
