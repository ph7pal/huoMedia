<?php

class UsersController extends H {

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $count = Users::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Users::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    public function actionView($id) {
        $this->render('view', array(
            'info' => $this->loadModel($id),
        ));
    }

    public function actionGroup() {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $count = UserGroup::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = UserGroup::model()->findAll($criteria);

        $this->render('group', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    public function actionAddGroup($id = '') {
        $this->checkPower('addusergroup');
        $this->checkPower('editusergroup');
        if ($id) {
            $model = UserGroup::model()->findByPk($id);
        } else {
            $model = new UserGroup();
        }
        if ($id) {
            $upmodel = UserPower::model()->find('groupid=:gid', array(':gid' => $id));
            if (!$upmodel) {
                $upmodel = new UserPower;
                $upmodel->groupid = $model->id;
            }
        } else {
            $upmodel = new UserPower;
            $upmodel->groupid = $model->id;
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-group-addGroup-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['UserGroup'])) {
            $powers = $_POST['powers'];
            $_POST['UserGroup']['cTime'] = zmf::now();
            $model->attributes = $_POST['UserGroup'];
            if ($model->save()) {
                GroupPowers::model()->deleteAll("gid=" . $model->id);
                if (!empty($powers)) {
                    foreach ($powers as $p) {
                        $_data = array(
                            'gid' => $model->id,
                            'powers' => $p,
                        );
                        $gpmodel = new GroupPowers();
                        $gpmodel->attributes = $_data;
                        $gpmodel->save();
                    }
                }
                $userPowers = $_POST['UserPower'];
                $upinfo = UserPower::model()->find('groupid=:gid', array(':gid' => $model->id));
                if ($upinfo) {
                    UserPower::model()->updateByPk($upinfo['id'], $userPowers);
                } else {
                    $upmodel->attributes = $userPowers;
                    $upmodel->save();
                }
                UserAction::record('editusergroup', $model->id);
                $this->redirect(array('users/group'));
            }
        }
        $mine = UserGroup::getPowers($model->id);
        $data = array(
            'mine' => $mine,
            'model' => $model,
            'upmodel' => $upmodel,
        );
        $this->render('addGroup', $data);
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['Users'])) {
            if ($_POST['Users']['password'] != $model->password && $_POST['Users']['password']) {
                $_POST['Users']['password'] = md5($_POST['Users']['password']);
            }
            $model->attributes = $_POST['Users'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {
        $model = new Users;
        if (isset($_POST['Users'])) {
            
            $model->attributes = $_POST['Users'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('create', array('model' => $model));
    }

    /**
     * 禁止用户
     */
    public function actionBan($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['ban'])) {
            $attr = array(
                'logid' => $id,
                'classify' => 'ban',
                'actype' => 'user',
                'acvalue' => $_POST['ban']['type'],
                'desc' => $_POST['ban']['reason'],
            );
            $modelAA = new AdminAction();
            $modelAA->attributes = $attr;
            if ($modelAA->save()) {
                Users::model()->updateByPk($id, array('status' => $_POST['ban']['type']));
                if (!empty($_POST['ban']['contents'])) {
                    foreach ($_POST['ban']['contents'] as $val) {
                        Users::delUserContent($id, $val);
                    }
                }
                $this->message(1, '用户资料已更新', Yii::app()->createUrl('admin/users/ban', array('id' => $id)));
            }
        }
        $records = AdminAction::model()->findAll('logid=:logid AND classify="ban" AND actype="user"', array(':logid' => $id));
        $this->render('ban', array(
            'info' => $model,
            'records' => $records
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset
                            ($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users']))
            $model->attributes = $_GET['Users'];

        $this->render(
                'admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST[
                        'ajax']) && $_POST[
                'ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
