<style>
    th, td {
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title"><i class="fa fa-bell"></i> Thông báo</h3>
            </div>
            <div class="block-content">
                <form id="notify" method="POST">
                	<input type="hidden" name="t" value="add">
                	<div class="form-group">
                		<label>Nội dung thông báo :</label>
                		<textarea name="content" class="form-control" placeholder="Nhập nội dung thông báo...." rows="6"></textarea>
                	</div>
                	<button type="submit" class="btn btn-success"><i class="fa fa-bell"></i> Thêm thông báo</button>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Danh sách thông báo</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="d-sm-table-cell" style="width: 70px;">#</th>
                                <th class="d-sm-table-cell">Thông báo</th>
                                <th class="d-sm-table-cell">Thời gian</th>
                                <th class="d-sm-table-cell">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $lists = $db->orderBy('id', 'DESC')->get('notify');
                            foreach ($lists as $k => $x) {
                            	$content = $x['content'];
                            	if (mb_strlen($content) > 50) {
                            		$content = substr($content, 0, 50) . '...';
                            	}
                            ?>
                            <tr>
                                <td class="d-sm-table-cell"><?= $x['id']; ?></td>
                                <td class="d-sm-table-cell" style="font-weight: bold;"><?= text_style($content); ?></td>
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
<div class="modal fade" id="modal-update-notify" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Chỉnh sửa thông báo</h3>
                    <div class="block-options"></div>
                </div>
                <div class="block-content">
                    <form action="" id="update_notify" method="POST">
                        <input type="hidden" name="t" value="update">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label>Nội dung thông báo :</label>
                            <textarea name="content" class="form-control" placeholder="Nhập nội dung thông báo...." rows="6"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info btn-block"><i class="fa fa-check"></i> Lưu</button>
                    </form><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('form#notify').bind('submit', function (e) {
        $.post(api('admin/notify'), $(this).serializeArray(), function (a) {
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        e.preventDefault();
    });
    $('[data-delete]').bind('click', function () {
    	if (confirm('Chắc chắn xóa thông báo này ?')) {
    		$that = $(this);
	    	$id = $that.data('delete');
	    	$.post(api('admin/notify'), {t: 'delete', id: $id}, function (a) {
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
        $.post(api('admin/notify'), {t: 'info', id: $id}, function (a) {
            $.each(a, (k, v) => {
                $('form#update_notify').find('[name="' + k + '"]').val(v);
            });
            $('#modal-update-notify').modal('show');
        });
    });
    $('form#update_notify').bind('submit', function (e) {
        $.post(api('admin/notify'), $(this).serializeArray(), function (a) {
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        e.preventDefault();
    });
</script>