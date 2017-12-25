<?php
$infoItem = empty($this->infoItem) ? ['name' => '', 'category_id' => 0, 'link' => ''] : $this->infoItem;
$url = [
    'save' => URL::createLink('admin',  $this->arrParam['controller'], 'edit',['id'=>$this->arrParam['id']]),
    'cancel' => URL::createLink('admin',  $this->arrParam['controller'], 'index')
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
                                <label class="col-sm-3 text-right control-label">Author<i style="color: red"> *</i></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Author" name="form[name]"
                                           value="<?php if (isset($infoItem['name'])) echo $infoItem['name'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Current Avatar</label>
                                <div class="col-sm-6 text-left">
                                    <img src="<?php echo $this->_dirImg . "/author/" . $infoItem['avatar'] ?>"
                                         alt="No Image" height="40px">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Avatar</label>
                                <div class="col-sm-6 text-left">
                                    <input type="file" class="form-control" onchange="readURL(this);" name="avatar">
                                    <span class="help-block"><i style="color: red"> *</i>Select a new one if you want to change image</span>
                                    <div class="blah">
                                        <img id="blah" src="#" height="50px"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Info</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Info" name="form[info]"
                                           value="<?php if (isset($infoItem['info'])) echo $infoItem['info'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Email" name="form[email]"
                                           value="<?php if (isset($infoItem['email'])) echo $infoItem['email'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Facebook</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Facebook" name="form[facebook]"
                                           value="<?php if (isset($infoItem['facebook'])) echo $infoItem['facebook'] ?>"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label">Phone</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Phone" name="form[phone]"
                                           value="<?php if (isset($infoItem['phone'])) echo $infoItem['phone'] ?>"
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

