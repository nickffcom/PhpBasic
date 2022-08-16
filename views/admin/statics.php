<?php 
$time_day = date('H') . ' hour';
$time_month = date('d') . ' day';
if (date('d') == 1) {
    $time_month = date('H') . ' hour';
}

$count_today = statistic($time_day);
$count_month = statistic($time_month);
$count_all = statistic();

function statistic ($time = '') {
    global $db;
    if (!empty($time)) {
        $db->where('time', strtotime("- $time"), '>=');
    }
    $value = $db->where('type', 'payment')->getValue('history', 'SUM(total_money)');
    return $value;
}
?>
<style>
    th, td {
        text-align: center;
    }
    .badge {
        font-size: 17px;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title"><i class="fa fa-money-bill-alt"></i> Thống kê doanh thu</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="DataTable table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="d-sm-table-cell">Doanh thu hôm nay ( <?= date('d'); ?> )</th>
                                <th class="d-sm-table-cell">Doanh thu tháng này ( <?= date('m/Y'); ?> )</th>
                                <th class="d-sm-table-cell">Doanh thu toàn bộ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-sm-table-cell">
                                    <span class="badge badge-info">+ <?= number_format($count_today); ?> VNĐ</span> 
                                </td>
                                <td class="d-sm-table-cell">
                                    <span class="badge badge-danger">+ <?= number_format($count_month); ?> VNĐ</span> 
                                </td>
                                <td class="d-sm-table-cell">
                                    <span class="badge badge-success">+ <?= number_format($count_all); ?> VNĐ</span> 
                                </td>
                            </tr>
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