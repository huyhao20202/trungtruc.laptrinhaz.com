<?php
$data = new Model();
$querySlide="SELECT * FROM `slide` AS `sl` WHERE `sl`.`status`='1' ORDER BY `sl`.`ordering` ASC";
$dataSlide=$data->execute($querySlide,true);

?>
<section class="slide" style="background-image: url(<?php echo $urlImage ?>/homeslider/bg.jpg)">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            foreach ($dataSlide as $key =>$value){
                if($key==0){
                    echo '<li data-target="#carousel-example-generic" data-slide-to="'.$key.'" class="active"></li>';
                }else{
                    echo '<li data-target="#carousel-example-generic" data-slide-to="'.$key.'" ></li>';
                }
            }

            ?>

        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php foreach ($dataSlide as $key=>$value){
                if($key==0) {
                    echo '<div class="item active">';
                }else{
                    echo '<div class="item">';
                }

            ?>
                <img src="<?php echo $urlImage . "/homeslider/".$value['picture'] ?>" alt="...">
                <div class="carousel-caption">
                    <h2><?php echo $value['title']?></h2>
                    <p><?php echo $value['content']?></p>
                </div>

            <?php
            echo '</div>';
            }?>

<!--            <div class="item active">-->
<!--                <img src="--><?php //echo $urlImage . "/homeslider/bg.jpg" ?><!--" alt="...">-->
<!--                <div class="carousel-caption">-->
<!--                    <h2>Học Nhiều - Miễn Phí</h2>-->
<!--                    <p>Học lập trình trực tuyến miễn phí nhiều hơn<br> tại ZendVN-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item ">-->
<!--                <img src="--><?php //echo $urlImage . "/homeslider/bg2.jpg" ?><!--" alt="...">-->
<!--                <div class="carousel-caption">-->
<!--                    <h2>Lập Trình Viên Web - Bắt đầu từ đâu?</h2>-->
<!--                    <p>-->
<!--                   Bạn muốn trở thành một lập trình viên nhưng bạn chưa biết phải bắt đầu từ đâu, cần học những gì?-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <img src="--><?php //echo $urlImage . "/homeslider/bg3.jpg" ?><!--" alt="...">-->
<!--                <div class="carousel-caption">-->
<!--                    <h2>Xu thế - Online</h2>-->
<!--                    <p>Học trực tuyến giúp bạn tiết kiệm chi phí, thời gian,<br> cập nhật được nhiều kiến thức mới-->
<!--                        <br>-->
<!--                        nhanh nhất và hiệu quả nhất-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</section>