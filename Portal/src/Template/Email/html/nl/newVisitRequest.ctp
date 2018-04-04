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
                    <td style="padding: 0px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        <h3>Beste <?= HD_COMPANYNAME ?>,</h3>
                        <p class="lead">Er is een nieuwe aanvraag voor een bezoek.</p>
                        <p>
                            <strong>Klantcode:</strong> <?= $customerCode ?><br />
                            <strong>Klant:</strong> <?= $customerName ?><br />
                            <strong>Bezoekdatum:</strong> <?= $date; ?> om <?= $time; ?> <br />
                            <strong>Soort bezoek:</strong> <?= $type == 1 ? "Naar klant" : "Klant komt naar ". HD_COMPANYNAME; ?><br /><br />

                            <strong>Gebruiker:</strong> <?= $userName ?><br />
                            <strong>Email:</strong> <?= $userEmail ?><br /><br />

                            <strong>Reden bezoek:</strong><br />
                            <em><?= nl2br($request) ?></em><br /><br />

                            <strong>Aanvraag beantwoorden:</strong><br />
                            <a href="http://www.hodi-portal.nl/admin.php?sMenuKeuze=adminagendaedititem&id=<?= $id ?>">Afspraak bevestigen</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.hodi-portal.nl/admin.php?sMenuKeuze=adminagendaedititem&id=<?= $id ?>">Afspraak wijzigen</a>
                        </p>

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