<?php

class PostsController extends Admin {

    /**
     * 已取消其他文章类型，默认为游记
     * @param type $classify，分类
     */

    public function actionCreate($id = '') {
        $this->layout='common';
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
            $tagids=  array_unique(array_filter($_POST['tags']));
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
                //处理标签
                $intoTags=array();
                if(!empty($tagids)){                    
                    foreach ($tagids as $tagid){
                        $_info=Tags::addRelation($tagid, $model->id, 'posts');
                        if($_info){
                            $intoTags[]=$tagid;
                        }
                    }                    
                }
                if(!$isNew || !empty($intoTags)){
                    Posts::model()->updateByPk($model->id,array('tagids'=>join(',',$intoTags)));
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $tags=  Tags::getClassifyTags('posts');
        $this->pageTitle = '与世界分享你的旅行见闻 - ' . zmf::config('sitename');
        $this->render('create', array(
            'model' => $model,
            'tags' => $tags,
        ));
    }

    public function loadModel($id) {
        $model = Posts::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
