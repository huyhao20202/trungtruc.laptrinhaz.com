<?php
$url=['convert'=>URL::createLink('default','user','convertPoint',null,'convert-point.html')];
?>
<section id="featured-request-teacher" class="featured-request-teacher section" style="color: #0b5fc6">
    <div class="awe-parallax "></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="request-featured">
                    <h1 class="big text-center">Thực hiện đổi điểm</h1>
                    <div class="form-forget">
                        <?php
                        echo $this->errors;
                        echo $this->success;
                        ?>
                        <form action="<?php echo $url['convert']?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail2" style="font-weight: bold;">Nhập số điểm muốn đổi:</label>
                                <input type="number" name="form[convert]" class="form-control form-forget" id="exampleInputEmail2" placeholder="point">
                                <div class="errorPass"></div>
                            </div>
                             <div class="show-money"></div>

                            <button type="submit" class="btn btn-default changPass">Change</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }
    var money='<?php echo $this->money[0]['current_money'] ?>';
    $("input[name='form[convert]']").keyup(function () {
        console.log(money);
        var value=$(this).val();
        var compute=(money*value);
        var format=formatNumber(compute,'.',',')
        $(".show-money").text(format+" VNĐ");
    })

</script>