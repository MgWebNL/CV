<aside id="sidebar" class="sidebar c-overflow">
    <div class="s-profile m-30">
        <span>
            <img src="/portal/img/logos/default_<?= HD_COMPANYCODE ?>.jpg" class="img-responsive" width="100%" />
            <hr />
        </span>
    </div>

    <ul class="main-menu">
        <li class="<?= @$menuItem_Home ?>"><a href="/Home/"><i class="fa fa-home"></i> Home</a></li>
        <li class="<?= @$menuItem_Calendar ?>"><a href="/Calendar/"><i class="fa fa-calendar-o"></i> <?= __('Calendar'); ?></a></li>

        <li class="sub-menu sub-menu-no-plus <?= @$menuItem_Quotation ?> <?= @$menuItemSub_Quotation ?>">
            <a href="/Quotation/index/0"><i class="fa fa-edit"></i> <?= __('Quotations'); ?></a>
            <ul>
                <li class="<?= @$iStatus ?>"><a href="/Quotation"><?= __('All') ?></a></li>
                <li class="<?= @$iStatus0 ?>"><a href="/Quotation/index/0"><?= __('Pending') ?></a></li>
                <li class="<?= @$iStatus1 ?>"><a href="/Quotation/index/1"><?= __('Ordered') ?></a></li>
                <li class="<?= @$iStatus2 ?>"><a href="/Quotation/index/2"><?= __('Canceled') ?></a></li>
            </ul>
        </li>

        <li class="sub-menu sub-menu-no-plus <?= @$menuItem_Order ?> <?= @$menuItemSub_Order ?>">
            <a href="/Order/index/0/""><i class="fa fa-check-square-o"></i> <?= __('Orders'); ?></a>
            <ul>
                <li class="<?= @$iStatus ?>"><a href="/Order/"><?= __('All') ?></a></li>
                <li class="<?= @$iStatus0 ?>"><a href="/Order/index/0/"><?= __('Pending') ?></a></li>
                <li class="<?= @$iStatus2 ?>"><a href="/Order/index/2/"><?= __('Sent') ?></a></li>
                <li class="<?= @$iStatus3 ?>"><a href="/Order/index/3/"><?= __('Delivered') ?></a></li>
            </ul>
        </li>

        <li class="sub-menu sub-menu-no-plus <?= @$menuItem_Invoice ?> <?= @$menuItemSub_Invoice ?>">
            <a href="/Invoice/Overview"><i class="fa fa-eur"></i> <?= __('Invoices'); ?></a>
            <ul>
                <li class="<?= @$iStatus ?>"><a href="/Invoice/"><?= __('All') ?></a></li>
                <li class="<?= @$iStatusX ?>"><a href="/Invoice/Overview"><?= __('Open') ?></a></li>
                <li class="<?= @$iStatus2 ?>"><a href="/Invoice/index/2"><?= __('Paid') ?></a></li>
            </ul>
        </li>

        <li class="sub-menu sub-menu-no-plus <?= @$menuItem_Article ?> <?= @$menuItemSub_Article ?>">
            <a href="/Article/index/0"><i class="fa fa-cubes"></i> <?= __('Articles'); ?></a>
            <ul>
                <li class="<?= @$iStatus ?>"><a href="/Article/"><?= __('All') ?></a></li>
                <li class="<?= @$iStatus3 ?>"><a href="/Article/Order/"><?= __('Order advice') ?></a></li>
                <li class="<?= @$iStatus4 ?>"><a href="/Article/Ondemand/"><?= __('On demand') ?></a></li>
                <li class="<?= @$iStatus0 ?>"><a href="/Article/index/0"><?= __('Frequent') ?></a></li>
                <li class="<?= @$iStatus1 ?>"><a href="/Article/index/1"><?= __('Occasional') ?></a></li>
                <li class="<?= @$iStatus2 ?>"><a href="/Article/index/2"><?= __('History') ?></a></li>
            </ul>
        </li>

        <li class="<?= @$menuItem_Webshop ?>"><a href="/Webshop/" target="_portal"><i class="fa fa-globe"></i> <?= __('Webshop'); ?></a></li>

<!--        <li class="sub-menu --><?//= @$menuItem_Application ?><!--">-->
<!--            <a href="#" data-ma-action="submenu-toggle"><i class="fa fa-mobile"></i> --><?//= __('Applications'); ?><!--</a>-->
<!--            <ul>-->
<!--                <li><a href="#">--><?//= __('Portal help') ?><!--</a></li>-->
<!--                <li><a href="#">--><?//= __('Box calculator') ?><!--</a></li>-->
<!--                <li><a href="#">--><?//= __('Print my items') ?><!--</a></li>-->
<!--            </ul>-->
<!--        </li>-->
    </ul>


    <ul class="main-menu hidden">
        <li class="active">
            <a href="/Home/"><i class="zmdi zmdi-home"></i> Home</a>
        </li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-chart"></i> Dashboards</a>

            <ul>
                <li><a href="dashboards/analytics.html">Analytics</a></li>
                <li><a href="dashboards/school.html">School</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Headers</a>

            <ul>
                <li><a href="textual-menu.html">Textual menu</a></li>
                <li><a href="image-logo.html">Image logo</a></li>
                <li><a href="top-mainmenu.html">Mainmenu on top</a></li>
            </ul>
        </li>
        <li><a href="typography.html"><i class="zmdi zmdi-format-underlined"></i> Typography</a></li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-widgets"></i> Widgets</a>

            <ul>
                <li><a href="widget-templates.html">Templates</a></li>
                <li><a href="widgets.html">Widgets</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-list"></i> Tables</a>

            <ul>
                <li><a href="tables.html">Normal Tables</a></li>
                <li><a href="data-tables.html">Data Tables</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-text"></i> Forms</a>

            <ul>
                <li><a href="form-elements.html">Basic Form Elements</a></li>
                <li><a href="form-components.html">Form Components</a></li>
                <li><a href="form-examples.html">Form Examples</a></li>
                <li><a href="form-validations.html">Form Validation</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-swap-alt"></i>User Interface</a>
            <ul>
                <li><a href="colors.html">Colors</a></li>
                <li><a href="animations.html">Animations</a></li>
                <li><a href="buttons.html">Buttons</a></li>
                <li><a href="icons.html">Icons</a></li>
                <li><a href="alerts.html">Alerts</a></li>
                <li><a href="preloaders.html">Preloaders</a></li>
                <li><a href="notification-dialog.html">Notifications & Dialogs</a></li>
                <li><a href="media.html">Media</a></li>
                <li><a href="components.html">Components</a></li>
                <li><a href="other-components.html">Others</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-trending-up"></i>Charts & Maps</a>
            <ul>
                <li><a href="flot-charts.html">Flot Charts</a></li>
                <li><a href="other-charts.html">Other Charts</a></li>
                <li><a href="maps.html">Maps</a></li>
            </ul>
        </li>
        <li><a href="calendar.html"><i class="zmdi zmdi-calendar"></i> Calendar</a></li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-image"></i>Photo Gallery</a>
            <ul>
                <li><a href="photos.html">Default</a></li>
                <li><a href="photo-timeline.html">Timeline</a></li>
            </ul>
        </li>

        <li><a href="generic-classes.html"><i class="zmdi zmdi-layers"></i> Generic Classes</a></li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Sample Pages</a>
            <ul>
                <li><a href="profile-about.html">Profile</a></li>
                <li><a href="list-view.html">List View</a></li>
                <li><a href="messages.html">Messages</a></li>
                <li><a href="pricing-table.html">Pricing Table</a></li>
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="wall.html">Wall</a></li>
                <li><a href="invoice.html">Invoice</a></li>
                <li><a href="login.html">Login and Sign Up</a></li>
                <li><a href="lockscreen.html">Lockscreen</a></li>
                <li><a href="404.html">Error 404</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-menu"></i> 3 Level Menu</a>

            <ul>
                <li><a href="form-elements.html">Level 2 link</a></li>
                <li><a href="form-components.html">Another level 2 Link</a></li>
                <li class="sub-menu">
                    <a href="#" data-ma-action="submenu-toggle">I have children too</a>

                    <ul>
                        <li><a href="#">Level 3 link</a></li>
                        <li><a href="#">Another Level 3 link</a></li>
                        <li><a href="#">Third one</a></li>
                    </ul>
                </li>
                <li><a href="form-validations.html">One more 2</a></li>
            </ul>
        </li>
        <li>
            <a href="https://wrapbootstrap.com/theme/material-admin-responsive-angularjs-WB011H985"><i class="zmdi zmdi-money"></i> Buy this template</a>
        </li>
    </ul>
</aside>

<aside id="chat" class="sidebar">

    <div class="chat-search">
        <div class="fg-line">
            <input type="text" class="form-control" placeholder="Search People">
            <i class="zmdi zmdi-search"></i>
        </div>
    </div>

    <div class="lg-body c-overflow">
        <div class="list-group">
            <a class="list-group-item media" href="#">
                <div class="pull-left p-relative">
                    <img class="lgi-img" src="/portal/img/demo/profile-pics/2.jpg" alt="">
                    <i class="chat-status-busy"></i>
                </div>
                <div class="media-body">
                    <div class="lgi-heading">Jonathan Morris</div>
                    <small class="lgi-text">Available</small>
                </div>
            </a>

            <a class="list-group-item media" href="#">
                <div class="pull-left">
                    <img class="lgi-img" src="/portal/img/demo/profile-pics/1.jpg" alt="">
                </div>
                <div class="media-body">
                    <div class="lgi-heading">David Belle</div>
                    <small class="lgi-text">Last seen 3 hours ago</small>
                </div>
            </a>

            <a class="list-group-item media" href="#">
                <div class="pull-left p-relative">
                    <img class="lgi-img" src="/portal/img/demo/profile-pics/3.jpg" alt="">
                    <i class="chat-status-online"></i>
                </div>
                <div class="media-body">
                    <div class="lgi-heading">Fredric Mitchell Jr.</div>
                    <small class="lgi-text">Availble</small>
                </div>
            </a>

            <a class="list-group-item media" href="#">
                <div class="pull-left p-relative">
                    <img class="lgi-img" src="/portal/img/demo/profile-pics/4.jpg" alt="">
                    <i class="chat-status-online"></i>
                </div>
                <div class="media-body">
                    <div class="lgi-heading">Glenn Jecobs</div>
                    <small class="lgi-text">Availble</small>
                </div>
            </a>

            <a class="list-group-item media" href="#">
                <div class="pull-left">
                    <img class="lgi-img" src="/portal/img/demo/profile-pics/5.jpg" alt="">
                </div>
                <div class="media-body">
                    <div class="lgi-heading">Bill Phillips</div>
                    <small class="lgi-text">Last seen 3 days ago</small>
                </div>
            </a>

            <a class="list-group-item media" href="#">
                <div class="pull-left">
                    <img class="lgi-img" src="/portal/img/demo/profile-pics/6.jpg" alt="">
                </div>
                <div class="media-body">
                    <div class="lgi-heading">Wendy Mitchell</div>
                    <small class="lgi-text">Last seen 2 minutes ago</small>
                </div>
            </a>
        </div>
    </div>
</aside>