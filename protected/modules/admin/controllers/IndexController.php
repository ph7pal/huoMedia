<?php

class IndexController extends Admin {

    public function init() {
        parent::init();
        $this->checkPower('login');
    }

    public function actionIndex() {
        $this->render('index', $data);
    }

}
