<?php

class PostsController extends Q {

    public $pType;
    public $pOrder;    
    public $favored = false;
    public $favorited = false;
    public $selectColid; //当前选择的文章分类

    /**
     * 已取消其他文章类型，默认为游记
     * @param type $classify，分类
     */
    public function actionCreate($id = '') {
        $id = zmf::filterInput($id);
        if (!zmf::uid()) {
            $this->redirect(array('site/login'));
        }
        if ($id) {
            $model = $this->loadModel($id);
            if ($model->uid != zmf::uid()) {
                if (!Users::checkPower('editpost', false, true)) {
                    throw new CHttpException(403, '不被允许的操作.');
                }
            }
            $action = zmf::filterInput($_GET['action'], 't', 1);
        } else {
            $model = new Posts;
            $model->classify = Posts::CLASSIFY_TRAVEL_LOG; //文章分类
            $model->colid = 4; //前期默认为游记，以后再考虑开放其他类型
            $model->areaid = $this->theAreaId; //前期根据用户选择来，不做强制必填
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'posts-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Posts'])) {
            //判断是否应被禁止
            $forbidInfo = Posts::isForbidden($_POST['Posts']['content'], 'post');
            if ($forbidInfo['status'] != Posts::STATUS_PASSED) {
                //todo，增加用户非法操作次数
                $_POST['Posts']['status'] = Posts::STATUS_STAYCHECK;
            }
            //处理文本
            $filter = Posts::handleContent($_POST['Posts']['content']);
            if ($action == 'perfect') {
                $_POST['Posts']['content'] = $model->content . $filter['content'];
            } else {
                $_POST['Posts']['content'] = $filter['content'];
            }
            foreach ($_POST['Posts'] as $k => $val) {
                $_POST['Posts'][$k] = zmf::filterInput($val, 't');
            }
            if (Yii::app()->session['checkHasBadword'] == 'yes') {
                $_POST['Posts']['status'] = Posts::STATUS_STAYCHECK;
            }
            if (!$model->isNewRecord) {
                $_POST['Posts']['updateTime'] = zmf::now();
                $isNew = false;
            } else {
                $isNew = true;
            }
            unset(Yii::app()->session['checkHasBadword']);
            if (!empty($filter['attachids'])) {
                $attkeys = array_filter(array_unique($filter['attachids']));
                if (!empty($attkeys)) {
                    $_POST['Posts']['faceimg'] = $attkeys[0]; //默认将文章中的第一张图作为封面图
                }
            } else {
                $_POST['Posts']['faceimg'] = ''; //否则将封面图置为空(有可能编辑后没有图片了)
            }
            $model->attributes = $_POST['Posts'];
            if ($model->save()) {
                //将上传的图片置为通过
                Attachments::model()->updateAll(array('status' => Posts::STATUS_DELED), 'logid=:logid AND classify=:classify', array(':logid' => $model->id, ':classify' => 'posts'));
                if (!empty($attkeys)) {
                    $attstr = join(',', $attkeys);
                    if ($attstr != '') {
                        Attachments::model()->updateAll(array('status' => Posts::STATUS_PASSED, 'logid' => $model->id), 'id IN(' . $attstr . ')');
                    }
                }
                $data['content'] = $model->content;
                $data['url'] = "keyid={$model->id}&areaid={$model->areaid}&classify=post";
                Posts::autoLink($data);
                if ($isNew) {
                    UserAction::recordAction($model->id, 'addpost', zmf::uid());
                }
                $this->redirect(array('index', 'id' => $model->id));
            }
        }
        $cols = Column::allCols(1, 0, 1, Posts::CLASSIFY_POST);
        if (!$model->isNewRecord) {
            if ($action == 'perfect') {
                $model->content = '';
            } else {
                $model->content = zmf::text(array('action' => 'edit'), $model->content, false, 600);
            }
        }
        $this->pageTitle = '与世界分享你的旅行见闻 - ' . zmf::config('sitename');
        $this->render('create', array(
            'model' => $model,
            'cols' => $cols,
            'action' => $action,
        ));
    }    

    public function loadModel($id) {
        $model = Posts::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
