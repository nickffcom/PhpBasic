
<div id="page-container">
    <main id="main-container">
        <div class="bg-image">
            <div class="row no-gutters justify-content-center bg-primary-dark-op">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                            <div class="mb-2 text-center">
                                <span style="font-size: 30px;font-weight: bold;letter-spacing: 1px;color:black;"><?= $logo_text; ?></span>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">Tạo Tài Khoản</p>
                            </div>
                            <form class="js-validation-signin" name="register" method="POST">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Tài khoản" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-hero-primary"><i class="fa fa-fw fa-user mr-1"></i> Đăng Ký</button>
                                </div>
                            </form>
                        </div>
                        <div class="block-content bg-body">
                            <div class="d-flex justify-content-center text-center push">
                                <div class="font-w600 font-size-sm py-1 text-center">Đã có tài khoản? <a href="/">Đăng nhập</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    $('form').bind('submit', function (e) {
        showNotify({
            type: 'info',
            text: 'Đang đăng ký...',
            hide: false,
            clickToClose: false
        });
        $.post(api('register'), $(this).serializeArray(), function (a) {
            if (a.status > 0) {
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
            showNotify((a.status > 0 ? 'success' : 'error'), a.message);
        });
        e.preventDefault();
    });
</script>