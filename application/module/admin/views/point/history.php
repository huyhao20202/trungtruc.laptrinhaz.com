<?php
$infoUser=$this->data;
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
                                                <th>Current Point</th>
                                                <th>Email</th>
                                                <th>Point convert</th>
                                                <th>Money</th>
                                                <th>date</th>
                                                <th>time</th>
                                                <th>status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($infoUser as $key => $value) { ?>
                                                <tr role="row" class="odd">
                                                    <td><input type="checkbox" name="cid[]"
                                                               value="<?php echo $value['id'] ?>">
                                                    </td>
                                                    <td><?php echo $value['current_point'] ?></td>
                                                    <td><?php echo $value['email'] ?></td>
                                                    <td><?php echo $value['point_convert'] ?></td>
                                                    <td><?php echo number_format($value['money'],0,'.','.')." VNĐ" ?></td>
                                                    <td><?php echo $value['date_convert'] ?></td>
                                                    <td><?php echo $value['time'] ?></td>
                                                    <td ><?php if($value['status']==0)
                                                        echo "<a class='processing' href='#' value='".$value['id']."' >Processing...</a>";
                                                    else
                                                        echo "<a class='processing' href='#'>Completed</a>";
                                                        ?></td>

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
<script>
    $(".processing").click(function (e) {
        e.preventDefault();
        var value=$(this).attr("value");
        var valueText =$(this).text().trim();
        if(valueText == 'Processing...'){
            $.ajax({
                url:ROOT_URL+'index.php?module=admin&controller=point&action=statusConvert',
                dataType:'text',
                data:{id:value},
                success:function(data){
                    $(".processing").text("Completed");
                }
            })
        }

    })
</script>
