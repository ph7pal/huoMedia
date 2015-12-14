<?php

class PoiErrorController extends H {

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
        $count = PoiError::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = PoiError::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    public function actionManage() {
        $id = zmf::filterInput($_POST['id']);
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, '不允许的操作');
        }
        if (!isset($id) OR ! is_numeric($id)) {
            $this->jsonOutPut(0, '缺少参数');
        }
        $status = Posts::STATUS_PASSED;
        if (PoiError::model()->updateByPk($id, array('status' => $status))) {
            $this->jsonOutPut(1, '操作成功！');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PoiError the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PoiError::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
