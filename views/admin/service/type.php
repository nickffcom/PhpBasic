<style>
    th, td {
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Phân loại <?= mb_strtoupper($type); ?></h3>
            </div>
            <div class="block-content">
                <form id="add" method="POST">
                	<input type="hidden" name="t" value="add">
                    <input type="hidden" name="type" value="<?= $type; ?>">
                    <div class="form-group">
                        <label>Tên <?= mb_strtoupper($type); ?> :</label>
                        <input type="text" name="name" placeholder="Nhập tên <?= mb_strtoupper($type); ?>" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Mô tả <?= mb_strtoupper($type); ?> :</label>
                        <textarea name="description" placeholder="Mô tả <?= mb_strtoupper($type); ?>" class="form-control" rows="4" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label>Giá tiền :</label>
                        <input type="number" name="price" placeholder="Giá tiền <?= mb_strtoupper($type); ?>" class="form-control" required="">
                    </div>
                	<button type="submit" class="btn btn-danger"><i class="fa fa-plus-circle"></i> Thêm <?= mb_strtoupper($type); ?></button>
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
                <h3 class="block-title">Danh sách <?= mb_strtoupper($type); ?></h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="d-sm-table-cell">#</th>
                                <th class="d-sm-table-cell">Tên</th>
                                <th class="d-sm-table-cell">Mô tả</th>
                                <th class="d-sm-table-cell">Giá</th>
                                <th class="d-sm-table-cell">Thời gian</th>
                                <th class="d-sm-table-cell">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $lists = $db->where('type', $type)->orderBy('id', 'DESC')->get('service');
                            foreach ($lists as $k => $x) {
                            	$description = $x['description'];
                            ?>
                            <tr>
                                <td class="d-sm-table-cell"><?= ($k + 1); ?></td>
                                <td class="d-sm-table-cell"><?= $x['name']; ?></td>
                                <td class="d-sm-table-cell" style="font-weight: bold;"><?= $description; ?></td>
                                <td class="d-sm-table-cell"><?= number_format($x['price']); ?> VNĐ</td>
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
<div class="modal fade" id="modal-edit-service" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"><i class="fa fa-edit"></i> Chỉnh sửa <?= mb_strtoupper($type); ?></h3>
                    <div class="block-options"></div>
                </div>
                <div class="block-content">
                    <form action="" id="update_service">
                        <input type="hidden" name="t" value="update">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label>Tên <?= mb_strtoupper($type); ?> :</label>
                            <input type="text" name="name" placeholder="Nhập tên <?= mb_strtoupper($type); ?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Mô tả <?= mb_strtoupper($type); ?> :</label>
                            <textarea name="description" placeholder="Mô tả <?= mb_strtoupper($type); ?>" class="form-control" rows="4" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label>Giá tiền :</label>
                            <input type="number" name="price" placeholder="Giá tiền <?= mb_strtoupper($type); ?>" class="form-control" required="">
                        </div>
                        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Lưu cập nhật</button>
                    </form><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('form#add').bind('submit', function (e) {
        $.post(api('admin/service'), $(this).serializeArray(), function (a) {
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        e.preventDefault();
    });
    $('[data-delete]').bind('click', function () {
    	if (confirm('Chắc chắn xóa loại này ?')) {
    		$that = $(this);
	    	$id = $that.data('delete');
	    	$.post(api('admin/service'), {t: 'delete', id: $id}, function (a) {
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
        $.post(api('admin/service'), {t: 'info', id: $id}, function (a) {
            $.each(a, (k, v) => {
                $('form#update_service').find('[name="' + k + '"]').val(v);
            });
            $('#modal-edit-service').modal('show');
        });
    });
    $('form#update_service').bind('submit', function (e) {
        $.post(api('admin/service'), $(this).serializeArray(), function (a) {
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        e.preventDefault();
    });
</script>