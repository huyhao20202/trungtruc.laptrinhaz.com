<?php
$infoUser=$this->dataUser;
$url=['edit'=>URL::createLink('admin','point','edit'),
    'history'=>URL::createLink('admin','point','history')];
?>
<div class="content-wrapper category" style="min-height: 915.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
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
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <form action="#" method="post" id="adminForm">
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                               role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="no-sort"><input type="checkbox" name="checkall-toggle"></th>
                                                <th>Point</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Notice</th>
                                                <th>ID</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($infoUser as $key => $value) { ?>
                                                <tr role="row" class="odd">
                                                    <td><input type="checkbox" name="cid[]"
                                                               value="<?php echo $value['id'] ?>">
                                                    </td>
                                                    <td><a href="#"
                                                           onclick="submitForm('<?php echo $url['edit'] . "&id=" . $value['id'] ?>')"
                                                        ><?php echo $value['all_point'] ?></td>
                                                    <td><?php echo $value['fullname'] ?></td>
                                                    <td><a href="<?php echo $url['history'].'&idUser='.$value['id']?>"><?php echo $value['email'] ?></a></td>
                                                    <td><?php if(isset($value['notice'])) echo "Waiting..."?></td>
                                                    <td><?php echo $value['id'] ?></td>
                                                </tr>

                                                <?php
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- /.box-body -->
                </div>
                <!--            </form>-->
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <!-- /.content -->
</div>
