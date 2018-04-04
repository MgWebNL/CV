<?php
use Cake\I18n\Number;
?>
<!-- Email Body : BEGIN -->
<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">
    <!-- LOGO : BEGIN -->
    <tr>
        <td bgcolor="#ffffff">
            <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td style="padding: 0px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        <img src="https://www.hodi-portal.nl/portal/img/logos/default_<?= HD_COMPANYCODE ?>.jpg" width="160" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- 1 Column Text + Button : END -->

    <!-- 1 Column Text + Button : BEGIN -->
    <tr>
        <td bgcolor="#ffffff">
            <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td style="padding: 0px; font-family: sans-serif; font-size: 13px; line-height: 20px; color: #555555;">
                        <h3>Beste <?= HD_COMPANYNAME ?>,</h3>
                        <p class="lead">Er is een nieuwe order binnengekomen.</p>


                        <table width="100%" style="padding: 0px; font-family: sans-serif; font-size: 13px; line-height: 20px; color: #555555;">
                            <tr style="padding-bottom: 20px; vertical-align: top;">
                                <td width="50%">
                                    <h5>Factuuradres</h5>
                                    <?= $aCart["basis"]["adres"] ?>
                                </td>
                                <td width="50%">
                                    <h5>Afleveradres</h5>
                                    <?= $aCart["basis"]["delAdres"] ?>
                                </td>
                            </tr>

                            <tr style="padding-bottom: 20px; vertical-align: top;">
                                <td width="50%">
                                    <h5>Ordergegevens</h5>
                                    <strong>Ordernummer:</strong> <?= $aOrder->ordernumber ?><br />
                                    <strong>Leverdatum:</strong> <?= date('d-m-Y', strtotime($aCart["basis"]["delDate"])) ?><br />
                                    <strong>Orderreferentie:</strong> <?= $aOrder->orderreference ?><br />
                                    <strong>Contactpersoon:</strong> <?= $aOrder->contactperson ?>
                                </td>
                                <td width="50%">
                                    <h5>Opmerkingen</h5>
                                    <?= $aOrder->remarks ?>
                                </td>
                            </tr>

                            <tr style="padding-bottom: 20px;">
                                <td colspan="2">
                                    <h5>Artikelen</h5>
                                    <table width="100%" style="padding: 0px; font-family: sans-serif; font-size: 12px; line-height: 20px; color: #555555;">
                                        <tr style="padding-bottom: 10px;">
                                            <td width="100"><strong>Code</strong></td>
                                            <td><strong>Omschrijving</strong></td>
                                            <td width="80" align="right"><strong>Aantal</strong></td>
                                            <td width="80" align="right"><strong>Prijs</strong></td>
                                            <td width="100" align="right"><strong>Leverdatum</strong></td>
                                        </tr>
                                        <?php foreach($aOrder->TempOrderRules as $rule){ ?>
                                            <tr style="padding-bottom: 10px; vertical-align: top;">
                                                <td width="150"><?= $rule->article ?></td>
                                                <td><?= $rule->description ?></td>
                                                <td align="right"><?= $rule->quantity ?></td>
                                                <td align="right">&euro; <?= Number::precision($rule->price,4); ?></td>
                                                <td align="right"><?= $rule->deliverydate->format('d-m-Y') ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <br />
                        <p>Met vriendelijke groet,</p>
                        <p><?= HD_COMPANYNAME ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- 1 Column Text + Button : BEGIN -->

</table>
<!-- Email Body : END -->