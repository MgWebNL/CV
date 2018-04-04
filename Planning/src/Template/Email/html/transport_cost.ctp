<html>
    <head>
        <title></title>
    </head>

    <body>
        <p>
            <p>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta property="og:title" content="Orders verzonden naar klant" />
                <title>Orders verzonden naar klant</title>
            </p>

            <table border="0" align="center" cellpadding="2" cellspacing="2" style="width:620px;">
                <tbody>
                <tr>
                    <td height="33">
                        <img src="http://www.hodi-news.nl/int/websites/planning/emailheader.jpg" alt="Hodi International" width="620" title="Hodi International" border="0" />
                    </td>
                </tr>
                </tbody>
            </table>

            <table border="0" align="center" cellpadding="5" cellspacing="0" style="width: 600px;">
                <tbody>
                <tr>
                    <td width="600">
                        <p style="font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;">
                            <br />
                            Geachte, &nbsp;
                        </p>

                        <p style="font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;">
                           Er zijn zojuist <?= $count ?> orders verstuurd via vervoerder <strong><?= $trans ?></strong>
                        </p>

                        <p style="font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;">
                            Het totaalbedrag van de transportorders is <strong>&euro; <?= number_format($total, 2, ",", ".") ?></strong>
                        </p>

                        <p style="font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;">
                            Met vriendelijke groet,<br />
                            Hodi International
                        </p>

                        <div align="center">
                            <p style="font-size: 11px; font-family: Verdana,Arial,Helvetica,sans-serif;line-height: 26px; align=; text-align: center;">
                                U ontvangt deze email omdat u orders bij ter transport heeft aangeboden.
                            </p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </p>

    </body>
</html>