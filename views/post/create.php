<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php 
$script = <<< JS
   $('form#w0').submit(function(e){
   		e.preventDefault();
	    var form = $(this);
	    var title = $('#post-title').val();
	    var content = $('#post-content').val();
	    var author = $('#post-author').val();
	    $.ajax({
            method: "POST",
            url: "/post/create",
            data: form.serialize();
        })
        .done(function(data) {
          console.log(data);
        });
        // return false;
   })
JS;
$this->registerJs ($script);
?>
