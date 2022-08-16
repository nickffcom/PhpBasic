<style>
    th, td {
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title"><i class="fa fa-cog"></i> Cài đặt</h3>
            </div>
            <div class="block-content">
                <form id="settings" method="POST">
                	<input type="hidden" name="t" value="settings">
                    <div class="form-group">
                        <label>Vietcombank Session :</label>
                        <textarea name="vietcombank_data" class="form-control" placeholder="Vietcombank Session..." rows="6"></textarea>
                    </div>
                	<button type="submit" class="btn btn-success"><i class="fa fa-cog"></i> Lưu cài đặt</button>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
<script>
    const $settings = <?= json_encode($settings); ?>;
    $.each($settings, (k, v) => {
        $('form#settings').find('[name="' + k + '"]').val(v);
    });
    $('form#settings').bind('submit', function (e) {
        $.post(api('admin/action'), $(this).serializeArray(), function (a) {
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        e.preventDefault();
    });
</script>