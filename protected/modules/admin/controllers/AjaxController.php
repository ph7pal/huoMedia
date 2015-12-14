<?php

class AjaxController extends Q {

    public function init() {
        parent::init();
        if (!Yii::app()->request->isAjaxRequest) {
            $this->jsonOutPut(0, Yii::t('default', 'forbiddenaction'));
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, Yii::t('default', 'loginfirst'));
        }
    }

    public function actionArea() {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])) {
            $name = $_GET['q'];
            $criteria = new CDbCriteria;
            $criteria->condition = "title LIKE :keyword OR name LIKE :keyword";
            $criteria->params = array(':keyword' => '%' . strtr($name, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%');
            $criteria->limit = 10;
            $userArray = Area::model()->findAll($criteria);
            $returnVal = '';
            foreach ($userArray as $userAccount) {
                $_btitle = '';
                if ($userAccount['belongid'] > 0) {
                    $_beinfo = Area::model()->findByPk($userAccount['belongid']);
                    if ($_beinfo) {
                        $_btitle = '(' . $_beinfo['title'] . ')';
                    }
                }
                $returnVal .= $userAccount->getAttribute('title') . $_btitle . '|' . $userAccount->getAttribute('id') . "\n";
            }
            echo $returnVal;
        }
    }

    /**
     * 自动联想坐标
     */
    public function actionPosition() {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])) {
            $name = $_GET['q'];
            $criteria = new CDbCriteria;
            $criteria->condition = "(title_cn LIKE :keyword OR title_en LIKE :keyword OR title_local LIKE :keyword) AND `status`=" . Posts::STATUS_PASSED;
            $criteria->params = array(':keyword' => '%' . strtr($name, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%');
            $criteria->limit = 10;
            $criteria->select = 'id,areaid,title_cn,title_en,title_local';
            $userArray = Position::model()->findAll($criteria);
            $returnVal = '';
            foreach ($userArray as $userAccount) {
                $_btitle = '';
                $_beinfo = Area::model()->findByPk($userAccount['areaid']);
                if ($_beinfo) {
                    $_btitle = '(' . $_beinfo['title'] . ')';
                }
                $_title = '';
                if ($userAccount['title_cn'] != '') {
                    $_title = $userAccount['title_cn'];
                } elseif ($userAccount['title_en'] != '') {
                    $_title = $userAccount['title_en'];
                } else {
                    $_title = $userAccount['title_local'];
                }
                $returnVal .= $_title . $_btitle . '|' . $userAccount->getAttribute('id') . "\n";
            }
            echo $returnVal;
        }
    }

    /**
     * 改变用户所属群组
     */
    public function actionUserGroup() {
        Users::checkPower('usergroup');
        $uid = zmf::filterInput($_POST['a'], 't', 1);
        $gid = zmf::filterInput($_POST['b'], 't', 1);
        if (!$uid OR ! $gid) {
            $this->jsonOutPut(0, '数据不全，请核实');
        }
        $uinfo = Users::getUserInfo($uid);
        if (!$uinfo) {
            $this->jsonOutPut(0, '该用户不存在，请核实');
        }
        $gingo = UserGroup::getInfo($gid);
        if (!$gingo) {
            $this->jsonOutPut(0, '该用户组不存在，请核实');
        }
        $data = array(
            'groupid' => $gid
        );
        if (Users::model()->updateByPk($uid, $data)) {
            $this->jsonOutPut(1, '更新成功');
        } else {
            $this->jsonOutPut(0, '更新失败');
        }
    }

    public function actionDelAvator() {
        Users::checkPower('delavator');
        $uid = zmf::filterInput($_POST['a'], 't', 1);
        if (!$uid) {
            $this->jsonOutPut(0, '数据不全，请核实');
        }
        $uinfo = Users::getUserInfo($uid);
        if (!$uinfo) {
            $this->jsonOutPut(0, '该用户不存在，请核实');
        }
        $s = zmf::avatar($uid, 'small', true, 'app');
        $o = zmf::avatar($uid, 'origin', true, 'app');
        $b = zmf::avatar($uid, 'big', true, 'app');
        @unlink($s);
        @unlink($o);
        @unlink($b);
        $this->jsonOutPut(1, '已删除，请核实');
    }

    public function actionDelUser() {
        Users::checkPower('deluser');
        $uid = zmf::filterInput($_POST['a'], 't', 1);
        if (!$uid) {
            $this->jsonOutPut(0, '数据不全，请核实');
        }
        $uinfo = Users::getUserInfo($uid);
        if (!$uinfo) {
            $this->jsonOutPut(0, '该用户不存在，请核实');
        }
        //将用户所有文章、图片、评论放入回收箱
        Posts::model()->updateAll(array('status' => Posts::STATUS_DELED), 'uid=:uid', array(':uid' => $uid));
        Attachments::model()->updateAll(array('status' => Posts::STATUS_DELED), 'uid=:uid', array(':uid' => $uid));
        Comments::model()->updateAll(array('status' => Posts::STATUS_DELED), 'uid=:uid', array(':uid' => $uid));
        $this->jsonOutPut(1, '已删除，请核实');
    }

}
