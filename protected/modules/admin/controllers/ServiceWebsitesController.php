<?php

class ServiceWebsitesController extends Admin {

    public function init() {
        parent::init();
        $this->checkPower('serviceWebsite');
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
    public function actionCreate($id = '') {
        $this->checkPower('addWebsite');
        if ($id) {
            $model=  $this->loadModel($id);
            $typeLabel = ServiceWebsites::types($model->type);
        } else {
            $type = zmf::val('type', 1);
            if (!$type) {
                $this->redirect(array('create', 'type' => 1000));
            }
            $typeCode = ServiceWebsites::getTypeCode($type);
            $typeLabel = ServiceWebsites::types($typeCode);
            $model = new ServiceWebsites;
            $model->type = $typeCode;
        }
        if (isset($_POST['ServiceWebsites'])) {
            $model->attributes = $_POST['ServiceWebsites'];
            if ($model->save()){
                if(!$id){
                    Yii::app()->user->setFlash('websiteCreateSuccess', "保存成功！您可以继续添加。");
                    $this->redirect(array('create','type'=>$type));
                }else{
                    $typeCodes=  ServiceWebsites::getTypeCode('admin');
                    $typeCodesArr=  array_flip($typeCodes);
                    $this->redirect(array('index','type'=>$typeCodesArr[$model->type]));
                }
            }      
        }
        $this->render('create', array(
            'model' => $model,
            'typeLabel' => $typeLabel,
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
        $this->checkPower('delWebsite');        
        $this->loadModel($id)->updateByPk($id,array('status'=>  Posts::STATUS_DELED));
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $type = zmf::val('type', 1);
        if (!$type) {
            $this->redirect(array('index', 'type' => 'meilishuo'));
        }
        $typeCode = ServiceWebsites::getTypeCode($type);
        if (!$typeCode) {
            $this->redirect(array('index', 'type' => 'meilishuo'));
        }
        $criteria = new CDbCriteria();
        $criteria->addCondition('status=' . Posts::STATUS_PASSED);
        $criteria->addCondition('type=' . $typeCode);
        $criteria->order = 'cTime DESC';
        $count = ServiceWebsites::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = ServiceWebsites::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
            'type' => $type,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ServiceWebsites the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ServiceWebsites::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ServiceWebsites $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'service-websites-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
