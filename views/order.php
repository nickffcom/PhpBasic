<?php 
$id = s($_GET['id']);
$type = s($_GET['type']);
if (empty($type) || !in_array($type, $typeVaild)) {
    exit();
}

$lists_order = $db->where('type', $type)->get('service', NULL, array(
    'service.*',
    '(SELECT COUNT(DISTINCT code) FROM order_service INNER JOIN data_service ON (order_service.ref_id = data_service.id) WHERE service.id = data_service.type_id AND order_service.uid = '. $me->uid .') as total_count'
));
?>
<style>
    th, td {
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-gd-dusk">
                <h3 class="block-title">Lọc <?= mb_strtoupper($type); ?> đã mua</h3>
            </div>
            <div class="block-content">
                <?php if (empty($lists_order)) { ?>
                <div class="text-center" style="font-size:20px;color:red;font-weight: bold;">KHU VỰC NÀY CHƯA CÓ HÀNG !</div>
                <?php } else { ?>
                <div class="row">
                    <?php foreach ($lists_order as $x) { ?>
                    <!-- loop -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-1">
                        <div class="custom-control custom-block custom-control-primary">
                            <input type="checkbox" class="custom-control-input service-checked" id="<?= $type; ?>_id_<?= $x['id']; ?>" name="type" value="<?= $x['id']; ?>"<?= ($id == $x['id'] ? 'checked' : ''); ?>>
                            <label class="custom-control-label p-2" for="<?= $type; ?>_id_<?= $x['id']; ?>">
                                <span class="d-flex align-items-center">
                          <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 60px;"><strong><?= number_format($x['total_count']); ?> bộ</strong></div>
                            <span class="hcss ml-2">
                                <span class="font-w700"><?= $x['name']; ?></span>
                                    <!--<span class="d-block font-size-sm text-muted"><?= $x['description']; ?></span>-->
                                    <i style="position:absolute;right:5px;bottom:10px;" class="fa fa-question-circle text-muted" data-toggle="tooltip" data-placement="top" title="<?= $x['description']; ?>"></i>
                                    <span class="d-block font-size-sm text-muted"><!-- <i class="font-w400" style="font-size: 0.77rem;"><del>0 VNĐ</del></i> --><strong class="text-danger"> <?= number_format($x['price']); ?> VNĐ</strong></span>
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
                <div class="table-responsive">
                    <table id="bm-table" class="table table-hover table-bordered table-vcenter">
                        <thead>
                            <tr>
                                <th style="width: 90px;">#</th>
                                <th>Loại <?= mb_strtoupper($type); ?></th>
                                <th class="d-sm-table-cell text-center">Số lượng</th>
                                <th class="d-sm-table-cell text-center">Giá</th>
                                <th class="d-sm-table-cell text-center">Ngày mua</th>
                                <th class="d-sm-table-cell text-center">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            $sql = "SELECT order_service.*, service.name, service.type, COUNT(*) AS total_buy, SUM(order_service.price) AS total_price FROM order_service INNER JOIN data_service ON (data_service.id = order_service.ref_id) INNER JOIN service ON (service.id = data_service.type_id) WHERE service.type = '$type' AND order_service.uid = {$me->uid}";
                            if (!empty($id) && is_numeric($id)) {
                                $sql .= " AND service.id = '$id'";
                            }
                            $sql .= " GROUP BY order_service.code ORDER BY order_service.id DESC";

                            // $list=$conn->query($sql);
                            $lists = $db->rawQuery($sql);
                            $counts = count($lists);
                            foreach ($lists as $x) {
                                $counts--;
                            ?>
                            <!-- loop -->
                            <tr>
                                <td style="width: 90px;"><?= $counts; ?></td>
                                <td><?= $x['name']; ?></td>
                                <td><?= number_format($x['total_buy']); ?></td>
                                <td><?= number_format($x['total_price']); ?></td>
                                <td class="d-sm-table-cell" style="width: 200px;"><?= date('H:i:s - d/m/Y', $x['time']); ?></td>
                                <td>
                                    <a href="" data-order="<?= $x['code']; ?>">Xem đơn hàng</a>
                                </td>
                            </tr>
                            <!-- /loop -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div><br>
                <div style="display: table; margin:0 auto;">
                    <nav>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-view-order" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Chi tiết đơn hàng</h3>
                    <div class="block-options"></div>
                </div>
                <div class="block-content">
                    <div class="table-responsive" data-xcontent></div>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <a href="javascript:;" id="xdownload">
                        <button type="button" data-download="" class="btn btn-primary">Tải xuống</button>
                    </a>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                </div>
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
        window.location.href = '?type=<?= $type; ?>' + ($that.is(':checked') ? '&id=' + $that.val() : '');
    });
    $('[data-order]').bind('click', function (e) {
        $code = $(this).data('order');
        $.get(api('view_order'), {t: 'view', code: $code}, function (a) {
            $('[data-download]').attr('data-download', $code);
            $('[data-xcontent]').html(a); 
            $('#modal-view-order').modal('show');
        });
        e.preventDefault();
    });
    $('[data-download]').bind('click', function () {
        window.location = '/api/view_order?t=download&code=' + $(this).data('download');
    });
</script>