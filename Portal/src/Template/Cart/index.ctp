<?php
use Cake\I18n\Number;
/**
 * IMPORTANT :: DEFINE CART VAR OUT OF SESSION-VAR !!!
 */
?>

<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Shopping cart') ?>
                </h2>
            </div>

            <?php if(count($aCart) == 0){ ?>
                <div class="card-body card-padding">
                    <div class="alert alert-warning m-b-0">
                        <?= __('No items available'); ?>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="card-body">
                    <?php include('index-cart.ctp') ?>
                    <?php include('index-cart-xs.ctp') ?>
                </div>

                <div class="card-body card-padding">
                    <a href="/Home/" class="btn btn-default pull-left m-r-10">
                        <i class="fa fa-home fa-p-r"></i><?= __('Home') ?>
                    </a>
                    <form method="post" action="/Cart/destroy/">
                        <button class="btn btn-danger pull-left" type="submit">
                            <i class="fa fa-trash fa-p-r"></i><?= __('Empty cart') ?>
                        </button>
                    </form>

                    <button href="#" id="nextCart" class="btn btn-hodi pull-right">
                        <?= __('Order now') ?><i class="fa fa-arrow-right fa-p-l"></i>
                    </button>

                    <button id="updateCart" class="btn btn-default pull-right m-r-10">
                        <i class="fa fa-refresh fa-p-r"></i><?= __('Update cart') ?>
                    </button>

                    <div class="clearfix"></div>
                </div>
            <?php } ?>

        </div>
    </div>


</div>


<script>
    $('#updateCart').on('click', function(){
        $('#submitType').val('reload');
        $('#cartArticles')[0].submit();
    });

    $('#nextCart').on('click', function(){
        $('#submitType').val('next');
        $('#cartArticles')[0].submit();
    });
</script>