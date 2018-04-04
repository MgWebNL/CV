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
                            Good day, &nbsp;
                        </p>

                        <p style="font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;">
                           The following orders need to be loaded <b>first</b> in the truck:
                        </p>

                        <p style="font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;">
                            <ul style="font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;">
                                <?php
                                foreach($aOrders as $order){
                                    echo "<li style=\"font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;\">".$order."</li>";
                                }
                                ?>
                            </ul>
                        </p>

                        <p style="font-size: 18px; font-family:Calibri,Arial,Helvetica,sans-serif; line-height: 26px;">
                            Sincerely,<br />
                            Hodi International
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </p>

    </body>
</html>