<?php 
if (!($type == 'via')) {
	exit();
}
?>
<style>
    th, td {
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title"><i class="fa fa-upload"></i> Upload Backup <?= mb_strtoupper($type); ?></h3>
            </div>
            <div class="block-content">
            	<div class="alert alert-danger">
            		- Có thể chọn nhiều File để Upload cùng 1 lúc <br>
            		- Trong tên File phải có UID để hệ thống tự định dạng và tải cho khách! <br>
            		- Upload thất bại do : file không hợp lệ, file không phải đuôi .html, không có UID trong tên File <br>
            		- Nếu File trùng tên hoặc tồn tại, hệ thống sẽ xóa File cũ và đè dữ liệu lên File mới
            	</div>
                <form id="upload" method="POST" enctype="multipart/form-data">
                	<input type="hidden" name="t" value="upload_backup">
                	<div class="form-group">
                		<label>Chọn File :</label>
                		<input type="file" name="files[]" class="form-control" multiple="" accept=".html">
                	</div>
                	<div class="count form-group">
                        <span class="badge badge-info">Tổng : <span class="total">0</span></span>
                        <span class="badge badge-success">Thành công : <span class="success">0</span></span>
                        <span class="badge badge-danger">Thất bại : <span class="error">0</span></span>
                    </div>
                	<button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Upload</button>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
<script>
	$('form#upload').bind('submit', function (e) {
		$form = new FormData($(this)[0]);
		$.ajax({
			url: api('admin/action_data'),
			data: $form,
			cache: false,
			processData: false,
			contentType: false,
			method: 'POST',
			success: (a) => {
				$.each(a.count, (k, v) => {
	                $('div.count .' + k).text(v);
	            });
				showNotify((a.status > 0 ? 'success' : 'error'), a.message);
			},
            error: () => {
                showNotify('error', 'Upload thất bại, vui lòng tải lại trang!');
            }
		});
		e.preventDefault();
	});
</script>