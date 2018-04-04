<?php $loginSession = $this->request->session()->read('customerlogin'); ?>

<?php
    if(isset($loginSession["Accountmanager"]["HdEmployee"]["telephone"]) &&  $loginSession["Accountmanager"]["HdEmployee"]["telephone"] !== ""){
        $tel = $loginSession["Accountmanager"]["HdEmployee"]["telephone"];
    }else{
        $tel = HD_TELEPHONE;
    }

    if(isset($loginSession["Accountmanager"]["HdEmployee"]["emailaddress"]) &&  $loginSession["Accountmanager"]["HdEmployee"]["emailaddress"] !== ""){
        $email = $loginSession["Accountmanager"]["HdEmployee"]["emailaddress"];
    }else{
        $email = HD_EMAIL;
    }

    if(getimagesize('/portal/img/employee/'. $loginSession["Accountmanager"]["ORDMWNRINT"].'.jpg')){
        $img = '/portal/img/employee/'.$loginSession["Accountmanager"]["ORDMWNRINT"].'.jpg';
    }else{
        $img = '/portal/img/employee/'.HD_COMPANYCODE.'.jpg';
    }
?>


<div class="panel-group employeehelper">
    <div class="panel bgm-hodi">

        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body p-20 p-b-0 text-center">
                <a data-toggle="collapse" href="#collapse1" class="btn btn-link btn-close">
                    <i class="fa fa-close"></i>
                </a>
                <img src="<?= $img ?>" width="100" class="img-circle img-responsive img-thumbnail" />
                <h4 class="m-b-0"><?= __('Hi, I\'m') ?> <?= $loginSession["Accountmanager"]["ORDMWROEPNAAM"] ?></h4>
            </div>
            <div class="panel-footer p-20 text-justify" style="background: #FFF;">
                <p><?= __('I\'m your personal account manager') ?>. <?= __('If you have any questions about quotations, orders, invoices or products, you can contact me') ?>.</p>
                <button id="callButton" class="btn bgm-hodi btn-block btn-no-shadow m-b-10">
                    <?= __('Call') ?> <?= $loginSession["Accountmanager"]["ORDMWROEPNAAM"] ?>
                </button>
                <p id="callExplain" class="hidden"><?= __('If you don\'t have telephone software, you can call to contact') ?> <?= $loginSession["Accountmanager"]["ORDMWROEPNAAM"] ?> <?= __('on') ?> <?= $tel; ?></p>
                <button id="mailButton" class="btn bgm-hodi btn-block btn-no-shadow m-b-10">
                    <?= __('Email') ?> <?= $loginSession["Accountmanager"]["ORDMWROEPNAAM"] ?>
                </button>
                <p id="mailExplain" class="hidden"><?= __('If your email client doesn\'t open, you can send an email to') ?> <?= $loginSession["Accountmanager"]["ORDMWROEPNAAM"] ?> <?= __('on') ?> <?= $email ?></p>
                <!-- <a class="btn bgm-hodi btn-block btn-no-shadow disabled">
                    <?= __('Start chat') ?> <?= __('with') ?> Danny
                </a>
                <a class="btn bgm-hodi btn-block btn-no-shadow disabled">
                    <?= __('Start chat') ?>
                </a>
                <a class="btn btn-block bgm-gray btn-no-shadow disabled">
                    <?= __('No chat available') ?>
                </a> -->
            </div>
        </div>

        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse1" class="btn bgm-orange btn-no-shadow m-0">
                    <?= __('How can we help you?') ?>
                </a>
            </h4>
        </div>
    </div>
</div>

<style>
    .employeehelper{
        position: fixed;
        bottom: 0;
        right: 30px;
        width: 300px;
    }

    .employeehelper .btn-link{
        color: #F3F3F3;
    }

    .employeehelper h4{
        color: #FFF;
    }

    .btn-close{
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>

<script>
    $('#callButton').on('click', function(){
        window.location = 'tel:<?= $tel; ?>';
        $('#callExplain').removeClass('hidden');
    });

    $('#mailButton').on('click', function(){
        window.location = 'mailto:<?= $email ?>';
        $('#mailExplain').removeClass('hidden');
    });
</script>