<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\I18n\Number;

?>

<!DOCTYPE html>
<html>
  <head>
    <?php
        $cakeDescription = 'Productieplanning Hodi International: ';
    ?>

    <?= $this->Html->charset() ?>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <!-- Bootstrap 3.3.2 -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/dist/css/font-awesome.min.css" rel="stylesheet">

    <!-- Theme style -->
    <link href="/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- PLUGINS -->
    <link href="/plugins/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/bootstrap-select/bootstrap-select.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

    <script src="/plugins/jQuery/jQuery-2.1.3.min.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script>
        function fnExcelReport(table_id, file_name = null) {

            if(file_name === null){
                file_name = "download";
            }

            var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
            tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';

            tab_text = tab_text + '<x:Name>' + file_name + '</x:Name>';

            tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
            tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

            tab_text = tab_text + "<table border='1px'>";
            tab_text = tab_text + $('#'+table_id).html();
            tab_text = tab_text + '</table></body></html>';

            var data_type = 'data:application/vnd.ms-excel';

            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");

            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
                if (window.navigator.msSaveBlob) {
                    var blob = new Blob([tab_text], {
                        type: "application/csv;charset=utf-8;"
                    });
                    navigator.msSaveBlob(blob, file_name + '.xls');
                }
            } else {
                $('#export').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
                $('#export').attr('download', file_name + '.xls');
            }

        }
    </script>

  </head>

  <?= $this->Element('localhost_alert'); ?>

  <?php if($this->request->session()->read("adminlogin")){ ?>
  <body class="skin-purple">

    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="/Dashboard/" class="logo">
            <b class="hidden-xs">Planning</b>
            <b class="visible-xs"><?= @Number::precision($aQuantity["totaal"], 0) ?></b>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <?php if($this->request->session()->read("adminlogin")["supplier_nrint"] == ""){ ?>
              
              <?php } ?>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!--                  <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>-->
                  <span class="hidden-xs"><?= key($_SESSION['adminlogin']['name_user']); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
<!--                    <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />-->
                    <p>
                        <?= key($adminlogin['name_user']); ?>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <a class="btn btn-block btn-default btn-flat" href="/Authorization/logout/"><?= __('Afmelden') ?></a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->

              <form action="/Search/" method="post" class="sidebar-form">
                  <div class="input-group">
                      <input type="text" pattern=".{4,}" required title="<?= __('4 characters minimum') ?>" name="searchKey" class="form-control" placeholder="<?= __('Zoeken') ?>..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                  </div>
              </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

            <!-- DASHBOARD MENU -->
              <li>
                      <a href="/Dashboard/">
                          <i class="fa fa-home"></i>
                          <span><?= __('Dashboard'); ?></span>
                      </a>
                  </li>

            <!-- CONTACT MENU -->
              <li>
                    <a href="/Contact/">
                        <i class="fa fa-phone"></i>
                        <span><?= __('Contact'); ?></span>
                        <span class="label label-primary bg-purple pull-right">
                            <?= @Number::precision($aCount["prepress"], 0) ?>
                        </span>
                    </a>
                </li>

            <!-- STUDIO MENU -->
                <li>
                      <a href="/Studio/">
                          <i class="fa fa-paint-brush"></i>
                          <span><?= __('Studio'); ?></span>
                          <span class="label label-primary bg-purple pull-right">
                              <?= @Number::precision($aCount["studio"], 0) ?>
                          </span>
                      </a>
                  </li>

            <!-- DRUKKERIJ MENU -->
                  <li class="treeview">
                    <a href="#">
                        <i class="fa fa-print"></i>
                        <span><?= __('Drukkerij'); ?></span>
                        <span class="label label-primary bg-purple pull-right">
                            <?= @Number::precision($aCount["printing"], 0) ?>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/Preprinting/"><i class="fa fa-circle-o"></i>
                                <span><?= __('Bestellen bij drukkerij'); ?></span>
                                <span class="label pull-right">
                                    <?= @Number::precision($aCount[100], 0) ?>
                                </span>
                            </a>
                        </li>
                        <li><a href="/Printing/">
                                <i class="fa fa-circle-o"></i>
                                <span><?= __('Orders bij drukkerij'); ?></span>
                                <span class="label pull-right">
                                   <?= @Number::precision($aCount[101], 0) ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                  </li>

            <!-- POLEN MENU -->

                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-cog"></i>
                          <span><?= __('Verpakken'); ?></span>
                          <span class="label label-primary bg-purple pull-right">
                              <?= @Number::precision($aCount["packaging"], 0) ?>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          <li>
                              <a href="/Prepackaging/"><i class="fa fa-circle-o"></i>
                                  <span><?= __('Wacht op ontvangst'); ?></span>
                                  <span class="label pull-right">
                                       <?= @Number::precision($aCount[102], 0) ?>
                                  </span>
                              </a>
                          </li>
                          <li>
                              <a href="/Prepackaging/OnMachine/"><i class="fa fa-circle-o"></i>
                                  <span><?= __('Op machine'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[103], 0) ?>
                                  </span>
                              </a>
                          </li>
                          <li><a href="/Packaging/ToPack/">
                                  <i class="fa fa-circle-o"></i>
                                  <span><?= __('Naar verpakker'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[104], 0) ?>
                                  </span>
                              </a>
                          </li>
                          <li><a href="/Packaging/Intake/">
                                  <i class="fa fa-circle-o"></i>
                                  <span><?= __('Ontvangst verpakker'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[109], 0) ?>
                                  </span>
                              </a>
                          </li>
                          <li><a href="/Packaging/">
                                  <i class="fa fa-circle-o"></i>
                                  <span><?= __('Bij verpakker'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[105], 0) ?>
                                  </span>
                              </a>
                          </li>
                      </ul>
                  </li>

              <?php $nrint = $this->request->session()->read('adminlogin')["supplier_nrint"] == "" ? "total" : $this->request->session()->read('adminlogin')["supplier_nrint"]; ?>
              <li class="treeview">
                  <a href="#">
                      <i class="fa fa-truck"></i>
                      <span><?= __('Transport'); ?></span>
                          <span class="label label-primary bg-purple pull-right">
                              <?= @Number::precision($aCount['transport'], 0) ?>
                          </span>
                  </a>
                  <ul class="treeview-menu">
                      <li>
                          <a href="/Transport/waitinglist"><i class="fa fa-circle-o"></i>
                              <span><?= __('Verzenden naar Hodi'); ?></span>
                                  <span class="label pull-right">
                                       <?= @Number::precision($aCount[112], 0) ?>
                                  </span>
                          </a>
                      </li>
                      <li>
                          <a href="/Transport/loading/"><i class="fa fa-circle-o"></i>
                              <span><?= __('Laadvolgorde'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[113], 0) ?>
                                  </span>
                          </a>
                      </li>
                      <li>
                          <a href="/Transport/intake/"><i class="fa fa-circle-o"></i>
                              <span><?= __('Aankomst Hodi'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[114], 0) ?>
                                  </span>
                          </a>
                      </li>
                      <li><a href="/Transport/assign/">
                              <i class="fa fa-circle-o"></i>
                              <span><?= __('Aanmelden transport'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[115], 0) ?>
                                  </span>
                          </a>
                      </li>

                  </ul>
              </li>

                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-euro"></i>
                          <span><?= __('Financieel'); ?></span>
                          <span class="label label-primary bg-purple pull-right">
                              <?= @Number::precision($aCount["finance"], 0) ?>
                          </span>
                      </a>
                      <ul class="treeview-menu">
                          <li>
                              <a href="/Finance/Intake/"><i class="fa fa-circle-o"></i>
                                  <span><?= __('Inslaan'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[106], 0) ?>
                                  </span>
                              </a>
                          </li>
                          <li>
                              <a href="/Finance/Invoice/"><i class="fa fa-circle-o"></i>
                                  <span><?= __('Factureren'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[107], 0) ?>
                                  </span>
                              </a>
                          </li>
                          <li><a href="/Finance/Transport/">
                                  <i class="fa fa-circle-o"></i>
                                  <span><?= __('Transportkosten'); ?></span>
                                  <span class="label pull-right">
                                      <?= @Number::precision($aCount[108], 0) ?>
                                  </span>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-line-chart"></i>
                          <span><?= __('Overzichten'); ?></span>
                      </a>
                      <ul class="treeview-menu">
                          <li>
                              <a href="/Overview/Stock"><i class="fa fa-circle-o"></i>
                                  <span>Voorraadoverzicht</span>
                              </a>
                          </li>
                          <li>
                              <a href="/overview/performance"><i class="fa fa-circle-o"></i>
                                  <span>Doorloopsnelheid</span>
                              </a>
                          </li>
                          <li>
                              <a href="/overview/orderssend"><i class="fa fa-circle-o"></i>
                                  <span>Verzonden aantallen</span>
                              </a>
                          </li>
                          <li>
                              <a href="/overview/purchaseTransport"><i class="fa fa-circle-o"></i>
                                  <span>Inkooporder transport</span>
                              </a>
                          </li>
                      </ul>
                  </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <?php if($iSyncAlert == 1 && $this->request->session()->read("adminlogin")["supplier_nrint"] == ""){ ?>
                <div class="callout callout-danger">
                    Let op! Synchonisatie met Ohmega vindt alleen plaats van maandag t/m vrijdag tussen 08:00 en 18:00 !!
                </div>
            <?php } ?>

            <h1>
              <?= __($this->fetch('title')) ?>
            </h1>

            <ol class="breadcrumb">
                <li><a href="javascript:history.go(-1);"><i class="fa fa-reply"></i> Terug</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">


          <?= $this->Flash->render() ?>
          <?= $this->fetch('content') ?>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versie</b> 2.0
        </div>
        <strong>Copyright &copy; 2006-<?= date("Y") ?> <a href="http://www.hd-it.nl">HD-it</a><small> - Online maatwerkapplicaties.</small></strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
	<script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- PLUGINS -->
    <script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="/plugins/bootstrap-select/bootstrap-select.js" type="text/javascript"></script>
    <script src="/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/plugins/datepicker/locales/bootstrap-datepicker.nl.js" type="text/javascript"></script>
    <script src="/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>

    <!-- EXPORT -->
    <script type="text/javascript" src="/js/exportJS/tableExport.js"></script>
    <script type="text/javascript" src="/js/exportJS/jquery.base64.js"></script>


    <!-- AdminLTE App -->
    <script src="/dist/js/app.js" type="text/javascript"></script>

    <!-- START ALL jQUERY -->
    <script src="/dist/js/initialize.js" type="text/javascript"></script>

    <style>
        .oc{
            background: #FF0 !important;
        }

        [data-href] {
            cursor: pointer;
        }
    </style>

    <script>
        $(document).ready(function(){
            $('.ui-loader').remove();
        })


        $('form:not(.makeCSV)').submit(function(){
            $(this).find('input').addClass('disabled');
            $(this).find('button').addClass('disabled');
        });

        $.event.special.tap = {
            setup: function(data, namespaces) {
                var $elem = $(this);
                $elem.bind('touchstart', $.event.special.tap.handler)
                    .bind('touchmove', $.event.special.tap.handler)
                    .bind('touchend', $.event.special.tap.handler);
            },

            teardown: function(namespaces) {
                var $elem = $(this);
                $elem.unbind('touchstart', $.event.special.tap.handler)
                    .unbind('touchmove', $.event.special.tap.handler)
                    .unbind('touchend', $.event.special.tap.handler);
            },

            handler: function(event) {
                //event.preventDefault();
                var $elem = $(this);
                $elem.data(event.type, 1);
                if (event.type == 'touchend' && !$elem.data('touchmove')) {
                    event.type = 'tap';
                    //$elem.event.handle.apply(this, arguments);
                } else if ($elem.data('touchend')) {
                    $elem.removeData('touchstart touchmove touchend');
                }
            }
        };

        $("[data-touch-href]")
            .on('touchstart', function () {
                $(this).data('moved', '0');
            })
            .on('touchmove', function () {
                $(this).data('moved', '1');
            })
            .on('touchend', function () {
                if($(this).data('moved') == 0){
                    window.location.href = $(this).data('touch-href');
                }
            });

        $('#slimScrollDiv').slimScroll({
            height: '250px'
        });

        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab_<?= $this->request->params["controller"]; ?>_<?= $this->request->params["action"]; ?>', $(e.target).attr('href'));
                console.log(localStorage.activeTab_<?= $this->request->params["controller"]; ?>_<?= $this->request->params["action"]; ?>)
            });
            var activeTab = localStorage.getItem('activeTab_<?= $this->request->params["controller"]; ?>_<?= $this->request->params["action"]; ?>');
            if(activeTab){
                $('#saveStateTab a[href="' + activeTab + '"]').tab('show');
            }
        });

        $('.datepicker2').datepicker().on('show.bs.modal', function(event) {
            event.stopPropagation();
        }).on('hide.bs.modal', function(event) {
            event.stopPropagation();
        });

        $('[data-href]').on('click', function(){
            window.location = $(this).data('href');
        });

    </script>




  </body>

  <?php }else{ ?>
    <?= $this->fetch('content') ?>
<?php } ?>

  <?php
    if($this->request->session()->read("adminlogin")["supplier_nrint"] != "" && $_SERVER["REMOTE_ADDR"] != '92.71.254.146'){
        echo "<style>iframe{ display: none !important; }</style>";
    }
  ?>
</html>