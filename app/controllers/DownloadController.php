<?php

namespace app\controllers;

function rwaccess($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

function roaccess($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		: ($attr == 'read' || $attr == 'locked');   // else read only
}
use Yii;
use yii\easyii\modules\page\models\Page;
use yii\web\Controller;

class DownloadController extends Controller
{
    public function beforeAction($action) {
        if(Yii::$app ->controller->action->id!=="index")
            $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actions()
    {
        $rights =array(
            'driver' => 'LocalFileSystem',
            'URL'    => '',
            "uploadMaxSize"   => 1073741824
        );

        if(Yii::$app->user->isGuest){
            $rights ['uploadDeny']=array('all');
            $rights ['accessControl']= 'app\controllers\roaccess' ;
        }
        else{
            $rights ['accessControl']= 'app\controllers\rwaccess' ;
            if(IS_ROOT ){
            }
        }
        return array(
            'connector' => array(
				'class' => 'yii2elfinder\ConnectorAction',
				'clientOptions'=>array(
					'locale' => '',
					'debug'  => false,
					'roots'  => array(
						array_merge($rights,
							array('path'   => dirname(__DIR__).'/../software/')
						)
					)   
				)
			),
			'yii2elfinderc' => array(
				'class' => 'yii2elfinder\ConnectorAction',
				'clientOptions'=>array(
					'locale' => '',
					'debug'  => false,
					'roots'  => array(
						array_merge($rights,
							array('path'   => dirname(__DIR__).'/../software/yii2elfinder')
						)
					)   
				)
			),
			'dawomac' => array(
				'class' => 'yii2elfinder\ConnectorAction',
				'clientOptions'=>array(
					'locale' => '',
					'debug'  => false,
					'roots'  => array(
						array_merge($rights,
							array('path'   => dirname(__DIR__).'/../software/dawoma')
						)
					)   
				)
			)
		);
	}
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDawoma()
    {
        return $this->render('dawoma');
    }
    public function actionGetupdate()
    {
		ini_set('max_execution_time', 300); 
		$name	= $_GET['file'];
		/*dirname(__DIR__)=/home/dawomu9q/public_html/app/controllers*/
		$upload_path = dirname(__DIR__).'/../software/dawoma/update/';
		$fichero=$upload_path.$_GET['file'];
		//check file exists and it is a file in the subdirectory
		if (is_file($fichero)&&(FALSE!==realpath($upload_path))&&(FALSE!==realpath($fichero))&& (strpos(realpath($fichero),realpath($upload_path))===0)) {
			
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($fichero));
			readfile($fichero);
		}
		else
			throw new \yii\web\NotFoundHttpException();
		exit();
    }
    public function actionYii2elfinder()
    {
        return $this->render('yii2elfinder');
    }
}