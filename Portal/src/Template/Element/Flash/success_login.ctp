<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>


<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-check text-success"></i></span>
    <div class="fg-line">
        <p class="form-control-static text-success text-left"><?= $message ?></p>
    </div>
</div>
