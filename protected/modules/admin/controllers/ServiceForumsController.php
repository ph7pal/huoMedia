<?php

class ServiceForumsController extends Admin {

    public function init() {
        parent::init();
        $this->checkPower('serviceForum');
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id='') {
        $this->checkPower('addForum');
        if ($id) {
            $model=  $this->loadModel($id);
        } else {
            $model = new ServiceForums;
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ServiceForums'])) {
            $model->attributes = $_POST['ServiceForums'];
            if ($model->save()){
                if(!$id){
                    Yii::app()->user->setFlash('forumCreateSuccess', "保存成功！您可以继续添加。");
                    $this->redirect(array('create'));
                }else{
                    $this->redirect(array('index'));
                }
            }      
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->actionCreate($id);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->checkPower('delForum');        
        $this->loadModel($id)->updateByPk($id,array('status'=>  Posts::STATUS_DELED));
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->addCondition('status=' . Posts::STATUS_PASSED);
        $criteria->order = 'cTime DESC';
        $count = ServiceForums::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = ServiceForums::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ServiceForums the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ServiceForums::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ServiceForums $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'service-forums-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
