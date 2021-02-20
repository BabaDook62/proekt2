<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Download extends ActiveRecord {
	public static function tableName() {
		return 'article';
	}

	public static function getFilename() {
		return Download::findOne($_GET['id'])['image'];
	}

	public static function fileDownload($filename) {
		$path = Yii::getAlias('@webroot').'/uploads';
    	$file = $path.'/'.$filename;
    	if (file_exists($file))
    	{
        	Yii::$app->response->xSendFile($file);
    	}
	}
}

?>