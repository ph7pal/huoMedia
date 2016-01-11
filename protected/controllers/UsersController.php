<?php

class UsersController extends Q {
    public function init() {
        parent::init();
        if(!$this->uid){
            $this->redirect(array('site/login'));
        }
    }
    public function actionNotice() {
        $sql = "SELECT * FROM {{notification}} WHERE uid='{$this->uid}' ORDER BY cTime DESC";
        Posts::getAll(array('sql' => $sql), $pages, $comLists);
        Notification::model()->updateAll(array('new' => 0), 'uid=:uid', array(':uid' => $this->uid));
        $data = array(
            'posts' => $comLists,
            'pages' => $pages,
        );
        $this->pageTitle = $this->userInfo['truename'] . '的提醒 - ' . zmf::config('sitename');
        $this->render('notice', $data);
    }

}
