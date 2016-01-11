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
        $keyid = zmf::val('k', 2);
        $to = zmf::val('to', 2);
        $type = zmf::val('t', 1);
        $content = zmf::val('c', 1);
        $email = zmf::val('email', 1);
        $username = zmf::val('username', 1);
        if (!isset($type) OR ! in_array($type, array('posts'))) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (!isset($keyid) OR ! is_numeric($keyid)) {
            $this->jsonOutPut(0, Yii::t('default', 'pagenotexists'));
        }
        if (!$content) {
            $this->jsonOutPut(0, '评论不能为空哦~');
        }
        if ($this->uid) {
            $status = Posts::STATUS_PASSED;
            $uid = $this->uid;
        } else {
            if (!$username) {
                $this->jsonOutPut(0, '请填写称呼');
            }
            zmf::setCookie('noLoginUsername', $username, 2592000);            
            if ($email != '') {
                $validator = new CEmailValidator;
                if (!$validator->validateValue($email)) {
                    $this->jsonOutPut(0, '请填写正确的邮箱地址');
                }
                zmf::setCookie('noLoginEmail', $email, 2592000);
            }
            $status = Posts::STATUS_STAYCHECK;
            $uid = 0;
            if (zmf::actionLimit($type, $keyid, 5, 86400, true)) {
                $this->jsonOutPut(0, '操作太频繁，请稍后再试');
            }
        }
        $postInfo = Posts::model()->findByPk($keyid);
        if (!$postInfo || $postInfo['status'] != Posts::STATUS_PASSED) {
            $this->jsonOutPut(0, '您所评论的内容不存在');
        }
        //处理文本
        $filter = Posts::handleContent($content);
        $content = $filter['content'];
        $model = new Comments();
        $toNotice = true;
        if ($to) {
            $comInfo = Comments::model()->findByPk($to);
            if (!$comInfo || $comInfo['status'] != Posts::STATUS_PASSED) {
                $to = '';
            } elseif ($comInfo['uid'] == $uid) {
                $toNotice = false;
            } else {
                $touid = $comInfo['uid'] > 0 ? $comInfo['uid'] : '';
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
            'status' => $status,
            'username' => $username,
            'email' => $email,
        );
        unset(Yii::app()->session['checkHasBadword']);
        $model->attributes = $intoData;
        if ($model->validate()) {
            if ($model->save()) {
                if ($type == 'posts') {
                    $_url = CHtml::link('查看详情', array('posts/view', 'id' => $keyid, '#' => 'pid-' . $model->id));
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
                if ($uid) {
                    $intoData['loginUsername'] = $this->userInfo['truename'];
                }
                $html = $this->renderPartial('/posts/_comment', array('data' => $intoData, 'postInfo' => $postInfo), true);
                $this->jsonOutPut(1, $html);
            } else {
                $this->jsonOutPut(0, '新增评论失败');
            }
        } else {
            $this->jsonOutPut(0, '新增评论失败');
        }
    }

    public function actionGetContents() {
        $data = zmf::filterInput($_POST['data']);
        $page = zmf::filterInput($_POST['page']);
        $type = zmf::filterInput($_POST['type'], 't', 1);
        if (!$data || !$type) {
            $this->jsonOutPut(0, '数据不全，请核实');
        }
        if (!in_array($type, array('comments'))) {
            $this->jsonOutPut(0, '暂不允许的分类');
        }
        if ($page < 1 || !is_numeric($page)) {
            $page = 1;
        }
        $limit = 30;
        $longHtml = '';
        $postInfo = array();
        switch ($type) {
            case 'comments':
                $limit = 30;
                $posts = Comments::getCommentsByPage($data, 'posts', $page, $limit);
                $view = '/posts/_comment';
                break;
            default:
                $posts = array();
                break;
        }
        if (!empty($posts)) {
            foreach ($posts as $k => $row) {
                $longHtml.=$this->renderPartial($view, array('data' => $row, 'k' => $k, 'postInfo' => $postInfo), true);
            }
        }
        $data = array(
            'html' => $longHtml,
            'loadMore' => (count($posts) == $limit) ? 1 : 0,
            'formHtml' => ''
        );
        $this->jsonOutPut(1, $data);
    }

    public function actionDelContent() {
        $this->checkLogin();
        $data = zmf::val('data', 1);
        $type = zmf::val('type', 1);
        if (!$data || !$type) {
            $this->jsonOutPut(0, '数据不全，请核实');
        }
        if (!in_array($type, array('comment', 'post', 'notice', 'tag'))) {
            $this->jsonOutPut(0, '暂不允许的分类');
        }
        switch ($type) {
            case 'comment':
                $info = Comments::model()->findByPk($data);
                if (!$info) {
                    $this->jsonOutPut(0, '您所查看的内容不存在');
                } elseif ($info['uid'] != $this->uid) {
                    if ($this->checkPower('delComment', $this->uid, true)) {
                        //我是管理员，我就可以删除
                    } else {
                        $this->jsonOutPut(0, '不被允许的操作');
                    }
                }
                if (Comments::model()->updateByPk($data, array('status' => Posts::STATUS_DELED))) {
                    $this->jsonOutPut(1, '已删除');
                }
                $this->jsonOutPut(1, '已删除');
                break;
            case 'post':
                $info = Posts::model()->findByPk($data);
                if (!$info) {
                    $this->jsonOutPut(0, '您所查看的内容不存在');
                } elseif ($info['uid'] != $this->uid) {
                    if ($this->checkPower('delPost', $this->uid, true)) {
                        //我是管理员，我就可以删除
                    } else {
                        $this->jsonOutPut(0, '不被允许的操作');
                    }
                }
                if (Posts::model()->updateByPk($data, array('status' => Posts::STATUS_DELED))) {
                    $this->jsonOutPut(1, '已删除');
                }
                $this->jsonOutPut(1, '已删除');
                break;
            case 'notice':
                if (!$data || !is_numeric($data)) {
                    $this->jsonOutPut(0, '您所操作的内容不存在');
                }
                if (Notification::model()->deleteByPk($data)) {
                    $this->jsonOutPut(1, '已删除');
                }
                $this->jsonOutPut(1, '已删除');
                break;
            case 'tag':
                if (!$data || !is_numeric($data)) {
                    $this->jsonOutPut(0, '您所操作的内容不存在');
                }
                if (Tags::model()->updateByPk($data, array('status' => Posts::STATUS_DELED))) {
                    $this->jsonOutPut(1, '已删除');
                }
                $this->jsonOutPut(1, '已删除');
                break;
            default:
                $this->jsonOutPut(0, '操作有误');
                break;
        }
    }

    public function actionSetStatus() {
        $this->checkLogin();
        $keyid = zmf::val('a', 2);
        $classify = zmf::val('b', 1);
        $_status = zmf::val('c', 1);
        if (!$keyid) {
            $this->jsonOutPut(0, '请选择对象');
        }
        if (!in_array($classify, array('posts', 'comments'))) {
            $this->jsonOutPut(0, '不允许的类型');
        }
        if (!in_array($_status, array('del', 'passed'))) {
            $this->jsonOutPut(0, '不允许的类型');
        }
        if ($_status == 'top') {
            if ($classify == 'posts') {
                $attr = array(
                    'top' => 1,
                    'updateTime' => zmf::now()
                );
            } else {
                $attr = array(
                    'top' => 1
                );
            }
        } else if ($_status == 'canceltop') {
            $attr = array(
                'top' => 0,
            );
        } else if ($_status == 'del') {
            $attr = array(
                'status' => Posts::STATUS_DELED,
            );
        } else if ($_status == 'passed') {
            $attr = array(
                'status' => Posts::STATUS_PASSED,
            );
        }
        $ucClassify = ucfirst($classify);
        if (!class_exists($ucClassify)) {
            $this->jsonOutPut(0, '不存在的类型');
        }
        $model = new $ucClassify;
        if ($model->updateByPk($keyid, $attr)) {
            $this->jsonOutPut(1, '操作成功');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

    public function actionFavorite() {
        $data = zmf::val('data', 1);
        $type = zmf::val('type', 1);
        $ckinfo = Posts::favorite($data, $type, 'web');
        $this->jsonOutPut($ckinfo['state'], $ckinfo['msg']);
    }

}
