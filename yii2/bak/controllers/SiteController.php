<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;



class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['login','error','about','blank','foto','wemos','wemoson','wemosoff'],
                        'allow' => true,
                       // 'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionWemos()
    {
       // $this->layout='blank';
        return $this->render('wemos');
    }
    /**
     * Displays about page.
     *
     * @return string
     */
   

    public function actionWemoson()
    {   
        $ch1 = curl_init();
        $ch2 = curl_init();
        $ch3 = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch1, CURLOPT_URL, "http://192.168.43.41/3/on");
        curl_setopt($ch1, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_URL, "http://192.168.43.117/4/on");
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch3, CURLOPT_URL, "http://192.168.43.234/5/on");
        curl_setopt($ch3, CURLOPT_HEADER, 0);

        //create the multiple cURL handle
        $mh = curl_multi_init();

        //add the two handles
        curl_multi_add_handle($mh,$ch1);
        curl_multi_add_handle($mh,$ch2);
        curl_multi_add_handle($mh,$ch3);

        $active = null;
        //execute the handles
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        //close the handles
        curl_multi_remove_handle($mh, $ch1);
        curl_multi_remove_handle($mh, $ch2);
        curl_multi_remove_handle($mh, $ch3); 
        curl_multi_close($mh);

        return $this->redirect(['wemos']);
    }
    public function actionWemosoff()
    {   
        $ch1 = curl_init();
        $ch2 = curl_init();
        $ch3 = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch1, CURLOPT_URL, "http://192.168.43.41/3/off");
        curl_setopt($ch1, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_URL, "http://192.168.43.117/4/off");
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch3, CURLOPT_URL, "http://192.168.43.234/5/off");
        curl_setopt($ch3, CURLOPT_HEADER, 0);

        //create the multiple cURL handle
        $mh = curl_multi_init();

        //add the two handles
        curl_multi_add_handle($mh,$ch1);
        curl_multi_add_handle($mh,$ch2);
        curl_multi_add_handle($mh,$ch3);

        $active = null;
        //execute the handles
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        //close the handles
        curl_multi_remove_handle($mh, $ch1);
        curl_multi_remove_handle($mh, $ch2);
        curl_multi_remove_handle($mh, $ch3);
        curl_multi_close($mh);
        return $this->redirect(['wemos']);
    }

    public function actionWemoson1()
    {
            $options = array(
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POST            => false,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_CONNECTTIMEOUT  => 120,
                CURLOPT_TIMEOUT         => 120,
            );
            $nama = time(); 
            $ch = curl_init('http://192.168.43.41/3/on'.$nama);
            curl_setopt_array($ch, $options);
            $content = curl_exec($ch);
            curl_close($ch);

            echo $content;
    }

    public function actionWemosoff1()
    {
            $options = array(
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POST            => false,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_CONNECTTIMEOUT  => 120,
                CURLOPT_TIMEOUT         => 120,
            );
            $nama = time(); 
            $ch = curl_init('http://192.168.43.41/3/off'.$nama);
            curl_setopt_array($ch, $options);
            $content = curl_exec($ch);
            curl_close($ch);

            echo $content;
    }

    public function actionAbout(){
        return $this->render('about');
    }
}





