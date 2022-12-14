<?php

use frontend\components\Common;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */

$this->title = 'Мусихин Н.А.';
$arr = Common::arrСhoiceСurrency ();

// вот тут прилось накостылить, не сделал AJAX  пока только изучаю) и в форму вписал PHP код , требовалось больше времени для разбора
?>


<div class="site-index">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => false, 'id'=>'full_form_id']);
    ?>



    <div class="col-12">
        <div class="row">
            <?php for ($i=0; $i<count($arr); $i++) {?>
                <div class="checkbox_val">
            <?echo $form->field($model,$arr[$i]["CharCode"])->checkbox(array('value'=>1, 'uncheckValue'=>0 , 'class'=>'get_value')); ?>
                </div>
        <?
            }
            ?>
        </div>
    </div>
</div>
<?echo Html::submitButton('Применить Выбор', ['class' => ' btn btn-success btn_ajax' , 'id'=>'submit submit-button', 'name'=>'submit']);?>

<?php ActiveForm::end(); ?>
<?

if (!empty($arrKey)){
?>
    <div class="site-index">
    <div class="body-content">
        <div id="currency"></div>
            <div class="row">
                             <?Common::showIsTheGun($arrKey);?>
            </div>
    </div>
    </div>
    <?
}
?>
<script>
    $('#submit').bind('click', function() {
        $(this).prop('disabled', true);
    });
</script>
