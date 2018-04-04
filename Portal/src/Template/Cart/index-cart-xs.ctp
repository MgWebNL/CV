<table class="table table-hover hidden table-condensed">
    <thead>
    <tr>
        <th width="125">Code</th>
        <th class="visible-xs"></th>
        <th class="hidden-xs"><?= __('Description') ?></th>
        <th class="hidden-xs text-right" width="120"><?= __('Price') ?></th>
        <th width="150"><?= __('Qty') ?></th>
        <th class="text-right" width="120"><?= __('Amount') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php for($i = 1; $i <= 5; $i++){ ?>
        <tr>
            <td>Code</td>
            <td class="visible-xs"></td>
            <td class="hidden-xs">Omschrijving artikel 1</td>
            <td class="hidden-xs text-right">&euro; 999.999,99</td>
            <td class="text-right">
                <div class="input-group input-group-sm">
                    <span class="input-group-btn">
                        <a class="btn btn-danger btn-no-shadow" href="#">
                            <span class="fa fa-minus"></span>
                        </a>
                    </span>
                    <input type="num" class="form-control text-center" value="1">
                    <span class="input-group-btn">
                        <a class="btn btn-success btn-no-shadow" href="#">
                            <span class="fa fa-plus"></span>
                        </a>
                    </span>
                </div>
            </td>
            <td class="text-right">&euro; 999.999,99</td>
        </tr>
    <?php } ?>

    </tbody>

    <tfoot>
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