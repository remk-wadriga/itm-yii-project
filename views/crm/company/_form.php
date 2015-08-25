<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 21-08-2015
 * Time: 15:08 PM
 *
 * @var \components\View $this
 * @var \models\Company $model
 * @var \yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'userId')->dropDownList($model->usersItems) ?>
    <?= $form->field($model, 'ownershipId')->dropDownList($model->ownershipsItems) ?>
    <?= $form->field($model, 'edrpou') ?>
    <?= $form->field($model, 'webAddress') ?>
    <?= $form->field($model, 'jurAddress') ?>
    <?= $form->field($model, 'phyAddress') ?>
    <?= $form->field($model, 'postcode') ?>
    <?= $form->field($model, 'postbox') ?>
    <?= $form->field($model, 'description')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form -->
