<?php
$dataStudent=$this->dataStudent;

?>

<h3 class="md black"  <?php if(count($dataStudent)<=0) echo 'style="border-bottom:unset !important;"'?>><i class="fa fa-users" aria-hidden="true"></i> Học viên: <?php echo count($dataStudent)?>  </h3>
<div class="tab-list-student custom-tab-list-student">
    <ul class="list-student custom-list-student">
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
                <div class="list-body custom-list-body">
                    <?php if(!empty($value['username'])){
                        echo '<cite class="xsm custom-xsm">'.$value['username'].'</cite>';
                    }else{
                        echo '<cite class="xsm custom-xsm">'.$value['fullname'].'</cite>';
                    }?>
                </div>
            </li>
            <!-- END / LIST STUDENT -->
        <?php }?>
    </ul>
</div>