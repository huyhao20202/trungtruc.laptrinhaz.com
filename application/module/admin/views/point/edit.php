<?php
$infoItemEdit=$this->infoItemEdit;
$url = [
    'save' => URL::createLink('admin', 'point', 'changePoint', ['type' => 'save']),
    'save-close' => URL::createLink('admin', 'point', 'changePoint', ['type' => 'close']),
    'cancel' => URL::createLink('admin', 'point', 'index')
];
//echo "<pre>";
//print_r($infoItemEdit);
//echo "</pre>";
?>
<div class="content-wrapper" style="min-height: 915.8px;">
    <section class="content-header">
        <h1>
            Manage&nbsp;<?php echo ucfirst($this->arrParam['controller'])?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i><?php echo ucfirst($this->arrParam['module']) ?></a></li>
            <li><a href="#"><?php echo ucfirst($this->arrParam['controller']) ?></a></li>
            <li class="active"><?php echo ucfirst($this->arrParam['action']) ?></li>
        </ol>
    </section>
    <section class="text-center no-bg">

        <a class="btn btn-app"
           onclick="javascript:submitForm('<?php echo $url['save-close'] ?>')"
        >
            <i class="fa fa-save"></i> Save & Close
        </a>
        <a href="<?php echo $url['cancel'] ?>" class="btn btn-app">
            <i class="fa  fa-arrow-circle-left"></i> Cancel
        </a>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info text-center">
                    <?php
                    if (isset($this->errors)) {
                        echo $this->errors;
                    }
                    if (isset($this->success)) {
                        echo $this->success;
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data" id="adminForm">

                        <div class="box-body">

                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Change 1 Point by<i style="color: red"> *(VNĐ)</i></label>
                                <div class="col-sm-6">
                                    <input  type="number" class="form-control"  name="form[current_money]" min="1"
                                           value="<?php if (isset($infoItemEdit[0]['current_money'])) echo $infoItemEdit[0]['current_money'] ?>"
                                    >
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
