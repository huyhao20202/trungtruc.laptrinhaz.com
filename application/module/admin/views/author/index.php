<?php
$listItem = empty($this->listItem) ? [] : $this->listItem;
$url = array(
    'add' => URL::createLink('admin', $this->arrParam['controller'], 'add'),
    'edit' => URL::createLink('admin', $this->arrParam['controller'], 'edit'),
    'delete' => URL::createLink('admin', $this->arrParam['controller'], 'delete'),
    'active' => URL::createLink('admin', $this->arrParam['controller'], 'status', ['type' => 1]),
    'inactive' => URL::createLink('admin', $this->arrParam['controller'], 'status', ['type' => 0]),
);
?>
<div class="content-wrapper" style="min-height: 915.8px;" id="content">
    <!-- Content Header (Page header) -->
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
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header text-center">
                        <button class="btn btn-app"
                                onclick="javascript:submitForm('<?php echo $url['add'] ?>')"
                        >
                            <i class="fa fa-plus-square-o"></i> Add
                        </button>
                        <button class="btn btn-app"
                                onclick="javascript:submitForm('<?php echo $url['active'] ?>')"
                        >
                            <i class="fa fa-check-circle-o"></i> Active
                        </button>
                        <button class="btn btn-app"
                                onclick="javascript:submitForm('<?php echo $url['inactive'] ?>')"
                        >
                            <i class="fa fa-circle-o"></i> Inactive
                        </button>
                        <button class="btn btn-app"
                                onclick="javascript:submitForm('<?php echo $url['delete'] ?>')"
                        >
                            <i class="fa fa-minus-square-o"></i> Delete
                        </button>
                    </div>
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
                                                <th class="sorting">Name</th>
                                                <th class="no-sort">Avatar</th>
                                                <th class="sorting">Info</th>
                                                <th class="sorting">Email</th>
                                                <th class="sorting">Facebook</th>
                                                <th class="sorting">Phone</th>
                                                <th class="sorting">Created</th>
                                                <th class="sorting">Created by</th>
                                                <th class="sorting">Modified</th>
                                                <th class="sorting">Modified By</th>
                                                <th class="sorting">Status</th>
                                                <th class="sorting">ID</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($listItem as $key => $value) { ?>
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <input type="checkbox" name="cid[]"
                                                               value="<?php echo $value['id'] ?>">
                                                    </td>
                                                    <td class="sorting_1">
                                                        <a href="#"
                                                           onclick="submitForm('<?php echo $url['edit'] . "&id=" . $value['id'] ?>')"
                                                        >
                                                            <?php echo $value['name'] ?>
                                                        </a>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <img src="<?php echo $this->_dirImg . "/author/" . $value['avatar'] ?>"
                                                             alt="" height="40px">
                                                        </a>
                                                    </td>
                                                    <td><?php echo $value['info'] ?></td>
                                                    <td><?php echo $value['email'] ?></td>
                                                    <td><?php echo $value['facebook'] ?></td>
                                                    <td><?php echo $value['phone'] ?></td>
                                                    <td><?php echo $value['created'] ?></td>
                                                    <td><?php echo $value['created_by'] ?></td>
                                                    <td><?php echo $value['modified'] ?></td>
                                                    <td><?php echo $value['modified_by'] ?></td>
                                                    <td class="text-center status">
                                                        <?php
                                                        $onclick = URL::createLink('admin', DB_TBAUTHOR, 'ajaxStatus', ['id' => $value['id'], 'status' => $value['status']]);
                                                        echo '<i aria-hidden="true" onclick="javascript:ajaxStatus(\'' . $onclick . '\')" id="status-' . $value['id'] .'" class="fa ' . ($value['status'] ? 'fa-toggle-on' : 'fa-toggle-off') . '"></i>';
                                                        ?>
                                                    </td>
                                                    <td><?php echo $value['id'] ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <!-- /.content -->
</div>

