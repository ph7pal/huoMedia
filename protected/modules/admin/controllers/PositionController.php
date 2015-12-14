<?php

class PositionController extends H {
    public function actionView($id) {
        $this->render('view', array(
          'model' => $this->loadModel($id),
        ));
    }
    public function actionCreate($id = '') {
        if (!$id) {
            $model = new Position;
        } else {
            $model = $this->loadModel($id);
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $nextPost = 0;
        if ($_GET['type'] == 'post') {
            $fromid = $_GET['postid'];
            if (!$fromid) {
                $fromid = 1;
            }
            $info = Posts::model()->findByPk($fromid);
            $_next = Posts::model()->findBySql("SELECT id FROM {{posts}} WHERE id>$fromid ORDER BY id ASC LIMIT 1");
            $nextPost = $_next['id'];
            if (!$info) {
                if ($_next) {
                    $this->redirect(array('create', 'type' => 'post', 'postid' => $nextPost));
                } else {
                    $this->redirect(array('create'));
                }
            }
            $model->title_cn = $info->title;
            $model->content = nl2br(strip_tags($info->content));
            $model->sourceurl = $info->sourceurl;
            $model->sourceinfo = $info->sourceinfo;
            $model->long = $info->long;
            $model->lat = $info->lat;
            $model->mapZoom = $info->mapZoom;
        }
        if (isset($_POST['Position'])) {
            if ($_POST['Position']['title_cn'] != '') {
                $_POST['Position']['pinyin'] = tools::pinyin($_POST['Position']['title_cn']);
            }
            if (!empty($_POST['nickname'])) {
                $_POST['Position']['nickname'] = join('#', array_unique(array_filter($_POST['nickname'])));
            } else {
                $_POST['Position']['nickname'] = '';
            }
            if(isset($_POST['suggest_area']) && isset($_POST['Position']['areaid'])){
                zmf::setCookie('addPoiSuggestArea', $_POST['suggest_area'], 86400);
                zmf::setCookie('addPoiAreaid', $_POST['Position']['areaid'], 86400);
            }
            $model->attributes = $_POST['Position'];
            if ($model->save()) {
                if ($nextPost) {
                    $_url = '/poi/' . $model->id . '.html';
                    Posts::model()->updateByPk($fromid, array('redirect' => $_url));
                    $this->redirect(array('create', 'type' => 'post', 'postid' => $nextPost));
                }
                KeywordIndexer::createKeywords($model);
                $this->redirect(array('redirect', 'id' => $model->id));
            }
        }
        if ($model->nickname) {
            $model->nickname = explode('#', $model->nickname);
        }
        $this->render('create', array(
          'model' => $model,
          'nextPost' => $nextPost,
        ));
    }

    public function actionUpdate($id) {
        $this->actionCreate($id);
    }
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    
    public function actionRedirect($id){
        $data=array(
            'id'=>$id
        );
        $this->render('redirect',$data);
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->select = 'id,title_cn,title_en,title_local,status';
        $count = Position::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Position::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Position('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Position']))
            $model->attributes = $_GET['Position'];

        $this->render('admin', array(
          'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Position the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Position::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Position $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'position-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
