<?php

class AreaController extends H {

    public function actionTools() {
        $this->render('tools');
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Area;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Area'])) {
            $model->attributes = $_POST['Area'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Area'])) {
            $model->attributes = $_POST['Area'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $belongId = zmf::filterInput($_GET['belongid']);
        $criteria = new CDbCriteria();
        $criteria->order = '`queue` ASC';
        if (!$belongId) {
            $extra=zmf::config('codeForWho');
            if($extra=='xiaobao'){
                $criteria->addCondition('theorder=3');
            }else{
                $criteria->addCondition('theorder=1');
            }
        } else {
            $criteria->addCondition('belongid=' . $belongId);
        }
        $count = Area::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $posts = Area::model()->findAll($criteria);

        $this->render('index', array(
            'pages' => $pager,
            'posts' => $posts,
        ));
    }

    public function actionRecommend() {
        $first = Area::allColumns('first', 0, 'id,title');
        foreach ($first as $k => $v) {
            $seconds = Area::getColsIds($v['id'], $breadbar, $info, false);
            $_sql = "SELECT id,title,hot,theorder FROM {{area}} WHERE id IN($seconds) AND theorder < 4 ORDER BY theorder";
            $_children = Yii::app()->db->createCommand($_sql)->queryAll();
            $first[$k]['children'] = $_children;
        }
        if (isset($_POST['selected'])) {
            $idsArr = $_POST['selected'];
            Area::model()->updateAll(array('hot' => 0));
            if (!empty($idsArr)) {
                $idstr = join(',', array_filter(array_unique($idsArr)));
                if (Area::model()->updateAll(array('hot' => 1), "id IN($idstr)")) {
                    
                }
            }
            $this->message(1, '更新成功', Yii::app()->createUrl('admin/area/recommend'));
            Yii::app()->end();
        }
        $data = array(
            'areas' => $first
        );
        $this->render('recommend', $data);
    }

    /**
     * 首页推荐地区
     */
    public function actionTops() {
        $areas = Area::getTops();
        $this->render('tops', array(
            'areas' => $areas,
        ));
    }

    public function actionOrder($belongid) {
        $areas = Area::model()->findAll(
                array(
                    'select' => 'id,title',
                    'condition' => 'belongid=' . $belongid,
                    'order' => '`queue` ASC'
                )
        );
        $areas = CHtml::listData($areas, 'id', 'title');
        Area::model()->updateByPk($belongid, array('extra'=>''));
        $data = array(
            'areas' => $areas
        );
        $this->render('order', $data);
    }

    public function actionChangeOrder() {
        $ids = $_POST['ids'];
        if ($ids == '') {
            $this->jsonOutPut(0, '操作对象不能为空');
        }
        $arr = array_filter(explode('#', $ids));
        if (empty($arr)) {
            $this->jsonOutPut(0, '操作对象不能为空');
        }
        $s = $e = 0;
        foreach ($arr as $k => $v) {
            $_order = ($k + 1);
            $data = array(
                'queue' => $_order
            );
            $_info = Area::model()->updateByPk($v, $data);
            if ($_info) {
                $s+=1;
            } else {
                $e+=1;
            }
        }
        if ($s == count($arr)) {
            $this->jsonOutPut(1, '排序成功');
        } elseif ($e > 0 AND $e < count($arr)) {
            $this->jsonOutPut(1, '部分排序成功');
        } else {
            $this->jsonOutPut(0, '排序失败，可能是未做修改');
        }
    }

    public function actionAdmin() {
        $model = new Area('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Area']))
            $model->attributes = $_GET['Area'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionManage() {
        $id = tools::val('keyid');
        if (!$id) {
            $this->jsonOutPut(0, '缺少参数');
        }
        $res = false;
        $type = tools::val('type', 't', 1);
        if ($type == 'cancelTop') {
            $res = Area::model()->updateByPk($id, array('recommend' => 0));
        } elseif ($type == 'addTop') {
            $res = Area::model()->updateByPk($id, array('recommend' => 1));
        }elseif($type=='hot'){
            $res = Area::model()->updateByPk($id, array('hot' => 1));
        }elseif($type=='cancelHot'){
            $res = Area::model()->updateByPk($id, array('hot' => 0));
        }
        if ($res) {
            $this->jsonOutPut(1, '操作成功');
        } else {
            $this->jsonOutPut(0, '操作失败');
        }
    }

    public function actionUpload($id) {
        $model = $this->loadModel($id);
        $type=  tools::val('type', 't', 1);
        if(isset($_POST) && $_POST['save-btn']=='保存'){
            $logo=$id.'.jpg';
            $overwrite=$_POST['overwrite'];
            if($overwrite){
                $ids = Area::getColsIds($id, $breadbar, $info, false);
            }else{
                $ids=$id;
            }
            if(Area::model()->updateAll(array('logo'=>$logo),"id IN({$ids})")){
                $this->message(1, '更新成功', Yii::app()->createUrl('admin/area/index'));
            }else{
                $this->message(0, '更新成功', Yii::app()->createUrl('admin/area/index'));
            }
        }
        if($type=='logo'){
            $from='logo';
            $model->logo=  Area::getLogo($model);
        }else{
            $from='upload';
        }
        $this->render('tops', array(
            'model' => $model,
            'from' => $from,
        ));
    }

    public function loadModel($id) {
        $model = Area::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'area-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 统计地区下的景点酒店等数量
     */
    public function actionTj() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $num = 10;
        $start = ($page - 1) * $num;
        $sql = "SELECT id FROM {{area}} ORDER BY id DESC LIMIT $start,$num";
        $items = Yii::app()->db->createCommand($sql)->queryAll();
        if (empty($items)) {
            $url = Yii::app()->createUrl('admin/tools/index');
        } else {
            foreach ($items as $it) {
                $ids = Area::getColsIds($it['id'], $_breadbar, $_info, false);
                $attr = array(
                    'scenic' => Position::model()->count("areaid IN($ids) AND classify=" . Position::POSITION . " AND status=" . Posts::STATUS_PASSED),
                    'restaurant' => Position::model()->count("areaid IN($ids) AND classify=" . Position::RESTAURANT . " AND status=" . Posts::STATUS_PASSED),
                    'hotel' => Position::model()->count("areaid IN($ids) AND classify=" . Position::HOTEL . " AND status=" . Posts::STATUS_PASSED),
                    'shopping' => Position::model()->count("areaid IN($ids) AND classify=" . Position::SHOPPING . " AND status=" . Posts::STATUS_PASSED),
                    'question' => Question::model()->count("areaid IN($ids) AND status=" . Posts::STATUS_PASSED),
                    'tips' => PoiTips::model()->count("areaid IN($ids) AND classify='" . Position::AREA . "' AND status=" . Posts::STATUS_PASSED),
                );
                Area::model()->updateByPk($it['id'], $attr);
            }
            $url = Yii::app()->createUrl('admin/area/tj', array('page' => ($page + 1)));
        }
        $this->redirect("正在处理第{$page}页", 1, $url, 1);
    }

}
