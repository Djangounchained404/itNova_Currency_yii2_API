<?php

namespace frontend\controllers;


use frontend\components\Common;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Currency;
use Yii;
use maxwen\yii\curl\Curl;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */


    public function actionIndex()
    {

        $idArr = Common::fullArrDataGiven();

        return $this->render('index', compact('idArr')); // c передачей масива

    }


    public function actionAjax()
    {

        $model = new Currency();
        $count = 0;
        $arrKey = [];
        if($model->load(\Yii::$app->request->post())){ // при получении данных пост

           foreach ($model['attributes'] as $key =>$y) { // перебераем масив что бы  получить колчиество выбранных элементов.
                 if ((int)$model['attributes'][$key] !==0) {
                     $arrKey[$count] = $key;
                        $count++;
            }

           }
           if (!empty($arrKey)){
               return $this->render('ajax', compact('arrKey','model'));// отправляем масив для дальнейшего присваевания к нему значений.
           }
           else {
               return $this->render('ajax', compact('model')); // если ничего не выбранно , ничего и не делаем
           }



        } else { // при  не получении данных пост
            // либо страница отображается первый раз, либо есть ошибка в данных
            $idArr = Common::fullArrDataGiven();
            return $this->render('ajax', compact('model','idArr'));
        }
    }


}















