<?php

namespace app\modules\admin\controllers;

use app\models\ImageUpload;
use app\models\Users;
use app\models\User;
use app\models\UsersSearch;
use yii\filters\AccessControl;
use app\models\Download;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\ForbiddenHttpException;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(User::accessControl(['admin', 'user'])) {
        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = User::getMyUsername();
            if($model->validate() && $model->save()){
                return $this->redirect(['index']);
            } else return $this->render('create',compact('model'));
        } else return $this->render('create',compact('model'));
        } else { return $this->render('download404'); }
    }

    

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(User::accessControl(['admin'])) {
        $model = $this->findModel($id);

        if($model['user_id'] == User::getMyUsername() || User::accessControl(['admin']))

       { 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                   return $this->redirect(['view', 'id' => $model->id]);
               }else{
       
               return $this->render('update', [
                   'model' => $model,
               ]);
               }
           }else{
            return $this->render('download404', ['model'=>$model]);
           }
        } else { return $this->render('download404'); }
        
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
         if(User::accessControl(['admin'])) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    } else { return $this->render('download404'); }
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSetImage($id)
    {
        $model = new ImageUpload;

        if (Yii::$app->request->isPost)
        {
            $article = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            if($article->saveImage($model->uploadFile($file, $article->image)))
            {
                return $this->redirect(['view', 'id'=>$article->id]);
            }
        }
        
        return $this->render('image', ['model'=>$model]);
    }
    public function actionDownload()
  {
    if(User::accessControl(['admin', 'user'])) {
        $model = new Download();
    
  Download::fileDownload(Download::getFilename());
        } else { return $this->render('download404'); }
    
}
}
