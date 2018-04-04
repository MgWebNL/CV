<?php
// LINK
$link = '/Article/view/';
?>

<div class="col-xs-<?= $xs ?> col-sm-<?= $sm ?> col-md-<?= $md ?> col-lg-<?= $lg ?> ">
    <!-- LIST -->
    <div class="card">
        <div class="card-header" data-href="/Article/Order/">
            <h2>
                <span id="orders"><?= __('Order advice') ?></span>
            </h2>
        </div>

        <div class="card-body card-padding hidden">
            <div class="alert alert-warning bgm-secondair m-b-0">
                <?= __('No items available'); ?>
            </div>
        </div>

        <div class="card-body card-padding m-t-0 p-t-0" id="orderAdviceAjaxResult">

        </div>

    </div>
</div>

<script>
    function orderAdviceAjax() {
        $('#orderAdviceAjaxResult').html('<?= addslashes(str_replace("\r\n", "", $this->element('Ajax/loading'))) ?>');
        registerJqxhr(
            $.ajax({
                url: "/Home/loadDashboardModuleOrderAdviceAjax/",
                success: function (response) {
                    // you will get response from your php page (what you echo or print)
                    $('#orderAdviceAjaxResult').html(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    $('#orderAdviceAjaxResult').html(
                        '<?= str_replace("\r\n", "", $this->element('Ajax/error', ["scriptname" => "orderAdviceAjax"])) ?>'
                    );
                },
            })
        );
    }
    $(function() {
        orderAdviceAjax();
    });

</script>