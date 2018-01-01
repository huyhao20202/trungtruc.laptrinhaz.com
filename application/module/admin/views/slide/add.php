<?php
$infoItem=$this->infoItem;

$url = [
    'save' => URL::createLink('admin', DB_TBSLIDE, 'add', ['type' => 'save']),
    'save-close' => URL::createLink('admin', DB_TBSLIDE, 'add', ['type' => 'close']),
    'save-new' => URL::createLink('admin', DB_TBSLIDE, 'add', ['type' => 'new']),
    'cancel' => URL::createLink('admin', DB_TBSLIDE, 'index')
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
                                <label class="col-sm-3 text-right control-label">Title<i style="color: red"> *</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  name="form[title]"
                                           value="<?php if (isset($infoItem['title'])) echo $infoItem['title'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Content<i style="color: red"> *</i></label>
                                <div class="col-sm-6">
                                    <textarea name="form[content]" id="ckeditorDescription" rows="10" cols="80">
                                        <?php if (isset($infoItem['content'])) echo $infoItem['content'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Ordering<i style="color: red"> *</i></label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control"  name="form[ordering]" min="1"
                                           value="<?php if (isset($infoItem['ordering'])) echo $infoItem['ordering'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Picture</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" onchange="readURL(this);"
                                           name="picture">
                                    <div class="blah">
                                        <img id="blah" src="#" height="50px"/>
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
<script>
    CKEDITOR.replace('ckeditorDescription');
    CKEDITOR.replace('ckeditorSourse');
</script>