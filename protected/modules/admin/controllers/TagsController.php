<?php

/**
 * @filename TagsController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-1-4  12:54:36 
 */
class TagsController extends Admin {

    public function init() {
        parent::init();
        $this->checkPower('tags');
    }

    public function actionIndex() {
        $classify = zmf::val('classify', 1);
        if ($classify) {
            $_label = Tags::classify($classify);
            if (!$_label) {
                throw new CHttpException(404, '请选择正确的类别.');
            }
        }
        $criteria = new CDbCriteria();
        $criteria->addCondition('status=' . Posts::STATUS_PASSED);
        if ($classify) {
            $criteria->addCondition("classify='" . $classify . "'");
        }
        $criteria->order = 'cTime DESC';
        $count = Tags::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Tags::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    public function actionCreate($id = '') {
        $this->checkPower('addTag');
        $classify = zmf::val('classify', 1);
        if ($id) {
            $model = Tags::model()->findByPk($id);
            if (!$model) {
                $this->message(0, '该标签不存在');
            }
            $classifyLabel = Tags::classify($model->classify);
            $isNew = false;
        } else {
            if (!$classify) {
                throw new CHttpException(404, '请选择类别.');
            } else {
                $_label = Tags::classify($classify);
                if (!$_label) {
                    throw new CHttpException(404, '请选择类别.');
                }
                $classifyLabel = $_label;
            }
            $model = new Tags;
            $model->classify = $classify;
            $isNew = true;
        }
        if (isset($_POST['Tags'])) {
            if (!$model->classify) {
                $model->addError('title', '请选择类别');
            } elseif ($model->classify == 'forumType' && !$_POST['Tags']['pid']) {
                $model->addError('title', '请选择所属类别');
            } else {
                $model->attributes = $_POST['Tags'];
                if ($model->save()) {
                    if ($isNew) {
                        Yii::app()->user->setFlash('tagCreateSuccess', "保存成功！您可以继续添加。");
                        $this->redirect(array('create', 'classify' => $classify));
                    } else {
                        $this->redirect(array('index', 'classify' => $classify));
                    }
                }
            }
        }
        $belongTags = array();
        if ($model->classify == 'forumType') {
            $belongTags = Tags::getClassifyTags('forumForum');
        }

        $this->render('create', array(
            'model' => $model,
            'classifyLabel' => $classifyLabel,
            'belongTags' => $belongTags,
        ));
    }

    public function actionUpdate($id) {
        $this->actionCreate($id);
    }

}
