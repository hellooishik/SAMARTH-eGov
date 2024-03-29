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
use app\models\createUser;
use app\component\api;
use app\component\googleSearch;

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
        

        public function actionApi($id)
{
    $post = Post::findOne($id);

    if ($post) {
        // Implement your fetching logic here
        // You can use $post->ID or $post->Title to fetch data from the API

        Yii::$app->session->setFlash('success', 'Data fetched successfully.');
    } else {
        Yii::$app->session->setFlash('error', 'Post not found.');
    }

    return $this->redirect(['index']); // Redirect to the index page or any other page
}
        public function actionapifetch()
        {
          
    
            if ($post) {
                $googleApi = Yii::$app->externalApi; // Assuming you configured this in components
                $googleApiKey = 'AIzaSyDp4oPYZ4qOdfUlKpD-7S8hpAYWFTNEBFM'; // Replace with your actual Google API key
    
                $googleSearchService = new GoogleSearchService($googleApi, $googleApiKey);
                $searchResults = $googleSearchService->searchByTitle($post->Title);
    
                // Save search results to the database or do any necessary processing
                // Example: Save the search results to a new table named 'google_search_results'
                // Adjust the table and attribute names according to your database structure
                foreach ($searchResults['items'] as $item) {
                    $googleResult = new GoogleSearchResult();
                    $googleResult->post_id = $post->ID;
                    $googleResult->title = $item['title'];
                    $googleResult->snippet = $item['snippet'];
                    $googleResult->link = $item['link'];
                    $googleResult->save();
                }
    
                Yii::$app->session->setFlash('success', 'Data fetched and saved successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Post not found.');
            }
    
            return $this->redirect(['index']); // Redirect to the index page or any other page
        }
        public function actionCreate()
        {
            $post = new Post(); // Change variable name to $post
            $formData = yii::$app->request->post();
            
            if ($post->load($formData)) { // Fix the syntax error, use "->" instead of "->"
                if ($post->save()) {
                    yii::$app->getSession()->setFlash('message', 'Post is published successfully'); // Fix the typo in the success message
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
        public function actionCreateUser()
        {
            $model = new UserRegistrationForm();
    
            if (Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());
                if ($model->register()) {
                    Yii::$app->session->setFlash('success', 'User created successfully.');
                    return $this->redirect(['index']); // Redirect to the home page or any other page
                }
            }
    
            return $this->render('create-user', ['model' => $model]);
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
       
        return $this->render('site/about');
    
    }
}
