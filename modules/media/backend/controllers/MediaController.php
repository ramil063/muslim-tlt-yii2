<?php

namespace modules\media\backend\controllers;

use common\models\Album;
use Yii;
use common\models\Media;
use modules\media\backend\models\search\MediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MediaController implements the CRUD actions for Media model.
 */
class MediaController extends Controller
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
     * Lists all Media models.
     * @param $album_id
     * @return mixed
     */
    public function actionIndex($album_id)
    {
        $searchModel = new MediaSearch();
        $params = Yii::$app->request->queryParams;
        $album = Album::find()->where(['id' => $album_id])->one();
        $params['MediaSearch']['album_id'] = $album->id;
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'album' => $album
        ]);
    }

    /**
     * Creates a new Media model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $album_id
     * @return mixed
     */
    public function actionCreate($album_id)
    {
        $model = new Media();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'album_id' => $album_id]);
        } else {
            $album = Album::find()->where(['id' => $album_id])->one();
            return $this->render('create', [
                'model' => $model,
                'album' => $album
            ]);
        }
    }

    /**
     * Updates an existing Media model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $albumId = $model->album_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'album_id' => $albumId]);
        } else {
            $album = Album::find()->where(['id' => $albumId])->one();
            return $this->render('update', [
                'model' => $model,
                'album' => $album
            ]);
        }
    }

    /**
     * Deletes an existing Media model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $albumId = $model->album_id;
        $model->delete();
        return $this->redirect(['index', 'album_id' => $albumId]);
    }

    /**
     * Finds the Media model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Media the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Media::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
