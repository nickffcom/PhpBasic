<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Check LIMIT BM</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <div class="form-group">
                        <label for="textarea" class="control-label">Nhập List ID</label>
                        <textarea class="form-control" id="lists" rows="6" placeholder="Mỗi Dòng 1 ID" onpaste="setTimeout( e => {tinhtien()},100)"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea" class="control-label">Ký Tự Ngăn Cách</label>
                        <input class="form-control" id="ngancach" placeholder="Ký tự ngăn cách" value="|"></input>
                    </div>
                    <div class="form-group">
                        <label for="textarea" class="control-label">Cột Chứa ID ( ở đầu tiên là 0 sau | là 1 ) </label>
                        <input class="form-control" id="cotid" placeholder="Cột chứ token bắt đầu từ 0" value="0"></input>
                    </div>
                    <div class="form-group">
                        <span class="nav-main-link-badge badge badge-pill badge-primary">Tổng: <b id="total">0</b></span>
                        <span class="nav-main-link-badge badge badge-pill badge-success">Live: <b id="live">0</b></span>
                        <span class="nav-main-link-badge badge badge-pill badge-danger">Eror: <b id="die">0</b></span>
                        <span class="nav-main-link-badge badge badge-pill badge-info">BM 50$: <b id="bm50">0</b></span>
                        <span class="nav-main-link-badge badge badge-pill badge-warning">BM 350$: <b id="bm350">0</b></span>
                    </div>
                    <div class="clearfix">
                        <div class="form-group text-center">
                            <button class="d-inline-block btn btn-hero-sm btn-hero-info" onclick="clickbtn()">CHECK LIMIT BM</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textarea" class="control-label">BM 50$</label>
                        <textarea class="form-control" id="bm_50" rows="6" placeholder="Kết quả sẽ xuất hiện ở đây" disabled=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea" class="control-label">BM 350$</label>
                        <textarea class="form-control" id="bm_350" rows="6" placeholder="Kết quả sẽ xuất hiện ở đây" disabled=""></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var live, die, lists, bm50, bm350;

    function tinhtien() {
        lists = $("#lists").val().trim().split("\n");
        $("#total").html(lists.length);
    }

    function clickbtn() {
        lists = $("#lists").val().trim().split("\n");
        live = 0;
        die = 0;
        bm50 = 0;
        bm350 = 0;
        $("#btncheck").html('Vui Lòng Đợi...');
        run_script(0);
    };

    function run_script(index) {
        if (index < lists.length) {
            checklimit(index);
        } else {
            $("#btncheck").html('Hoàn Tất');
            $("#bm_50").removeAttr('disabled');
            $("#bm_350").removeAttr('disabled');
        }
    }

    function checklimit(index) {
        var cotid = $("#cotid").val().trim();
        var ngancach = $("#ngancach").val().trim();
        var id = lists[index].split(ngancach)[cotid].trim();
        $.post(api('tools/check_limit_bm'), {
            bmid: id,
        }).done(function (d) {
            // d = JSON.parse(d);
            if (d.error == false) {
                if (d.type == 50) {
                    ++bm50;
                    $("#bm50").text(bm50);
                    $("#bm_50").append(lists[index] + "\n");
                    ++live;
                    $("#live").text(live);
                    toastr.success(id + ' ~~> 50$', 'Message!')
                } else if (d.type == 350) {
                    ++bm350;
                    $("#bm350").text(bm350);
                    $("#bm_350").append(lists[index] + "\n");
                    ++live;
                    $("#live").text(live);
                    toastr.success(id + ' ~~> 350$', 'Message!')
                } else {
                    ++die;
                    $("#die").text(die);
                    toastr.error(id + ' ~~> ERROR', 'Message!')
                }
            } else if (d.error == true) {
                ++die;
                $("#die").text(die);
                toastr.error(id + ' ~~> ERROR', 'Message!')
            } else if (d.error == 'stop') {
                return !1;
            }
        }).always(function (d) {
            // d = JSON.parse(d);
            if (d.error == 'stop') {
                toastr.error(d.msg, 'Message!')
                $("#btncheck").html('Hoàn Tất');
                $("#bm_50").removeAttr('disabled');
                $("#bm_350").removeAttr('disabled');
                return !1;
            }
            run_script(index + 1);
        });
    }

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>