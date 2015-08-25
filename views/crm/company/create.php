<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 21-08-2015
 * Time: 15:06 PM
 *
 * @var \components\View $this
 * @var \models\Company $model
 */

$this->title = 'Создать компанию';
$this->params['breadcrumbs'] = [['label' => 'Компании', 'url' => ['/crm/company/list']], ['label' => $this->title]];
?>

<h3><?= $this->title ?></h3>

<?= $this->render('_form', ['model' => $model]) ?>
