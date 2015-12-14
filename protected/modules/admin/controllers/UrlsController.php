<?php

class UrlsController extends H {

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Urls;
        if (isset($_POST['Urls'])) {
            $_POST['Urls']['hash']='urls';
            $_POST['Urls']['code']='urls';
            $model->attributes = $_POST['Urls'];
            if ($model->validate()){
                $info=  Urls::FAA($_POST['Urls']['url']);
                if($info){
                    $this->redirect(array('view', 'id' => $info->id));
                }else{
                    $this->message(0, '新增失败，请重试');
                }
            }
        }
        $this->render('create', array(
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
        $count = Urls::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Urls::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }
    

    public function actionAdmin() {
        $model = new Urls('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Urls']))
            $model->attributes = $_GET['Urls'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Urls::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'urls-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
