<?php

class PostsController extends Q {

    public $favored = false;
    public $favorited = false;

    public function actionView() {
        $id = zmf::val('id', 2);
        if (!$id) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $info = $this->loadModel($id);
        $pageSize = 30;
        $comments = Comments::getCommentsByPage($id, 'posts', 1, $pageSize);        
        $data = array(
            'info' => $info,
            'comments' => $comments,
            'loadMore' => count($comments) == $pageSize ? 1 : 0,
        );
        $this->pageTitle=$info['title'];
        $this->selectNav='posts';
        $this->render('view', $data);
    }

    public function loadModel($id) {
        $model = Posts::model()->findByPk($id);
        if ($model === null || $model->status!=Posts::STATUS_PASSED)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
