<!-- PREPRESS BUTTON -->
<?php if($aOrder->HdIntPrplGeneral->reprint == "0" && ((isset($aPrepress) && count($aPrepress) == 0) || !$aPrepress)) { ?>
    <div class="btn-group btn-group-sm">
        <a href="/Order/Instructions/<?= $aOrder["orderrule_id"] ?>" type="button" class="btn bg-purple  <?php if(isset($aPrepress["prepress_done"]) && $aPrepress["prepress_done"] == 1){ ?>disabled<?php } ?>"><i class="fa fa-check-square"></i> Instructieformulier</a>
        <button type="button" class="btn bg-purple dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="/Order/Instructions/<?= $aOrder["orderrule_id"] ?>"><i class="fa fa-check-square"></i> Instructieformulier</a></li>
            <li><a href="##" onclick="$('#confirmReprint').modal()"><i class="fa fa-repeat"></i> Ongewijzigde herdruk</a></li>
        </ul>
    </div>
<?php }elseif($aOrder->HdIntPrplGeneral->reprint == "0") { ?>
    <a href="/Order/Instructions/<?= $aOrder["orderrule_id"] ?>" type="button" class="btn btn-sm bg-purple  <?php if(isset($aPrepress) && $aPrepress["prepress_done"] == 1){ ?>disabled<?php } ?>"><i class="fa fa-check-square"></i> Instructieformulier</a>
<?php }else{ ?>
    <a href="##" class="btn btn-sm bg-purple disabled"><i class="fa fa-repeat"></i> Ongewijzigde herdruk</a></a>
<?php } ?>