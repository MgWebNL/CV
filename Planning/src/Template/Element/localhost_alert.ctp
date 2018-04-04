<style>
    .localhost{
        width: 500px !important;
        height: 30px !important;
        position: fixed !important;
        top: 0 !important;
        left: 50% !important;
        margin-left: -250px !important;
        margin-top: 10px !important;
        text-align: center !important;
        line-height: 30px;
        z-index: 9999 !important;
        padding: 0 !important;
    }

    .localhost.full{
        width: 100% !important;
        height: 50px !important;
        position: fixed !important;
        top: 0 !important;
        left: 0% !important;
        margin-left: 0px !important;
        margin-top: 0px !important;
        text-align: center !important;
        line-height: 50px;
        z-index: 9999 !important;
        padding: 0 !important;
    }
</style>

<?php
    $show = "";
    $extension = pathinfo($_SERVER['SERVER_NAME'], PATHINFO_EXTENSION);
    if($extension == "home"){
        $show = "U werkt op uw lokale PC !!";
    }
    if($extension == "test"){
        $show = "U werkt op de testserver !!";
    }
?>

<?php if($show != ""){ ?>
    <div class="alert alert-danger localhost">
        <i class="fa fa-warning"></i> <?= $show ?>
    </div>
<?php } ?>

<script>
    $(function() {
        $(window).on('scroll', function(){
            var top = $(window).scrollTop();
            if(top > 50){
                $('.localhost').addClass('full');
            }else{
                $('.localhost').removeClass('full');
            }
        });
    });
</script>
