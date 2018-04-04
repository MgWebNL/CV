<?php
use Cake\I18n\Time;
?>

<!-- Modal -->
<?= $this->element('Modal/request'); ?>

<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Orders') ?> - <?= __($sStatus) ?>
                    <div class="pull-right">
                        <a href="#" class="btn btn-xs btn-secondair btn-no-shadow" data-toggle="modal" data-target="#requestModal" title="<?= __('New request') ?>">
                            <i class="fa fa-plus"></i> <?= __('New request') ?>
                        </a>
                    </div>
                </h2>
            </div>

            <?php if(count($aList) == 0){ ?>
                <div class="card-body card-padding">
                    <div class="alert alert-warning bgm-secondair m-b-0">
                        <?= __('No items available'); ?>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="card-body card-padding">
                    <table class="table table-sortable table-hover table-condensed no-padding">
                        <thead>
                        <tr>
                            <th width="125">Ref.</th>
                            <th width="125"><?= __('No.') ?></th>
                            <th class="visible-xs"></th>
                            <th class="hidden-xs" width="125"><?= __('Date') ?></th>
                            <th class="hidden-xs"><?= __('Description') ?></th>
                            <th class="text-right" width="80"><?= __('Status') ?></th>
                            <th class="hidden-xs text-right" width="125"><?= __('Delivery date') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($aList as $row){ ?>
                            <tr>
                                <td data-href="/Order/view/<?= $row->ORDORNRINT ?>"><?= ($row->ORDORREFERENTIE == "") ? "<em>" . __("N/A") . "</em>" : $row->ORDORREFERENTIE ?></td>
                                <td data-href="/Order/view/<?= $row->ORDORNRINT ?>"><?= $row->ORDORNR ?></td>
                                <td data-href="/Order/view/<?= $row->ORDORNRINT ?>" class="visible-xs"></td>
                                <td data-href="/Order/view/<?= $row->ORDORNRINT ?>" data-sort="<?= $row->ORDORDATUM->format('Ymd') ?>" class="hidden-xs"><?= $row->ORDORDATUM->format('d-m-Y') ?></td>
                                <td data-href="/Order/view/<?= $row->ORDORNRINT ?>" class="hidden-xs">
                                    <?=
                                    $row->ORDOROMS == "" ?
                                    "<em>" . __('Not available') . "</em>" :
                                        $row->ORDOROMS
                                    ?>

                                </td>
                                <td data-href="/Order/view/<?= $row->ORDORNRINT ?>" class="text-right">
                                    <?= __($row->ORDORSTATUSTEXT['text']) ?>
                                </td>
                                <td class="text-right hidden-xs">
                                    <?php
                                    if($row->deliveryDate == "NA"){
                                        echo __('Not available');
                                    }elseif($row->deliveryDate != "tooltip"){
                                        $time = new Time($row->deliveryDate);
                                        echo $time->format('d-m-Y');
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
                                            <?php foreach($row->OrderLine as $rule){ ?>
                                                <tr>
                                                    <td><?= $rule->Article->BKHARCODE ?></td>
                                                    <td class='text-right'>
                                                        <?=
                                                            is_null($rule->ORDRR_LEVERDATUM) || $rule->ORDRR_LEVERDATUM->format('d-m-Y') == "30-11--0001" || $rule->ORDRR_LEVERDATUM->format('d-m-Y') == "00-00-0000"?
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
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            <?php } ?>

        </div>
    </div>


</div>