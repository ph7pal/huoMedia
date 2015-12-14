<?php

class AttachmentsController extends H {

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Attachments;
        if (isset($_POST['Attachments'])) {
            $model->attributes = $_POST['Attachments'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['Attachments'])) {
            $model->attributes = $_POST['Attachments'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order = 'cTime DESC';
        $count = Attachments::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 32;
        $pager->applyLimit($criteria);
        $posts = Attachments::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    public function actionAdmin() {
        $model = new Attachments('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Attachments']))
            $model->attributes = $_GET['Attachments'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Attachments::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'attachments-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
