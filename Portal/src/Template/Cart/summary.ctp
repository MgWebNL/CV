<?php
use Cake\I18n\Number;
/**
 * IMPORTANT :: DEFINE CART VAR OUT OF SESSION-VAR !!!
 */
$aCartOptions = $this->request->session()->read('cartOptions');
$aCartOptions2 = $this->request->session()->read('cartOptions2');
?>

<!-- CONTENT -->
<form method="post" action="/Cart/makeOrder/">
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

                        <?php if($iTransportCostCart > 0){ ?>

                            <tr>
                                <td>TR</td>
                                <td class="text-right">1</td>
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
                    <h2><?= __('Summary') ?></h2>
                </div>
                <div class="card-body card-padding">
                    <ul class="list-group m-b-20">
                        <?php if($aCartOptions["delivery-method"] == "deliver") { ?>
                            <li class="list-group-item border">
                                <h5>
                                    <div class="radio radio-main">
                                        <input id="delivery" type="radio" name="delivery-method" value="deliver" checked>
                                        <label for="delivery">
                                            <?= __('Deliver') ?>
                                            <small> ~ <?= __('Deliver at your office or an other delivery address') ?></small>
                                        </label>
                                    </div>
                                </h5>
                                <div class="cart-method-info delivery-method-info" id="delivery_info">
                                    <p>
                                        <?= __('Your order will be delivered at') ?>:
                                    </p>
                                    <p>
                                        <input type="hidden" name="delivery-address" value="<?= $aAddress->BKHAAFNRINT ?>" />
                                        <?= $aAddress->BKHAAFNAAM ?><br />
                                        <?= $aAddress->BKHAAFSTRAAT ?> <?= $aAddress->BKHAAFHUISNR ?><?= $aAddress->BKHAAFHUISNR_TOE ?><br />
                                        <?= $aAddress->BKHAAFPOSTCODE ?> <?= $aAddress->BKHAAFPLAATS ?><br />
                                        <?= $aAddress->BKHLAOMS ?>
                                    </p>
                                </div>
                            </li>
                        <?php }else{ ?>
                            <li class="list-group-item border">
                                <h5>
                                    <div class="radio radio-main">
                                        <input id="pickup" type="radio" value="pickup" checked>
                                        <label for="pickup">
                                            <?= __('Pick up') ?>
                                            <small> ~ <?= __('Pick up your order at our warehouse') ?></small>
                                        </label>
                                    </div>
                                </h5>
                                <div class="cart-method-info delivery-method-info" id="pickup_info">
                                    <p>
                                        <?= __('You can pick up your order at') ?>:
                                    </p>
                                    <addr>
                                        Hodi Verpakkingsmaterialen BV<br />
                                        Kernreactorstraat 1<br />
                                        3903 LG Veenendaal<br />
                                        Nederland
                                    </addr>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>


                    <ul class="list-group m-b-20">
                        <li class="list-group-item border">
                            <h5>
                            <div class="radio radio-main">
                                <input id="invoice_address" type="radio" name="invoice-address" value="invoice" checked>
                                <label for="invoice_address">
                                    <?= __('Invoice') ?>
                                    <small> ~ <?= __('Your invoice will be sent to this address') ?></small>
                                </label>
                            </div>
                            </h5>
                            <div class="cart-method-info" id="invoice_address">
                                <p>
                                    <?= $aCustomer->BKHADNAAM ?><br />
                                    <?= $aCustomer->BKHADADRES_W ?> <?= $aCustomer->BKHADADRES_HNR ?><?= $aCustomer->BKHADADRES_HNR_TOE ?><br />
                                    <?= $aCustomer->BKHADPOSTCODE ?> <?= $aCustomer->BKHADPLAATS ?><br />
                                    <?= $aCustomer->Country->BKHLAOMS ?>
                                </p>
                            </div>
                        </li>
                    </ul>


                    <ul class="list-group m-b-20">
                        <?php if($aCartOptions["delivery-date"] == "sap") { ?>
                        <li class="list-group-item border">
                            <h5>
                                <div class="radio radio-main">
                                    <input id="delivery_sap" type="radio" name="delivery-date" value="sap" checked>
                                    <label for="delivery_sap">
                                        <?= __('Delivery as soon as posible') ?>
                                        <small> ~ <?= __('Your order will be sent when it\'s complete') ?></small>
                                    </label>
                                </div>
                            </h5>
                            <div class="cart-method-info delivery-date-info" id="delivery_sap_info">
                                <p>
                                    <strong><?= __('Estimated delivery date') ?></strong>:
                                    <?= $aDeliveryDateMin->format('d-m-Y'); ?>
                                </p>
                            </div>
                        </li>
                        <?php }else{ ?>
                        <li class="list-group-item border m-b-20">
                            <h5>
                                <div class="radio radio-main">
                                    <input id="delivery_date" type="radio" name="delivery-date" value="date" checked>
                                    <label for="delivery_date">
                                        <?= __('Delivery date') ?>
                                        <small> ~ <?= __('Your items will be delivered separately') ?></small>
                                    </label>
                                </div>
                            </h5>
                            <div class="cart-method-info delivery-date-info" id="delivery_date_info">
                                <table class="table no-padding">
                                    <thead>
                                    <tr>
                                        <th width="125">Code</th>
                                        <th><?= __('Description') ?></th>
                                        <th class="text-right" width="150"><?= __('Qty') ?></th>
                                        <th class="text-right" width="120"><?= __('Delivery date') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($aCart as $item){ ?>
                                        <?php $date = (isset($this->request->session()->read('cartOptions')["del-date"][$item->article_id])) ? $this->request->session()->read('cartOptions')["del-date"][$item->article_id] : $aDeliveryDateMin->format('Y-m-d'); ?>
                                        <tr>
                                            <td><?= $item->article_code ?></td>
                                            <td><?= $item->article_name ?></td>
                                            <td class="text-right"><?= Number::precision($item->quantity,0) ?></td>
                                            <td class="text-right">
                                                <input type="hidden" name="del-date[<?= $item->article_id ?>]" id="del_date_<?= $item->article_id ?>_hid" value="<?= $date ?>" />
                                                <span data-date="<?= $date ?>" id="del_date_<?= $item->article_id ?>"><?= $date ?></span>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>

                    <ul class="list-group m-b-20">

                        <li class="list-group-item border">
                            <h5>
                                <div class="radio radio-main">
                                    <input id="payment" type="radio" name="payment-method" value="invoice" checked>
                                    <label for="payment">
                                        <?= __('Payment by invoice') ?>
                                        <small> ~ <?= __('Pay after delivery') ?></small>
                                    </label>
                                </div>
                            </h5>
                            <div class="cart-method-info payment-method-info" id="payment_info">
                                <p>
                                    <?= __('Your invoice will be sent to') ?>:
                                </p>
                                <p>
                                    <?= $aCustomer->BKHADNAAM ?><br />
                                    <?= $aCustomer->BKHADADRES_W ?> <?= $aCustomer->BKHADADRES_HNR ?><?= $aCustomer->BKHADADRES_HNR_TOE ?><br />
                                    <?= $aCustomer->BKHADPOSTCODE ?> <?= $aCustomer->BKHADPLAATS ?><br />
                                    <?= $aCustomer->Country->BKHLAOMS ?>
                                </p>

                            </div>
                        </li>
                    </ul>

                    <ul class="list-group m-b-20">
                        <li class="list-group-item border">
                            <h5>
                                <div class="radio radio-main">
                                    <input id="reference" type="radio" checked>
                                    <label for="reference">
                                        <?= __('Your reference') ?>
                                        <small> ~ <?= __('Add a reference to your order') ?></small>
                                    </label>
                                </div>
                            </h5>
                            <div class="cart-method-info">
                                <p>
                                    <?= $this->request->session()->read('cartOptions')["reference"] ?>
                                </p>
                            </div>
                        </li>

                        <li class="list-group-item border">
                            <h5>
                                <div class="radio radio-main">
                                    <input id="remark" type="radio" checked>
                                    <label for="remark">
                                        <?= __('Remarks') ?>
                                        <small> ~ <?= __('Add a remark to your order') ?></small>
                                    </label>
                                </div>
                            </h5>
                            <div class="cart-method-info">
                                <p>
                                    <?= nl2br($this->request->session()->read('cartOptions')["remark"]) ?>
                                </p>
                            </div>
                        </li>
                    </ul>


                    <a href="/Cart/Address/" class="btn btn-default">
                        <i class="fa fa-arrow-left fa-p-r"></i><?= __('Edit address') ?>
                    </a>
                    <button type="submit" class="btn btn-hodi pull-right">
                        <?= __('Send order') ?><i class="fa fa-check fa-p-l"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>