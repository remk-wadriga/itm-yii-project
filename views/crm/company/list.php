<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 21-08-2015
 * Time: 14:24 PM
 *
 * @var \components\View $this
 * @var \models\Company[] $companies
 */

use yii\helpers\Html;

$this->params['breadcrumbs'] = ['Компании'];
?>

<?= Html::a('Создать компанию', ['/crm/company/create'], ['class' => 'btn btn-primary']) ?>


<h1>Companies</h1>
