<?php
use Cake\I18n\Number;

echo $this->element('Modal/approveQuote');
echo $this->element('Modal/editQuote');
echo $this->element('Modal/rejectQuote');

?>
<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Quotation') ?> #<?= $aQuotation->ORDOFNR ?>
                </h2>
            </div>

            <div class="card-body card-padding">

                <div class="row">

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Quote date') ?></dt>
                            <dd><?= $aQuotation->ORDOFDATUM->format('d-m-Y') ?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Quote no.') ?></dt>
                            <dd><?= $aQuotation->ORDOFNR ?></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Description') ?></dt>
                            <dd>
                                <?=
                                $aQuotation->ORDOFOMS == "" ?
                                "<em>". __("Not available") ."</em>" :
                                $aQuotation->ORDOFOMS
                                ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Your ref.') ?></dt>
                            <dd>
                                <?=
                                $aQuotation->ORDOFREFERENTIE == "" ?
                                "<em>". __("Not available") ."</em>" :
                                $aQuotation->ORDOFREFERENTIE
                                ?>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Your cont. person') ?></dt>
                            <dd><?= $aQuotation->Employee->ORDMWNAAM ?></dd>
                        </dl>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <dl class="dl-horizontal">
                            <dt><?= __('Your address') ?></dt>
                            <dd>
                                <address>
                                    <?= $aQuotation->Address->BKHADNAAM ?><br />
                                    <?php if(!is_null($aQuotation->Contactperson)){ ?>
                                        <?= __('attn.') ?> <?= $aQuotation->Contactperson->BKHCOTOTAALNAAM ?><br />
                                    <?php } ?>
                                    <?= $aQuotation->Address->BKHADADRES_W ?> <?= $aQuotation->Address->BKHADRES_HNR ?> <?= $aQuotation->Address->BKHADRES_HNR_TOE ?><br />
                                    <?= $aQuotation->Address->BKHADPOSTCODE ?> <?= $aQuotation->Address->BKHADPLAATS ?><br />
                                    <?= $aQuotation->Address->Country->BKHLAOMS ?>
                                </address>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?= __('Current status') ?></dt>
                            <dd><?= __($aQuotation->ORDOFSTATUSTEXT['text']) ?></dd>
                        </dl>
                        <?php if($aQuotation->ORDOFSTATUS == 0){ ?>
                            <dl class="dl-horizontal">
                                <dt><?= __('Edit status') ?></dt>
                                <dd>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-hodi btn-xs btn-no-shadow dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Make a choice') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="hover-success"><a href="#approveQuote" data-toggle="modal"><?= __('Aprove quote') ?></a></li>
                                            <li class="hover-danger"><a href="#editQuote" data-toggle="modal"><?= __('Reject quote') ?></a></li>
                                            <li class="hover-warning hidden"><a href="#rejectQuote" data-toggle="modal"><?= __('Edit quote') ?></a></li>
                                        </ul>
                                    </div>
                                </dd>
                            </dl>
                        <?php } ?>
                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12">

                        <hr />

                        <table class="table table-condensed table-hover no-padding">
                            <thead>
                                <tr>
                                    <th width="150"><?= __('Article no.') ?></th>
                                    <th class="visible-xs"></th>
                                    <th class="hidden-xs"><?= __('Description') ?></th>
                                    <th class="text-right" width="80"><?= __('Quantity') ?></th>
                                    <th class="hidden-xs text-right" width="100"><?= __('Unit') ?></th>
                                    <th width="50"></th>
                                    <th class="text-right" width="100"><?= __('Unitprice') ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($aQuotation->QuotationLine as $row){ ?>
                                <?php $rowspan = !empty($row->QuotationLinePrices) ? count($row->QuotationLinePrices) + 1 : 1; ?>
                                <?php $precision = substr(Number::precision($row->ORDFRAANTAL,2),-2) == "00" ? 0 : 2 ?>
                                <?php @$link = $aOrderCount[$row->ORDFR_BKHADNRINT] == 0 ? false : true ?>
                                <tr>
                                    <td rowspan="<?= $rowspan ?>">
                                        <?php if($link){ ?>
                                            <a class="text-link" href="/Article/view/<?= $row->Article->BKHARNRINT ?>">
                                                <?= $row->Article->BKHARCODE ?>
                                            </a>
                                        <?php }else{ ?>
                                            <?= $row->Article->BKHARCODE ?>
                                        <?php } ?>
                                    </td>
                                    <td rowspan="<?= $rowspan ?>" class="visible-xs"></td>
                                    <td rowspan="<?= $rowspan ?>" class="hidden-xs"><?= nl2br($row->ORDFROMS) ?></td>
                                    <td class="text-right"><strong><?= Number::precision($row->ORDFRAANTAL,$precision) ?></strong></td>
                                    <td class="hidden-xs text-right"><strong><?= $row->Article->ArticleUnit->BKHEHCODE ?></strong></td>
                                    <td class="text-right"><strong>&euro;</strong></td>
                                    <td class="text-right">
                                        <strong><?= Number::precision($row->ORDFRPRIJS,4) ?></strong>
                                    </td>
                                </tr>


                                <?php if($rowspan > 1){ ?>
                                    <?php foreach($row->QuotationLinePrices as $line){ ?>
                                        <tr>
                                            <td class="text-small text-right"><?= Number::precision($line->ORDOSTAANTAL,$precision) ?></td>
                                            <td class="text-small hidden-xs text-right">&nbsp;</td>
                                            <td class="text-small text-right">&euro;</td>
                                            <td class="text-small text-right">
                                                <?= Number::precision($line->ORDOSTPRIJS,4) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>

                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </div>


</div>