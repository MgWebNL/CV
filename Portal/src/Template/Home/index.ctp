<div class="row">
    <?php foreach($aModules as $module){ ?>
        <?= $this->element('Dashboard/'.$module["name"], $module); ?>
    <?php } ?>
</div>