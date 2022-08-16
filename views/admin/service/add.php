<style>
    .badge {
        font-size: 13px;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Thêm sản phẩm <?= mb_strtoupper($type); ?></h3>
            </div>
            <div class="block-content">
                <div class="alert alert-info">
                    Định dạng : <b><?= $typeFormat[$type]; ?></b> <font color="red">( Sai định dạng là thêm thất bại )</font>
                </div>
                <form id="add" method="POST">
                	<input type="hidden" name="t" value="add">
                    <div class="form-group">
                        <label>Dữ liệu <?= mb_strtoupper($type); ?> :</label>
                        <textarea name="data" class="form-control" placeholder="Nhập dữ liệu <?= mb_strtoupper($type); ?> cần thêm...." rows="7" required=""></textarea>
                    </div>
                	<div class="form-group">
                		<label>Loại :</label>
                		<select name="type_id" class="form-control">
                            <?php foreach ($services[$type] as $x) { ?>
                            <option value="<?= $x['id']; ?>"><?= $x['name']; ?> - Giá : <?= number_format($x['price']); ?> VNĐ ( Số lượng : <?= number_format($x['count_max']); ?> )</option>
                            <?php } ?>
                        </select>
                	</div>
                    <div class="count form-group">
                        <span class="badge badge-info">Tổng : <span class="total">0</span></span>
                        <span class="badge badge-success">Thành công : <span class="success">0</span></span>
                        <span class="badge badge-danger">Thất bại : <span class="error">0</span></span>
                    </div>
                	<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> Thêm dữ liệu</button>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
<script>
    $('[name="data"]').bind('keyup', function () {
        $('div.count .total').text($(this).val().trim().split("\n").filter(i => i).length);
    });
    $('form#add').bind('submit', function (e) {
        $.post(api('admin/action_data'), $(this).serializeArray(), function (a) {
            $.each(a.count, (k, v) => {
                $('div.count .' + k).text(v);
            });
            if (a.message) {
                showNotify((a.status > 0 ? 'success' : 'error'), a.message);
            }
        });
        e.preventDefault();
    });
</script>