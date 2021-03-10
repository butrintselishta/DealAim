<?php   
    require_once "db.php";
?>
<?php require "header.php"; ?>
<main>
    <!-- <div class="top_banner">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
            <div class="container">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">DealAIM</a></li>
                        <?php  ?>
                        <li><a href="#"></a></li>
                    </ul>
                </div>
                <h1>Si funksionon?</h1>
            </div>
        </div>
    </div> -->
    <!-- /top_banner -->
    <div class="container margin_30">
        <div class="row small-gutters ">
            <div class="main_title">
                <h2>Si funksionon?</h2>
                <span>FUNKSIONIMI</span>
                <p>Se si funksionon ankandi, si të ofertoni, bleni, apo edhe të futni produktet tuaja në ankand e keni të sqaruar në këtë faqe!</p>
            </div>
            <div class="col-md-12 auc_function" style="padding: 15px 25px 15px 25px !important;">
                <?php
                    $faq_select = prep_stmt("SELECT * FROM faq ORDER BY faq_id DESC", null,null);
                    if(mysqli_num_rows($faq_select) > 0){
                        while($row = mysqli_fetch_array($faq_select)){
                            echo $row['faq_data'];
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</main>

<?php require "footer.php"; ?>  