<?php
// LINK
$link = '/Article/view/';
?>

<div class="col-xs-<?= $xs ?> col-sm-<?= $sm ?> col-md-<?= $md ?> col-lg-<?= $lg ?> ">
    <!-- LIST -->
    <div class="card">
        <div class="card-header">
            <h2>
                <span id="orders"><?= __('Portal tour') ?></span>
            </h2>
        </div>

        <div class="card-body card-padding hidden">
            <div class="alert alert-warning bgm-secondair m-b-0">
                <?= __('No items available'); ?>
            </div>
        </div>

        <div class="card-body card-padding m-t-0 p-t-0">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/gpNW5XusLug?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                <br />&nbsp;
            </div>
        </div>

    </div>
</div>