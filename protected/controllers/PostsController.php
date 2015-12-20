<?php

class PostsController extends Q {

    public $pType;
    public $pOrder;
    public $favored = false;
    public $favorited = false;
    public $selectColid; //当前选择的文章分类
    
    public function actionView($id){
        $info=  $this->loadModel($id);
        $data=array(
            'info'=>$info
        );
        $this->render('view',$data);
    }

    /**
     * 已取消其他文章类型，默认为游记
     * @param type $classify，分类
     */

    public function actionCreate($id = '') {
        $id = zmf::myint($id);
        if (!$this->uid) {
            $this->redirect(array('site/login'));
        }
        if ($id) {
            $model = $this->loadModel($id);
            $isNew = false;
        } else {
            $model = new Posts;
            $isNew = true;
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'posts-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Posts'])) {
            //处理文本
            $filter = Posts::handleContent($_POST['Posts']['content']);
            $_POST['Posts']['content'] = $filter['content'];
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
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->pageTitle = '与世界分享你的旅行见闻 - ' . zmf::config('sitename');
        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Posts::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
