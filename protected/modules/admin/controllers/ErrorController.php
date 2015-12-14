<?php
class ErrorController extends Q
{
    //public $layout = false;
    /**
     * 错误信息显示页
     */
    public function actionIndex ()
    {
        if ($error = Yii::app()->errorHandler->error) {
            switch ($error['code']) {
                case 404: 
                  $tpl = 'error'; 
                  //$this->redirect(zmf::config('baseurl'), true, 301);
                  break; 
                case 400:
                case 500: $tpl = 'error'; break;
                default: $tpl = 'error'; break;
            }
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('//error/'.$tpl, $error);
        }
    }
}