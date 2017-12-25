<?php
$statistics = $this->statistics;
?>
<section id="before-footer" class="before-footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 text-center">
                <div class="mc-count-item">
                    <h4>Category</h4>
                    <p>
                        <span class="countup number-counters">
                            <strong data-to="<?php echo $statistics[DB_TBCATEGORY] ?>">0</strong>
                        </span>
                    </p>
                </div>
                <div class="mc-count-item">
                    <h4>Courses</h4>
                    <p>
                        <span class="countup number-counters">
                            <strong data-to="<?php echo $statistics[DB_TBCOURSE] ?>">0</strong>
                        </span>
                    </p>
                </div>
                <div class="mc-count-item">
                    <h4>Teachers</h4>
                    <p>
                        <span class="countup number-counters">
                            <strong data-to="<?php echo $statistics[DB_TBAUTHOR] ?>">0</strong>
                        </span>
                    </p>
                </div>
                <div class="mc-count-item">
                    <h4>Video</h4>
                    <p>
                        <span class="countup number-counters">
                            <strong data-to="<?php echo $statistics[DB_TBVIDEO] ?>">0</strong>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>