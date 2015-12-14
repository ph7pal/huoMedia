<?php

class AdsController extends H {


    public function actionView($id) {
        $this->render('view', array(
          'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Ads;
        if (isset($_POST['Ads'])) {
            if (isset($_POST['Ads']['start_time'])) {
                $_POST['Ads']['start_time'] = strtotime($_POST['Ads']['start_time']);
            }
            if (isset($_POST['Ads']['expired_time'])) {
                $_POST['Ads']['expired_time'] = strtotime($_POST['Ads']['expired_time']);
            }
            $model->attributes = $_POST['Ads'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
          'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Ads'])) {
            $model->attributes = $_POST['Ads'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
          'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order = 'cTime DESC';
        $count = Ads::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Ads::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Ads('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Ads']))
            $model->attributes = $_GET['Ads'];

        $this->render('admin', array(
          'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Ads the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Ads::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Ads $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ads-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
