<?php use Cake\I18n\Number; ?>

<?php foreach($aList as $rule) {
    $now = new \Cake\I18n\Time();
    if ($now > $rule->BKHVFDATUM_VV) {
        $iLate += $rule->BKHVFOPEN_VAL;
    } else {
        $iOK[] += $rule->BKHVFOPEN_VAL;
    }
    $iOpen += $rule->BKHVFOPEN_VAL;
} ?>

<?php
// LINK
$link = '/Article/view/';
?>

<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <span id="orders"><?= __('Order advice') ?></span>
                </h2>

            </div>

            <?php if(count($aList) == 0){ ?>
                <div class="card-body card-padding">
                    <div class="alert alert-warning m-b-0">
                        <?= __('No items available'); ?>
                    </div>
                </div>
            <?php }else{ ?>

                <div class="card-body card-padding">

                    <form method="post" action="/Cart/addListFromOrderAdvice/" id="paymentForm">

                        <button type="submit" class="btn btn-block btn-success visible-xs" id="payButtonXS" disabled="disabled">
                            <?= __('Pay') ?> &euro; <span id="totalAmountXs">0,00</span>
                        </button>

                        <table class="table table-sortable table-hover table-condensed no-padding">
                            <thead>
                            <tr>
                                <th width="25">
                                    <div class="checkbox checkbox-main">
                                        <input id="checkall" type="checkbox">
                                        <label for="checkall"></label>
                                    </div>
                                </th>
                                <th width="125"><?= __('My code') ?></th>
                                <th width="125"><?= __('Art.Code') ?></th>
                                <th class="visible-xs"></th>
                                <th class="hidden-xs"><?= __('Description') ?></th>
                                <th class="text-right" width="100"><?= __('Qty') ?></th>
                                <th class="text-right" width="100"><?= __('Qty') ?></th>
                                <th class="hidden-xs text-right" width="100"><?= __('Date') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($aList as $art){ ?>
                                <?php
                                $dateView = date('d-m-Y', strtotime($art->besteldatum));
                                $date = date('Ymd', strtotime($art->besteldatum));
                                $now = date('Ymd');
                                ?>
                                <tr <?= ($date < $now) ? "class='text-danger'" : "" ?> >
                                    <td>
                                        <div class="checkbox checkbox-main">
                                            <input id="checkbox_<?= $art->BKHARNRINT ?>" type="checkbox" name="article[<?= $art->BKHARNRINT ?>]" value="<?= $art->BKHARCODE ?>">
                                            <label for="checkbox_<?= $art->BKHARNRINT ?>"></label>
                                        </div>
                                    </td>
                                    <td data-href="<?= $link.($art->BKHARNRINT) ?>"><?= $art->customer_artNumber ?></td>
                                    <td data-href="<?= $link.($art->BKHARNRINT) ?>"><?= $art->BKHARCODE ?></td>
                                    <td data-href="<?= $link.($art->BKHARNRINT) ?>" class="visible-xs"></td>
                                    <td data-href="<?= $link.($art->BKHARNRINT) ?>" class="hidden-xs"><?= $art->BKHAROMS ?></td>
                                    <td data-href="<?= $link.($art->BKHARNRINT) ?>" class="text-right">
                                        <?= \Cake\I18n\Number::precision($art["ArticleUsage"]["opt_bst"], 0) ?>
                                    </td>
                                    <td class="text-right">
                                        <input style="height: 18px; text-align: right;" class="form-control input-sm" type="text" name="quantity[<?= $art->BKHARNRINT ?>]" value="<?= $art["ArticleUsage"]["opt_bst"] ?>" />
                                    </td>
                                    <td data-href="<?= $link.($art->BKHARNRINT) ?>" class="text-right">
                                        <?= $dateView ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>

                            <tfoot id="totalFooter" class="hidden hidden-xs">
                                <td></td>
                                <td></td>
                                <td colspan="99" class="text-right">
                                    <button type="submit" class="btn btn-success" id="orderButton">
                                        <?= __('Order these') ?> <span id="totalCount">X</span> <?= __('items') ?>
                                    </button>
                                </td>
                            </tfoot>
                        </table>
                    </form>
                </div>
            <?php } ?>

        </div>
    </div>


</div>


<script>
    $(function(){
        $('#checkall').on('click', function(){
            var $bool = $(this).prop('checked');
            var $tableId = $(this).closest('form').attr('id');
            $('#'+$tableId+" input[type=checkbox]").prop('checked', $bool);
            calcTotalAmount($(this));

            if($bool === true) {
                $('html, body').animate({
                    scrollTop: $("#orderButton").offset().top
                }, 2000);
            }
        });
    });

    function calcTotalAmount($this){
        var $tableId = $this.closest('form').attr('id');
        var $total = 0;
        var $count = 0;
        $('#'+$tableId+" input[type=checkbox]:not(#checkall)").each(function(){
            if($(this).prop('checked')) {
                $count++;
            }
        });
        if($count > 0){
            // NORMAL BUTTON
            $('#totalCount').html($.number($count, 0, ',', '.'));
            $('#totalFooter').removeClass('hidden');

            // XS BUTTON
            $('#totalCount').html($.number($count, 0, ',', '.'));
            $('#payButtonXS').prop('disabled', false);
        }else{
            // NORMAL BUTTON
            $('#totalFooter').addClass('hidden');

            // XS BUTTON
            $('#totalAmountXs').html($.number(0, 2, ',', '.'));
            $('#payButtonXS').prop('disabled', 'disabled');
        }
    }

    $(function(){
        $('#paymentForm input[type=checkbox]:not(#checkall)').on('change', function(){
            var $tableId = $(this).closest('form').attr('id');
            var $count = 0;
            $('#'+$tableId+" input[type=checkbox]:checked:not(#checkall)").each(function(){
                $count++;
            });
            if($count > 0){
                // NORMAL BUTTON
                $('#totalCount').html($.number($count, 0, ',', '.'));
                $('#totalFooter').removeClass('hidden');

                // XS BUTTON
                $('#totalCount').html($.number($count, 0, ',', '.'));
                $('#payButtonXS').prop('disabled', false);
            }else{
                // NORMAL BUTTON
                $('#totalFooter').addClass('hidden');

                // XS BUTTON
                $('#totalAmountXs').html($.number(0, 2, ',', '.'));
                $('#payButtonXS').prop('disabled', 'disabled');
            }
        });
    });

</script>