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
                        <h3>Beste <?= $username ?>,</h3>
                        <p class="lead">U heeft aangegeven een nieuw wachtwoord te willen ontvangen.</p>
                        <p>Uw nieuwe wachtwoord is: <strong><?= $password ?></strong></p>
                        <p>U kunt inloggen met uw gebruikersnaam en uw nieuwe wachtwoord. U dient dan direct uw wachtwoord te wijzigen.</p>
                        <!-- Callout Panel -->
                        <p class="callout">
                            U kunt ook rechtstreeks inloggen door op deze link te klikken <a href="<?= $link ?>" style="color: #05A4E0;">Klik hier &raquo;</a>
                        </p><!-- /Callout Panel -->

                        <br />
                        <p>Met vriendelijke groet,</p>
                        <p><?= HD_COMPANYNAME ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- 1 Column Text + Button : END -->

</table>
<!-- Email Body : END -->