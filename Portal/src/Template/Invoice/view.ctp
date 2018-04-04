<?php
use Cake\I18n\Number;
?>
<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Invoice') ?> #<?= $aInvoice->BKHVFNR ?>
                    <div class="pull-right">
                        <?= $this->Form->postLink('Download CSV', '/Invoice/download/csv/'.$aInvoice->BKHVFNRINT, ['class' => 'btn btn-xs btn-hodi']) ?>
                        <?= $this->Form->postLink('Download PDF', '/Invoice/download/pdf/'.$aInvoice->BKHVFNRINT, ['class' => 'btn btn-xs btn-hodi']) ?>
                    </div>
                </h2>
            </div>

            <div class="card-body card-padding">
                <div class="row">

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Delivery address') ?></dt>
                            <dd>
                                <?php if(!is_null($aInvoice->Order)){ ?>
                                    <address>
                                        <?= $aInvoice->Order->AddressDelivery->BKHAAFNAAM ?><br />
                                        <?php if(!is_null($aInvoice->Order->Contactperson)){ ?>
                                            <?= __('attn.') ?> <?= $aInvoice->Order->Contactperson->BKHCOTOTAALNAAM ?><br />
                                        <?php } ?>
                                        <?= $aInvoice->Order->AddressDelivery->BKHAAFSTRAAT ?> <?= $aInvoice->Order->AddressDelivery->BKHAAFHUISNR ?> <?= $aInvoice->Order->AddressDelivery->BKHAAFHUISNR_TOE ?><br />
                                        <?= $aInvoice->Order->AddressDelivery->BKHAAFPOSTCODE ?> <?= $aInvoice->Order->AddressDelivery->BKHAAFPLAATS ?><br />
                                        <?= $aInvoice->Order->AddressDelivery->Country->BKHLAOMS ?>
                                    </address>
                                <?php }else{ ?>
                                    <?= __('No delivery address available'); ?>
                                <?php } ?>
                            </dd>
                        </dl>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Invoice address') ?></dt>
                            <dd>
                                <address>
                                    <?= $aInvoice->Address->BKHADNAAM ?><br />
                                    <?php if(!is_null($aInvoice->Contactperson)){ ?>
                                        <?= __('attn.') ?> <?= $aInvoice->Contactperson->BKHCOTOTAALNAAM ?><br />
                                    <?php } ?>
                                    <?= $aInvoice->Address->BKHADADRES_W ?> <?= $aInvoice->Address->BKHADRES_HNR ?> <?= $aInvoice->Address->BKHADRES_HNR_TOE ?><br />
                                    <?= $aInvoice->Address->BKHADPOSTCODE ?> <?= $aInvoice->Address->BKHADPLAATS ?><br />
                                    <?= $aInvoice->Address->Country->BKHLAOMS ?>
                                </address>
                            </dd>
                        </dl>
                    </div>

                </div>
                <div class="row ">

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Invoice no.') ?></dt>
                            <dd><?= $aInvoice->BKHVFNR ?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Invoice date') ?></dt>
                            <dd><?= $aInvoice->BKHVFDATUM->format('d-m-Y') ?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Expiry date') ?></dt>
                            <dd class="<?= ($aInvoice->BKHVFSTATUS == 1) ? "text-danger" : "" ?>">
                                <?=
                                    is_null($aInvoice->BKHVFDATUM_VV) ?
                                    "<em>" . __('Not available') . "</em>" :
                                    $aInvoice->BKHVFDATUM_VV->format('d-m-Y')
                                ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Payment date') ?></dt>
                            <dd>
                                <?=
                                is_null($aInvoice->InvoicePaymentsLast["BKHVBDATUM"]) || $aInvoice->BKHVFOPEN != 0 ?
                                    "<em>" . __('Not available') . "</em>" :
                                    $aInvoice->InvoicePaymentsLast["BKHVBDATUM"]->format('d-m-Y')
                                ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Order no.') ?></dt>
                            <dd>
                                <?php if(!is_null($aInvoice->Order)){ ?>
                                    <a class="text-link" href="/Order/view/<?= $aInvoice->Order->ORDORNRINT ?>">
                                        <?= $aInvoice->Order->ORDORNR ?>
                                    </a>
                                <?php }else{ ?>
                                    <?= __('No order numbers available'); ?>
                                <?php } ?>
                            </dd>
                        </dl>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Customer no.') ?></dt>
                            <dd><?= $aInvoice->Address->BKHADCODE ?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('VAT no.') ?></dt>
                            <dd><?=$aInvoice->Address->BKHADBTWNUMMER ?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Your cont. person') ?></dt>
                            <dd>
                                <?=
                                    @!is_null($aInvoice->Order->Contactperson) ?
                                    $aInvoice->Order->Contactperson->BKHCOTOTAALNAAM :
                                    "<em>". __("Not available") ."</em>"
                                ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Your reference') ?></dt>
                            <dd>
                                <?php if(!is_null($aInvoice->Order)){ ?>
                                    <?= $aInvoice->Order->ORDORREFERENTIE ?>
                                <?php }else { ?>
                                    <em><?= __('Not available'); ?></em>
                                <?php } ?>
                            </dd>
                        </dl>
                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12">
                        <hr />
                        <?php if(!empty($aInvoice->InvoiceLine)){ ?>


                            <table class="table table-condensed table-hover no-padding">
                                <thead>
                                    <tr>
                                        <th width="150"><?= __('Article no.') ?></th>
                                        <th class="visible-xs"></th>
                                        <th class="hidden-xs"><?= __('Description') ?></th>
                                        <th class="text-right" width="80"><?= __('Quantity') ?></th>
                                        <th class="hidden-xs text-right" width="100"><?= __('Unit') ?></th>
                                        <th class="hidden-xs" width="50"></th>
                                        <th class="hidden-xs text-right" width="100"><?= __('Unitprice') ?></th>
                                        <th width="50"></th>
                                        <th class="text-right" width="100"><?= __('Amount') ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach($aInvoice->InvoiceLine as $row){ ?>
                                        <tr>
                                            <td>
                                                <a class="text-link" href="/Article/view/<?= $row->Article->BKHARNRINT ?>">
                                                    <?= $row->Article->BKHARCODE ?>
                                                </a>
                                            </td>
                                            <td class="visible-xs"></td>
                                            <td class="hidden-xs"><?= nl2br($row->BKHVROMS) ?></td>
                                            <td class="text-right"><?= Number::precision($row->BKHVRAANTAL,2) ?></td>
                                            <td class="hidden-xs text-right"><?= $row->Article->ArticleUnit->BKHEHCODE ?></td>
                                            <td class="hidden-xs text-right">&euro;</td>
                                            <td class="hidden-xs text-right"><?= Number::precision($row->BKHVRPRIJS,4) ?></td>
                                            <td class="text-right">&euro;</td>
                                            <td class="text-right"><?= Number::precision($row->BKHVRBEDRAG,2) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                                <tfoot>
                                    <tr colspan="99" class="separator"></tr>
                                    <tr>
                                        <th><?= __('Subtotal') ?></th>
                                        <td class="visible-xs"></td>
                                        <td class="hidden-xs"></td>
                                        <td class="text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="text-right">&euro;</td>
                                        <td class="text-right"><?= Number::precision($aInvoice->BKHVFJAAROMZET,2) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('VAT') ?></th>
                                        <td class="visible-xs"></td>
                                        <td class="hidden-xs"></td>
                                        <td class="text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="text-right">&euro;</td>
                                        <td class="text-right"><?= Number::precision($aInvoice->BKHVFBTW,2) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Total amount') ?></th>
                                        <td class="visible-xs"></td>
                                        <td class="hidden-xs"></td>
                                        <td class="text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="hidden-xs text-right"></td>
                                        <td class="text-right">&euro;</td>
                                        <td class="text-right"><?= Number::precision($aInvoice->BKHVFBEDRAG_EUR,2) ?></td>
                                    </tr>

                                    <?php if($aInvoice->BKHVFOPEN_VAL > 0 && $aInvoice->BKHVFOPEN_VAL != $aInvoice->BKHVFBEDRAG_EUR){ ?>
                                        <tr colspan="99" class="separator"></tr>
                                        <tr>
                                            <th><?= __('Paid') ?></th>
                                            <td class="visible-xs"></td>
                                            <td class="hidden-xs"></td>
                                            <td class="text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td class="text-right">&euro;</td>
                                            <td class="text-right"><?= Number::precision($aInvoice->BKHVFBEDRAG_EUR - $aInvoice->BKHVFOPEN_VAL,2) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Open amount') ?></th>
                                            <td class="visible-xs"></td>
                                            <td class="hidden-xs"></td>
                                            <td class="text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td class="text-right">&euro;</td>
                                            <td class="text-right"><?= Number::precision($aInvoice->BKHVFOPEN_VAL,2) ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php if($aInvoice->BKHVFOPEN_VAL > 0) { ?>
                                        <tr>
                                            <th></th>
                                            <td class="visible-xs"></td>
                                            <td class="hidden-xs"></td>
                                            <td class="text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td class="hidden-xs text-right"></td>
                                            <td colspan="2" class="text-right">
                                                <form method="post" action="/Invoice/payInvoiceBatch/" id="paymentForm">
                                                    <select name="gateway" id="gateway" style="width:100%" required>
                                                        <option value="">- Selecteer een betaalmethode -</option>
                                                        <?php foreach($aGateways as $gateway){ ?>
                                                            <option value="<?= $gateway->id ?>"><?= $gateway->description ?></option>
                                                        <?php } ?>
                                                    </select><br /><br />
                                                    <input type="hidden" name="payInvoice[<?= $aInvoice->BKHVFNRINT ?>]" value="<?= $aInvoice->BKHVFOPEN_VAL ?>" />
                                                    <button type="submit" class="btn btn-block btn-success" id="payButton">
                                                        <?= __('Pay invoice') ?>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tfoot>
                            </table>
                        <?php }else{ ?>
                            <div class="alert alert-warning bgm-secondair">
                                <?= __('No invoice rules available'); ?>
                            </div>
                        <?php } ?>
                    </div>

                </div>

            </div>

        </div>
    </div>


</div>