<?php use Cake\I18n\Number; ?>
<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">

        <?= $this->Flash->render('passwordError') ?>

        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Account') ?>
                </h2>
            </div>

            <div class="card-body card-padding hidden">
                <div class="card-body p-t-0">
                    <ul class="tab-nav" <?php if(HD_MAIN_COLOR_TEXT != "blue"){ echo 'data-tab-color="'.HD_MAIN_COLOR_TEXT.'"'; } ?>>
                        <li class="active">
                            <a href="#accountInfo" data-toggle="tab">
                                <?= __('Info') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#accountContacts" data-toggle="tab">
                                <?= __('Personnel') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#accountAddresses" data-toggle="tab">
                                <?= __('Addresses') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#accountEmails" data-toggle="tab">
                                <?= __('Emails') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#accountSettings" data-toggle="tab">
                                <?= __('Settings') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#accountUsers" data-toggle="tab">
                                <?= __('Users') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content p-t-0">
            <div role="tabpanel" class="tab-pane active" id="accountInfo">
                <div class="row">
                    <div class="col-md-4">

                        <!-- COMPANY INFO -->
                        <div class="card">
                            <div class="card-header bgm-hodi">
                                <h2><?= __('Company info') ?></h2>
                            </div>

                            <div class="card-body">
                                <table class="table table-condensed">
                                    <tr>
                                        <th width="50%"><?= __('Company name') ?></th>
                                        <td width="50%"><?= $aAddress->BKHADNAAM ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Street + no.') ?></th>
                                        <td><?= $aAddress->BKHADADRES_W ?> <?= $aAddress->BKHADADRES_HNR ?><?= $aAddress->BKHADADRES_HNR_TOE ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Postal code') ?></th>
                                        <td><?= $aAddress->BKHADPOSTCODE ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Town') ?></th>
                                        <td><?= $aAddress->BKHADPLAATS ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Country') ?></th>
                                        <td><?= $aAddress->Country->BKHLAOMS ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Username') ?></th>
                                        <td><?= $aAddress->BKHADGEBRUIKERSNAAM ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Website') ?></th>
                                        <td>
                                            <a href="http://<?= $aAddress->BKHADWEBSITE ?>" target="_blank">
                                                <?= $aAddress->BKHADWEBSITE ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Telephone') ?></th>
                                        <td>
                                            <a href="tel:<?= $aAddress->BKHADTELEFOON ?>">
                                                <?= $aAddress->BKHADTELEFOON ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Account manager') ?></th>
                                        <td><?= $aAddress->HdAddress->Employee->ORDMWNAAM ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Payment info -->
                        <div class="card">
                            <div class="card-header bgm-hodi">
                                <h2>Payment info</h2>
                            </div>

                            <div class="card-body">
                                <table class="table table-condensed">
                                    <tr>
                                        <th width="50%"><?= __('Bank account') ?></th>
                                        <td width="50%"><?= $aAddress->BKHADIBAN ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('VAT no.') ?></th>
                                        <td><?= $aAddress->BKHADBTWNUMMER ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Payment conditions') ?></th>
                                        <td><?= $aAddress->PaymentCondition->BKHBTOMS ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Payment method') ?></th>
                                        <td><?= $aAddress->PaymentMethod->BKHBWOMS ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Pay rate') ?></th>
                                        <td><?= Number::precision($aPayRate->AvgPayRate,0) ?> <?=  __('days') ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Open amount') ?></th>
                                        <td>&euro; <?= Number::precision($aOpenAmount->Total->amount,2) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Part expired') ?></th>
                                        <td>&euro; <?= Number::precision($aOpenAmount->Late->amount,2) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <!-- Contacts -->
                        <div class="card">
                            <div class="card-header bgm-hodi">
                                <h2><?= __('Contacts') ?></h2>
                            </div>

                            <div class="card-body">
                                <table class="table table-condensed">
                                    <?php foreach($aContactperson as $pers){ ?>
                                    <tr>
                                        <th width="50%">
                                            <span
                                                data-trigger="hover"
                                                data-toggle="popover"
                                                data-html="true"
                                                data-placement="right"
                                                data-original-title="<?= __('Contact type') ?>"
                                                data-content="
                                                    <table width='250' class='deliverydateTable'>
                                                    <tr><th width='80%'><?= __('Type') ?></th><th class='text-right'><?= __('Active') ?></th></tr>

                                                    <tr><td><?= __('Quote') ?></td><td class='text-center'><?= ($pers->BKHCO_EMAIL_OF == 1) ? "<i class='fa fa-check'></i>" : "" ?></td></tr>
                                                    <tr><td><?= __('Order') ?></td><td class='text-center'><?= ($pers->BKHCO_EMAIL_OR == 1) ? "<i class='fa fa-check'></i>" : "" ?></td></tr>
                                                    <tr><td><?= __('Invoice') ?></td><td class='text-center'><?= ($pers->BKHCO_EMAIL_VF == 1) ? "<i class='fa fa-check'></i>" : "" ?></td></tr>
                                                    <tr><td><?= __('Purchase') ?></td><td class='text-center'><?= ($pers->BKHCO_EMAIL_INK == 1) ? "<i class='fa fa-check'></i>" : "" ?></td></tr>
                                                    <tr><td><?= __('Packinglist') ?></td><td class='text-center'><?= ($pers->BKHCO_EMAIL_PAK == 1) ? "<i class='fa fa-check'></i>" : "" ?></td></tr>

                                                    </table>
                                                ">

                                                <attr><?= $pers->BKHCOTOTAALNAAM ?></attr>

                                            </span>
                                        </th>
                                        <td width="50%">
                                            <?= $pers->BKHCOEMAIL ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>

                        <!-- Addresses -->
                        <div class="card">
                            <div class="card-header bgm-hodi">
                                <h2><?= __('Addresses') ?></h2>
                            </div>

                            <div class="card-body">
                                <table class="table table-condensed">
                                    <?php foreach($aDeliveryAddress as $address){ ?>
                                    <tr>
                                        <th width="50%">
                                            <span
                                                data-trigger="hover"
                                                data-toggle="popover"
                                                data-html="true"
                                                data-placement="right"
                                                data-original-title="<?= __('Delivery address') ?>"
                                                data-content="

                                                        <?= $address->BKHAAFNAAM ?><br />
                                                        <?= $address->BKHAAFSTRAAT ?> <?= $address->BKHAAFHUISNR ?><?= $address->BKHAAFHUISNRTOE ?><br />
                                                        <?= $address->BKHAAFPOSTCODE ?> <?= $address->BKHAAFPLAATS ?><br />
                                                        <?= $address->Country->BKHLAOMS ?>

                                                ">

                                                <attr><?= $address->BKHAAFSTRAAT ?> <?= $address->BKHAAFHUISNR ?><?= $address->BKHAAFHUISNRTOE ?></attr>

                                            </span>

                                        </th>
                                        <td width="50%"><?= $address->BKHAAFPLAATS ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="card">
                            <div class="card-header bgm-hodi">
                                <h2><?= __('Change password') ?></h2>
                            </div>

                            <div class="card-body">
                                <form method="post" action="/Account/changePassword/">

                                    <table class="table table-condensed">
                                        <tr>
                                            <td width="100%">
                                                <p class="m-0 p-0"><?= __('Your password needs to contain 1 uppercase, 1 lowercase, 1 number and a minimum length of 6 characters.') ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="password" required class="form-control" name="passwordNew" placeholder="<?= __('Type your new password') ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><input type="password" required class="form-control" name="passwordNewRetype" placeholder="<?= __('Retype your new password') ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn btn-hodi btn-block" type="submit">
                                                    <?= __('Update password') ?>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="card rating-list hidden text-center">
                            <div class="card-header bgm-green">
                                <h2>We score</h2>
                            </div>

                            <h1>8.3 / 10</h1>
                            <div class="rl-star">
                                <i class="zmdi zmdi-star active"></i>
                                <i class="zmdi zmdi-star active"></i>
                                <i class="zmdi zmdi-star active"></i>
                                <i class="zmdi zmdi-star active"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <div class="card-body card-padding p-b-0 p-t-10">
                                <a class="btn btn-hodi btn-block disabled" href="#">
                                    <?= __('Please, rate us') ?><?= __('You already rated us with') ?> 6.8 !
                                </a>
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="card">
                            <div class="card-header bgm-hodi">
                                <h2><?= __('Newsletters') ?></h2>
                            </div>

                            <div class="card-body">
                                <table class="table table-condensed">
                                    <tr>
                                        <th width="50%">
                                            <label for="news1" class="text-bold"><?= __('Company info') ?></label>
                                        </th>
                                        <td width="50%">
                                            <div class="toggle-switch" data-ts-color="green">
                                                <input id="news1" <?= ($aAddress->HdAddress->newsletter == 1) ? "checked" : "" ?> data-ajax-onchange="newsletter" type="checkbox" hidden="hidden">
                                                <label for="news1" class="ts-helper"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="news2" class="text-bold"><?= __('Special offers') ?></label></th>
                                        <td>
                                            <div class="toggle-switch" data-ts-color="green">
                                                <input id="news2" <?= ($aAddress->HdAddress->newsletter_offers == 1) ? "checked" : "" ?> data-ajax-onchange="newsletter_offers" type="checkbox" hidden="hidden">
                                                <label for="news2" class="ts-helper"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="news3" class="text-bold"><?= __('Our partners') ?></label></th>
                                        <td>
                                            <div class="toggle-switch" data-ts-color="green">
                                                <input id="news3" <?= ($aAddress->HdAddress->newsletter_partners == 1) ? "checked" : "" ?> data-ajax-onchange="newsletter_partners" type="checkbox" hidden="hidden">
                                                <label for="news3" class="ts-helper"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="card">
                            <div class="card-header bgm-hodi">
                                <h2><?= __('Suggestions') ?></h2>
                            </div>

                            <div class="card-body">
                                <form method="post" action="/Account/sendSuggestion/">
                                    <table class="table table-condensed">
                                        <tr>
                                            <td>
                                                <textarea name="inputSuggestion" class="form-control" rows="5"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn btn-hodi btn-block" type="submit">
                                                    <?= __('Send suggestions') ?>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<script>
    function setData($nrint, $field, $bool, $parent) {
        $.ajax({
            type: "post",
            url: '/Account/ajax/saveNewsletter/',
            data: "field="+$field+'&value='+$bool+"&nrint="+$nrint,

            error: function () {
                alert('<?= __('Saving your newsletter preferences failed !') ?>');
                $parent.prop("checked", !$parent.prop("checked"));
            },
        });
    }

    $("[data-ajax-onchange]").on('change', function(){
        var $bool = $(this).prop('checked') ? 1 : 0;
        var $field = $(this).data('ajax-onchange');

        setData('<?= $aAddress->BKHADNRINT ?>', $field, $bool, $(this));
    });
</script>