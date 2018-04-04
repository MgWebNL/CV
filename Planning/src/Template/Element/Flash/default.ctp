<?php
$class = 'callout callout-';
if (!empty($params['class'])) {
    $class .= $params['class'];
}else{
    $class .= 'warning';
}
?>

<div class="row">
    <div class="col-xs-12">
        <div class="<?= h($class) ?>" onclick="this.classList.add('hidden')">
            <p><i class="fa fa-warning"></i> <?= h($message) ?></p>
        </div>
    </div>
</div>
