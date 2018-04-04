<!-- CUSTOMER DESIGN ANSWER -->
<?php $disable = "disabled"; ?>
<?php if(isset($aPrepress["prepress_artwork_ok"]) && $aPrepress["prepress_artwork_ok"] == 1 && $aPrepress["prepress_artwork_to_customer"] == -1){ $disable = ""; } ?>
<div class="btn-group">
    <button type="button" class="btn btn-sm bg-purple dropdown-toggle <?= $disable ?>" data-toggle="dropdown">
        Design voorstel akkoord? <span class="caret fa-margin-left"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="#" onclick="$('#designOK').modal()">Ja, <small>plaats opmerking</small></a></li>
        <li><a href="#" onclick="$('#designAndProofOK').modal()">Ja <small>en drukproef ook akkoord</small></a></li>
        <li><a href="#" onclick="$('#designNotOK').modal()">Nee, <small>plaats opmerking</small></a></li>
    </ul>
</div>