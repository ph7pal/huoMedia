<?php

class AttachmentsController extends Q {

    public function actionUpload() {
        $uptype = zmf::filterInput($_GET['type'], 't', 1);
        $logid = zmf::filterInput($_GET['id']); //所属对象
        $reImgsize = zmf::filterInput($_GET['imgsize']); //返回图片的尺寸
        $fileholder = zmf::filterInput($_GET['fileholder'], 't', 1); //上传控件的ID
        if (!isset($uptype) OR ! in_array($uptype, array('posts','siteinfo'))) {
            $this->jsonOutPut(0, '请设置上传所属类型' . $uptype);
        }
        if (Yii::app()->request->getParam('PHPSESSID')) {
            Yii::app()->session->close();
            $res = Yii::app()->session->setSessionID(Yii::app()->request->getParam('PHPSESSID'));
            Yii::app()->session->open();
        }
        if (Yii::app()->user->isGuest) {
            $this->jsonOutPut(0, '请先登录');
        }
        if (!$fileholder) {
            $fileholder = 'filedata';
        }
        if (!isset($_FILES[$fileholder]) || !is_uploaded_file($_FILES[$fileholder]["tmp_name"]) || $_FILES[$fileholder]["error"] != 0) {
            $this->jsonOutPut(0, '无效上传，请重试');
        }
        $img = CUploadedFile::getInstanceByName($fileholder);
        $ext = $img->getExtensionName();
        $size = $img->getSize();
        if ($size > zmf::config('imgMaxSize')) {
            $this->jsonOutPut(0, '上传文件最大尺寸为：' . tools::formatBytes(zmf::config('imgMaxSize')));
        }
        $upExt = zmf::config("imgAllowTypes");
        if (!preg_match('/^(' . str_replace('*.', '|', str_replace(';', '', $upExt)) . ')$/i', $ext)) {
            $this->jsonOutPut(0, '上传文件扩展名必需为：' . $upExt);
        }
        $sizeinfo = getimagesize($_FILES[$fileholder]["tmp_name"]);
        if ($sizeinfo['0'] < zmf::config('imgMinWidth') OR $sizeinfo[1] < zmf::config('imgMinHeight')) {
            $this->jsonOutPut(0, "要求上传的图片尺寸，宽不能不小于" . zmf::config('imgMinWidth') . "px，高不能小于" . zmf::config('imgMinHeight') . "px.");
        }
        $ctime = zmf::now();
        $dir = zmf::uploadDirs($ctime, 'app', $uptype);
        zmf::createUploadDir($dir);
        $fileName = zmf::uuid() . '.' . $ext;
        $origin = $dir;
        if (move_uploaded_file($_FILES[$fileholder]["tmp_name"], $origin . $fileName)) {
            $data = array();
            $status = Posts::STATUS_NOTPASSED;
            $data['uid'] = zmf::uid();
            $data['logid'] = $logid;
            $data['filePath'] = $fileName;
            $data['fileDesc'] = '';
            $data['classify'] = $uptype;
            $data['covered'] = '0';
            $data['cTime'] = $ctime;
            $data['status'] = $status;
            $data['width'] = $sizeinfo[0];
            $data['height'] = $sizeinfo[1];
            $data['size'] = $size;
            $model = new Attachments();
            $model->attributes = $data;
            if ($model->save()) {
                $attachid = $model->id;
                $returnImgDir = zmf::getUpExtraUrl($ctime);
                $saveName = $uptype . '/' . $returnImgDir . '/' . $fileName;
                $accessKey = zmf::config('qiniuAk');
                $secretKey = zmf::config('qiniuSk');
                $bucket = zmf::config('qiniuBucket');
                if ($accessKey && $secretKey && $bucket) {
                    $auth = new Auth($accessKey, $secretKey);
                    $token = $auth->uploadToken($bucket);
                    $uploadMgr = new UploadManager();
                    list($ret, $err) = $uploadMgr->putFile($token, $saveName, $origin . $fileName);
                    if ($err !== null) {
                        zmf::fp(var_export($err));
                        $this->jsonOutPut(0, '上传至云服务错误');
                    }
                }
                $returnimg = zmf::uploadDirs($ctime, 'site', $uptype) . $fileName;
                $returnimg = zmf::getThumbnailUrl($returnimg, '650', $uptype);
                $_attr = array(
                    'id' => $attachid,
                    'imgurl' => $returnimg,
                );
                $html = '';
                if ($uptype == 'posts') {
                    //$html=  $this->renderPartial('/posts/_addImg',array('data'=>$_attr),true);
                }
                $outPutData = array(
                    'status' => 1,
                    'attachid' => $attachid,
                    'imgsrc' => $returnimg,
                    'html' => $html,
                );
                $json = CJSON::encode($outPutData);
                echo $json;
            } else {
                $this->jsonOutPut(0, '写入数据库错误');
            }
        }
    }
}
