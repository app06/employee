<?php

namespace app\controllers;

use app\forms\EmployeeCreateForm;
use app\models\Interview;
use app\services\dto\RecruitData;
use app\services\EmployeeService;
use Yii;
use app\models\Employee;
use app\forms\search\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    private $employeeService;

    public function __construct($id, $module, EmployeeService $employeeService, $config = [])
    {
        $this->employeeService = $employeeService;
        parent::__construct($id, $module, $config = []);
    }

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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws \yii\web\ServerErrorHttpException
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new EmployeeCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $employee = $this->employeeService->create(
                new RecruitData($form->firstName, $form->lastName, $form->address, $form->email),
                $form->orderDate,
                $form->contractDate,
                $form->recruitDate
            );
            Yii::$app->session->setFlash('success', 'Employee is recruit.');
            return $this->redirect(['view', 'id' => $employee->id]);
        }
        return $this->render('create', [
            'createForm' => $form,
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $interview_id
     * @throws \yii\web\ServerErrorHttpException
     * @return mixed
     */
    public function actionCreateByInterview($interview_id)
    {
        $interview = $this->findInterviewModel($interview_id);

        $form = new EmployeeCreateForm($interview);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $employee = $this->employeeService->createByInterview(
                $interview->id,
                new RecruitData($form->firstName, $form->lastName, $form->address, $form->email),
                $form->orderDate,
                $form->contractDate,
                $form->recruitDate
            );
            Yii::$app->session->setFlash('success', 'Employee is recruit.');
            return $this->redirect(['view', 'id' => $employee->id]);
        }

        return $this->render('create', [
            'createForm' => $form,
        ]);
    }

    /**
     * Updates an existing Employee model.
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
     * Deletes an existing Employee model.
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
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findInterviewModel($id)
    {
        if (($model = Interview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
