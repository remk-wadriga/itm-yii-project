<?php
/**
 * @var \components\View $this
 * @var string $content
 * @var array $leftMenuItems
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use assets\MainAsset;
use yii\widgets\Menu;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    // Nav bar items
    $items = [
        ['label' => 'Home', 'url' => Yii::$app->getHomeUrl()],
    ];
    
    if(Yii::$app->user->isGuest){
        $items[] = ['label' => 'Login', 'url' => ['/account/auth/login']];
        $items[] = ['label' => 'Register', 'url' => ['/account/auth/register']];
    }else{
        $items[] = ['label' => 'Logout (' . Yii::$app->user->name . ')', 'url' => ['/account/auth/logout'], 'linkOptions' => ['data-method' => 'post']];
    }

    // Nav bar
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $items,
        ]);

    NavBar::end();
    ?>

    <br />
    <br />
    <br />


    <div class="container">

        <!-- Breadcrumbs -->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <!-- Left menu -->
        <?php if(!Yii::$app->user->isGuest && isset($leftMenuItems) && !empty($leftMenuItems)): ?>
            <?= Menu::widget([
                'items' => $leftMenuItems,
            ]) ?>
        <?php endif; ?>

        <!-- Content -->
        <?= $content ?>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->registerJs('
    Main.init();
'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
