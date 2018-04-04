<?php use Cake\I18n\Number; ?>

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
                    <span id="orders"><?= __('On demand') ?></span>
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
                                <th width="150"><?= __('Reference') ?></th>
                                <th width="80"><?= __('Order no.') ?></th>
                                <th width="125"><?= __('My code') ?></th>
                                <th width="125"><?= __('Art.Code') ?></th>
                                <th class="visible-xs"></th>
                                <th class="hidden-xs"><?= __('Description') ?></th>


                                <th class="text-right" width="100"><?= __('Qty') ?></th>
                                <th class="text-right" width="100"><?= __('Demanded') ?></th>
                                <th class="hidden-xs text-right" width="100"><?= __('To demand') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($aList as $art){ ?>
                                <?php $iToDemand = $art->ORDRR_INAFROEP - $art->ORDRR_AANTAL_AFGEROEPEN; ?>
                                <tr>
                                    <td data-href="/Order/view/<?= $art->ORDORNRINT ?>"><?= $art->ORDORREFERENTIE ?></td>
                                    <td data-href="/Order/view/<?= $art->ORDORNRINT ?>"><?= $art->ORDORNR ?></td>

                                    <td data-href="/Article/view/<?= $art->BKHARNRINT ?>/<?= $iToDemand ?>"><?= $art->customer_artNumber ?></td>
                                    <td data-href="/Article/view/<?= $art->BKHARNRINT ?>/<?= $iToDemand ?>"><?= $art->BKHARCODE ?></td>
                                    <td class="visible-xs"></td>
                                    <td data-href="/Article/view/<?= $art->BKHARNRINT ?>/<?= $iToDemand ?>" class="hidden-xs"><?= $art->BKHAROMS ?></td>

                                    <td class="text-right"><?= Number::precision($art->ORDRR_INAFROEP,0) ?></td>
                                    <td class="text-right"><?= Number::precision($art->ORDRR_AANTAL_AFGEROEPEN,0) ?></td>
                                    <td class="text-right"><?= Number::precision($iToDemand,0) ?></td>
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