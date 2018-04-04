<?php
use Cake\I18n\Number;
$session = $this->request->session();
$cart = $session->read('Cart')->sortBy('article_name');
?>
<li class="dropdown">
    <a data-toggle="dropdown" href="#">
        <i class="him-icon zmdi zmdi-shopping-cart"></i>
        <i class="him-counts"><?= count($session->read('Cart')) ?></i>
    </a>
    <div class="dropdown-menu pull-right dropdown-menu-xl">
        <div class="list-group">
            <div class="lg-header m-b-0 p-b-20">
                <?= __('Shopping cart') ?>
            </div>

            <?php if(count($session->read('Cart')) == 0){ ?>
                <div class="lg-body">
                    <p class="view-more">
                        <br />
                        <i class="zmdi zmdi-shopping-cart zmdi-hc-5x text-muted"></i><br /><br />
                        <?= __('No items in your cart yet') ?>
                    </p>
                </div>
            <?php }else{ ?>
                <div class="lg-body">
                    <?php foreach($cart as $k => $item){ ?>
                        <?php if($k < 5){ ?>
                            <?php $link = (is_null($item->Article) || $item->shopRoot == 'online' || !isset($aCustomerArticles->{$item->article_id})) ? "#" : "/Article/View/".$item->article_id ?>
                            <div class="list-group-item cart-group" data-href="<?= $link ?>">
                                <div class="cart-title"><?= $item->article_code ?></div>
                                <div class="cart-price"><?= Number::precision($item->quantity, 0) ?>x</div>
                                <div class="cart-price hidden">&euro; <?= Number::precision($item->article_price * $item->quantity, 2) ?></div>
                                <div class="cart-description"><?= $item->article_name ?></div>
                                <div class="cart-price hidden"><?= Number::precision($item->quantity, 0) ?>x</div>
                                <div class="clearfix"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <?php if(count($session->read('Cart')) > 5){ ?>
                        <div class="list-group-item text-center" data-href="#">
                           +<?= count($session->read('Cart')) - 5 ?> <?= __('more items in cart') ?>
                        </div>
                    <?php } ?>

                    <div class="list-group-item hidden">
                        <div class="cart-title"><?= __('Transport') ?></div>
                        <div class="cart-price">&euro; 999.999,99</div>
                        <div class="clearfix m-b-10"></div>

                        <div class="cart-title-total"><?= __('Total') ?></div>
                        <div class="cart-price-total">&euro; 999.999,99</div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="list-group-item">
                        <a class="btn btn-block btn-hodi" href="/cart/"><?= __('View All') ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</li>