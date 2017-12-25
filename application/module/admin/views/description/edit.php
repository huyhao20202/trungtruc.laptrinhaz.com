<?php
$infoItem = $this->infoItem;
$id = isset($infoItem ['id']) ? $infoItem['id'] : 0;

$url = [
    'save' => URL::createLink('admin', DB_TBDESCRIPTION, 'edit',['id'=>$this->arrParam['id']]),
    'cancel' => URL::createLink('admin', DB_TBDESCRIPTION, 'index')
];

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
           onclick="javascript:submitForm('<?php echo $url['save'] ?>')"
        >
            <i class="fa fa-plus-square"></i> Save
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
                                <label class="col-sm-3 text-right control-label">Course <i
                                        style="color: red">*</i></label>
                                <div class="col-sm-6 text-left">
                                    <input type="text" value="<?php echo $infoItem['name'] ?>" disabled class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Current Image Thumbnail</label>
                                <div class="col-sm-6 text-left">
                                    <img src="<?php echo $this->_dirImg . "/course/" . $infoItem['imageThumbnail'] ?>"
                                         alt="" height="40px">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Image</label>
                                <div class="col-sm-6 text-left">
                                    <input type="file" class="form-control" onchange="readURL(this);" name="imageThumbnail">
                                    <span class="help-block"><i style="color: red"> *</i>Select a new one if you want to change image</span>
                                    <div class="blah">
                                        <img id="blah" src="#" height="50px"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Description</label>
                                <div class="col-sm-6">
                                    <textarea name="form[description]" id="ckeditorDescription" rows="10" cols="80">
                                        <?php if (isset($infoItem['description'])) echo $infoItem['description'] ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    CKEDITOR.replace('ckeditorDescription');
</script>