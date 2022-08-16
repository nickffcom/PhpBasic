<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $page_title; ?></title>
    <meta name="description" content="Hệ thống bán BM, Via & Clone VN uy tính">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Ads69.net - Hệ thống bán BM, Via & Clone VN uy tín - giá rẻ">
    <meta property="og:description" content="Hệ thống bán BM, Via & Clone VN uy tính">
    <meta property="og:image" content="./assets/images/banner.png">
    <link rel="shortcut icon" href="./assets/images/fb.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <link rel="stylesheet" id="css-main" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-theme" href="/assets/css/dashmix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css" />
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="./public/css/context.bootstrap.css"/>
    <link rel="stylesheet" href="./public/css/context.standalone.css"/>
    
    <script src="/public/js/context.js"></script>
    <script src="/public/js/vue.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="./public/js/initialize.js"></script> -->

    


    <style>
        /* .sweet-alert {
            background: url('/assets/images/bg-pattern.png');
            border-radius: 2px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }
        
        body {
            cursor: url('/assets/images/click.cur'), progress;
        }
                
        a:hover, button:hover {
            cursor: url('/assets/images/hover.cur'), progress;
        }
        
        .swal-wide {
            width: 1000px !important;
        } */
    </style>
</head>

<body>
    <?php if (!$is_log) { ?>
    <?php require( $page_path ); ?>
    <?php } else { ?>
        <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">
        <nav id="sidebar" aria-label="Main Navigation">
            <div class="bg-header-dark">
                <div class="content-header bg-white-10">
                    <a class="link-fx font-w600 font-size-lg text-white" href="/">
                        <span style="font-size: 30px;font-weight: bold;letter-spacing: 3px;color:white;">
                            <?= $logo_text; ?>
                        </span>
                        <!-- <span class="smini-visible"><span class="text-white-75">F</span><span class="text-white">B</span></span>
                        <span class="smini-hidden"><span class="text-white-75"></span><img style="width: 100%;" src="/assets/images/logo.svg">
                        </span> -->
                    </a>
                    <div>
                        <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)"> <i class="fa fa-times-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <?php if ($is_admin) { ?>
                    <li class="nav-main-heading">QUẢN LÝ ADMIN</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/admin/settings"><i class="nav-main-link-icon fa fa-cog"></i>
                          <span class="nav-main-link-name">Cài đặt chung</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/admin/users"><i class="nav-main-link-icon far fa-user"></i>
                          <span class="nav-main-link-name">Thành viên</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/admin/trans"><i class="nav-main-link-icon fa fa-dollar-sign"></i>
                          <span class="nav-main-link-name">Cộng/Trừ tiền</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/admin/notify"><i class="nav-main-link-icon fa fa-bell"></i>
                          <span class="nav-main-link-name">Thông báo</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/admin/statics"><i class="nav-main-link-icon fa fa-money-bill-alt"></i>
                          <span class="nav-main-link-name">Thống kê doanh thu</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/admin/history"><i class="nav-main-link-icon fa fa-history"></i>
                          <span class="nav-main-link-name">Lịch sử hoạt động</span>
                        </a>
                    </li>
                    <?php foreach (array('bm', 'via', 'clone') as $x) { ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu active" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon fa fa-plus-circle"></i>
                                <span class="nav-main-link-name">Quản lý <?= mb_strtoupper($x); ?></span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="/admin/add?type=<?= $x; ?>">
                                        <i class="nav-main-link-icon fa fa-plus-circle"></i>
                                        <span class="nav-main-link-name">Thêm</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="/admin/manage?type=<?= $x; ?>&status=0">
                                        <i class="nav-main-link-icon fa fa-list"></i>
                                        <span class="nav-main-link-name">Quản lý</span>
                                    </a>
                                </li>
                                <?php if ($x == 'via') { ?>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="/admin/upload?type=<?= $x; ?>">
                                        <i class="nav-main-link-icon fa fa-upload"></i>
                                        <span class="nav-main-link-name">Upload Backup</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="/admin/type?type=<?= $x; ?>">
                                        <i class="nav-main-link-icon fa fa-book"></i>
                                        <span class="nav-main-link-name">Phân loại</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php } ?>

                    <li class="nav-main-heading">BUSINESS MANAGER</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/#mua-bm"><i class="nav-main-link-icon far fa-eye"></i>
                          <span class="nav-main-link-name">Mua BM</span>
                          <span class="nav-main-link-badge badge badge-pill badge-success">new</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="order?type=bm"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                          <span class="nav-main-link-name">BM đã mua</span>
                          <span class="nav-main-link-badge badge badge-pill badge-primary">0</span>
                        </a>
                    </li>
                    <li class="nav-main-heading">Via, Clone Đã mua</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon far fa-eye"></i>
                            <span class="nav-main-link-name">Lịch sử Mua Via</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/#mua-via">
                                    <i class="nav-main-link-icon far fa-eye"></i>
                                    <span class="nav-main-link-name">Mua Via</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="order?type=via">
                                    <i class="nav-main-link-icon fa fa-history"></i>
                                    <span class="nav-main-link-name">Lịch sử mua Via</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon far fa-eye"></i>
                            <span class="nav-main-link-name">Lịch sử Mua Clone</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/#mua-clone">
                                    <i class="nav-main-link-icon far fa-eye"></i>
                                    <span class="nav-main-link-name">Mua Clone</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="order?type=clone">
                                    <i class="nav-main-link-icon fa fa-history"></i>
                                    <span class="nav-main-link-name">Lịch sử mua Clone</span>
                                </a>
                            </li>
                    
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon far fa-eye"></i>
                            <span class="nav-main-link-name">Lịch sử Mua <span class="text-danger"></span> Proxy</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="mua-proxy">
                                    <i class="nav-main-link-icon far fa-eye"></i>
                                    <span class="nav-main-link-name">Mua Proxy</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="order_proxy">
                                    <i class="nav-main-link-icon fa fa-history"></i>
                                    <span class="nav-main-link-name">Lịch sử mua proxy</span>
                                </a>
                            </li>
                    
                        </ul>
                    </li>
                    <li class="nav-main-heading">Thanh toán</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/nap-tien"><i class="nav-main-link-icon fa fa-dollar-sign"></i>
                            <span class="nav-main-link-name">Nạp tiền</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/lich-su-nap-tien"><i class="nav-main-link-icon fa fa-history"></i>
                            <span class="nav-main-link-name">Lịch sử nạp tiền</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/lich-su-thanh-toan"><i class="nav-main-link-icon fa fa-history"></i>
                            <span class="nav-main-link-name">Lịch sử thanh toán</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="/ho-tro"> <i class="nav-main-link-icon fa fa-headset"></i>
                            <span class="nav-main-link-name">Hỗ trợ</span>
                        </a>
                    </li>
                    <li class="nav-main-heading">Ae Fan Chè Xanh</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="note-tool"><i class="nav-main-link-icon fa fa-comment-dollar"></i>
                            <span class="nav-main-link-name">Cần biết về Tool</span>
                        </a>
                    </li>
                     <li class="nav-main-item">
                        <a class="nav-main-link" href="check-live-uid"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Check Live UID</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="tool-mien-phi"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Tool Miễn Phí + Lưu ý </span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="mua-proxy"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name text-success">Mua Proxy <3 </span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="share-clone-to-via"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Share Tkqc Clone =>Via </span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="check-limit-ads"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name text-danger">Quản Lý Ads Meta</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="share-clone-to-bm"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Share Tkqc Clone =>BM</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="check-info-via"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Check Info Via</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="reg-bm"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Reg BM </span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="check-sai-pass"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Check Sai Pass Via</span>
                        </a>
                    </li>
                 <!-- <li class="nav-main-item">
                    <a class="nav-main-link" href="kich-momo"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                        <span class="nav-main-link-name">Kích Tkqc Momo</span>
                    </a>
                 </li>        -->
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="change-info-ads"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Change Info TKQC</span>
                        </a>
                    </li>             
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="len-camp"><i class="nav-main-link-icon fa fa-hand-holding"></i>
                            <span class="nav-main-link-name">Add thẻ +Set Camp SLL</span>
                        </a>
                    </li>
                 
                </ul>
            
            </div>
           
        </nav>
        
        <header id="page-header">
            <div class="content-header">
                <div>
                    <button type="button" class="btn btn-dual mr-1" data-toggle="layout" data-action="sidebar_toggle"><i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
                <div>
                    <div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-hero-success d-none d-md-inline-block">Số dư: <?= number_format($me->money); ?>đ</button> <a href="/nap-tien" class="btn btn-hero-info">Nạp Tiền</a>
                            <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-fw fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block"><?= $me->username; ?></span>
                                <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">Thông tin tài khoản</div>
                                <div class="p-2">
                                    <a class="dropdown-item" href="/tai-khoan"><i class="far fa-fw fa-user mr-1"></i> Tài khoản</a>
                                    <a class="dropdown-item" href="/lich-su-thanh-toan"> <i class="far fa-fw fa-file-alt mr-1"></i> Lịch sử</a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/logout"> <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="page-header-loader" class="overlay-header bg-primary-darker">
                    <div class="content-header">
                        <div class="w-100 text-center"> <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
            </div>    
        </header>
        <script src="/assets/js/dashmix.app.js"></script>
        <main id="main-container">
            <div class="content">
                <?php require( $page_path ); ?>
            </div>
        </main>
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-0">
                <div class="row font-size-sm">
                    <!--<div class="col-sm-6 order-sm-1 text-center text-sm-left"><a class="font-w600" href="#" target="_blank"><?= $site_name; ?></a> &copy; <span data-toggle="year-copy"><?= date('Y'); ?></span>-->
                    </div>
                </div>
            </div>
        </footer>
        <div id="onlineDonate"></div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="modal-thongbao" tabindex="-1" role="dialog" aria-labelledby="modal-thongbao" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông Báo Từ Hệ Thống</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-1 font-size-lg">
                        <b>- Hệ thống <font color="red">Nạp Tiền Auto VCB</font>
              <br>
              <font color="red">- NEW - Tạo Mã 2FA</font>
            </b>
                        <br>
                        <font color="red">- NEW - Chức Năng Đại Lý Quan Tâm Có Thể Liên hệ Admin</font>
                        </b>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="setCookie('modal_thongbao', '1', '1');">Không hiển thị lại</button>
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal -->
    </div>
    <?php } ?>
    
    <?php if (!$is_log) { ?>
    <script src="/assets/js/dashmix.app.js"></script>
    <?php } ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/js/table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.js"></script>
    <script>
        /* global PNotify */
        // pnotify
        PNotify.prototype.options.styling = 'bootstrap3'

        function api (t) {
            return '/api/' + t;
        }

        $.ajaxSetup({
            beforeSend: () => {
                $('button').prop('disabled', 1);
            },
            complete: () => {
                $('button').prop('disabled', 0);
            }
        });

        function showNotify (o) {
            var opts = {
                animate_speed: 'fast',
                buttons: {
                    closer: true,
                    sticker: false
                }
            }
            if (arguments.length > 1) {
                if (arguments.length === 2) {
                    o = {
                        type: arguments[0],
                        text: arguments[1]
                    }
                } else {
                    o = {
                        type: arguments[0],
                        title: arguments[1],
                        text: arguments[2]
                    }
                }
            } else {
                if (typeof(o) === 'string') {
                    o = {
                        type: 'info',
                        text: o
                    }
                }
            }
            opts = Object.assign(opts, o)
            if (!opts.hide) {
                opts.animation = 'none'
            }
            var notice = new PNotify(opts)
            if (o.clickToClose !== false) {
                notice.get().click(function() {
                    notice.remove()
                })
            }
            return notice
        }
    </script>
</body>
</html>