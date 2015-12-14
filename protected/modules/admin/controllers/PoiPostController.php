<?php

class PoiPostController extends H {

    public function actionView($id) {
        $this->render('view', array(
          'model' => $this->loadModel($id),
        ));
    }
    
    public function actionCreate() {
        $model = new PoiPost;
        if (isset($_POST['PoiPost'])) {
            $model->attributes = $_POST['PoiPost'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
          'model' => $model,
        ));
    }
    
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['PoiPost'])) {
            $model->attributes = $_POST['PoiPost'];
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
        $criteria->order = 'id DESC';
        $count = PoiPost::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = PoiPost::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PoiPost('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PoiPost']))
            $model->attributes = $_GET['PoiPost'];

        $this->render('admin', array(
          'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PoiPost the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PoiPost::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PoiPost $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'poi-post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
