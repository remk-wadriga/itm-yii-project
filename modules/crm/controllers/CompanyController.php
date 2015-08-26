<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 21-08-2015
 * Time: 14:22 PM
 */

namespace crm\controllers;

use models\search\CompanySearch;
use Yii;
use crm\abstracts\ControllerAbstract;
use models\Company;
use yii\web\NotFoundHttpException;

class CompanyController extends ControllerAbstract
{
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render(['model' => $model]);
    }

    public function actionList()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->params());

        return $this->render([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Company();

        if ($model->load($this->post()) && $model->save()) {
            return $this->redirect(['/crm/company/view', 'id' => $model->id]);
        }

        return $this->render(['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($this->post()) && $model->save()) {
            return $this->redirect(['/crm/company/view', 'id' => $model->id]);
        }

        return $this->render(['model' => $model]);
    }

    /**
     * findModel
     * @param int $id
     * @return null|Company
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        $model = Company::findOne($id);
        if (empty($model)) {
            throw new NotFoundHttpException('Company not found!');
        }

        return $model;
    }
}