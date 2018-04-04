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

<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Invoices') ?> - <?= __($sStatus) ?>
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
                    <p class="text-muted"><?= __('To pay your open invoices, tick the checkboxes and click the Pay-button') ?></p>

                    <div class="row">
                        <div data-href="/Invoice/Overview" class="col-xs-12 col-sm-4 col-md-4 col-lg-3 ">
                            <div class="mini-charts-item bgm-hodi">
                                <div class="clearfix">
                                    <div class="chart">
                                        <i class="fa fa-eur"></i>
                                    </div>
                                    <div class="count">
                                        <small><?= __('Open invoices') ?></small>
                                        <h2> &euro; <?= Number::precision($iOpen,2) ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if($iLate == 0){ ?>
                        <div data-href="/Invoice/Expired" class="col-xs-12 col-sm-4 col-md-4 col-lg-3 ">
                            <div class="mini-charts-item bgm-green">
                                <div class="clearfix">
                                    <div class="chart">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="count">
                                        <small><?= __('Expired invoices') ?></small>
                                        <h2> &euro; <?= Number::precision($iLate,2) ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div data-href="/Invoice/Expired" class="col-xs-12 col-sm-4 col-md-4 col-lg-3 ">
                            <div class="mini-charts-item bgm-red">
                                <div class="clearfix">
                                    <div class="chart">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="count">
                                        <small><?= __('Expired invoices') ?></small>
                                        <h2> &euro; <?= Number::precision($iLate,2) ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>


                    <form method="post" action="/Invoice/payInvoiceBatch/" id="paymentForm">

                        <div class="visible-xs">
                            <select name="gatewayXs" id="gatewayXs" style="width:100%" required>
                                <option value="">- Selecteer een betaalmethode -</option>
                                <?php foreach($aGateways as $gateway){ ?>
                                    <option value="<?= $gateway->id ?>"><?= $gateway->description ?></option>
                                <?php } ?>
                            </select><br /><br />
                            <button type="submit" class="btn btn-block btn-success" id="payButtonXS" disabled="disabled">
                                <?= __('Pay') ?> &euro; <span id="totalAmountXs">0,00</span>
                            </button>
                        </div>

                        <table class="table table-sortable table-hover table-condensed no-padding">
                            <thead>
                            <tr>
                                <th width="25">
                                    <div class="checkbox checkbox-main">
                                        <input id="checkall" type="checkbox">
                                        <label for="checkall"></label>
                                    </div>
                                </th>
                                <th class="hidden-xs" width="150">Ref.</th>
                                <th><?= __('No.') ?></th>
                                <th class="text-right hidden-xs" width="125"><?= __('Date') ?></th>
                                <th class="text-right hidden-xs" width="125"><?= __('Amount') ?></th>
                                <th class="text-right hidden-xs" width="125"><?= __('Expiry date') ?></th>
                                <th class="text-right" width="125"><?= __('Open amount') ?></th>
                                <th class="text-right" width="100"><?= __('Days open') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($aList as $rule){ ?>
                                <?php $now = new \Cake\I18n\Time(); ?>
                                <?php if($now > $rule->BKHVFDATUM_VV){ ?>
                                    <tr class="<?= ($now->modify('-3 days')  > $rule->BKHVFDATUM_VV) ? "text-danger" : "" ?>">
                                        <td>
                                            <div class="checkbox checkbox-main">
                                                <input id="checkbox_<?= $rule->BKHVFNRINT ?>" type="checkbox" name="payInvoice[<?= $rule->BKHVFNRINT ?>]" value="<?= number_format($rule->BKHVFOPEN_VAL,"2",".","") ?>">
                                                <label for="checkbox_<?= $rule->BKHVFNRINT ?>"></label>
                                            </div>
                                        </td>
                                        <td data-href="/Invoice/view/<?= $rule->BKHVFNRINT ?>"><?= $rule->BKHVFTEKST1 == "" ? "<em>" . __("N/A") . "</em>" : $rule->BKHVFTEKST1 ?></td>
                                        <td data-href="/Invoice/view/<?= $rule->BKHVFNRINT ?>"><?= $rule->BKHVFNR ?></td>
                                        <td data-href="/Invoice/view/<?= $rule->BKHVFNRINT ?>" data-sort="<?= $rule->BKHVFDATUM->format('Ymd') ?>" class="text-right hidden-xs"><?= $rule->BKHVFDATUM->format('d-m-Y') ?></td>
                                        <td data-href="/Invoice/view/<?= $rule->BKHVFNRINT ?>" class="text-right hidden-xs">&euro; <?=  Number::precision($rule->BKHVFBEDRAG_EUR,2) ?></td>
                                        <td data-href="/Invoice/view/<?= $rule->BKHVFNRINT ?>" data-sort="<?= is_null($rule->BKHVFDATUM_VV) ? 0 : $rule->BKHVFDATUM_VV->format('Ymd') ?>" class="text-right hidden-xs"><?= is_null($rule->BKHVFDATUM_VV) ? __('Not available') : $rule->BKHVFDATUM_VV->format('d-m-Y') ?></td>
                                        <td data-href="/Invoice/view/<?= $rule->BKHVFNRINT ?>" class="text-right">
                                            &euro; <?= Number::precision($rule->BKHVFOPEN_VAL,2) ?>
                                        </td>
                                        <td data-href="/Invoice/view/<?= $rule->BKHVFNRINT ?>" class="text-right">
                                            <?php

                                                $oDate = new \DateTime($rule->BKHVFDATUM->format('Y-m-d'));
                                                $oDate2 = new \DateTime();
                                                //debug($oDate);
                                                $interval = $oDate->diff($oDate2);
                                                echo $interval->format("%a days");
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>

                            </tbody>

                            <tfoot id="totalFooter" class="hidden hidden-xs">
                            <td></td>
                            <td><h5 class="hidden-xs hidden-sm"><span id="totalCount">X</span> <?= __('invoice(s) selected') ?></h5></td>
                            <td class="text-right hidden-xs"></td>
                            <td class="text-right hidden-xs" ></td>
                            <td class="text-right hidden-xs"></td>
                            <td class="text-right hidden-xs"></td>
                            <td colspan="2" class="text-right">
                                <select name="gateway" id="gateway" required>
                                    <option value="">- Selecteer een betaalmethode -</option>
                                    <?php foreach($aGateways as $gateway){ ?>
                                        <option value="<?= $gateway->id ?>"><?= $gateway->description ?></option>
                                    <?php } ?>
                                </select><br /><br />
                                <button type="submit" class="btn btn-block btn-success">
                                    <?= __('Pay') ?> &euro; <span id="totalAmount">x.xxx.xxx,xx</span>
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

            $('#gateway').on('change', function(){
                $('#gatewayXs').val($(this).val());
            });

            $('#gatewayXs').on('change', function(){
                $('#gateway').val($(this).val());
            });
        });
    });

    function calcTotalAmount($this){
        var $tableId = $this.closest('form').attr('id');
        var $total = 0;
        var $count = 0;
        $('#'+$tableId+" input[type=checkbox]:not(#checkall)").each(function(){
            if($(this).prop('checked')) {
                $total += Number($(this).val());
                $count++;
            }
        });
        if($total > 0){
            // NORMAL BUTTON
            $('#totalAmount').html($.number($total, 2, ',', '.'));
            $('#totalCount').html($.number($count, 0, ',', '.'));
            $('#totalFooter').removeClass('hidden');

            // XS BUTTON
            $('#totalAmountXs').html($.number($total, 2, ',', '.'));
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
            var $total = 0;
            var $count = 0;
            $('#'+$tableId+" input[type=checkbox]:checked:not(#checkall)").each(function(){
                $total += Number($(this).val());
                $count++;
            });
            if($total > 0){
                // NORMAL BUTTON
                $('#totalAmount').html($.number($total, 2, ',', '.'));
                $('#totalCount').html($.number($count, 0, ',', '.'));
                $('#totalFooter').removeClass('hidden');

                // XS BUTTON
                $('#totalAmountXs').html($.number($total, 2, ',', '.'));
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