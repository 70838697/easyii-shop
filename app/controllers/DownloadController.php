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
         'path'   => dirname(__DIR__).'../../software/',
         'URL'    => '',
          "uploadMaxSize"   => 1073741824, 
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
               $rights
            )   
        )
      )
    );
  }
    public function actionIndex()
    {
        if(!Yii::$app->getModule('admin')->installed){
            return $this->redirect(['/install/step1']);
        }
        return $this->render('index');
    }
}