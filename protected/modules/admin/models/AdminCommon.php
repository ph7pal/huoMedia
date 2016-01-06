<?php

class AdminCommon extends CActiveRecord {

    public static function navbar() {
        $c = Yii::app()->getController()->id;
        $a = Yii::app()->getController()->getAction()->id;
        $attr['login'] = array(
            'title' => '首页',
            'url' => Yii::app()->createUrl('admin/index/index'),
            'active' => in_array($c, array('index'))
        );
        $attr['posts'] = array(
            'title' => '文章',
            'url' => Yii::app()->createUrl('admin/posts/index'),
            'active' => in_array($c, array('posts'))
        );
        $attr['comments'] = array(
            'title' => '评论',
            'url' => Yii::app()->createUrl('admin/comments/index'),
            'active' => in_array($c, array('comments'))
        );
        $attr['group'] = array(
            'title' => '标签',
            'url' => Yii::app()->createUrl('admin/tags/index'),
            'active' => in_array($c, array('tags'))
        );
        
        $attr['user'] = array(
            'title' => '用户',
            'url' => Yii::app()->createUrl('admin/users/index'),
            'active' => in_array($c, array('users'))
        );
        $attr['attachments'] = array(
            'title' => '图片',
            'url' => Yii::app()->createUrl('admin/attachments/index'),
            'active' => in_array($c, array('attachments'))
        );
        $attr['system'] = array(
            'title' => '系统',
            'url' => Yii::app()->createUrl('admin/config/index'),
            'active' => in_array($c, array('site','config','siteInfo'))
        );
        foreach ($attr as $k => $v) {
            if (!Controller::checkPower($k, '', true)) {
                //unset($attr[$k]);
            }
        }
        return $attr;
    }

}
