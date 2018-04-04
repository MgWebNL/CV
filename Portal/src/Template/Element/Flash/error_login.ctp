<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>


<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-warning text-danger"></i></span>
    <div class="fg-line">
        <p class="form-control-static text-danger text-left"><?= $message ?></p>
    </div>
</div>
