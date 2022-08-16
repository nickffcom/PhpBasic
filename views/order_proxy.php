<?php 

$lists = $db->rawQuery("SELECT * FROM proxy WHERE proxy.uid='$me->uid'ORDER BY proxy.time DESC");
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
                <h3 class="block-title"><?=count($lists); ?> Proxy đã mua</h3>
            </div>
            <div class="block-content">
                <?php if (empty($lists)) { ?>
                <div class="text-center" style="font-size:20px;color:red;font-weight: bold;">Ck iu chưa quất ở wep' site Proxy bao giờ!</div>
                <?php } else { ?>
                <div class="text-center" style="font-size:20px;color:red;font-weight: bold;">Các ck iu sử dụng proxy mục đích trong sạch nhé !!!!</div>
                <?php } ?>
                <div style="border-bottom: 1px solid #e6ebf4;margin:1.1rem 0 1.75rem 0;"></div>
                <div class="table-responsive">
                    <table id="bm-table" class="table table-hover table-bordered table-vcenter">
                        <thead>
                            <tr>
                                <th style="width: 90px;">#</th>
                                <th>Tên</th>
                                <th class="d-sm-table-cell text-center text-success">Giá mua</th>
                                <th class="d-sm-table-cell text-center">Key / Địa chỉ IP</th>
                                <th class="d-sm-table-cell text-center">User|Password nếu có</th>
                                <th class="d-sm-table-cell text-center">Loại</th>
                                <th class="d-sm-table-cell text-center text-primary">Change Ip ?</th>
                                <th class="d-sm-table-cell text-center">Ngày hết hạn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counts = count($lists);
                            foreach ($lists as $x) {
                                if($x['changeip']==1){
                                    $x['changeip']="Cho đổi";
                                }
                                $counts--;
                            ?>
                            <tr>
                                
                                <td style="width: 90px;"><?= $counts; ?></td>
                                <td class="text-danger"><?= $x['name']; ?></td>
                                <td><?= $x['price']; ?></td>
                                <td class="text-primary"><?= $x['ip']; ?></td>
                                <td> <?= $x['user_pwd']; ?></td>
                                <td>
                                    <?= $x['type']; ?>
                                </td>
                                <td>
                                    <?= $x['changeip']; ?>
                                </td>
                                <td  class="d-sm-table-cell text-info" style="width: 200px;">
                                        <?= date('H:i:s - d/m/Y', $x['time_out']); ?>
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

<script>
 
</script>