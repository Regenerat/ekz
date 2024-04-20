<?php

use app\models\Report;
use app\models\Role;
use app\models\Status;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ReportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';

?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'number',
            'description:ntext',
            'status',
            [
                'attribute' => 'Сменить статус',
                'visible' => (Yii::$app->user->identity->role_id == Role::ADMIN_ID ? true : false),
                'format' => 'raw',
                'value' => function($model){

                    if($model->status_id == Status::NEW_STATUS){
                        $html = Html::beginForm(Url::to(['update', 'id' => $model->id]));
                        $html .= Html::activeDropDownList($model, 'status_id',[
                            '2' => 'Принять',
                            '3' => 'Отклонить',
                        ]);

                        $html .= Html::submitButton('Save', ['class' => 'btn btn-success']);
                        return $html;
                    }

                    return "";
                }
                // 'class' => ActionColumn::className(),
                // 'urlCreator' => function ($action, Report $model, $key, $index, $column) {
                //     return Url::toRoute([$action, 'id' => $model->id]);
                //  }
            ],
        ],
    ]); ?>


</div>
