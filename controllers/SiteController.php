<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Post;

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
            $posts = Post::find()->all();
            return $this->render('home', ['posts' => $posts]);
        }
        public function actionCreate()
        {
            $post = new Post(); // Change variable name to $post
            $formData = yii::$app->request->post();
            
            if ($post->load($formData)) { // Fix the syntax error, use "->" instead of "->"
                if ($post->save()) {
                    yii::$app->getSession()->setFlash('success', 'Post is published successfully'); // Fix the typo in the success message
                    return $this->redirect(['index']); // Fix the syntax error, use "->" instead of "="
                } else {
                    yii::$app->getSession()->setFlash('message', 'Failed to publish'); // Fix the typo in the failure message
                }
            }
        
            return $this->render('create', ['post' => $post]);
        }
        public function actionView($id){
            $post = post::findOne($id);
            echo $id;
            return $this->render('view', ['post' => $post]);
        }
        public function actionUpdate($id){
            $post = Post::findOne($id);

    if ($post->load(Yii::$app->request->post()) && $post->save()) {
        Yii::$app->session->setFlash('success', 'Post Updated Successfully');
        return $this->redirect(['index', 'id' => $post->ID]); // Fix the syntax here
    } else {
        return $this->render('update', ['post' => $post]);
    }
        }
        public function actionDelete($id){
            $post = Post::findOne($id)->delete();
            if($post){
                yii::$app->getSession()->setFlash('success', 'Post is Deleted successfully'); 
                return $this->redirect(['index', ['post' => $post]]); // Fix the syntax here
            }
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
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
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
    public function actionAbout()
    {
        return $this->render('about');
    }
}
