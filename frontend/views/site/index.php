<?php

/* @var $this yii\web\View */
/* @var $drive_data array|null */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <div class="col-12">
            <h1>My Drives:</h1>
        </div>
        <div class="col-12">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $drive_data,
                'options' => [ 'class' => 'grid-view table-responsive'],
                'pager' => [
                    'class' => '\yii\widgets\LinkPager',
                    'options' => ['class' => 'pagination'],
                    'linkOptions' => ['class'=>'page-item'],
                ],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                    ],
                    'title',
                    [
                        'attribute' => 'thumbnailLink',
                        'contentOptions' => ['style' => 'font-size:12px'],
                        'format' => 'image',
                        'value' => function ($data) {
                            if(isset($data['thumbnailLink'])){
                                return $data['thumbnailLink'];
                            }
                        }
                    ],
                    [
                        'attribute' => 'embedLink',
                        'contentOptions' => ['style' => 'font-size:12px'],
                        'format' => 'url',
                        'value' => function ($data) {

                            if (isset($data['webContentLink'])) {
                                return $data['webContentLink'];
                            } else if (isset($data['exportLinks']['application/zip'])) {
                                return $data['exportLinks']['application/zip'];
                            }
                            return isset($data['embedLink']) ? $data['embedLink'] : null;
                        }
                    ],
                    [
                        'attribute' => 'modifiedDate',
                        'format' => ['date', 'php:Y-m-d'],

                    ],
                    [
                        'attribute' => 'fileSize',
                        'value' => function ($data) {
                            if(isset($data['fileSize']))
                            {
                                $bytes = floatval($data['fileSize']);
                                $result = $bytes / pow(1024, 2);
                                $result = str_replace(".", "," , strval(round($result, 2)))."MB";

                                return $result;
                            }
                        }
                    ],
                    [
                            'attribute' => 'ownerNames',
                            'value' => function ($data) {
                                $owners = $data['ownerNames'];
                                if(count($owners) > 1) {
                                    $owners_design = "<ul>";
                                    foreach ($owners as $owner) {
                                        $owners_design .= "<li>$owner</li>";
                                    }
                                    $owners_design .= "</ul>";
                                    return $owners_design;
                                }
                                return $owners[0];
                            }
                    ],
                ],
            ]); ?>
        </div>
    </div>



</div>
