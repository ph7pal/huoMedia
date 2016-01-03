<?php

class PostsController extends Q {

    public $favored = false;
    public $favorited = false;
    
    public function actionView($id){
        $info=  $this->loadModel($id);
        $data=array(
            'info'=>$info
        );
        $this->render('view',$data);
    }

    public function loadModel($id) {
        $model = Posts::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
