<style>
    th, td {
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title"><i class="fa fa-user"></i> Danh sách thành viên</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="DataTable table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="d-sm-table-cell" style="width: 70px;">UID</th>
                                <th class="d-sm-table-cell">Username</th>
                                <th class="d-sm-table-cell">Số dư</th>
                                <th class="d-sm-table-cell">Loại tài khoản</th>
                                <th class="d-sm-table-cell">Thời gian tạo</th>
                                <th class="d-sm-table-cell">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $lists_users = $db->orderBy('uid', 'DESC')->get('users');
                            foreach ($lists_users as $k => $x) {
                                $roleText = 'Thành viên';
                                if ($x['is_admin'] > 0) {
                                    $roleText = 'Admin';
                                }
                            ?>
                            <tr>
                                <td class="d-sm-table-cell"><?= $x['uid']; ?></td>
                                <td class="d-sm-table-cell" style="font-weight: bold;"><?= $x['username']; ?></td>
                                <td class="d-sm-table-cell">
                                    <span class="badge badge-success"><?= number_format($x['money']); ?> VNĐ</span> 
                                </td>
                                <td class="d-sm-table-cell"><?= $roleText; ?></td>
                                <td class="d-sm-table-cell"><?= time_text($x['create_time']); ?></td>
                                <td class="d-sm-table-cell">
                                    <button data-update="<?= $x['uid']; ?>" class="btn btn-info"><i class="fa fa-eye"></i></button>
                                	<button data-delete="<?= $x['uid']; ?>" class="btn btn-danger"><i class="fa fa-times"></i></button>
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
<div class="modal fade" id="modal-update-users" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title">Chỉnh sửa thành viên</h3>
                    <div class="block-options"></div>
                </div>
                <div class="block-content">
                    <form action="" id="update_users" method="POST">
                        <input type="hidden" name="t" value="update">
                        <input type="hidden" name="uid">
                        <div class="form-group">
                            <label>Tài khoản :</label>
                            <input type="text" name="username" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu :</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Loại tài khoản :</label>
                            <select name="is_admin" class="form-control">
                                <option value="0">Thành viên</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info btn-block"><i class="fa fa-check"></i> Lưu</button>
                    </form><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
    $('[data-delete]').bind('click', function () {
    	if (confirm('Chắc chắn xóa thành viên này ?')) {
    		$that = $(this);
	    	$id = $that.data('delete');
	    	$.post(api('admin/users'), {t: 'delete', uid: $id}, function (a) {
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
        $.post(api('admin/users'), {t: 'info', uid: $id}, function (a) {
            $.each(a, (k, v) => {
                $('form#update_users').find('[name="' + k + '"]').val(v);
            });
            if (a.message) {
                showNotify((a.status > 0 ? 'success' : 'error'), a.message);
            } else {
                $('#modal-update-users').modal('show');
            }
        });
    });
    $('form#update_users').bind('submit', function (e) {
        $.post(api('admin/users'), $(this).serializeArray(), function (a) {
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        e.preventDefault();
    });
</script>