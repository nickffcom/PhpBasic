<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Lịch sử nạp tiền</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="d-sm-table-cell" style="width: 15%;">Thời gian</th>
                                <th class="d-sm-table-cell text-center" style="width: 20%;">Mã giao dịch</th>
                                <th class="d-sm-table-cell text-center" style="width: 20%;">Số tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $lists = $db->where('uid', $me->uid)->where('type', 'payment')->orderBy('id', 'DESC')->get('history');
                            foreach ($lists as $x) {
                                $action_id = (!empty($x['action_id']) ? $x['action_id'] : $x['id']);
                            ?>
                            <tr>
                                <td class="d-sm-table-cell" style="width: 30%;"><?= date('H:i:s - d/m/Y', $x['time']); ?></td>
                                <td class="d-sm-table-cell text-center" style="width: 30%;"><?= $action_id; ?></td>
                                <td class="d-sm-table-cell text-center" style="width: 30%;"><?= number_format($x['total_money']); ?> VNĐ</td>
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