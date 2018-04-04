<?php
$action = $this->request->action;
$lang = $this->request->session()->read("customerlogin")["customer_language"];
?>
<?php if(isset($aPageHelper) && !empty($aPageHelper)){ ?>
    <header style="margin-top: -40px;" id="pagehelp">
        <div class="panel-group" id="home-accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
<!--                    <button type="button" class="close"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>-->
                    <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="title"><?= __('Page help') ?></h4>
                                </div>
                                <div class="col-sm-12">
                                    <!-- INITIAL TEXT -->
                                    <?= isset($aPageHelper["initialize"][$lang]) ? "<p>".$aPageHelper["initialize"][$lang]."</p>" : ""; ?>
                                    <!-- PAGE TEXT -->
                                    <?= isset($aPageHelper[$action][$lang]) ?  "<p>".$aPageHelper[$action][$lang]."</p>" : ""; ?>
                                </div>
                                <!-- /.col-sm-4 -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title text-center">
                        <a data-toggle="collapse" data-parent="#home-accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <span><?= __('Help me') ?></span>
                        </a>
                    </h4>
                </div>
            </div>
        </div>
    </header>

    <style>
        #pagehelp .panel-title>a {
            padding: 10px 15px;
            display: block;
            font-size: 13px;
            background-color: white;
            border-radius: 0px 0px 10px 10px;
            width: 150px;
            position: relative;
            left: 50%;
            margin-left: -75px;
        }
    </style>
<?php } ?>