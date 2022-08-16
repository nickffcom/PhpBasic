<style>
    th, td {
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">
                    Danh sách sản phẩm <?= mb_strtoupper($type); ?>
                    <span style="width: 250px;">
                        <select id="status" class="form-control">
                            <option value="1"<?= ($_GET['status'] == 1 ? 'selected' : ''); ?>>Hiển thị sản phẩm đã bán</option>
                            <option value="0"<?= ($_GET['status'] == 0 ? 'selected' : ''); ?>>Hiển thị sản phẩm chưa bán</option>
                            <option value="all"<?= ($_GET['status'] == 'all' ? 'selected' : ''); ?>>Hiển thị tất cả</option>
                        </select>
                    </span> 
                </h3>
            </div>
            <script>
                $('#status').bind('change', function () {
                    window.location.href = '?type=<?= $type; ?>&status=' + $(this).val();
                });
            </script>
            <div class="block-content">
                <div class="alert alert-danger">
                    Vui lòng chỉ cập nhật sản phẩm chứ không xóa sản phẩm, vì xóa sản phẩm khách hàng sẽ không thể xem/check khi mua hoặc đã mua xong!
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="d-sm-table-cell">#</th>
                                <?php if (in_array($type, array('via', 'clone'))) { ?>
                                <th class="d-sm-table-cell">UID</th>
                                <?php } ?>
                                <?php if ($type == 'bm') { ?>
                                <th class="d-sm-table-cell">BMID</th>
                                <?php } ?>
                                <th class="d-sm-table-cell">Loại</th>
                                <th class="d-sm-table-cell">Giá</th>
                                <th class="d-sm-table-cell">Trạng thái</th>
                                <th class="d-sm-table-cell">Thời gian</th>
                                <th class="d-sm-table-cell">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql = "SELECT data_service.*, service.price, service.name FROM data_service INNER JOIN service ON (data_service.type_id = service.id) WHERE service.type = '$type'";
                            
                            switch ($_GET['status']) {
                                case '0':
                                    $sql .= " AND data_service.status = 1";
                                    break;

                                case '1':
                                    $sql .= " AND data_service.status = 0";
                                    break;
                                
                                default:
                                    $sql .= "";
                                    break;
                            }

                            $sql .= " ORDER BY data_service.status ASC";

                            $lists = $db->rawQuery($sql);

                            foreach ($lists as $k => $x) {
                                $uids = $x['user_id'];
                                if ($type == 'bm') {
                                    $uids = $x['bm_id'];
                                }
                                $stt = '<span class="badge badge-success">Đã bán</span>';
                                if ($x['status'] == 1) {
                                    $stt = '<span class="badge badge-danger">Chưa bán</span>';
                                }
                            ?>
                            <tr>
                                <td class="d-sm-table-cell"><?= ($k + 1); ?></td>
                                <td class="d-sm-table-cell"><?= $uids; ?></td>
                                <td class="d-sm-table-cell"><?= $x['name']; ?></td>
                                <td class="d-sm-table-cell"><?= number_format($x['price']); ?> VNĐ</td>
                                <td class="d-sm-table-cell"><?= $stt; ?></td>
                                <td class="d-sm-table-cell"><?= date('H:i:s - d/m/Y', $x['time']); ?></td>
                                <td class="d-sm-table-cell">
                                    <button data-update="<?= $x['id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></button>
                                	<button data-delete="<?= $x['id']; ?>" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
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
<div class="modal fade" id="modal-update-data" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Cập nhật sản phẩm</h3>
                    <div class="block-options"></div>
                </div>
                <div class="block-content">
                    <form action="" id="update_data" method="POST">
                        <input type="hidden" name="t" value="update">
                        <input type="hidden" name="id">
                        <?php
                        $exp_data = explode('|', $typeUpdate[$type]);
                        foreach ($exp_data as $x) {
                        ?>
                        <div class="form-group">
                            <label><?= mb_strtoupper($x); ?> :</label>
                            <input type="text" name="<?= $x; ?>" class="form-control">
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-info btn-block"><i class="fa fa-check"></i> Lưu</button>
                    </form><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-delete]').bind('click', function () {
    	if (confirm('Chắc chắn xóa này ?')) {
    		$that = $(this);
	    	$id = $that.data('delete');
	    	$.post(api('admin/action_data'), {t: 'delete', id: $id}, function (a) {
	    		if (a.status > 0) {
	    			$that.parent().parent().fadeOut();
	    		}
	    		showNotify((a.status > 0 ? 'success' : 'error'), a.message);
	    	});
    	}
    });
    $('[data-update]').bind('click', function () {
        $that = $(this);
        $id = $that.data('update');
        $.post(api('admin/action_data'), {t: 'info', id: $id}, function (a) {
            $.each(a, (k, v) => {
                $('form#update_data').find('[name="' + k + '"]').val(v);
            });
            $('#modal-update-data').modal('show');
        });
    });
    $('form#update_data').bind('submit', function (e) {
        $.post(api('admin/action_data'), $(this).serializeArray(), function (a) {
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        e.preventDefault();
    });
    $(function () {
        $('table').DataTable({
            'charset': 'utf8',
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'responsive': true,
            'order': [
                [0, 'desc']
            ],
            'pageLength': 25,
            'lengthMenu': [
                [5, 10, 25, 50, 100, 200, 500, 1000, -1], 
                [5, 10, 25, 50, 100, 200, 500, 1000, 'Tất cả']
            ],
            'language': {
                'info': 'Hiển trị trang _PAGE_ trong tổng _PAGES_ trang',
                'searchPlaceholder': 'Nội dung...',
                'search': 'Tìm kiếm :',
                'zeroRecords': 'Không tìm thấy kết quả...',
                // 'infoEmpty': 'Không tìm thấy kết quả...',
                'infoEmpty': 'Không tìm thấy kết quả...',
                'lengthMenu': 'Hiển thị _MENU_ kết quả',
                'infoFiltered': ''
            },
            'paginate': {
                'first': 'Đầu',
                'last': 'Cuối',
                'next': 'Tiếp',
                'previous': 'Trước'
            },
            'columnDefs': [
               {
                   'type': 'input',
                   'targets': [1, 2, 3]
               }
            ]
        });
    });
</script>