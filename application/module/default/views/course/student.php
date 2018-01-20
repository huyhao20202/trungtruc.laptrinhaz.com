<?php
$dataStudent=$this->dataStudent;

?>

<h3 class="md black"><?php echo count($dataStudent).' Học viên'?></h3>
<div class="tab-list-student">
    <ul class="list-student">
        <?php foreach ($dataStudent as $value){?>
            <!-- LIST STUDENT -->
            <li class="student-custom">
                <div class="image">
                    <?php if(!empty($value['avatar'])){
                        echo '<img src="'.TEMPLATE_URL.'/default/main/images/avatar/'.$value['avatar'].'" alt="">';
                    }else{
                        echo '<img src="'.TEMPLATE_URL.'/default/main/images/avatar/no-avatar.png" alt="">';

                    }?>

                </div>
                <div class="list-body">
                    <?php if(!empty($value['username'])){
                        echo '<cite class="xsm"><a href="#">'.$value['username'].'</a></cite>';
                    }else{
                        echo '<cite class="xsm"><a href="#">'.$value['fullname'].'</a></cite>';
                    }?>
                </div>
            </li>
            <!-- END / LIST STUDENT -->
        <?php }?>
    </ul>
</div>