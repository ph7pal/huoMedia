<?php

/**
 * @filename assets.php 
 * @Description 统一处理css、js加载
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2015-6-2  14:15:47 
 */
class assets {

    /**
     * 加载js路径配置文件
     * @param type $type 应用类型
     */
    public function jsConfig($type = 'web', $module = 'web') {
        $arr['common'] = array(
            'baseUrl' => zmf::config('baseurl'),
            'hasLogin' => Yii::app()->user->isGuest ? 'false' : 'true',
            'loginUrl' => Yii::app()->createUrl('/site/login'),
            'module' => $module,
            'csrfToken' => Yii::app()->request->csrfToken,
            'currentSessionId' => Yii::app()->session->sessionID,
            'addCommentUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/addComment'),
        );
        $arr['web'] = array(
            'editor'=>'',
            'allowImgTypes' => zmf::config('imgAllowTypes'),
            'allowImgPerSize' => zmf::formatBytes(zmf::config('imgMaxSize')),
            'perAddImgNum' => zmf::config('imgUploadNum'),
            'contentsUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/getContents'), //获取内容
            'delContentUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/delContent'), //删除内容
            'favoriteUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/favorite'), //收藏内容
            'feedbackUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/feedback'), //意见反馈
            'setStatusUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/setStatus'),
        );
        $arr['mobile'] = array(
            'contentsUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/getContents'), //获取内容
            'delContentUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/delContent'), //删除内容
            'favoriteUrl' => zmf::config('domain') . Yii::app()->createUrl('/ajax/favorite'), //收藏内容
        );
        $attrs = array_merge($arr['common'], $arr[$type]);
        $longHtml = '<script>var zmf={';
        foreach ($attrs as $k => $v) {
            $longHtml.=$k . ":'" . $v . "',";
        }
        $longHtml.='};</script>';
        echo $longHtml;
    }

    public function loadCssJs($type = 'web', $action = '') {
        if(YII_DEBUG){
            $staticUrl = Yii::app()->baseUrl.'/';
        }else{
            $_staticUrl = zmf::config('cssJsStaticUrl');
            $staticUrl = $_staticUrl ? $_staticUrl : zmf::config('baseurl');
        }
        $cs = Yii::app()->clientScript;
        $c = Yii::app()->getController()->id;
        $a = Yii::app()->getController()->getAction()->id;
        $cssDir = Yii::app()->basePath . '/../jsCssSrc/css';
        $jsDir = Yii::app()->basePath . '/../jsCssSrc/js';
        $cssArr = array();
        $jsArr = array();
        if ($type == 'web') {
            $cssArr = array(
                'bootstrap',
                'font-awesome',
                'zmf',
            );
            $jsArr = array(
                'bootstrap',
                'zmf',                
            );
            $cs->registerCoreScript('jquery');
        } elseif ($type == 'mobile') {
            $cssArr = array(
                'frozen',
            );
            $jsArr = array(
                'zepto',
                'frozen',
            );
            $cssArr[] = 'mobile';
            $jsArr[] = 'mobile';
        }elseif ($type == 'admin') {
            $cssArr = array(
                'frozen',
            );
            $jsArr = array(
                'zepto',
                'frozen',
            );
            $cssArr[] = 'mobile';
            $jsArr[] = 'mobile';
        }
        $cssDirArr = zmf::readDir($cssDir, false);
        $jsDirArr = zmf::readDir($jsDir, false);
        foreach ($cssArr as $cssFileName) {
            foreach ($cssDirArr as $cssfile) {
                if (strpos($cssfile, $type . '-' . $cssFileName) !== false) {
                    $cs->registerCssFile($staticUrl . 'jsCssSrc/css/' . $cssfile);
                }
            }
        }
        foreach ($jsArr as $jsFileName) {
            foreach ($jsDirArr as $jsfile) {
                if (strpos($jsfile, $type . '-' . $jsFileName) !== false) {
                    if (strpos($jsfile, 'head') !== false) {
                        $pos = CClientScript::POS_HEAD;
                    } else {
                        $pos = CClientScript::POS_END;
                    }
                    $cs->registerScriptFile($staticUrl . 'jsCssSrc/js/' . $jsfile, $pos);
                }
            }
        }
    }

}
