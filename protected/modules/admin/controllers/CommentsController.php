<?php

class CommentsController extends Admin {

    public function actionIndex() {
        $type=zmf::val('type',1);
        if(!$type || $type=='staycheck'){
            $status=  Posts::STATUS_STAYCHECK;
        }else{
            $status=  Posts::STATUS_PASSED;
        }
        $sql="SELECT c.id,c.content,c.cTime,p.title,c.logid FROM {{comments}} c,{{posts}} p WHERE c.status={$status} AND c.logid=p.id ORDER BY c.cTime DESC";
        Posts::getAll(array('sql'=>$sql), $pager, $posts);
        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    public function loadModel($id) {
        $model = Comments::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
