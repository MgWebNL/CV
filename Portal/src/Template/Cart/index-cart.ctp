<?php
use Cake\I18n\Number;
?>
<form id="cartArticles" method="post" action="/Cart/processCart">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th width="125">Code</th>
            <th><?= __('Description') ?></th>
            <th class="text-right" width="120"><?= __('Price') ?></th>
            <th width="150"><?= __('Qty') ?></th>
            <th class="text-right" width="120"><?= __('Amount') ?></th>
            <th class="text-right" width="25"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($aCart as $item){ ?>
            <tr>
                <td>
                    <?php $link = (is_null($item->Article) || $item->shopRoot == 'online' || !isset($aCustomerArticles->{$item->article_id})) ? "" : "/Article/View/".$item->article_id ?>
                    <?php if($link == ""){ echo $item->article_code; }else{ echo '<a href="'.$link.'" class="text-link">'.$item->article_code.'</a>'; } ?>
                </td>
                <td><?= $item->article_name ?></td>
                <td class="text-right">&euro; <?= Number::precision($item->article_price,4) ?></td>
                <td class="text-right">
                    <div class="input-group input-group-sm hidden">
                        <span class="input-group-btn">
                            <a class="btn btn-link btn-no-shadow" href="#">
                                <span class="fa fa-minus"></span>
                            </a>
                        </span>
                        <input type="num" class="form-control text-center" value="<?= Number::precision($item->quantity,0) ?>">
                        <span class="input-group-btn">
                            <a class="btn btn-link btn-no-shadow" href="#">
                                <span class="fa fa-plus"></span>
                            </a>
                        </span>
                    </div>

                    <div class="input-group input-group-sm">
                        <?= $item->article_price_force == 1 ? '<input type="hidden" name="force['.$item->article_id.']" value="'.$item->article_price.'">' : '' ?>
                        <input type="number" name="qty[<?= $item->article_id ?>]" data-cart-count="<?= $item->article_id ?>" class="form-control text-center" value="<?= $item->quantity ?>">
<!--                        <span class="input-group-btn">-->
<!--                            <a class="btn btn-link btn-no-shadow" href="#">-->
<!--                                <span class="fa fa-refresh"></span>-->
<!--                            </a>-->
<!--                        </span>-->
                    </div>
                </td>
                <td class="text-right">&euro; <?= Number::precision($item->quantity * $item->article_price,2) ?></td>
                <td class="text-right">
                    <button class="btn btn-danger btn-no-shadow" name="remove" type="submit" value="<?= $item->article_id ?>">
                        <span class="fa fa-trash"></span>
                    </button>
                </td>
            </tr>
        <?php } ?>

        <?php if($iTransportCostCart > 0){ ?>

            <tr>
                <td>TR</td>
                <td><?= __('Transport') ?></td>
                <td class="text-right"></td>
                <td class="text-right">
                </td>
                <td class="text-right">&euro; <?= Number::precision($iTransportCostCart,2) ?></td>
                <td class="text-right">
                </td>
            </tr>

        <?php } ?>

        </tbody>

        <tfoot class="hidden">
            <tr class="separator">
                <td colspan="5"></td>
            </tr>
            <tr>
                <th><?= __('Subtotal') ?></th>
                <td class="visible-xs text-right"></td>
                <td colspan="2" class="hidden-xs text-right"></td>
                <td class="text-right"></td>
                <td class="text-right">&euro; 999.999,99</td>
            </tr>
            <tr>
                <th><?= __('Transport') ?></th>
                <td class="visible-xs text-right"></td>
                <td colspan="2" class="hidden-xs text-right"></td>
                <td class="text-right"></td>
                <td class="text-right">&euro; 999.999,99</td>
            </tr>
            <tr>
                <th><?= __('VAT') ?> 21%</th>
                <td class="visible-xs text-right"></td>
                <td colspan="2" class="hidden-xs text-right"></td>
                <td class="text-right"></td>
                <td class="text-right">&euro; 999.999,99</td>
            </tr>
            <tr>
                <th><?= __('TOTAL') ?></th>
                <td class="visible-xs text-right"></td>
                <td colspan="2" class="hidden-xs text-right"></td>
                <td class="text-right"></td>
                <td class="text-right">&euro; 999.999,99</td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" id="submitType" name="submitType" />
</form>