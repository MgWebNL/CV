<!-- Modal BoxSticker -->
<script>
    // selectAllText
    function selectElementContents(e){var t,n,c=document.body;if(document.createRange&&window.getSelection){t=document.createRange(),(n=window.getSelection()).removeAllRanges();try{t.selectNodeContents(e),n.addRange(t)}catch(c){t.selectNode(e),n.addRange(t)}}else c.createTextRange&&((t=c.createTextRange()).moveToElementText(e),t.select());document.execCommand("copy")}
</script>

<div class="modal fade" id="myModalSticker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sticky-note-o"></i>Doossticker</h4>
            </div>
            <div class="modal-body no-padding">
                <ul class="list-group">

                    <li class="list-group-item">
                        <table class="table" id="sticker" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                                <th width="50%">Ordernumber:</th>
                                <td><?= $aOrder->order_nr ?></td>
                            </tr>
                            <tr>
                                <th align="right">Customer:</th>
                                <td><?= $aOrder->adres_name ?></td>
                            </tr>
                            <tr>
                                <th align="right">Design:</th>
                                <td><?= $aOrder->order_description ?></td>
                            </tr>
                            <tr>
                                <th align="right">Quantity:</th>
                                <td><?= $aOrder->HdIntPrplGeneral->article_box_quantity ?></td>
                            </tr>
                            <tr>
                                <th align="right">Reference:</th>
                                <td><?= $aOrder->order_reference ?></td>
                            </tr>
                            <?php if($bStickerWebsite == 1){ ?>
                                <tr>
                                    <th align="right">Website:</th>
                                    <td><strong><?= strtolower($aOrder["adres_website"]) ?></strong></td>
                                </tr>
                            <?php } ?>
                            </tbody></table>
                    </li>

                    <li class="list-group-item no-border">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <button type="button" onclick="selectElementContents( document.getElementById('sticker'))" class="btn btn-default bg-purple btn-sm btn-block">
                                    <i class="fa fa-copy"></i> Copy table
                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item no-border">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn btn-default bg-purple btn-sm btn-block" data-dismiss="modal">
                                    <i class="fa fa-times"></i> Sluiten
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>