<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;
// use app\models\PostSearch;
use yii\helpers\Json;
/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Post();
         $rows = 5;
        $dataProvider = $model->search(Yii::$app->request->getQueryParams(),$rows);    
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $test = $model->id;
                $sautatca = Post::findOne($test);
                $sumcount = Post::find()->count();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['count' => $sumcount,'data'=>$sautatca];
            }else{
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $items = ['message' => 'error'];
                return $items;
            }
            // echo json_encode(array('status'=>200,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
        }else{
                    return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
        }
            // echo json_encode(array('status'=>200,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $test = $model->id;
                $sautatca = Post::findOne($test);
            }else{
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $items = ['data' => ['associative', 'array']];
                return $items;
            }
            // echo json_encode(array('status'=>200,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
        }else{
            return $this->render('create',['model'=>$model]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
