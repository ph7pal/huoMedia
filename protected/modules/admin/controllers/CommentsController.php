<?php

class CommentsController extends Admin {

    public function actionIndex() {
        $sql="SELECT c.id,c.content,c.cTime,p.title,c.logid FROM {{comments}} c,{{posts}} p WHERE c.logid=p.id ORDER BY c.cTime DESC";
        Posts::getAll(array('sql'=>$sql), $pager, $posts);
        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function loadModel($id) {
        $model = Comments::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
