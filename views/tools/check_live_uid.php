<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="block block-rounded block-themed block-fx-pop">
            <div class="block-header bg-info">
                <h3 class="block-title">Check Live UID </h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <div class="form-group">
                        <label for="textarea" class="control-label">Nhập List ID</label>
                        <textarea class="form-control" id="listclone"  example-textarea-input  wrap ="off" rows="6" placeholder="Mỗi Dòng 1 ID" onpaste="setTimeout( e => {tinhtien()},100)"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea" class="control-label">Check thoải mái đi ae - vì nó free mà   -Ae có thể bỏ vào gì vào cũng đc ,miễn đầu tiên là uid dạng 1000</label>
                        <!--<input class="form-control" id="ngancach" placeholder="Ký tự ngăn cách" value="|"></input>-->
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <span class="nav-main-link-badge badge badge-pill badge-primary">Tổng: <b id="total">0</b></span>-->
                    <!--    <span class="nav-main-link-badge badge badge-pill badge-success">Live: <b id="live">0</b></span>-->
                    <!--    <span class="nav-main-link-badge badge badge-pill badge-danger">Die: <b id="die">0</b></span>-->
                    <!--</div>-->
                    
                    <div class="clearfix">
                        <div class="form-group text-center">
                            <button class="d-inline-block btn btn-hero-sm btn-hero-info" onclick="check_live_uid();">CHECK LIVE UID</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textarea" class="control-label">UID LIVE</label>
                     <textarea wrap="off" class="form-control form-control-alt" id="listclonelive" name="example-textarea-input" rows="6" placeholder="Không có dữ liệu" style="font-size: 14px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea" class="control-label">UID DIE</label>
                      <textarea wrap="off" class="form-control form-control-alt is-invalid" id="listclonedie" name="example-textarea-input" rows="6" placeholder="Không có dữ liệu" style="font-size: 14px;"></textarea>
                    </div>
                </div>
            </div>
            <div style="position: sticky; bottom: 0; margin-bottom: 0;">
           
            <span class="live badge badge-success" style="display: none;">Live: <span class="" id="live">0</span></span>
            <span class="die badge badge-danger" >Die: <span class="" id="die">0</span></span>

            <!-- Animated -->
            <div class="progress push" style="position: sticky; bottom: 0px; margin-bottom: 0px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 200%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100">
                    <span class="font-size-sm font-w600">100%</span>
                </div>
            </div>
            <!-- END Animated -->

        </div>
        </div>
    </div>
</div>
<script>
   
function copyToClipboard_live() {
	
	/* Get the text field */
	var copyText = document.getElementById("listclonelive");
	
	/* Select the text field */
	copyText.select();
	copyText.setSelectionRange(0, 99999); /*For mobile devices*/
	
	/* Copy the text inside the text field */
	document.execCommand("copy");
	
	//Thong bao
	Dashmix.helpers('notify', {from: 'bottom', align: 'left', type: 'success', icon: 'fa fa-check mr-1', message: 'Đã copy!'});
}

function copyToClipboard_die() {
    
    /* Get the text field */
    var copyText = document.getElementById("listclonedie");
    
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/
    
    /* Copy the text inside the text field */
    document.execCommand("copy");
    
    //Thong bao
    Dashmix.helpers('notify', {from: 'bottom', align: 'left', type: 'success', icon: 'fa fa-check mr-1', message: 'Đã copy!'});
}

var listclone, arrclone, n, c;
var live, die;
function check_live_uid() {
    $('#checkliveuid').prop('disabled', true);
    $('#listclonelive').val("");
    $('#listclonedie').val("");
    $('.progress').show();
    n = 0;
    live = 0;
    die = 0;
    listclone = $('#listclone').val().trim();
    arrclone = listclone.split('\n');
    c = arrclone.length;
    for (var i = 0; i < 20; i++) {
        check_live_uid_progress();
    }
}

function check_live_uid_progress() {
    n = n + 1;
    var m = n - 1;
    var uid = get_uid(arrclone[m]);
    var url = 'https://graph.facebook.com/' + uid + '/picture?type=normal';
    fetch(url).then((response) => {
        if (/100x100/.test(response.url)) {
            $('.live').show();
            live++;
            $('#live').html(live);
            $('#listclonelive').val($('#listclonelive').val() + arrclone[m] + '\n');
        }else {
            $('.die').show();
            die++;
            $('#die').html(die);
            $('#listclonedie').val($('#listclonedie').val() + arrclone[m] + '\n');
        }
        var r = $(".progress-bar");
        var t = Math.floor(n * 100 / c);
        r.css("width", t + "%"), jQuery("span", r).html(t + "%");
        if (n < c) {
            check_live_uid_progress();
        }else {
            $('#checkliveuid').prop('disabled', false);
            return false;
        }
    });


}

function get_uid(data) {
    var clone = data.split("|");
    return clone[0];
}


</script>