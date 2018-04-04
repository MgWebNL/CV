<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= HD_APPNAME." - ".$this->fetch('title') ?></title>

    <!-- Vendor CSS -->
    <link href="/portal/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/portal/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
    <link href="/portal/vendors/bower_components/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="/portal/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="/portal/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="/portal/vendors/bower_components/bootstrap-checkbox/bootstrap-checkbox.css" rel="stylesheet">
    <link href="/portal/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
    <link href="/portal/vendors/bower_components/jquery/dist/jquery-ui.min.css"rel="stylesheet" />

    <!-- FONTS -->
    <link href="/portal/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="/portal/css/app_1.min.css" rel="stylesheet">
    <link href="/portal/css/app_2.min.css" rel="stylesheet">
    <link href="/portal/css/app_hodi.php?code=<?= HD_COMPANYCODE ?>" rel="stylesheet">

    <!-- INITIAL jQUERY -->
    <script src="/portal/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/portal/js/earlyLoad.js"></script>
    <?= $this->element('preloader') ?>

</head>
<body>
<?php if($this->request->session()->read('customerlogin')["customer_nrint"] != ""){ ?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?= __('Change password') ?></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/Account/changePassword/">
                        <p><?= __('Please enter your new password twice here') ?>.</p>
                        <p><?= __('Your password needs to contain 1 uppercase, 1 lowercase, 1 number and a minimum length of 6 characters.') ?></p>
                        <?= $this->Flash->render('passwordError') ?>
                        <table class="table table-condensed">
                            <tr>
                                <td width="100%"><input type="password" required class="form-control" name="passwordNew" placeholder="<?= __('Type your new password') ?>" /></td>
                            </tr>
                            <tr>
                                <td><input type="password" required class="form-control" name="passwordNewRetype" placeholder="<?= __('Retype your new password') ?>" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-hodi btn-block" type="submit">
                                        <?= __('Update password') ?>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= $this->element('header') ?>


    <section id="main">

        <?= $this->element('menu') ?>

        <section id="content">
            <div class="container">

                <?= $this->element('pagehelp') ?>

                <?= $this->Flash->render() ?>

                <?= $this->fetch('content') ?>

            </div>

        </section>
    </section>

    <?= $this->element('footer') ?>

    <?= $this->element('manager') //TODO:: UPLOADEN!! ?>

    <?php if($this->request->session()->read('customerlogin')["customer_force_password"] == 1){ ?>
        <script>
            $(document).ready(function(){
                $('#myModal').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            });

        </script>
    <?php } ?>

<?php }else{ ?>

    <?= $this->fetch('content') ?>

<?php } ?>

<?= $this->element('oldbrowser') ?>

<script>
    $title = $('title').html();
    $company = '<?= HD_COMPANYNAME ?>';
    setInterval(function(){
        $('title').html($('title').html() == $title ? $company : $title);
    }, 5000);
</script>

<!-- Javascript Libraries -->
<script src="/portal/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="/portal/vendors/bower_components/flot/jquery.flot.js"></script>
<script src="/portal/vendors/bower_components/flot/jquery.flot.resize.js"></script>
<script src="/portal/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
<script src="/portal/vendors/sparklines/jquery.sparkline.min.js"></script>
<script src="/portal/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

<script src="/portal/vendors/bower_components/moment/min/moment.min.js"></script>
<script src="/portal/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="/portal/vendors/bower_components/fullcalendar/dist/nl.js"></script>
<script src="/portal/vendors/bower_components/fullcalendar/dist/en.js"></script>
<script src="/portal/vendors/bower_components/fullcalendar/dist/de.js"></script>
<script src="/portal/vendors/bower_components/fullcalendar/dist/fr.js"></script>


<!-- DYNAMIC LANGUAGE FULLCALENDAR -->
<script src='/portal/vendors/bower_components/fullcalendar/dist/en.js'></script>
<!-- END DYNAMIC LANGUAGE FULLCALENDAR -->

<script src="/portal/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
<script src="/portal/vendors/bower_components/Waves/dist/waves.min.js"></script>
<script src="/portal/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
<script src="/portal/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/portal/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/portal/vendors/bower_components/autosize/dist/autosize.min.js"></script>
<script src="/portal/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/portal/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>


<script src="/portal/js/app2.min.js?time=<?= time() ?>"></script>
<?php if($_SERVER['REMOTE_ADDR'] == '92.71.254.146'){ ?>

<?php } ?>
<script>

    // LAAD STANDAARDEN DATATABLE IN
    $(function(){
        $('table.table-sortable').DataTable({
            "sDom": 't',
            iDisplayLength: 999999999,
            "order": [],
            orderCellsTop: true,
            "autoWidth": false
        });

        $('.selectpicker').selectpicker();

        $("button:not[type='submit']").on('click', function(e){
            alert('NOT SUBMIT');
            e.preventDefault();
        })
    });

</script>
</body>

</html>

