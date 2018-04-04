<!-- CUSTOMER DESIGN ANSWER -->
<?php $disable = "disabled"; ?>
<?php if(   isset($aPrepress["prepress_artwork_ok"])
            && $aPrepress["prepress_artwork_ok"] == 1
            && $aPrepress["prepress_artwork_to_customer"] == 1
            && $aPrepress["prepress_drukproof_to_customer"] == -1){ $disable = ""; } ?>
<div class="btn-group">
    <button type="button" class="btn btn-sm bg-purple dropdown-toggle <?= $disable ?>" data-toggle="dropdown">
        Drukproef akkoord? <span class="caret fa-margin-left"></span>
    </button>
    <ul class="dropdown-menu">
        <li><?= $this->Form->postLink('Ja', ['action' => 'customerProofAnswer', $aOrder["orderrule_id"], 1]); ?></li>
        <li><a href="#" onclick="$('#proofNotOK').modal()">Nee</a></li>
    </ul>
</div>