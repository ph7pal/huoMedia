<?php

class PostsController extends Q {
    
    public $favorited = false;

    public function actionView() {
        $id = zmf::val('id', 2);
        if (!$id) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $info = $this->loadModel($id);
        $pageSize = 30;
        $comments = Comments::getCommentsByPage($id, 'posts', 1, $pageSize);       
        $tags = Tags::getByIds($info['tagids']);
        $data = array(
            'info' => $info,
            'comments' => $comments,
            'tags' => $tags,
            'loadMore' => count($comments) == $pageSize ? 1 : 0,
        );
        $this->favorited=  Favorites::checkFavored($id, 'post');
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
