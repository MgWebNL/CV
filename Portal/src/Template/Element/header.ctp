<header id="header" class="clearfix" data-ma-theme="hd-it">
    <ul class="h-inner">
        <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li>

        <li>
            <ul class="hi-menu">
                <li>
                    <a href="javascript:history.go(-1);"><i class="him-icon zmdi zmdi-chevron-left"></i></a>
                </li>
            </ul>
        </li>

        <li class="hi-logo hidden-xs">
            <a href="/Home/"><?= HD_APPNAME ?></a>
        </li>

        <li class="pull-right">
            <ul class="hi-menu">

                <li data-ma-action="search-open">
                    <a href="#"><i class="him-icon zmdi zmdi-search"></i></a>
                </li>





                <li>
                    <a href="/account/"><i class="him-icon zmdi zmdi-account"></i></a>
                </li>

<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <i class="him-icon zmdi zmdi-email"></i>-->
<!--                        <i class="him-counts">6</i>-->
<!--                    </a>-->
<!--                </li>-->

                <?php //$this->element('notifications') ?>
                <?= $this->element('cart') ?>

<!--                <li class="hidden-xs ma-trigger" data-ma-action="sidebar-open" data-ma-target="#chat">-->
<!--                    <a href="#"><i class="him-icon zmdi zmdi-comment-alt-text"></i></a>-->
<!--                </li>-->
                <li>
                    <a href="/Help/"><i class="him-icon zmdi zmdi-help-outline"></i></a>
                </li>
                <li>
                    <a href="/Authorization/logout/"><i class="him-icon zmdi zmdi-power"></i></a>
                </li>

            </ul>
        </li>
    </ul>

    <!-- Top Search Content -->
    <div class="h-search-wrap" id="top-search-wrap">
        <form method="post" action="/Search/processSearchRequest/">
            <div class="hsw-inner">
                <i class="hsw-close zmdi zmdi-arrow-left" data-ma-action="search-close"></i>
                <input placeholder="<?= __('Type your keywords here') ?>..." type="text" name="keywords" />
            </div>
        </form>
    </div>
</header>