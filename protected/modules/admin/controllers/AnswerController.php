<?php

class AnswerController extends H {

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $count = Answer::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Answer::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Answer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Answer']))
            $model->attributes = $_GET['Answer'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Answer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Answer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Answer $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'answer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
