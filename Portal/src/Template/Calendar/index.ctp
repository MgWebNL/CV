<div class="container container-alt">
    <div class="block-header block-header-calendar">
        <h2>
            <span></span>
            <ul class="actions actions-calendar">
                <li><a class="calendar-prev" href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                <li><a class="calendar-next" href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>

                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                    <ul class="dropdown-menu dm-icon pull-right">
                        <li><a href="#" id="new-event"><i class="zmdi zmdi-view-comfy"></i> <?= __('New appointment') ?></a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-calendar-view="month"><i class="zmdi zmdi-view-comfy active"></i> <?= __('Month') ?></a></li>
                        <li><a href="#" data-calendar-view="basicWeek"><i class="zmdi zmdi-view-week"></i> <?= __('Week') ?></a></li>
                        <!--                        <li><a href="#" data-calendar-view="basicDay"><i class="zmdi zmdi-view-day"></i> --><?//= __('Day') ?><!--</a></li>-->
                    </ul>
                </li>
            </ul>
        </h2>
    </div>

    <div id="calendarAjaxResult">
        <?= $this->element('Ajax/loading'); ?>
    </div>


    <!-- Show event -->
    <div class="modal fade" id="modal-new-event" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <form method="post" action="/Calendar/newAppointment">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= __('New appointment') ?></h4>
                    </div>

                    <div class="modal-body">
                        <form class="edit-event__form">
                            <div class="form-group">
                                <div class="fg-line">
                                    <strong><?= __('Date') ?></strong>
                                    <input required class="form-control datepicker" type="text" readonly min="<?= date('Y-m-d', strtotime('+2 weekdays')); ?>" name="visit_date" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <strong><?= __('Time') ?>: </strong>
                                    <input required class="form-control timepicker" type="text" readonly name="visit_time" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <strong><?= __('Visit') ?>: </strong>
                                    <select required name="visit_type" class="form-control">
                                        <option value="0"><?= __('I will visit you'); ?></option>
                                        <option value="1"><?= __('Please visit me') ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fg-line">
                                    <strong><?= __('Reason') ?>: </strong>
                                    <textarea required name="visit_reason" class="form-control" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="fg-line">
                                    <p><?= __('When you submit your request, your accountmanager will contact you about the details of your appointment'); ?></p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-link" type="button" data-dismiss="modal"><?= __('Close') ?></button>
                        <button class="btn btn-hodi" type="submit"><?= __('Submit') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Show event -->
    <div class="modal fade" id="modal-edit-event" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= __('Order advice articles') ?></h4>
                </div>

                <div class="modal-body">
                    <form class="edit-event__form">
                        <div class="form-group">
                            <div class="fg-line">
                                <p type="text" class="form-control form-control-static">
                                    <strong><?= __('Article no.') ?></strong> <span class="edit-event-title"></span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="fg-line">
                                <p type="text" class="form-control form-control-static">
                                    <strong><?= __('Quantity') ?>: </strong> <span class="edit-event-quantity"></span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fg-line">
                                <p class="edit-event-description"></p>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-hodi edit-event-id"><?= __('Show article') ?></a>
                    <button class="btn btn-link" data-dismiss="modal"><?= __('Close') ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-visit" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= __('Visit from ') . HD_COMPANYNAME ?></h4>
                </div>

                <div class="modal-body">
                    <form class="edit-event__form">
                        <div class="form-group">
                            <div class="fg-line">
                                <p type="text" class="form-control form-control-static">
                                    <strong><?= __('Date'); ?>:</strong> <span class="edit-date"></span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="fg-line">
                                <p type="text" class="form-control form-control-static">
                                    <strong><?= __('Time'); ?>:</strong> <span class="edit-time"></span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fg-line">
                                <p type="text" class="form-control form-control-static">
                                    <strong><?= __('Visitor'); ?>:</strong> <span class="edit-empl"></span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fg-line">
                                <p class="edit-description"></p>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><?= __('Close') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Calendar Script -->
<script type="text/javascript">

    $(function(){
        registerJqxhr(
            $.ajax({
                url: "/Calendar/loadAppointmentsAjax/",
                success: function (response) {
                    // you will get response from your php page (what you echo or print)
                    $('#calendarAjaxResult').html('<div id="calendar" class="card"></div>');
                    setCalendar(JSON.parse(response));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    $('#calendarAjaxResult').html('<?= str_replace("\r\n", "", $this->element('Ajax/error')) ?>');
                }
            })
        )
    });

    function setCalendar(sJSON) {
        var target = $('#calendar');

        target.fullCalendar({
            header: false,
            theme: false,
            locale: '<?= $this->request->session()->read('customerlogin')["customer_language"] ?>',
            selectable: false,
            selectHelper: false,
            editable: false,
            nowIndicator: true,
            events: sJSON,

            viewRender: function (view) {
                var calendarDate = $("#calendar").fullCalendar('getDate');
                var calendarMonth = calendarDate.month();

                //Set data attribute for header. This is used to switch header images using css
                $('#calendar .fc-toolbar').attr('data-calendar-month', calendarMonth);

                //Set title in page header
                $('.block-header-calendar > h2 > span').html(view.title);
            },

            eventClick: function (event, element) {
                if (event.type == 'art') {
                    articleModal(event);
                }
                if (event.type == 'visit') {
                    visitModal(event);
                }
            }
        });

        //Calendar views switch
        $('body').on('click', '[data-calendar-view]', function (e) {
            e.preventDefault();

            $('[data-calendar-view]').removeClass('active');
            $(this).addClass('active');
            var calendarView = $(this).attr('data-calendar-view');
            target.fullCalendar('changeView', calendarView);
        });

        $('#new-event').on('click', function(e){
            newVisit(e);
        });


        //Calendar Next
        $('body').on('click', '.calendar-next', function (e) {
            e.preventDefault();
            target.fullCalendar('next');
        });


        //Calendar Prev
        $('body').on('click', '.calendar-prev', function (e) {
            e.preventDefault();
            target.fullCalendar('prev');
        });

        function articleModal(event) {
            var href = '/Article/view/' + event.id;
            $('.edit-event-id').prop('href', href);
            $('.edit-event-title').html(event.title);
            $('.edit-event-description').html(event.description);
            $('.edit-event-quantity').html(event.quantity);
            $('#modal-edit-event').modal('show');
        }

        function visitModal(event) {
            $('.edit-description').html(event.description);
            $('.edit-date').html(event.date);
            $('.edit-time').html(event.time);
            $('.edit-empl').html(event.empl);
            $('#modal-visit').modal('show');
        }

        function newVisit(event){
            $('#modal-new-event').modal('show');
        }

        var today = new Date().toISOString().split('T')[0];
//        $("[type=date]").attr('min', today);
//        //document.getElementsByName("date")[0].setAttribute('min', today);
    }
</script>

<script src="/portal/vendors/bower_components/jquery/dist/jquery.datetimepicker.min.js" type="application/javascript"></script>
<link href="/portal/vendors/bower_components/jquery/dist/jquery.datetimepicker.min.css" rel="stylesheet" />
<script>
//    $( ".datepicker" ).datepicker({
//        dateFormat: 'dd-mm-yy'
//    });
    $('.timepicker').datetimepicker({
        datepicker:false,
        allowTimes:[
            '09:00', '09:30',
            '10:00', '10:30',
            '11:00', '11:30',
            '12:00', '12:30',
            '13:00', '13:30',
            '14:00', '14:30',
            '15:00', '15:30',
            '16:00', '16:30',
        ],
        format: 'H:i'
    });
    $.datetimepicker.setLocale('nl');
    $('.datepicker').datetimepicker({
        i18n:{
            nl:{
                months:[
                    'Januari','Februari','Maart','April',
                    'Mei','Juni','Juli','Augustus',
                    'September','Oktober','November','December',
                ],
                dayOfWeek:[
                    "Zo.", "Ma", "Di", "Wo",
                    "Do", "Vr", "Za.",
                ]
            }
        },
        minDate:'<?= date('Y-m-d', strtotime("+2 days")); ?>)',
        onGenerate:function( ct ){
            jQuery(this).find('.xdsoft_date.xdsoft_weekend')
                .addClass('xdsoft_disabled');
        },
        weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
        timepicker:false,
        format:'d-m-Y'
    });
</script>