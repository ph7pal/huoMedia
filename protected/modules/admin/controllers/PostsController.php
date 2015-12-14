<?php

class PostsController extends H {


    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
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
        $count = Posts::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Posts::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    /*
     *  'position'=>'坐标',
      'post'=>'文章',
      'question'=>'问题',
      'answer'=>'回答',
      'poipost'=>'点评',
      'poitips'=>'短评',
      'comments'=>'评论',
      'user'=>'用户'
     */

    public function actionSearch() {
        $keyword = zmf::filterInput(Yii::app()->request->getParam('keyword'), 't', 1);
        $type = zmf::filterInput(Yii::app()->request->getParam('type'), 't', 1);
        if ($keyword) {
            if (!$type) {
                $type = 'position';
            }
            $originKey = $keyword;
            $keyword = "'%" . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . "%'";
            switch ($type) {
                case 'position':
                    $sql = "SELECT id,title_cn,title_en,title_local FROM {{position}} WHERE title_cn LIKE $keyword OR title_en LIKE $keyword OR title_local LIKE $keyword";
                    break;
                case 'post':
                    $sql = "SELECT id,title FROM {{posts}} WHERE title LIKE $keyword";
                    break;
                case 'question':
                    $sql = "SELECT id,title FROM {{question}} WHERE title LIKE $keyword";
                    break;
                case 'answer':
                    $sql = "SELECT id,logid FROM {{answer}} WHERE content LIKE $keyword";
                    break;
                case 'poipost':
                    $sql = "SELECT id,logid FROM {{poi_post}} WHERE content LIKE $keyword";
                    break;
                case 'poitips':
                    $sql = "SELECT id,logid FROM {{poi_tips}} WHERE content LIKE $keyword";
                    break;
                case 'comments':
                    $sql = "SELECT logid FROM {{comments}} WHERE content LIKE $keyword";
                    break;
                case 'user':
                    $sql = "SELECT id,truename,username FROM {{users}} WHERE truename LIKE $keyword OR username LIKE $keyword";
                    break;
            }
            if ($sql) {
                Posts::getAll(array('sql' => $sql), $pages, $posts);
            }
        }
        $data = array(
            'posts' => $posts,
            'pages' => $pages,
            'selectedType' => $type,
            'keyword' => $originKey,
        );
        $this->render('search', $data);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Posts('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Posts']))
            $model->attributes = $_GET['Posts'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Posts the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Posts::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Posts $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'posts-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
