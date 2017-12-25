<?php
$listCategory = empty($this->listCategory) ? [] : $this->listCategory;
$listAuthor = empty($this->listAuthor) ? [] : $this->listAuthor;
$infoItem = empty($this->infoItem) ? ['name' => '', 'category_id' => 0, 'link' => ''] : $this->infoItem;
$catefory_id = isset($infoItem ['category_id']) ? $infoItem['category_id'] : 0;
$author_id = isset($infoItem ['author_id']) ? $infoItem['author_id'] : 0;
$selectBoxCategory = Helper::cmsSelecbox($listCategory, 'form[category_id]', 'form-control', $catefory_id);
$selectBoxAuthor = Helper::cmsSelecbox($listAuthor, 'form[author_id]', 'form-control', $author_id);
$infoItem = isset($this->infoItem) ? $this->infoItem : [];;

//listTag tag complete
$listTag = $this->listTag;

$url = [
    'save' => URL::createLink('admin', DB_TBCOURSE, 'add', ['type' => 'save']),
    'save-close' => URL::createLink('admin', DB_TBCOURSE, 'add', ['type' => 'close']),
    'save-new' => URL::createLink('admin', DB_TBCOURSE, 'add', ['type' => 'new']),
    'cancel' => URL::createLink('admin', DB_TBCOURSE, 'index')
];
?>

<div class="content-wrapper" style="min-height: 915.8px;">
    <section class="content-header">
        <h1>
            Manage&nbsp;<?php echo ucfirst($this->arrParam['controller']) ?>
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
            <i class="fa fa-folder-open-o"></i> Save & Close
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
                                <label class="col-sm-3 text-right control-label">Name<i style="color: red">
                                        *</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Course" name="form[name]"
                                           value="<?php if (isset($infoItem['name'])) echo $infoItem['name'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Link Youtube<i style="color: red">
                                        *</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="form[link]" placeholder="Link Youtube"
                                           value="<?php if (isset($infoItem['link'])) echo $infoItem['link'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Image Course<i style="color: red">
                                        *</i></label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" onchange="readURL(this);" name="image">
                                    <div class="blah">
                                        <img id="blah" src="#" height="50px"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Image Thumnail Facebook</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" onchange="readURLThumbnail(this);"
                                           name="imageThumbnail">
                                    <div class="blah">
                                        <img id="blahThumbnail" src="#" height="50px"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Category<i style="color: red">
                                        *</i></label>

                                <div class="col-sm-6">
                                    <?php echo $selectBoxCategory ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Author<i style="color: red">
                                        *</i></label>

                                <div class="col-sm-6">
                                    <?php echo $selectBoxAuthor ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Tag<i style="color: red">
                                        *</i></label>
                                <div class="col-sm-6">
                                    <input name="form[tag]"
                                           id="mySingleField" value="php,javascript" type="hidden">
                                    <ul id="singleFieldTags"></ul>
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
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Link Sourse</label>
                                <div class="col-sm-6">
                                    <textarea name="form[sourse]" id="ckeditorSourse" rows="10" cols="80">
                                        <?php
                                        if (isset($infoItem['sourse'])) echo($infoItem['sourse']);
                                        else
                                            echo 'Link Github:<br>Link Driver:';
                                        ?>
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
<script type="text/javascript">
    $(function () {
        var strTag = "<?php echo $listTag ?>";
        var sampleTags = strTag.split(",");
        $('#singleFieldTags').tagit({
            availableTags: sampleTags,
            singleField: true,
            singleFieldNode: $('#mySingleField')
        });

    });
</script>
<script>
    CKEDITOR.replace('ckeditorDescription');
    CKEDITOR.replace('ckeditorSourse');
</script>