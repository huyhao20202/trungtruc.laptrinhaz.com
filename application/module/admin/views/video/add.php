<?php
$infoItem = $this->infoItem;
$url = [
    'save' => URL::createLink('admin', DB_TBVIDEO, 'add', ['type' => 'save','id'=>$this->arrParam['id']]),
    'save-close' => URL::createLink('admin', DB_TBVIDEO, 'add', ['type' => 'close','id'=>$this->arrParam['id']]),
    'save-new' => URL::createLink('admin', DB_TBVIDEO, 'add', ['type' => 'new','id'=>$this->arrParam['id']]),
    'cancel' => URL::createLink('admin', DB_TBVIDEO, 'index',['id'=>$this->arrParam['id']])
];

$listCourse = empty($this->listCourse) ? [] : $this->listCourse;
$infoItem = empty($this->infoItem) ? ['name' => '', 'category_id' => 0, 'link' => ''] : $this->infoItem;
$course_id = isset($infoItem ['course_id']) ? $infoItem['course_id'] : 0;
$selectBox = Helper::cmsSelecbox($listCourse, 'form[course_id]', 'form-control', $course_id);

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
                                    <input type="text" class="form-control" placeholder="Video" name="form[title]"
                                           value="<?php if (isset($infoItem['title'])) echo $infoItem['title'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Link Youtube<i style="color: red"> *</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="form[link]" placeholder="Link Youtube"
                                           value="<?php if (isset($infoItem['link'])) echo $infoItem['link'] ?>"
                                    >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Course<i style="color: red"> *</i></label>

                                <div class="col-sm-6">
                                    <?php echo $selectBox ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

