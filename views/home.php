<div class="row">
    <div class="col-12">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-defaul">
                <h4 class="block-title">Thông Báo</h4>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <?php 
                $lists_notify = $db->get('notify');
                foreach ($lists_notify as $x) {
                ?>
                <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
                    <?= text_style($x['content']); ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- loop -->
<div class="row justify-content-center" id="mua-bm">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title">Danh sách BM</h3>
                <div class="block-options">
                    <a class="btn btn-block-option" href="order?type=bm"> <i class="si si-settings"></i> BM của tôi</a>
                </div>
            </div>
            <div class="block-content">
                <?php if (empty($services['bm'])) { ?>
                <div class="text-center" style="font-size:20px;color:red;font-weight: bold;">KHU VỰC NÀY CHƯA CÓ HÀNG !</div>
                <?php } else { ?>
                <div class="row">
                    <?php foreach ($services['bm'] as $x) { ?>
                    <!-- loop -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-1">
                        <div class="custom-control custom-block custom-control-primary">
                            <input type="checkbox" class="custom-control-input service-checked" id="bm_id_<?= $x['id']; ?>" name="type" value="<?= $x['id']; ?>">
                            <label class="custom-control-label p-2" for="bm_id_<?= $x['id']; ?>">
                                <span class="d-flex align-items-center">
                          <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;"><strong><?= number_format($x['count_max']); ?></strong></div>
                            <span class="hcss ml-2">
                                <span class="font-w700"><?= $x['name']; ?></span>
                                    <!--<span class="d-block font-size-sm text-muted"><?= $x['description']; ?></span>-->
                                    <i style="position:absolute;right:5px;bottom:10px;" class="fa fa-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?= $x['description']; ?>"></i>
                                    <span class="d-block font-size-sm text-muted"><!-- <i class="font-w400" style="font-size: 0.77rem;"><del>0 VNĐ</del></i> --><strong class="text-danger"> » <?= number_format($x['price']); ?> VNĐ</strong></span>
                                    </span>
                                </span>
                            </label>
                            <span class="custom-block-indicator">
                                <i class="fa fa-check"></i>
                            </span>
                        </div>
                    </div>
                    <!-- /loop -->
                    <?php } ?>
                </div>
                <?php } ?>
                <div style="border-bottom: 1px solid #e6ebf4;margin:1.1rem 0 1.75rem 0;"></div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button class="d-inline-block btn btn-hero-sm btn-hero-info buy_service">Mua BM</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- loop -->
<div class="row justify-content-center" id="mua-via">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title">Danh sách VIA</h3>
                <div class="block-options">
                    <a class="btn btn-block-option" href="order?type=via"> <i class="si si-settings"></i> VIA của tôi</a>
                </div>
            </div>
            <div class="block-content">
                <?php if (empty($services['via'])) { ?>
                <div class="text-center" style="font-size:20px;color:red;font-weight: bold;">KHU VỰC NÀY CHƯA CÓ HÀNG !</div>
                <?php } else { ?>
                <div class="row">
                    <?php foreach ($services['via'] as $x) { ?>
                    <!-- loop -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-1">
                        <div class="custom-control custom-block custom-control-primary">
                            <input type="checkbox" class="custom-control-input service-checked" id="via_id_<?= $x['id']; ?>" name="type" value="<?= $x['id']; ?>">
                            <label class="custom-control-label p-2" for="via_id_<?= $x['id']; ?>">
                                <span class="d-flex align-items-center">
                          <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;"><strong><?= number_format($x['count_max']); ?></strong></div>
                          <span class="hcss ml-2">
                                <span class="font-w700"><?= $x['name']; ?></span>
                                    <!--<span class="d-block font-size-sm text-muted"><?= $x['description']; ?></span>-->
                                    <i style="position:absolute;right:5px;bottom:10px;" class="fa fa-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?= $x['description']; ?>"></i>
                                    <span class="d-block font-size-sm text-muted"><!-- <i class="font-w400" style="font-size: 0.77rem;"><del>0 VNĐ</del></i> --><strong class="text-danger"> » <?= number_format($x['price']); ?> VNĐ</strong></span>
                                    </span>
                                </span>
                            </label>
                            <span class="custom-block-indicator">
                                <i class="fa fa-check"></i>
                            </span>
                        </div>
                    </div>
                    <!-- /loop -->
                    <?php } ?>
                </div>
                <?php } ?>
                <div style="border-bottom: 1px solid #e6ebf4;margin:1.1rem 0 1.75rem 0;"></div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button class="d-inline-block btn btn-hero-sm btn-hero-info buy_service">Mua VIA</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- loop -->
<div class="row justify-content-center" id="mua-clone">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title">Danh sách CLONE</h3>
                <div class="block-options">
                    <a class="btn btn-block-option" href="order?type=clone"> <i class="si si-settings"></i> CLONE của tôi</a>
                </div>
            </div>
            <div class="block-content">
                <?php if (empty($services['clone'])) { ?>
                <div class="text-center" style="font-size:20px;color:red;font-weight: bold;">KHU VỰC NÀY CHƯA CÓ HÀNG !</div>
                <?php } else { ?>
                <div class="row">
                    <?php foreach ($services['clone'] as $x) { ?>
                    <!-- loop -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-1">
                        <div class="custom-control custom-block custom-control-primary">
                            <input type="checkbox" class="custom-control-input service-checked" id="clone_id_<?= $x['id']; ?>" name="type" value="<?= $x['id']; ?>">
                            <label class="custom-control-label p-2" for="clone_id_<?= $x['id']; ?>">
                                <span class="d-flex align-items-center">
                          <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;"><strong><?= number_format($x['count_max']); ?></strong></div>
                          <span class="hcss ml-2">
                                <span class="font-w700"><?= $x['name']; ?></span>
                                    <!--<span class="d-block font-size-sm text-muted"><?= $x['description']; ?></span>-->
                                    <i style="position:absolute;right:5px;bottom:10px;" class="fa fa-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?= $x['description']; ?>"></i>
                                    <span class="d-block font-size-sm text-muted"><!-- <i class="font-w400" style="font-size: 0.77rem;"><del>0 VNĐ</del></i> --><strong class="text-danger"> » <?= number_format($x['price']); ?> VNĐ</strong></span>
                                    </span>
                                </span>
                            </label>
                            <span class="custom-block-indicator">
                                <i class="fa fa-check"></i>
                            </span>
                        </div>
                    </div>
                    <!-- /loop -->
                    <?php } ?>
                </div>
                <?php } ?>
                <div style="border-bottom: 1px solid #e6ebf4;margin:1.1rem 0 1.75rem 0;"></div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button class="d-inline-block btn btn-hero-sm btn-hero-info buy_service">Mua CLONE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /loop -->
<div class="row">
    <div class="col-xl-6 col-xs-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title">Lịch Sử Nạp Tiền</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <?php 
                foreach (getHistory('payment') as $x) {
                    $id_xx = 'id***' . substr($x['uid'], 0, 2);
                ?>
                <!-- loop -->
                <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
                    <b>
                        <font color="green">
                            <img src="/assets/images/new.gif" height="18"> <?= $id_xx; ?></font> đã nạp số tiền + <font color="red"><em><?= number_format($x['total_money']); ?> VNĐ</em>
                        </font>
                    </b>
                    <span style="float: right;">
                        <span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="<?= date('H:i:s - d/m/Y', $x['time']); ?>">
                            <em><?= time_text($x['time']); ?></em>
                        </span>
                    </span>
                </div>
                <!-- /loop -->
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-xs-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title">Lịch Sử Thanh Toán</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <?php 
                foreach (getHistory('service') as $x) {
                    $username_xx = $x['username'];
                    $username_xx = substr($username_xx, 0, 2) . '***' . substr($username_xx, 5);
                ?>
                <!-- loop -->
                <div class="font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-success rounded-right">
                    <b>
                        <font color="green">
                            <i class="fa fa-bell"></i> <?= $username_xx; ?></font>: <font color="red"><?= $x['content']; ?> - tổng <?= number_format($x['total_money']); ?> VNĐ
                        </font>
                    </b>
                    <span style="float: right;">
                        <span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="<?= date('H:i:s - d/m/Y', $x['time']); ?>">
                            <em><?= time_text($x['time']); ?></em>
                        </span>
                    </span>
                </div>
                <!-- /loop -->
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('input.service-checked').bind('click', function () {
        $that = $(this);
        if ($that.is(':checked')) {
            $('input.service-checked').prop('checked', 0);
            $that.prop('checked', 1);
        } else {
            $that.prop('checked', 0);
        }
    });

    $('.buy_service').bind('click', function () {
        $type = $('[name="type"]:checked').val();
        if (!$type) {
            return showNotify('error', 'Vui lòng chọn một loại ' + $(this).text().split(" ")[1]);
        }
        $quantity = prompt('Nhập số lượng muốn mua : ', 100);
        if ($quantity < 1 || isNaN($quantity)) {
            return showNotify('error', 'Vui lòng nhập số lượng hợp lệ');
        }
        const $notice = showNotify({
            type: 'info',
            text: 'Đang thực hiện giao dịch..',
            hide: false,
            clickToClose: false
        });
        $.post(api('buy'), {id: $type, quantity: $quantity}, function (a) {
            if (a.status > 0) {
                setTimeout(function () {
                    window.location = a.move_location;
                }, 1500);
            }
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        setTimeout(function () {
            $notice.remove();
        }, 1000);
    });
</script>
<script type="text/javascript">
               swal({
                        title: "Ae yên tâm mua nhé...",
                        html:true,
                        text: " Bảo hành 1-1  sai pass, login đầu , hàng chưa đụng gì đến Ads và ko bảo hành hạn chế ,,,khách hàng nạp trên 100k sẽ được Admin backup free (số lượng <10)<br>",   
                        showConfirmButton:true

                     }, function() {


                        });
                        
              Swal.fire(
  'The Internet?',
  'That thing is still around?',
  'question'
)          
</script>
