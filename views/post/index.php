<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
  Create Post Ajax
</button>
    </p>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
  <?php      
    $form = ActiveForm::begin([
    'id' => $model->formName(),
    'options' => ['class' => 'form-horizontal'],
]) ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'content')->textArea(['rows' => '2'])?>
        <?= $form->field($model, 'author') ?>       
        <div class="col-lg-offset-1 col-lg-11">
            <button class="btn btn-primary create-post">Create</button>
        </div>
    </div>
<?php ActiveForm::end() ?>
      </div>
<!--       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content',
            'author',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<?php 
$script = <<< JS
$(".create-post").on('click',function(e){
    e.preventDefault();
        $.ajax({
                method: "POST",
                url: "/post",
                data: $('form#Post').serialize()
            })
            .done(function(data) {
                if($('tr td div').hasClass('empty')){
                    $('tbody tr').first().remove();
                }
                var count=parseInt(data.count);
                if($('tbody tr').last().find('td').first().text() == (count-1).toString()){
                    $('tbody').append('<tr data-key='+data.data.id+'><td>'+count+'</td><td>'+data.data.id+'</td><td>'+data.data.title+'</td><td>'+data.data.content+'</td><td>'+data.data.author+'</td><td><a href="/post/view?id='+data.data.id+'" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> <a href="/post/update?id='+data.data.id+'" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> <a href="/post/delete?id='+data.data.id+'" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td></tr>');
                }else if(count == 1){
                    $('tbody').append('<tr data-key='+data.data.id+'><td>'+count+'</td><td>'+data.data.id+'</td><td>'+data.data.title+'</td><td>'+data.data.content+'</td><td>'+data.data.author+'</td><td><a href="/post/view?id='+data.data.id+'" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> <a href="/post/update?id='+data.data.id+'" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> <a href="/post/delete?id='+data.data.id+'" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td></tr>');
                }
                $('#myModal').modal('toggle');
            });
    })
JS;
$this->registerJs ($script);
?>
