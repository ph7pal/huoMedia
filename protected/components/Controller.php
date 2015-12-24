<?php

class Controller extends CController {

    public function message($status = 0, $message = '', $url = '', $time = 3, $jump = true, $render = true) {
        if (empty($url)) {
            $url = Yii::app()->user->returnUrl;
        }
        if ($status) {
            $success = $message;
        } else {
            $error = $message;
        }
        $data = array(
            'error' => $error,
            'success' => $success,
            'jumpUrl' => $url,
            'waitSecond' => $time,
            'jumpStatus' => $jump
        );
        if ($render) {
            $this->render('//msg/error', $data);
        } else {
            $this->renderPartial('//msg/error', $data);
        }
        Yii::app()->end();
    }

    public function jsonOutPut($status = 0, $msg = '', $return = false, $end = true) {
        $outPutData = array(
            'status' => $status,
            'msg' => $msg
        );
        $json = CJSON::encode($outPutData);
        if ($return) {
            return $json;
        } else {
            echo $json;
        }
        if ($end) {
            Yii::app()->end();
        }
    }

}
