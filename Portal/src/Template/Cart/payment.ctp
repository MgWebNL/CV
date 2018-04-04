<?php
use Cake\I18n\Number;
/**
 * IMPORTANT :: DEFINE CART VAR OUT OF SESSION-VAR !!!
 */
?>

<!-- CONTENT -->
<form method="post" action="/Cart/savePayement/">
    <div class="row">
        <div class="col-xs-3">
            <div class="card">
                <div class="card-header">
                    <h2><?= __('Shopping cart') ?></h2>
                </div>
                <div class="card-body card-padding">
                    <table class="table no-padding">
                        <thead>
                        <tr>
                            <th width="125">Code</th>
                            <th class="text-right" width="150"><?= __('Qty') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($aCart as $item){ ?>
                            <tr>
                                <td><?= $item->article_code ?></td>
                                <td class="text-right"><?= Number::precision($item->quantity,0) ?></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <a class="view-more" href="/Cart/"><?= __('Edit cart') ?></a>
            </div>
        </div>

        <div class="col-xs-9">

            <div class="card">
                <div class="card-header">
                    <h2>Payment</h2>
                </div>
                <div class="card-body card-padding">
                    <ul class="list-group m-b-20">
                        <li class="list-group-item border">
                            <h5>
                                <div class="radio radio-main">
                                    <input id="payment" type="radio" name="payment-method" value="invoice" checked>
                                    <label for="payment">
                                        <?= __('Invoice') ?>
                                        <small> ~ <?= __('Pay after delivery') ?></small>
                                    </label>
                                </div>
                            </h5>
                            <div class="cart-method-info payment-method-info" id="payment_info">
                                <p>
                                    <?= __('Your invoice will be sent to') ?>:
                                </p>
                                <p>
                                    <?php // TODO:: FACT ADRES ?>
                                    Dhr. Mike Gerritsen<br />
                                    Stoker 36<br />
                                    6651 SJ Druten<br />
                                    Nederland
                                </p>

                            </div>
                        </li>
                        <li class="list-group-item border">
                            <h5>
                                <div class="radio radio-main">
                                    <input id="msp" type="radio" name="payment-method" value="msp">
                                    <label for="msp">
                                        <?= __('Online payment') ?>
                                        <small> ~ <?= __('Pay your invoice in advance') ?></small>
                                    </label>
                                </div>
                            </h5>
                            <div class="cart-method-info payment-method-info" id="msp_info" style="display:none;">
                                <p>
                                    <?= __('After confirmation you will be redirected to MultiSavePay') ?>
                                </p>
                            </div>
                        </li>
                    </ul>


                    <ul class="list-group m-b-20">
                        <li class="list-group-item border">
                            <h5>
                                <div class="radio radio-main">
                                    <input id="invoice_address" type="radio" name="invoice-address" value="invoice" checked>
                                    <label for="invoice_address">
                                        <?= __('Coupon code') ?>
                                        <small> ~ <?= __('Redeem your discount here') ?></small>
                                    </label>
                                </div>
                            </h5>
                            <?php // TODO:: COUPON ?>
                            <div class="cart-method-info" id="invoice_address">
                                <input type="text" name="coupon" class="form-control" />
                            </div>
                        </li>
                    </ul>


                    <a href="/Cart/Address/" class="btn btn-default">
                        <i class="fa fa-arrow-left fa-p-r"></i><?= __('Edit addresses') ?>
                    </a>
                    <button type="submit" class="btn btn-hodi pull-right">
                        <?= __('Payment') ?><i class="fa fa-arrow-right fa-p-l"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    $("[name='payment-method']").on('change', function(){
        $(".payment-method-info").hide();
        var $id = $(this).attr('id');
        $('#'+$id+"_info").show();
    });
</script>