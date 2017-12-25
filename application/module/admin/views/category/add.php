<?php
$infoItem = $this->infoItem;
$url = [
    'save' => URL::createLink('admin', DB_TBCATEGORY, 'add', ['type' => 'save']),
    'save-close' => URL::createLink('admin', DB_TBCATEGORY, 'add', ['type' => 'close']),
    'save-new' => URL::createLink('admin', DB_TBCATEGORY, 'add', ['type' => 'new']),
    'cancel' => URL::createLink('admin', DB_TBCATEGORY, 'index')
];
?>
<div class="content-wrapper" style="min-height: 915.8px;">
    <section class="content-header">
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
    </section>
    <section class="text-center no-bg">
        <a class="btn btn-app"
           onclick="javascript:submitForm('<?php echo $url['save'] ?>')"
        >
            <i class="fa fa-save"></i> Save
        </a>
        <a class="btn btn-app"
           onclick="javascript:submitForm('<?php echo $url['save-close'] ?>')"
        >
            <i class="fa fa-save"></i> Save & Close
        </a>
        <a class="btn btn-app"
           onclick="javascript:submitForm('<?php echo $url['save-new'] ?>')"
        >
            <i class="fa fa-plus-square"></i> Save & New
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
                                <label class="col-sm-3 text-right control-label">Category <i
                                            style="color: red">*</i></label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Category"
                                           name="form[name]"
                                           value="<?php if (isset($infoItem['name'])) echo $infoItem['name'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Status <i
                                            style="color: red">*</i></label>
                                <div class="col-sm-6 text-left">
                                    <div class="radio">
                                        <?php
                                        if ((isset($infoItem['status']))) {
                                            if ($infoItem['status'] == 1) {
                                                echo '<label><input type="radio" name="form[status]" id="status" value="1" checked>On</label>';
                                                echo '<label style="margin-left: 20px"><input type="radio" name="form[status]" value="0">Off</label>';
                                            } else {
                                                echo '<label><input type="radio" name="form[status]" id="status" value="1">On</label>';
                                                echo '<label style="margin-left: 20px"><input type="radio" name="form[status]" value="0" checked>Off</label>';
                                            }
                                        } else {
                                            echo '<label><input type="radio" name="form[status]" id="status" value="1">On</label>';
                                            echo '<label style="margin-left: 20px"><input type="radio" name="form[status]" value="0" checked>Off</label>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
