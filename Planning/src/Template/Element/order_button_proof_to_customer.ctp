<!-- DESIGN TO CUSTOMER -->
<?php if(isset($aPrepress["prepress_artwork_ok"])
    && $aPrepress["prepress_artwork_ok"] == 1
    && $aPrepress["prepress_artwork_to_customer"] == 1
    && $aPrepress["prepress_drukproof_ok"] == 1
    && $aPrepress["prepress_drukproof_to_customer"] == 0){ ?>
    <?php $disable = "disabled"; ?>
    <?php   if(isset($aPrepress["prepress_artwork_ok"])
         && $aPrepress["prepress_artwork_ok"] == 1
         && $aPrepress["prepress_artwork_to_customer"] == 1
         && $aPrepress["prepress_drukproof_ok"] == 1
         && $aPrepress["prepress_drukproof_to_customer"] == 0){ $disable = ""; } ?>
    <div class="btn-group">
        <button type="button" class="btn btn-sm bg-purple dropdown-toggle <?= $disable ?>" data-toggle="dropdown">
            Drukproef naar klant <span class="caret fa-margin-left"></span>
        </button>
        <ul class="dropdown-menu">
            <li><?= $this->Form->postLink('1 dag bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 1]); ?></li>
            <li><?= $this->Form->postLink('3 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 3]); ?></li>
            <li><?= $this->Form->postLink('5 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 5]); ?></li>
            <li><?= $this->Form->postLink('7 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 7]); ?></li>
            <li><?= $this->Form->postLink('10 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 10]); ?></li>
            <li><?= $this->Form->postLink('14 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 14]); ?></li>
        </ul>
    </div>
<?php }else{ ?>
    <!-- REMINDER -->
    <?php $disable = "disabled"; ?>
    <?php   if(isset($aPrepress["prepress_artwork_ok"])
        && $aPrepress["prepress_artwork_ok"] == 1
        && $aPrepress["prepress_artwork_to_customer"] == 1
        && $aPrepress["prepress_drukproof_ok"] == 1
        && $aPrepress["prepress_drukproof_to_customer"] == -1
        && $aPrepress["prepress_drukproof_retour_date"] < date('Y-m-d')){ $disable = ""; } ?>
    <div class="btn-group">
        <button type="button" class="btn btn-sm bg-purple dropdown-toggle <?= $disable ?>" data-toggle="dropdown">
            Reminder drukproef naar klant <span class="caret fa-margin-left"></span>
        </button>
        <ul class="dropdown-menu">
            <li><?= $this->Form->postLink('1 dag bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 1, 1]); ?></li>
            <li><?= $this->Form->postLink('3 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 3, 1]); ?></li>
            <li><?= $this->Form->postLink('5 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 5, 1]); ?></li>
            <li><?= $this->Form->postLink('7 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 7, 1]); ?></li>
            <li><?= $this->Form->postLink('10 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 10, 1]); ?></li>
            <li><?= $this->Form->postLink('14 dagen bedenktijd', ['action' => 'sendProofToCustomer', $aOrder["orderrule_id"], 14, 1]); ?></li>
        </ul>
    </div>
<?php } ?>
