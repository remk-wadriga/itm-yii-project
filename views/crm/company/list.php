<?php
/**
 * @var components\View $this
 * @var models\search\CompanySearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;
use yii\grid\GridView;
use widgets\pjax\Pjax;

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'userName',
            'ownershipName',
            'edrpou',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end() ?>

</div>