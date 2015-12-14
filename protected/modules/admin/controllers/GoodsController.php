<?php

class GoodsController extends H {

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
        if (!$id) {
            $model = new Goods;
            $isNew=true;
        } else {
            $model = $this->loadModel($id);
            $isNew=false;
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Goods'])) {
            if(isset($_POST['suggest_area']) && isset($_POST['Goods']['areaid'])){
                zmf::setCookie('addPoiSuggestArea', $_POST['suggest_area'], 86400);
                zmf::setCookie('addPoiAreaid', $_POST['Goods']['areaid'], 86400);
            }
            //处理文本
            $filter = Posts::handleContent($_POST['Goods']['content']);
            $_POST['Goods']['content'] = $filter['content'];     
            if (!empty($filter['attachids'])) {
                $attkeys = array_filter(array_unique($filter['attachids']));
                if (!empty($attkeys)) {
                    $_POST['Goods']['faceimg'] = $attkeys[0]; //默认将文章中的第一张图作为封面图
                }
            } else {
                $_POST['Goods']['faceimg'] = ''; //否则将封面图置为空(有可能编辑后没有图片了)
            }
            $relatePoiIds=$_POST['goods_poiid'];
            $model->attributes = $_POST['Goods'];
            if ($model->save()){
                if(!$isNew){
                    GoodsRelation::model()->deleteAll('logid=:logid', array(':logid'=>$id));
                }
                if(!empty($relatePoiIds)){
                    foreach($relatePoiIds as $poiid){
                        $_attr=array(
                            'logid'=>$model->id,
                            'poiid'=>$poiid,
                        );
                        $_model=new GoodsRelation;
                        $_model->attributes=$_attr;
                        $_model->save();
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order = 'cTime DESC';
        $count = Goods::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Goods::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Goods('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Goods']))
            $model->attributes = $_GET['Goods'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Goods the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Goods::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Goods $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'goods-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
