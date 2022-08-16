<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Lịch sử thanh toán</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="d-sm-table-cell" style="width: 70px;">#</th>
                                <th class="d-sm-table-cell">Mô tả</th>
                                <th class="d-sm-table-cell text-center">Số tiền</th>
                                <th class="d-sm-table-cell">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $lists = $db->where('uid', $me->uid)->where('type', 'service')->orderBy('id', 'DESC')->get('history');
                            $counts = count($lists);
                            foreach ($lists as $k => $x) {
                                $counts--;
                            ?>
                            <tr>
                                <td class="d-sm-table-cell"><?= $counts; ?></td>
                                <td class="d-sm-table-cell"><?= $x['content']; ?></td>
                                <td class="d-sm-table-cell text-center"><?= number_format($x['total_money']); ?> VNĐ</td>
                                <td class="d-sm-table-cell"><?= date('H:i:s - d/m/Y', $x['time']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div style="display: table; margin:0 auto;">
                    <nav>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>