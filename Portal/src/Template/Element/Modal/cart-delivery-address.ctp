<div class="modal fade" id="deliveryAddress" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= __('Edit delivery address') ?></h4>
            </div>
            <div class="modal-body">
                <select class="form-control" id="delivery_address">
                    <?php foreach($aAddresses as $row){ ?>
                        <option value="<?= $row->BKHAAFNRINT ?>">
                            <?= $row->BKHAAFNAAM." - ".$row->BKHAAFSTRAAT." ".$row->BKHAAFHUISNR.$row->BKHAAFHUISNR_TOE." - ".$row->BKHAAFPOSTCODE." ".$row->BKHAAFPLAATS." - ".$row->BKHLAOMS ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= __('Cancel') ?></button>
                <button type="submit" id="saveModalAddress" class="btn btn-hodi"><?= __('Save') ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#saveModalAddress').on('click', function (event) {
        var $array = JSON.parse('<?= json_encode($aAddresses); ?>');
        var $key = $('#delivery_address').val();
        var $object = $array[$key];

        var $string =
            $object['BKHAAFNAAM'] + '<br />' +
            $object["BKHAAFSTRAAT"] + ' ' + $object['BKHAAFHUISNR'] + $object['BKHAAFHUISNRTOE'] + '<br />' +
            $object["BKHAAFPOSTCODE"] + ' ' + $object["BKHAAFPLAATS"] + '<br />' +
            $object["BKHLAOMS"];
        $('#BKHAAFNRINT').val($key);
        $('#BKHAAFADRES').html($string);
        $('#deliveryAddress').modal('hide');
    });
</script>