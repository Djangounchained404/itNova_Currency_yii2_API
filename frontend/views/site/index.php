<?php

use frontend\components\Common;

/** @var yii\web\View $this */

$this->title = 'Мусихин Н.А.';


?>

<div class="site-index">
    <div class="body-content">
        <div id="currency"></div>

            <div class="row">
                <?
                Common::сurrencyAddViews($idArr);
                ?>

                </div>

    </div>
</div>

<?php
Common::showDb ($idArr);
?>
