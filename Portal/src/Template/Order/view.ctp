<?php
use Cake\I18n\Number;
use Cake\I18n\Time;
?>

<?php foreach($aOrder->OrderLine as $row){ ?>
    <?php $iToDemand = $row->ORDRR_INAFROEP - $row->ORDRR_AANTAL_AFGEROEPEN; ?>
<?php } ?>
<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Order') ?> #<?= $aOrder->ORDORNR ?>
                    <?php if($aOrder->ORDORSTATUSTEXT["text"] == "On demand"){ ?>
                        <form method="post" action="/Cart/reorder/">
                            <?php foreach($aOrder->OrderLine as $row){ ?>
                                <?php if($row->Article->BKHARNRINT != HD_CART_TRANS_ART_ID){ ?>
                                    <input type="hidden" name="article[<?= $row->ORDRRNRINT ?>]" value="<?= $row->Article->BKHARNRINT ?>" />
                                    <input type="hidden" name="quantity[<?= $row->ORDRRNRINT ?>]" value="<?= $iToDemand ?>" />
                                <?php } ?>
                            <?php } ?>
                            <button class="btn btn-xs btn-hodi btn-no-shadow pull-right" type="submit">
                                <i class="fa fa-shopping-cart fa-p-r"></i> <?= __('Demand this article') ?>
                            </button>
                        </form>
                    <?php }else{ ?>
                        <form method="post" action="/Cart/reorder/">
                            <?php foreach($aOrder->OrderLine as $row){ ?>
                                <?php if($row->Article->BKHARNRINT != HD_CART_TRANS_ART_ID){ ?>
                                    <input type="hidden" name="article[<?= $row->ORDRRNRINT ?>]" value="<?= $row->Article->BKHARNRINT ?>" />
                                    <input type="hidden" name="quantity[<?= $row->ORDRRNRINT ?>]" value="<?= $row->ORDRRAANTAL ?>" />
                                <?php } ?>
                            <?php } ?>
                            <button class="btn btn-xs btn-hodi btn-no-shadow pull-right" type="submit">
                                <i class="fa fa-refresh fa-p-r"></i> <?= __('Re-order order') ?>
                            </button>
                        </form>
                    <?php } ?>
                </h2>
            </div>

            <div class="card-body card-padding">
                <div class="row">

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Delivery address') ?></dt>
                            <dd>
                                <address>
                                    <?= $aOrder->AddressDelivery->BKHAAFNAAM ?><br />
                                    <?php if(!is_null($aOrder->Contactperson)){ ?>
                                        <?= __('attn.') ?> <?= $aOrder->Contactperson->BKHCOTOTAALNAAM ?><br />
                                    <?php } ?>
                                    <?= $aOrder->AddressDelivery->BKHAAFSTRAAT ?> <?= $aOrder->AddressDelivery->BKHAAFHUISNR ?> <?= $aOrder->AddressDelivery->BKHAAFHUISNR_TOE ?><br />
                                    <?= $aOrder->AddressDelivery->BKHAAFPOSTCODE ?> <?= $aOrder->AddressDelivery->BKHAAFPLAATS ?><br />
                                    <?= $aOrder->AddressDelivery->Country->BKHLAOMS ?>
                                </address>
                            </dd>
                        </dl>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Invoice address') ?></dt>
                            <dd>
                                <address>
                                    <?= $aOrder->Address->BKHADNAAM ?><br />
                                    <?php if(!is_null($aOrder->Contactperson)){ ?>
                                        <?= __('attn.') ?> <?= $aOrder->Contactperson->BKHCOTOTAALNAAM ?><br />
                                    <?php } ?>
                                    <?= $aOrder->Address->BKHADADRES_W ?> <?= $aOrder->Address->BKHADRES_HNR ?> <?= $aOrder->Address->BKHADRES_HNR_TOE ?><br />
                                    <?= $aOrder->Address->BKHADPOSTCODE ?> <?= $aOrder->Address->BKHADPLAATS ?><br />
                                    <?= $aOrder->Address->Country->BKHLAOMS ?>
                                </address>
                            </dd>
                        </dl>
                    </div>

                </div>
                <div class="row">

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Order no.') ?></dt>
                            <dd><?= $aOrder->ORDORNR ?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Description') ?></dt>
                            <dd>
                                <?=
                                $aOrder->ORDOROMS == "" ?
                                "<em>". __("Not available") ."</em>" :
                                    $aOrder->ORDOROMS
                                ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Your ref.') ?></dt>
                            <dd>
                                <?=
                                $aOrder->ORDORREFERENTIE == "" ?
                                "<em>". __("Not available") ."</em>" :
                                    $aOrder->ORDORREFERENTIE
                                ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Your cont. person') ?></dt>
                            <dd>
                                <?=
                                    $aOrder->Contactperson == "" ?
                                    "<em>". __("Not available") ."</em>" :
                                    $aOrder->Contactperson->BKHCOTOTAALNAAM
                                ?>
                            </dd>
                        </dl>
                        <?php if(!empty($aInvoices)){ ?>
                            <dl class="dl-horizontal">
                                <dt><?= __('Invoices') ?></dt>
                                <dd>
                                    <?php foreach($aInvoices as $inv){ ?>
                                        <a href="/Invoice/view/<?= $inv["BKHVFNRINT"] ?>" class="btn btn-xs btn-hodi">Factuur <?= $inv["BKHVFNR"] ?></a>
                                    <?php } ?>
                                </dd>
                            </dl>
                        <?php } ?>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Order status') ?></dt>
                            <dd>
                                <?= __($aOrder->ORDORSTATUSTEXT['text']) ?>
                                <?php
                                if($aTraces->count() > 0){
                                    echo "<br />";
                                    foreach($aTraces as $trace){
                                        $link = 'http://www.packntrace.nu/login/'.$trace->tt_trackingnumber.'/'.intval($trace->tt_follownumber).'/'.$aOrder->AddressDelivery->BKHAAFPOSTCODE.'/'.$aOrder->AddressDelivery->Country->BKHLAOMS.'/';
                                        $icon = ($trace->tt_last_status == 4) ? "fa-check" : "fa-truck fa-flip-horizontal";
                                        echo '<a href="'.$link.'" target="_packtrace" class="btn btn-hodi m-t-5 m-r-10 btn-xs btn-no-shadow">
                                              <i class="m-r-5 fa '.$icon.'"></i> '.__('Shipment').' '.intval($trace->tt_follownumber).'</a>';
                                    }
                                }
                                ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Order date') ?></dt>
                            <dd><?= $aOrder->ORDORDATUM->format('d-m-Y') ?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Delivery date') ?></dt>
                            <dd>
                                <?php
                                if($aOrder->deliveryDate == "NA"){
                                    echo __('Not available');
                                }elseif($aOrder->deliveryDate != "tooltip"){
                                    //$time = new Time();
                                    echo $aOrder->deliveryDate->format('d-m-Y');
                                }else{ ?>
                                    <span
                                        data-trigger="hover"
                                        data-toggle="popover"
                                        data-html="true"
                                        data-placement="left"
                                        data-original-title="<?= __('Delivery date') ?>"
                                        data-content="
                                            <table width='250' class='deliverydateTable'>
                                            <tr><th><?= __('Article code') ?></th><th class='text-right'><?= __('Delivery date') ?></th></tr>
                                            <?php foreach($aOrder->OrderLine as $rule){ ?>
                                                <tr>
                                                    <td><?= $rule->Article->BKHARCODE ?></td>
                                                    <td class='text-right'>
                                                        <?=
                                            is_null($rule->ORDRR_LEVERDATUM) || $rule->ORDRR_LEVERDATUM->format('d-m-Y') == "30-11--0001" ?
                                                "<em>" . __('Not available') . "</em>" :
                                                $rule->ORDRR_LEVERDATUM->format('d-m-Y')
                                            ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </table>
                                        ">

                                        <attr><?= __('More info') ?></attr>

                                    </span>
                                <?php } ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Our cont. person') ?></dt>
                            <dd><?= $aOrder->Employee->ORDMWNAAM ?>
                            </dd>
                        </dl>
                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12">

                        <hr />

                        <?php if($aOrder->ORDORSTATUSTEXT["text"] == "On demand"){ ?>
                            <table class="table table-condensed table-hover no-padding">
                                <thead>
                                <tr>
                                    <th width="150"><?= __('Article no.') ?></th>
                                    <th class="visible-xs"></th>
                                    <th class="hidden-xs"><?= __('Description') ?></th>
                                    <th class="text-right" width="80"><?= __('Quantity') ?></th>
                                    <th class="hidden-xs text-right" width="100"><?= __('Unit') ?></th>
                                    <th class="text-right" width="100"><?= __('Demanded') ?></th>
                                    <th class="hidden-xs text-right" width="100"><?= __('To demand') ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach($aOrder->OrderLine as $row){ ?>
                                    <?php $precision = substr(Number::precision($row->ORDRR_INAFROEP,2), -2) == "00" ? 0 : 2; ?>
                                    <tr>
                                        <td>
                                            <a class="text-link" href="/Article/view/<?= $row->Article->BKHARNRINT ?>/<?= $row->ORDRR_INAFROEP ?>/">
                                                <?= $row->Article->BKHARCODE ?>
                                            </a>
                                        </td>
                                        <td class="visible-xs"></td>
                                        <td class="hidden-xs"><?= nl2br($row->ORDRROMS) ?></td>
                                        <td class="text-right"><?= Number::precision($row->ORDRR_INAFROEP,$precision) ?></td>
                                        <td class="hidden-xs text-right"><?= $row->Article->ArticleUnit->BKHEHCODE ?></td>
                                        <td class="hidden-xs text-right"><?= Number::precision($row->ORDRR_AANTAL_AFGEROEPEN,0) ?></td>
                                        <td class="text-right"><?= Number::precision($iToDemand,0) ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php }else{ ?>
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
                                    <?php foreach($aOrder->OrderLine as $row){ ?>
                                    <?php $precision = substr(Number::precision($row->ORDRRAANTAL,2), -2) == "00" ? 0 : 2; ?>
                                    <tr>
                                        <td>
                                            <a class="text-link" href="/Article/view/<?= $row->Article->BKHARNRINT ?>/<?= $row->ORDRR_INAFROEP ?>/">
                                                <?= $row->Article->BKHARCODE ?>
                                            </a>
                                        </td>
                                        <td class="visible-xs"></td>
                                        <td class="hidden-xs"><?= nl2br($row->ORDRROMS) ?></td>
                                        <td class="text-right"><?= Number::precision($row->ORDRRAANTAL,$precision) ?></td>
                                        <td class="hidden-xs text-right"><?= $row->Article->ArticleUnit->BKHEHCODE ?></td>
                                        <td class="hidden-xs text-right">&euro;</td>
                                        <td class="hidden-xs text-right"><?= Number::precision($row->ORDRRPRIJS,4) ?></td>
                                        <td class="text-right">&euro;</td>
                                        <td class="text-right"><?= Number::precision($row->ORDRRBEDRAG,2) ?></td>
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
                                        <td class="text-right"><?= Number::precision($aOrder->ORDORBEDRAG_VAL,2) ?></td>
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
                                        <td class="text-right"><?= Number::precision($aOrder->ORDORBEDRAG_BTW,2) ?></td>
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
                                        <td class="text-right"><?= Number::precision($aOrder->ORDORBEDRAG_INCL,2) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        <?php } ?>
                    </div>

                </div>

            </div>

        </div>
    </div>


</div>