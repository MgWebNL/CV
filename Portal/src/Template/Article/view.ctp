<?php
use Cake\I18n\Number;
use Cake\I18n\Time;
?>
<!-- CONTENT -->

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h2>
                            <?= __('Article basics') ?>
                        </h2>
                    </div>

                    <div class="card-body card-padding" data-heightgroup="1">
                        <dl class="dl">
                            <dt><?= __('Article code') ?></dt>
                            <dd><?= $aList->BKHARCODE ?></dd>
                        </dl>

                        <dl class="dl">
                            <dt><?= __('My code') ?></dt>
                            <dd>
                                <form method="post" action="/Article/saveCustomerArticleCode/">
                                    <div class="input-group input-group-sm">
                                        <input type="hidden" name="article_id" value="<?= $aList->BKHARNRINT ?>" />
                                        <input type="hidden" name="customer_id" value="<?= $sCustomerNrint ?>" />
                                        <input type="text" name="newCode" class="form-control" value="<?= is_null($aList->HdCustomerArticle) ? "" : $aList->HdCustomerArticle->customer_artNumber ?>" placeholder="Type your order quantity">
                                    <span class="input-group-btn">
                                        <button class="btn btn-hodi" type="submit">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </span>
                                    </div>
                                </form>
                            </dd>
                        </dl>

                        <dl class="dl">
                            <dt><?= __('Description') ?></dt>
                            <dd><?= nl2br($aList->BKHAROMS) ?></dd>
                        </dl>

                        <dl class="dl">
                            <dt><?= __('Dimensions') ?></dt>
                            <dd>
                                <?= Number::precision($aList->Article->BKHAR_LENGTE,0) ." ".$aList->Article->BKHAR_LENGTE_EENHEID ?>
                                x <?= Number::precision($aList->Article->BKHAR_BREEDTE,0) ." ".$aList->Article->BKHAR_BREEDTE_EENHEID ?>
                                <?= ($aList->Article->BKHAR_HOOGTE_NVT != 1) ? " x ".Number::precision($aList->Article->BKHAR_HOOGTE,0) ." ".$aList->Article->BKHAR_HOOGTE_EENHEID: "" ?>
                            </dd>
                        </dl>

                        <?php if($aList->Article->ArticleColor->ORDKLOMS != ""){ ?>
                            <dl class="dl">
                                <dt><?= __('Color') ?></dt>
                                <dd><?= $aList->Article->ArticleColor->ORDKLOMS ?></dd>
                            </dl>
                        <?php } ?>

                        <dl class="dl">
                            <dt><?= __('Quality') ?></dt>
                            <dd><?= $aList->Article->ArticleQuality->BKHQUCODE == "" ? "<em>" . __('N/A') . "</em>" : $aList->Article->ArticleQuality->BKHQUCODE ?></dd>
                        </dl>

                        <?php if($aList->Article->ArticleConstruction->ORDCNSOMS != ""){ ?>
                            <dl class="dl">
                                <dt><?= __('Construction') ?></dt>
                                <dd><?= $aList->Article->ArticleConstruction->ORDCNSOMS ?></dd>
                            </dl>
                        <?php } ?>

                        <dl class="dl">
                            <dt><?= __('Sales unit') ?></dt>
                            <dd>per <?= Number::precision($aList->Article->BKHARINHOUD, 0) ?> x <?= strtolower($aList->Article->ArticleUnit->BKHEHCODE) ?></dd>
                        </dl>

                        <dl class="dl">
                            <dt><?= __('Pallet Qty.') ?></dt>
                            <dd><?= Number::precision($aList->Article->BKHARPALLETFACTOR,0) ?> x <?= strtolower($aList->Article->ArticleUnit->BKHEHCODE) ?></dd>
                        </dl>

                        <dl class="dl">
                            <dt><?= __('Stock item') ?></dt>
                            <dd><?= ($aList->Article->BKHARVOORRAAD == 1) ? __('Yes') : __('No') ?></dd>
                        </dl>

                        <?php if($aList->Article->BKHAR_FSC_NUMMER != ""){ ?>
                            <dl class="dl">
                                <dt>FSC<sup>&reg;</sup> code</dt>
                                <dd><?= $aList->Article->BKHAR_FSC_NUMMER ?></dd>
                            </dl>
                        <?php } ?>

                        <?php if($aList->Article->BKHAREANCODE != ""){ ?>
                            <dl class="dl">
                                <dt><?= __('EAN code') ?></dt>
                                <dd><?= $aList->Article->BKHAREANCODE ?></dd>
                            </dl>
                        <?php } ?>

                        <?php if($aList->Article->StatisticsCode->BKHSCCODE != ""){ ?>
                            <dl class="dl">
                                <dt><?= __('EAN code') ?></dt>
                                <dd><?= $aList->Article->StatisticsCode->BKHSCCODE ?></dd>
                            </dl>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h2>
                        <?= __('Additional info') ?>
                    </h2>
                </div>

                <div class="card-body card-padding" data-heightgroup="1">

                    <dl class="dl">
                        <dt><?= __('Delivery time') ?></dt>
                        <?php $delivery = $aList->Article->BKHARAANTAL > 0 && $aList->Article->BKHARVOORRAAD == 1 ? __('Directly available') : $aList->Article->BKHARLEVERTIJD_IKS . " " . __('days') ?>
                        <dd><?= $delivery ?> </dd>
                    </dl>

                    <dl class="dl">
                        <dt><?= __('Article usage') ?></dt>
                        <dd>
                            <?= Number::precision($aList->ArticleUsage["verbruik"],0) ?> x <?= strtolower($aList->Article->ArticleUnit->BKHEHCODE) ?> <?= __('a month') ?>
                        </dd>
                    </dl>

                    <dl class="dl">
                        <dt><?= __('Latest order qty.') ?></dt>
                        <dd>
                            <?= Number::precision($aList->Savings->oldQuantity,0) ?> x <?= strtolower($aList->Article->ArticleUnit->BKHEHCODE) ?>
                            <?php if($aList->Savings->saving != 0){ ?>
                                <div class="label label-warning pull-right">&euro; <?= Number::precision($aList->Savings->oldPrice,4) ?></div>
                            <?php } ?>
                        </dd>
                    </dl>

                    <dl class="dl">
                        <dt><?= __('Ideal order qty.') ?></dt>
                        <dd>
                            <?= Number::precision($aList->Savings->newQuantity,0) ?> x <?= strtolower($aList->Article->ArticleUnit->BKHEHCODE) ?>
                            <?php if($aList->Savings->saving != 0){ ?>
                                <div class="label label-warning pull-right">&euro; <?= Number::precision($aList->Savings->newPrice,4) ?></div>
                            <?php } ?>
                        </dd>
                    </dl>

                    <dl class="dl">
                        <dt><?= __('Your savings') ?></dt>
                        <dd class="text-success"><strong>&euro; <?= Number::precision($aList->Savings->saving,2) ?></strong></dd>
                    </dl>

                    <?php if($aList->ArticleUsage["besteldatum"] != "") { ?>
                        <?php
                        $oDate = $aList->ArticleUsage["besteldatum"];
                        $oDateNow = new Time();
                        ?>
                        <dl class="dl <?= $oDate < $oDateNow ? "text-danger" : "" ?>">
                            <dt><?= __('Next order date') ?></dt>

                            <dd><?= $oDate->format('d-m-Y') ?></dd>
                        </dl>
                    <?php }else{ ?>
                        <dl class="dl">
                            <dt><?= __('Next order date') ?></dt>

                            <dd><em><?= __('N/A') ?></em></dd>
                        </dl>
                    <?php } ?>

                    <dl class="dl">
                        <dt><?= __('Notify') ?></dt>
                        <dd>
                            <select class="selectpicker" data-ajax-onchange="1">
                                <option value="0"><?= __('When type is frequent') ?></option>
                                <option value="1" <?= (!is_null($aList->HdCustomerArticle) && $aList->HdCustomerArticle->notify == 1) ? "selected" : "" ?>><?= __('Always') ?></option>
                                <option value="-1" <?= (!is_null($aList->HdCustomerArticle) && $aList->HdCustomerArticle->notify == -1) ? "selected" : "" ?>><?= __('Never') ?></option>
                            </select>
                        </dd>
                    </dl>

                    <dl class="dl">
                        <dt><?= __('Order qty') ?></dt>
                        <dd>
                            <form method="post" action="/Cart/add/">
                                <div class="input-group input-group-sm">
                                    <input type="hidden" name="article_id" value="<?= $aList->BKHARNRINT ?>" />
                                    <input type="text" name="quantity" class="form-control" value="<?= round($aList->ArticleUsage["opt_bst"]) ?>" placeholder="Type your order quantity">
                                <span class="input-group-btn">
                                    <button class="btn btn-hodi" type="submit">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </span>
                                </div>
                            </form>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

            <div class="col-xs-12">
                <!-- Recent Posts -->
                <div class="card">
                    <div class="card-header" data-toggle="collapse" data-target="#collapseHistory">
                        <h2>
                            <?= __('Article history') ?>
                        </h2>
                        <div class="actions p-t-5">
                            <a role="button">
                                <i class="more-less fa fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse" id="collapseHistory">
                        <div class="card-body">
                            <div class="card-body card-padding p-t-0">
                                <div>
                                    <ul class="tab-nav">
                                        <li class="active">
                                            <a href="#orderHistory" data-toggle="tab">
                                                <?= __('Orders') ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#quoteHistory" data-toggle="tab">
                                                <?= __('Quotes') ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#invoiceHistory" data-toggle="tab">
                                                <?= __('Invoices') ?>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content p-t-0">
                                        <div role="tabpanel" class="tab-pane active" id="orderHistory">

                                            <table class="table table-sortable table-hover table-condensed no-padding">
                                                <thead>
                                                <tr>
                                                    <th width="125"><?= __('No.') ?></th>
                                                    <th width="200" class="hidden-xs"><?= __('Reference') ?></th>
                                                    <th class="visible-xs"><?= __('Reference') ?></th>
                                                    <th class="hidden-xs" width="125"><?= __('Date') ?></th>
                                                    <th class="hidden-xs"><?= __('Description') ?></th>
                                                    <th class="text-right"><?= __('Quantity') ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($aList->History->Order as $row){ ?>
                                                    <tr data-href="/Order/view/<?= $row->Order->ORDORNRINT ?>">
                                                        <td><?= $row->Order->ORDORNR ?></td>
                                                        <td class="hidden-xs">
                                                            <?=
                                                            $row->Order->ORDORREFERENTIE == "" ?
                                                                "<em>" . __('Not available') . "</em>" :
                                                                $row->Order->ORDORREFERENTIE
                                                            ?>
                                                        </td>
                                                        <td class="visible-xs">
                                                            <?=
                                                            $row->Order->ORDORREFERENTIE == "" ?
                                                                "<em>" . __('Not available') . "</em>" :
                                                                $row->Order->ORDORREFERENTIE
                                                            ?>
                                                        </td>
                                                        <td data-sort="<?= $row->Order->ORDORDATUM->format('Ymd') ?>" class="hidden-xs"><?= $row->Order->ORDORDATUM->format('d-m-Y')  ?></td>
                                                        <td class="hidden-xs">
                                                            <?=
                                                            $row->Order->ORDOROMS == "" ?
                                                                "<em>" . __('Not available') . "</em>" :
                                                                $row->Order->ORDOROMS
                                                            ?>

                                                        </td>
                                                        <td class="text-right"><?= Number::precision($row->ORDRRAANTAL, 0) ?></td>
                                                    </tr>
                                                <?php } ?>

                                                </tbody>
                                            </table>

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="quoteHistory">

                                            <table class="table table-sortable table-hover table-condensed no-padding">
                                                <thead>
                                                <tr>
                                                    <th width="125"><?= __('No.') ?></th>
                                                    <th class="hidden-xs" width="125"><?= __('Date') ?></th>
                                                    <th class="hidden-xs"><?= __('Description') ?></th>
                                                    <th class="text-right"><?= __('Quantity') ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php foreach($aList->History->Quote as $row){ ?>
                                                    <tr data-href="/Quotation/view/<?= $row->Quotation->ORDOFNRINT ?>">
                                                        <td><?= $row->Quotation->ORDOFNR ?></td>
                                                        <td data-sort="<?= $row->Quotation->ORDOFDATUM->format('Ymd') ?>" class="hidden-xs"><?= $row->Quotation->ORDOFDATUM->format('d-m-Y')  ?></td>
                                                        <td class="hidden-xs">
                                                            <?=
                                                            $row->Quotation->ORDOFOMS == "" ?
                                                                "<em>" . __('Not available') . "</em>" :
                                                                $row->Quotation->ORDOFOMS
                                                            ?>

                                                        </td>
                                                        <td class="text-right"><?= Number::precision($row->ORDFRAANTAL, 0) ?></td>
                                                    </tr>
                                                <?php } ?>

                                                </tbody>
                                            </table>

                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="invoiceHistory">

                                            <table class="table table-sortable table-hover table-condensed no-padding">
                                                <thead>
                                                <tr>
                                                    <th width="125"><?= __('No.') ?></th>
                                                    <th width="200" class="hidden-xs"><?= __('Reference') ?></th>
                                                    <th class="visible-xs"><?= __('Reference') ?></th>
                                                    <th class="hidden-xs" width="125"><?= __('Date') ?></th>
                                                    <th class="text-right"><?= __('Quantity') ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php foreach($aList->History->Invoice as $row){ ?>
                                                    <tr data-href="/Invoice/view/<?= $row->Invoice->BKHVFNRINT ?>">
                                                        <td><?= $row->Invoice->BKHVFNR ?></td>
                                                        <td class="hidden-xs">
                                                            <?=
                                                            $row->Invoice->BKHVFTEKST1 == "" ?
                                                                "<em>" . __('Not available') . "</em>" :
                                                                $row->Invoice->BKHVFTEKST1
                                                            ?>
                                                        </td>
                                                        <td class="visible-xs">
                                                            <?=
                                                            $row->Invoice->BKHVFTEKST1 == "" ?
                                                                "<em>" . __('Not available') . "</em>" :
                                                                $row->Invoice->BKHVFTEKST1
                                                            ?>
                                                        </td>
                                                        <td data-sort="<?= $row->Invoice->BKHVFDATUM->format('Ymd') ?>" class="hidden-xs"><?= $row->Invoice->BKHVFDATUM->format('d-m-Y')  ?></td>
                                                        <td class="text-right"><?= Number::precision($row->BKHVRAANTAL, 0) ?></td>
                                                    </tr>
                                                <?php } ?>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-4">

        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Default pricing') ?>
                </h2>
            </div>
            <?php if(!is_null($aList->ArticlePrice)){ ?>
            <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                    <th><?= __('Quantity') ?></th>
                    <th class="text-right"><?= __('Price') ?></th>
                    </thead>

                    <tbody>
                        <?php foreach($aList->ArticlePrice->ArticlePriceLine as $priceline){ ?>
                            <tr>
                                <td><?= Number::precision($priceline->BKHARSAANTAL_LAAG,0) ?></td>
                                <td class="text-right">&euro; <?= Number::precision($priceline->BKHARSPRIJS,4) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php }else{ ?>
                <div class="card-body card-padding">
                    <div class="alert alert-warning m-0">
                        <?= __('No default prices available'); ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Product image') ?>
                </h2>
            </div>
            <div class="card-body">
                <img src="<?= $aList->Image->article_img ?>" class="img-responsive img-thumbnail" />
            </div>
        </div>


    </div>
</div>



<script>
    function toggleIcon(e) {
        $(e.target)
            .prev('.card-header')
            .find(".more-less")
            .toggleClass('fa-plus fa-minus');
    }

    $('#collapseHistory').on('shown.bs.collapse', function (e) {
        reloadTables();
    });
    $('#collapseHistory').on('show.bs.collapse', toggleIcon);
    $('#collapseHistory').on('hide.bs.collapse', toggleIcon);

    $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
        reloadTables();
    });

    function setSameHeight(){
        $('[data-heightgroup]').each(function(){
            var $data = $(this).data('heightgroup');
            var $height = 0;
            $('[data-heightgroup='+$data+']').each(function(){
                $height = $(this).height() > $height ? $(this).height() : $height;
            });
            $('[data-heightgroup='+$data+']').height($height);
        });
    }

    setSameHeight();


    function setData($val) {
        $.ajax({
            type: "post",
            url: '/Article/ajax/saveArticleNotification/',
            data: "customer=<?= $sCustomerNrint ?>&article=<?= $aList->BKHARNRINT ?>&value="+$val,

            error: function () {
                alert('<?= __('Saving your notification preferences failed !') ?>');
            },
        });
    }

    $("[data-ajax-onchange]").on('change', function(){
        var $val = $(this).val();
        setData($val);
    });

</script>