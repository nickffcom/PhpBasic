<style>
   #data_acc tbody .gioihan {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap
        }
 
    #table.table-ellipsis tbody .gioihan:hover {
        text-overflow: clip;
        white-space: normal;
        word-break: break-all;
    }
    #data_acc tbody .gioihan-pass {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap
        }
    #table.table-ellipsis tbody .gioihan-pass:hover {
        text-overflow: clip;
        white-space: normal;
        word-break: break-all;
    }
    #data_acc tbody .gioihan-stt {
        max-width: 240px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap
        }
    #table.table-ellipsis tbody .gioihan-stt:hover {
        text-overflow: clip;
        white-space: normal;
        word-break: break-all;
    }
 
</style>
<body>
<div id="app">
    <!-- <div class="container"></div> -->
    <div class="row">
     
        <div class="col-12"> 
            <h3><span class="mr-2"><i class="fas fa-arrow-alt-circle-right"></i></span>Check Full Ads của 1 Via</h3>
        </div>
    

        <div class="col-12">
            <div class="col-12 col-xl-12 ft-description">
                <h4 class="text-danger"> Chức năng dùng để
                    <br>
                <span class="text-success">
                    + Check các thông tin  Limit - Ads - BM của 1 nick duy nhất ( thường là nick via bạn đang dùng)
                    <br>
                    + Share Pixel, Get link BM, Gửi lời mời kết bạn, Share tkqc cá nhân sang cá nhân , thêm tkqc cá nhân vào Bm đang cầm
                    <br>
                    <!-- + Giới hạn 5 luồng (Ặc) chạy 1 lần 
                    <br> -->
                </span>  
                </h4>   

            </div>
        </div>

        <div class="col-12">  
            <div class="col-12 col-xl-12 ft-description">
                    <h4 class="text-primary"> Hướng dẫn sử dụng  <a class="text-danger" href="https://youtu.be/2NvKd3UrZ-w">https://youtu.be/2NvKd3UrZ-w</a>
                        <br>
                    <span class="text-success">
                        + B1 :Lấy Token Via muốn check  điền vào 
                        <br>
                        + B2 : Có thể chọn proxy v6 hoặc không chọn proxy cũng đc ! 
                        <br>
                        + B3 : Ấn bắt đầu và ko cần làm gì thêm nha ck iu <#3333
                        <br>
                        <!-- + B4 : Chọn proxy ( Phải mua proxy trước thì mới chọn đc ) ! Ấn nút check proxy để tiến hành kiểm tra proxy còn sử dụng được không !!!
                        <br>
                        + B5 : Ấn nút bắt đầu và đợi tác vụ hoàn thành , nếu bỏ cookies vào thì sẽ chạy nhanh hơn định dạng uid|pass|2fa tầm 30-60s -->
                        <br>
                    </span>
                    Nếu chưa biết cách sử dụng thì zô đây , 500 ae sẵn sàng chỉ bạn chạy <a class="text-danger" href="https://zalo.me/g/hztoxf367"> https://zalo.me/g/hztoxf367</a>  
                </h4>

            
            </div>
        </div>

        <div class="col-12" style="border-top: 3px solid salmon;margin-bottom:1%"></div>

        <!-- <div class="col-12"> -->
            <div class="col-12">
                <button class="btn btn-primary btn-xs mt-2" :disabled="data_acc_is_stop" @click="data_acc_add()"><span class="mr-2"><i class="fas fa-user-plus"></i></span>Thêm clone</button>
                <button class="btn btn-secondary btn-xs mt-2"  :disabled="data_acc_is_stop" @click="data_acc_del_selected()"><span class=" mr-2"><i class="far fa-trash-alt"></i></span>Xoá đã chọn</button>
                <button class="btn btn-secondary btn-xs mt-2" :disabled="data_acc_is_stop" @click="data_acc_del_all()"><span class="fas fa-times mr-2"></span>Xoá tất cả</button>
                <div class="btn-group mt-2">
                    <button type="button" class="btn btn-secondary btn-xs" :disabled="data_acc_is_stop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-hand-pointer mr-2"></i>Chọn theo trạng thái</button>
                    <button type="button" class="btn btn-secondary btn-xs dropdown-toggle dropdown-toggle-split" :disabled="data_acc_is_stop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-angle-down dropdown-arrow"></span> <span class="sr-only">Toggle Dropdown</span>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" @click="data_acc_select_status(item)" v-for="(item, index) in get_data_acc_status"><b>{{ item }}</b></a>
                    </div>
                </div>
                <button class="btn btn-secondary btn-xs mt-2" :disabled="data_acc_is_stop" @click="data_acc_export_selected()"><span class="mr-2"><i class="fas fa-sign-out-alt"></i></span>Xuất đã chọn</button>
                <button class="btn btn-secondary btn-xs mt-2" :disabled="data_acc_is_stop" @click="data_acc_view_selected()"><span class="fas fa-eye mr-2"></span>Xem đã chọn</button>
                <button class="btn btn-danger btn-xs mt-2" @click="so_luong_edit()" :disabled="data_acc_is_stop"><span class="fas fa-edit mr-2"></span>Cập nhật số luồng (Hiện tại: {{ options.so_luong }})</button>
            </div>
            <div class="col-12">
                
                    <div class="btn-group btn-xs  mt-2">           
                            <select class="form-select bg-warning form-control" @change="select_proxy()" >
                                                        <option selected disabled>Chọn Proxy để chạy</option>
                                                        <option @click="select_proxy(item)" v-for="(item, index) in user_proxy" v-bind:value="item.id">
                                                            <b class="badge bg-info">{{ item.name }}</b>
                                                             => 
                                                            <b class="badge bg-warning">{{ item.time_exp }}</b>
                                                            <b class="fa-solid fa-dice-d6"></b>
                                                        </option>
                            </select>              
                    </div>
                  
                    <div class="input-group col-12 pl-0 mt-1">
                            <div class="col-6 pl-0">
                                <input type="text" class="form-control xs" placeholder="Chức năng này hiện tại chưa cho phép điền địa chỉ IP vào" aria-label="" v-model="options.proxyOptional">
                            </div>
                            <div class="col-6">
                               
                                <button class="btn btn-success btn-xs ml-1" :disabled="data_acc_is_stop" @click="check_proxy()"><span class="mr-2"><i class="far fa-check-circle"></i></span>Check Proxy</button>
                                <a href="mua-proxy">
                                <button class="btn btn-info btn-xs ml-2">
                                    <span class="mr-2"><i class="fas fa-shopping-cart"></i></span>Chưa có Proxy ? Mua ngay
                                </button>
                                </a>
                                
                            </div>
                                
                                    
                    </div>
                   
            </div>
            <div class="col-12 mt-4 ml-0" >
                  <div class="col-12 input-group ml-0">
                        <!-- <label>Điền token via nhận hoặc Cookies<input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-def"></label> -->
                        <div class="input-group-prepend ml-0">
                                <div class="input-group-text">
                                    <label>Điền token dạng EAAB (ngon nhất ) or EAAG vào đây ! 1 Token đã lấy dùng vài tháng mới hết hạn trừ khi đổi MK<input type="text" placeholder="Ví dụ EAAGNO4a7r2wBAOoXsPiu6huK2VB0Ucaf59FrpgW6WQBqHIPJr......." class="form-control"  v-model="options.tokenvia">    </label>
                                   
                                </div>
                                <div class="input-group-text">
                                    <label>Cách lấy : Vào link <a href="https://www.facebook.com/content_management/">Sau đây</a> Và Ấn phím CTRL + V nhập vào EAAG , rồi copy hết đến dấu nháy "   </label>
                                </div>

                        </div>
                        
                  </div>
            
            </div>

        <!-- </div> -->

        <div class="col-12 mt-5 mb-3">
            <div class="col-12">
                <button class="btn btn-success btn-xs ml-3" :disabled="data_acc_is_stop" @click="run_check_limit_ads()"><span class="mr-2"><i class="far fa-star"></i></span>Loading TKQC   </button>
                <button class="btn btn-info btn-xs ml-3" ><span class=""><i class="fas fa-battery-half mr-2"></i></span>Status:{{options.status}}</button>
                <button class="btn btn-success btn-xs ml-3" :disabled="data_acc_is_stop" @click="check_uid_fb_selected()"> <span class="mr-2"><i class="far fa-kiss-wink-heart"></i></span>Check Live / Die Nick</button>
            </div>
            <div class="col-12 mt-4">
                <div class="progress-wrapper">
                    <div class="progress-info info-xl">
                        <span class="h4 progress-tooltip bg-success">Tiến trình chạy</span>
                        <div class="progress-percentage">
                            <span>{{ progress.percent }}%</span>
                        </div>
                    </div>
                    <div class="progress progress-xl">
                        <div class="progress-bar bg-success" role="progressbar" v-bind:style="{ width: progress.percent + '%' }" v-bind:aria-valuenow="progress.value" v-bind:aria-valuemin="progress.min" v-bind:aria-valuemax="progress.max">

                        </div>
                       
                    </div>
                </div>
            </div>

            <div class="col-12 pl-0">
                <div id="NO_OPTIONS" class="" style="position: absolute; top:0; width: 100%;">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-striped table-hover  table-sm" id="data_acc" cellspacing="0%" width="100%">
                                <thead class="thead-dark" >
                                    <tr>
                                        <th class="th-sm" style="width:10px">STT</th>
                                        <th class="th-sm" style="width:10px"></th>
                                        <th class="th-sm">Id Ads</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Limit</th>
                                        <th class="th-sm">Ngưỡng</th>
                                        <th class="th-sm">Đã Tiêu</th>
                                        <th class="th-sm">BM</th>
                                        <th class="th-sm">Info Khác</th>
                                        <th class="th-sm">Trạng thái</th>
                                        <th class="th-sm" style="max-width:30px;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr v-for="(item, index) in data_acc">
                                            <td>{{ index + 1 }}</td>
                                            <td class="gioihan-pass">
                                            <div class="form-check dashboard-check">
                                                <input class="form-check-input" type="checkbox" value="true" v-model="item.checked">
                                            </div>
                                            </td>
                                            <td class="gioihan-pass"><b>{{ item.idads }}</b></td>
                                            <td class="gioihan-pass text-success"><b>{{ item.name }}</b></td>
                                            <td class="gioihan-pass text-danger"><b>{{ item.limit }}</b></td>
                                            <td class="gioihan-pass"><b>{{ item.nguong }}</b></td>
                                            <td class="gioihan-pass"><b>{{ item.datieu }}</b></td>

                                            <td class="gioihan"><b>{{ item.bm }}</b></td>
                                            <td class="gioihan text-info"><b>{{ item.khac }}</b></td>
                                            <td class="gioihan-stt"><b><span v-bind:class="item.class">{{ item.status }}</span></b></td>
                                            <td class=""><button class="btn btn-danger btn-sm me-2" @click="data_acc_del(index)" :disabled="data_acc_is_stop"><span class="fas fa-times"></span> Xoá</button></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>  
                   
                </div>
            </div>

            <!-- div test  -->
            
            
        </div>

    

    <!-- modalSharetkqc  -->
     <div class="modal fade mt-7" id="modalSharetkqc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">  
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSharetkqc">Share TKQC "Cá Nhân " Sang nick khác ! Vui lòng điền UID 1000xxx cần share tkqc qua ! Lưu ý : 2 nick phải là bạn bè trước mới share đc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="input-group-prepend ml-0">
                            <div class="input-group-text">
                                    <label>Điền Uid nhận TKQC<input type="text" class="form-control" aria-label="Text input with checkbox" v-model="options.uidnhan">  
                                    </label>
                                    <label>
                                                            Chọn Quyền Share 
                                                            <select class="form-control" id="quyen">
                                                                <option>Admin</option>
                                                                <option>Nhà Quảng Cáo</option>
                                                                <option>Nhà Phân Tích</option>
                                                            
                                                            </select>
                                    </label>
                                    <div class="input-group-text mt-3 ml-2">
                                        <label>Out TKQC Khi Share Xong ?<input class="ml-3"type="checkbox" v-model="options.out_tkqc">  Có  </label>
                                    </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="data_acc_is_stop" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" :disabled="data_acc_is_stop" @click="run_share_tkqc()">Bắt Đầu Share</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal share tkqc vào BM đang cầm -->

    <div class="modal fade mt-7" id="modalSharetkqcBM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="modalSharetkqc">Thêm TKQC "Cá Nhân " của mình vào 1 BM ---> BM này mình đang cầm mới được ) ! BM nhận phải Veri Email + Có Page Chính rồi nhé !!!!</h5>
                
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="input-group-text mb-4">
                <label>Thêm dòng 1 : Quyền quản trị sẽ chuyển sang hết BM ?<input class="ml-3"type="checkbox" value="" v-model="options.dong1"> Add dòng 1 </label>
                </div>
                <div class="input-group-text mt-4 mb-4">
                <label>Thêm dòng 2 : Yêu cầu Quyền Quảng Cáo ( Nên Chọn) ?<input class="ml-3"type="checkbox" value="" v-model="options.dong2"> Add dòng 2 nè  </label>
                </div>
                        <div class="input-group-prepend ml-0">
                            <div class="input-group-text">
                                <label>Điền ID BM muốn nhận TKQC ( Nick via phải cầm BM và phải làm chủ tkqc )<input type="text" class="form-control" aria-label="Text input with checkbox" v-model="options.bmnhan">    </label>
                                    <label>
                                                            Quyền Thêm (Auto Admin)
                                                            <!-- <select class="form-control" id="quyen">
                                                                <option>Admin</option>
                                                                <option>Nhà Quảng Cáo</option>
                                                                <option>Nhà Phân Tích</option>
                                                            
                                                            </select> -->
                                    </label>
                                    <!-- <div class="input-group-text mt-3 ml-2">
                                        <label>Out TKQC Khi Share Xong ?<input class="ml-3"type="checkbox" v-model="options.out_tkqc">  Có  </label>
                                    </div> -->
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="data_acc_is_stop" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" :disabled="data_acc_is_stop" @click="run_share_bm()" >Bắt Đầu Share</button>
                </div>
            </div>
        </div> 
    </div>  

    <!-- gửi lời mời kết bạn  -->
    <div class="modal fade mt-7" id="guiloimoikb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guiloimoikb">Điền vào UID kết bạn dạng 1000xxxx  ví dụ điền vào 100027903801302</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="input-group-prepend ml-0">
                            <div class="input-group-text">
                                <label>Bạn muốn gửi lời mời kết bạn đến Ai ? Điền uid or link fb >33 <input type="text" class="form-control" aria-label="Text input with checkbox" v-model="options.uidketban">    </label>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="data_acc_is_stop" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" :disabled="data_acc_is_stop" @click="run_send_kb()" >Gửi lời mời kết bạn</button>
                </div>
            </div>
        </div>
    </div> 
    
     <!-- Share Pixel -->
     <div class="modal fade mt-7" id="sharepixel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="sharepixel">Điền vào ID pixel  muốn share và Id Bm đang cầm pixel đó thật chính xác</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="input-group-prepend ml-0">
                            <div class="input-group-text">
                                <label>Id Pixel ?<input type="text" class="form-control" aria-label="Text input with checkbox" v-model="options.idpixel">    </label>      
                            </div>
                            <div class="input-group-text ml-8">
                                <label class="text-primary">Và Id BM cầm Pixel nữa !!!<input type="text" class="form-control" aria-label="Text input with checkbox" v-model="options.idbmcampixel">    </label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="data_acc_is_stop" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" :disabled="data_acc_is_stop" @click="run_share_pixel()">Tiến hành Share Pixel</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Change Info ads-->
     <div class="modal fade mt-7" id="changeads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="sharepixel">Change Múi Giờ / Tiền Tệ Của Tài Khoản Quảng Cáo( Được hay ko tùy Nick / IP )</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="input-group-prepend ml-0 ">
                                <!-- <div class="input-group-text"> -->
                                    <label>Change tiền tệ không ?
                                        <select class="custom-select bg-success" id="chelsea" @change="changetiente($event)">
                                            <option selected disabled value="0">Chọn tiền tệ</option>
                                            <option value="VND">Việt Nam</option>
                                            <option value="USD">USD</option>
                                            <option value="TMT">TMT</option>
                                            <option value="EUR">Euro</option>
                                            <option value="HKD">Hong Kong Dollar</option>
                                            <option value="IDR">Indonesian Rupiah</option>
                                            <option value="INR">Indian Rupee</option>
                                            <option value="KRW">Korean Won</option>
                                            <option value="MOP">Macau Patacas</option>
                                            <option value="MYR">Malaysian Ringgit</option>
                                            <option value="NGN">Nigerian Naira</option>
                                            <option value="UAH">UAH</option>
                                            <option value="NZD">New Zealand Dollar</option>
                                            <option value="UYU">Uruguayan peso</option>
                                            <option value="UZS">Uzbekistani Som</option>
                                            <option value="VEF">Venezuelan Bolivar</option>
                                            <option value="AUD">Australian Dollar</option>
                                            <option value="BDT">Bangladeshi Taka</option>
                                            <option value="BRL">Brazilian Real</option>
                                            <option value="CAD">Canadian Dollar</option>
                                            <option value="COP">Colombian Peso</option>
                                            <option value="PHP">Philippine Peso - PHP</option>
                                            <option value="PKR">Pakistani Rupee</option>
                                            <option value="QAR">Qatari Rials</option>
                                            <option value="RUB">Russian Rouble -RUB</option>
                                            <option value="SGD">Singapore Dollar -SGD</option>
                                            <option value="THB">Thai Baht -THB</option>
                                            <option value="TWD">Taiwan Dollar</option>
                                            <option value="UYU">Uruguayan peso</option>
                                            <option value="BDT">Bangladeshi Taka</option>



                                        </select>
                                    </label>

                                    <label >Đổi múi giờ ko ck iu ?
                                            <select class="custom-select" id="chelsea" @change="changemuigio($event)">
                                                    <option selected disabled value="0">Chọn múi giờ</option>
                                                    <option value="140">+7 Ho Chi Minh </option>
                                                    <option value="132">+7 Bangkok</option>
                                                    <option value="128">+7 Singapore</option>
                                                    <option value="95">+8 Kuala Lumpur</option>
                                                    <option value="94">-6 Mexico_City</option>
                                                    <option value="77">+9 Tokyo</option>
                                                    <option value="74">+1 Rome</option>
                                                    <option value="58">+0 London</option>
                                                    <option value="47">+1 Berlin</option>
                                                    <option value="8">+4 Dubai</option>
                                                    <option value="6">-6 Chicago</option>
                                                    <option value="2">-7 Mountain US</option>
                                                    <option value="7">-5 America/New_York</option>
                                                    <option value="57">+1 Paris</option>
                                                    <option value="134">+3 Europe/Istanbul</option>
                                                    <option value="135">-4 America/Port_of_Spain</option>
                                                    <option value="116">+3 Europe/Moscow</option>
                                                    <option value="110">+0 Europe/Lisbon</option>
                                                    <option value="94">-6 America/Mexico_City</option>
                                                    <option value="55">+1 Europe/Madrid</option>
                                                    <option value="62">+8 Asia/Hong_Kong</option>
                                                    <option value="66">+7 Asia/Jakarta</option>
                                                    <option value="79">ASIA_SEOUL</option>
                                                    <option value="98">EUROPE_AMSTERDAM</option>
                                                    <option value="102">AMERICA_PANAMA</option>
                                        
                                            </select>
                                    </label>
                                    <label > Đổi tên lun không ck iu
                                        <input type="text" class="form-control" placeholder="Điền tên vào đây ! Ko ngắn + ko dài" v-model="options.tenmuondoi">
                                    </label>
                                <!-- </div> -->
                             

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="data_acc_is_stop" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" :disabled="data_acc_is_stop" @click="run_change_ads()">Tiến hành Change Ads</button>
                </div>
            </div>
        </div>
    </div>

      <!-- Kích trả trước -->
      <div class="modal fade mt-7" id="kick_tt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="sharepixel">Chuyển TKQC Cá Nhân Từ Trả Sau =>> Qua Trả Trước</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                       <h1>Bạn có chắc chắn muốn chạy ????</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="data_acc_is_stop" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" :disabled="data_acc_is_stop" @click="run_kick_tt()">Tiến hành Kick Trả trước</button>
                </div>
            </div>
        </div>
    </div>



    </div>
</div>


</body>
<!-- <script src="public/js/ContextMenu.js"></script>  -->

<script>

</script>

<script>   //
        var app = new Vue({
            el: '#app',
            mixins: {},
            data: {
                data_acc: [],
                data_acc_selected: [],
                data_acc_select_all: false,
                data_acc_is_stop: true,
                options: {
                    proxy: {
                        id: false,
                        info: '',
                        time_exp:'',
                        name:''
                    },
                    so_luong: 3,
                    run_done: 0,
                    edenhazard:0,
                    chelsea_fc:0,
                    muigio:null,
                    tiente:null,
                },
                user_proxy: [],
                progress: {},
             
            },

            created: function() {  
               var self = this;
               self.options.edenhazard=(localStorage.getItem('edenhazard'))?localStorage.getItem('edenhazard'):"";
               self.options.chelsea_fc=(localStorage.getItem('chelsea_fc'))?localStorage.getItem('chelsea_fc'):"";
               self.get_proxy();
            },
            watch: {
            },
            computed: {
                get_data_acc_status: function() {
                    var filtered_array = [];
                    for (var i = 0; i < this.data_acc.length; i++) {
                        if (filtered_array.indexOf(this.data_acc[i].status) === -1) {
                            filtered_array.push(this.data_acc[i].status);
                        }
                    }
                    return filtered_array;
                }, 
            },
            methods: {
                get_proxy: function() {
                 var self = this;
                  var url='./api_tool/get_proxy_user';
                  var data =new URLSearchParams({
                    tokenvia: self.options.tokenvia,
                    edenhazard:self.options.edenhazard,
                    chelsea_fc:self.options.chelsea_fc,
                    type:0
                    });
                    const optionek = {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded',    
                        },
                        body: data
                    };
                 
                    fetch(url,optionek)
                        .then((response) =>{          
                            // self.data_acc_is_stop = true;
                           
                            return response.text();
                        })
                        .then((response)=>{
                            console.log(response);
                            var object = JSON.parse(response); 
                            console.log(object);
                            self.options.status=object.data.msg;
                            self.options.so_luong=object.data.so_luong;
                            self.options.maxsoluong=object.data.so_luong;
                            // console.log("options",app);
                            if(object.data.status===true){
                                
                                object.data.proxy.forEach((item,index)=>{
                                    
                                        var temp={
                                        name:item.name,
                                        info:item.id,
                                        time_exp:item.time_out,
                                        id:item.id
                                        }
                                        self.user_proxy.push(temp);
                                });
                                self.data_acc_is_stop=false;
                            }
                        })
                        .catch( response => {
                         console.log("lỗi:",response);
                         alert("Lỗi get proxy:"+response);
                    } );
                    
                  
                },
                check_proxy:function(){
                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng Chọn hoặc nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                        var data =new URLSearchParams({
                        tmproxy:this.options.tmproxy,
                        edenhazard:this.options.edenhazard,
                        chelsea_fc:this.options.chelsea_fc,
                        proxy:this.options.proxy.id,
                        // minproxy:this.options.minproxy,
                        // typeminproxy:this.options.typeminproxy,
                        type:1
                        });
                
                    const optionek = {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded',    
                        },
                        body: data
                    };
                    var url='./api_tool/check_changeproxy';
                    fetch(url,optionek)
                        .then((response) =>{
                                // console.log(response.text());
                        if(!response.ok){
                            
                                alert ="Sever k ổn / do proxy ";
                                return;
                            }
                            return response.text();
                        })
                        .then((response)=>{
                            alert(response);
                        })
                        .catch( response => {
                            alert("Lỗi nặng:"+response);
                    } );
                },
                change_proxy:function(){
                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng Chọn hoặc nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                        var data =new URLSearchParams({
                        tmproxy:this.options.tmproxy,
                        edenhazard:this.options.edenhazard,
                        chelsea_fc:this.options.chelsea_fc,
                        proxy:this.options.proxy.id,
                        // minproxy:this.options.minproxy,
                        // typeminproxy:this.options.typeminproxy,
                        type:2
                        });
                
                    const optionek = {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded',    
                        },
                        body: data
                    };
                    var url='./api_tool/check_changeproxy';
                    fetch(url,optionek)
                        .then((response) =>{
                    
                        if(!response.ok){
                            
                                alert ="Sever k ổn / do proxy ";
                                return;
                            }
                            return response.text();
                        })
                        .then((response)=>{
                            // console.log("response lần đầu",response);
                            // var object = JSON.parse(response);
                            alert(response);

                        })
                        .catch( response => {
                            alert("Lỗi nặng:"+response);
                    } );
                }, 
                select_proxy:function(item) {
                    item=event.target.value;
                    console.log("hài cốt",item);
                    this.options.proxy.id = Number.parseInt(item);  
                },
                changemuigio:function(e){
                    this.options.muigio=event.target.value;
                    console.log("this.options.muigio",this.options.muigio);
                },
                changetiente:function(e){
                    this.options.tiente=event.target.value;
                    console.log("this.options.tiente",this.options.tiente);
                },
                data_acc_add: function() {
                },
                data_acc_del: function(index) {
                    this.data_acc.splice(index, 1);
                },
                selected_data:function(index){
                    console.log("Data ặc nè",this.data_acc);
                    this.data_acc[index].checked=true;
                },
                data_acc_del_selected: function() {
                    var data_acc_new = [];
                    for (let row of this.data_acc) {
                        if (row.checked != true) {
                            data_acc_new.push(row);
                        }
                    }
                    this.data_acc = data_acc_new;
                },
                data_acc_del_all: async function() {
                    var confirm = await swal_confirm();
                    if (confirm.isDismissed == true) {
                        return;
                    }
                    this.data_acc = [];
                },
                delete_check: function() {
           
                        for (let row of this.data_acc) {
                            row.checked = false;
                        }
                
                },
                data_acc_select_status: function(status) {
                    for (let [index, row] of Object.entries(this.data_acc)) {
                        if (row.status == status) {
                            row.checked = true;
                        } else {
                            row.checked = false;
                        }
                    }
                },
                data_acc_export_selected: function() {
                    var data = '';
                    for (let row of this.data_acc) {
                        if (row.checked == true) {
                            data += row.idads + '|' + row.name + '|' + row.limit + '|' + row.nguong +'|'+row.datieu+'|'+row.bm+'|'+row.bm+'|'+row.khac+'|'+row.status+'\n';
                        }
                    }
                    var today = new Date();
                    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
                    var time = today.getHours() + " giờ:" + today.getSeconds()+" s";
                    var dateTime = date+' '+time;
                    var blob = new Blob([data], {
                        type: 'text/plain;charset=utf-8'
                    });
                    saveAs(blob, 'Ads69-' + dateTime + '.txt');
                },
                data_acc_view_selected: function() {
                    var data = '';
                    for (let row of this.data_acc) {
                        if (row.checked == true) {
                            data += row.idads + '|' + row.name + '|' + row.limit + '|' + row.nguong +'|'+row.datieu+'|'+row.bm+'|'+row.bm+'|'+row.khac+'|'+row.status+'\n';
                        }
                    }
                    view_tab(data);
                },
                check_uid_fb_selected: function() {
                    // alert('Hài');
                    var self=this;
                   
                    for (let [index, row] of Object.entries(this.data_acc)) {
                        if (row.checked == true) {
                            row.class = 'text-warning';
                            row.status = 'Đang Check uid...';
                            var url = 'https://graph.facebook.com/' + row.uid + '/picture?type=normal';
                            fetch(url).then((response) => {
                                if (/100x100/.test(response.url)) {
                                    row.class = 'text-success';
                                    row.status = 'UID live';
                                } else {
                                    row.class = 'text-danger';
                                    row.status = 'UID die';
                                }
                            });
                        }
                    }
                },
                run_check_limit_ads:function(){
                    var self=this;
                    var options = self.options;
                    var input=options.tokenvia;
                    self.data_acc=[];
                    if(!input){
                        alert("Vui lòng nhập Token EAAB (ngon nhất) or EAAG zô đi ck iuuuu");
                        return;
                    }else if(input.includes("EAA")){
                        
                    }else if(input.includes("c_user")){

                    }else{
                        alert("Bắt buộc phải nhập token vào");
                        return;
                    }
                    // console.log("pp",typeof self.options.proxy.id);
                    if(!Number.isInteger(self.options.proxy.id)){
                        alert("Chưa chọn Proxy nào để chạy kìa ck iuu");
                        return;
                    }
                    var data =new URLSearchParams({
                    tokenvia: options.tokenvia,
                    proxy: options.proxy.id,
                    edenhazard:options.edenhazard,
                    chelsea_fc:options.chelsea_fc,
                    type:1
                    });
                    const optionek = {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded',    
                        },
                        body: data
                    };
                   
                    
                    var url="./api_tool/check_limit_ads";
                    showNotify('success',"Đang chạy =>Vui lòng đợi");
                    fetch(url,optionek)
                        .then((response) =>{          
                           
                            return response.text();
                        })
                        .then((response)=>{
                            if(response.includes("error")){
                                showNotify('error',response);
                                return;
                            }
                            var object = JSON.parse(response);
                            
                            if(object.status===false){
                                showNotify('error',object.message);
                                return;
                            }
                            if(object['data'][0]['id']){

                            }else{
                                alert("Token sida or bị Fb chặn  rồi bro ơi !Thử lại sau");
                                return;
                            }
                            object.data.forEach((item,index)=>{
                                var info = {
                                checked: false,
                                idads: '',
                                name: '',
                                limit: '',
                                nguong: '',
                                datieu:'',
                                bm: '',
                                khac: '',
                                status: 'Đã -Thêm',
                                data: '',
                                };
                                if(object.data[index].hasOwnProperty('business')){
                                    // alert("có id bm");
                                    info.idads=item.business.id;
                                    info.name=item.business.name;
                                    info.limit=item.adtrust_dsl+" "+item.currency;
                                    info.nguong=item.min_billing_threshold.amount;
                                    info.datieu=item.amount_spent;
                                    info.bm="BM";
                                    info.khac=item.timezone_name+" | "+item.currency;
                                    var tt =item.account_status;
                                   
                                    if(tt==1){
                                        tt ="Live Mạnh";
                                        info.class="text-primary";
                                    }else{
                                        info.class="text-danger";        
                                        tt="Die rồi";             
                                    }
                                    info.status="Dư : "+item.balance+"  "+tt;

                                }else if(object.data[index].id){
                                    // alert("ngon lành tí r đó");
                                    info.idads=item.account_id;
                                    info.name=item.name;
                                    info.limit=item.adtrust_dsl+" "+item.currency;
                                    info.nguong=item.min_billing_threshold.amount;
                                    info.datieu=item.amount_spent;
                                    info.bm="Cá nhân";
                                    info.khac=item.timezone_name+"|"+item.currency;
                                    var tt =item.account_status;
                                 
                                    if(tt==1){
                                        tt ="Live Mạnh";
                                        info.class="text-primary";        
                                    }else{
                                        tt="Die rồi";     
                                        info.class="text-danger";        
                                    }
                                    info.status="Dư : "+item.balance+"  "+tt;

                                }
                                self.data_acc.push(info);
                            });

                        })
                        .catch( response => {
                            console.log("lỗi:",response);
                        self.data_acc_is_stop = true;
                        // info.status ="Lỗi:"+response;
                        alert("Lỗi exeption:"+response);
                    } );

           
                },
              
                data_acc_stop: function() {
                    this.data_acc_is_stop = true;
                },
                so_luong_edit: function() {
                    var self=this;
                    var get_data = prompt('Nhập số luồng', this.options.so_luong);
                    if (!get_data) {
                        return;
                    }
                    if (get_data > self.options.maxsoluong) {
                    alert('Số luồng tối đa của bạn là: '+self.options.maxsoluong 
                    +"\n"+"Số dư tài khoản cao thì sẽ được nâng số luồng lên,tối đa là 5"
                    +"\n"+"Vì băng thông sever giới hạn nên ko cho số luồng cao được "
                    +"\n"+"Các ck iuuuuu"
                    );
                            return;
                    }
                        this.options.so_luong = get_data;
                },
                run_share_tkqc:function(){ 
                    var self=this;
                    var options = self.options;
                    var input=options.tokenvia;
                    this.data_acc_selected = [];
                    for (let [index, row] of Object.entries(this.data_acc)) {
                        if (row.checked == true) {
                            row.index = index;
                            this.data_acc_selected.push(row);
                        }
                    }
                    if (this.data_acc_selected.length < 1) {
                        alert('Chưa chọn tkqc để share!');
                        return;
                    }
                    console.log("input",input);
                    if(!input){
                        alert("Vui lòng nhập token EAAB or EAAG , EAAB ngon nhất nhé");
                        return;
                    }
                        
                    if(options.uidnhan.includes('100')){
                    }else{
                        alert("Bắt buộc phải nhập uid dạng 1000..... vào");
                        showNotify('error','Bắt buộc phải nhập uid dạng 1000..... vào');
                        return;
                    }

                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                    var tkqc="";
                    if(this.data_acc_is_stop===true){
                        alert("Lỗi:"+self.options.status);
                        return;
                    }
                    var list_acc=[];
                    if(this.data_acc_selected.length>this.options.so_luong){
                        alert("Số ặc chọn chạy không được lớn hơn số luồng");
                        return;
                    }
                    for(var i=0;i<this.data_acc_selected.length;i++){
                        var index=self.data_acc_selected[i].index;
                        var kakarot={
                            vitri:index,
                            idads:self.data_acc[index].idads
                        }
                        self.data_acc[index].class = 'text-danger';
                        self.data_acc[index].status = 'Đang share....';
                        list_acc.push(kakarot);
                    }
                    console.log('tkqc',tkqc);
                    showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");

                    if(!options.out_tkqc){
                        options.out_tkqc='';
                    }
                    var result = document.getElementById("quyen").value;
                    if(result.includes("Admin")){
                        result="281423141961500";
                    }    
                    else if(result.includes("Cáo")){
                        result="461336843905730";
                    }
                    var tkqc=JSON.stringify(list_acc);
                    
                    self.data_acc_is_stop = true;

                    var data =new URLSearchParams({
                        tokenvia: options.tokenvia,
                        tkqc:tkqc,
                        uidnhan:options.uidnhan,
                        proxy: options.proxy.id,
                        outtkqc:options.out_tkqc,
                        edenhazard:options.edenhazard,
                        chelsea_fc:options.chelsea_fc,
                        guid:uuidv4(),
                        role:result,
                        type:2

                    });
                    var url="./api_tool/check_limit_ads";
                    
                    $.ajax({  // em post lên file php nãy thôi bác , action là nút bắt đầu
                            url: url,
                            type: 'POST',
                            dataType: 'text',
                            contentType: 'application/x-www-form-urlencoded',
                            data: data,
                            processData: false,
                            success: function(result) {
                                try{
                                        // console.log("jax",result);
                                        var object = JSON.parse(result);
                                        console.log("OB",object);
                                        
                                        if (object.status==false) {
                                            alert(object.message);
                                            return;
                                        }
                                        
                                        object.data.forEach((item,index)=>{
                                            var indexnek=item.index;
                                            var stt =item.stt;
                                            var status=item.status;
                                            if(status){
                                                self.data_acc[indexnek].class='text-success';
                                                
                                                showNotify('success',stt);
                                            }else{
                                                self.data_acc[indexnek].class='text-danger';
                                                showNotify('error',stt);
                                            }
                                            self.data_acc[indexnek].status=stt;

                                        });
                                    
                                    }catch(e){
                                        console.log("ex:",e.message);
                                        alert("Lỗi nặng:"+e.message);
                                        showNotify('error',e.message);
                                    }
                            },
                            error: function(xhr, status, error){
                                // var errorMessage = xhr.status + ': ' + xhr.statusText
                                showNotify('error',  xhr.statusText);
                                alert("Lỗi sever nặng:"+xhr.statusText)
                            },
                            complete:function(){
                                self.data_acc[i].checked =false;
                                self.data_acc_is_stop = false;
                            }
                        
                        });  
               
                },
                run_share_bm:function(){
                    var self=this;
                    var options = self.options;
                    var input=options.tokenvia;
                    this.data_acc_selected = [];
                    for (let [index, row] of Object.entries(this.data_acc)) {
                        if (row.checked == true) {
                            row.index = index;
                            this.data_acc_selected.push(row);
                        }
                    }
                    if (this.data_acc_selected.length < 1) {
                        alert('Chưa chọn tkqc để thêm vào BM');
                        return;
                    }
                    if(!input){
                        alert("Vui lòng token via....");
                        return;
                    }
                        
                    if(input.includes('EAA')){
                        // alert("Vui lòng nhập Token / Cookies Via nhận \n Hoặc tích vào chỉ kết bạn và nhập uid dạng 1000....");
                        // return;
                    }else{
                        alert("Bắt buộc phải nhập token EAAB/EAAG .... vào");
                        showNotify('error','Bắt buộc phải nhập token EAAB..... vào');
                        return;
                    }

                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                    if(this.options.dong1&&this.options.dong2){
                        alert("Vui Lòng Chỉ Chọn 1 Cách thêm vào BM  ( Dòng 1 or Dòng 2 )");
                        return;
                    }else if(!this.options.dong1&&!this.options.dong2){
                        alert("Vui lòng chọn 1 trong 2 cách  thêm vào BM nhé ck iuuuu");
                        return;
                    }
                    if(this.data_acc_is_stop===true){
                        alert("Lỗi:"+self.options.status);
                        return;
                    }
                    var list_acc=[];
                    if(this.data_acc_selected.length>this.options.so_luong){
                        alert("Số ặc chọn chạy không được lớn hơn số luồng");
                        return;
                    }
                    for(var i=0;i<this.data_acc_selected.length;i++){
                        var index=self.data_acc_selected[i].index;
                        var kakarot={
                            vitri:index,
                            idads:self.data_acc[index].idads
                        }
                        self.data_acc[index].class = 'text-danger';
                        self.data_acc[index].status = 'Đang thêm vào BM....';
                        list_acc.push(kakarot);
                    }
                    showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");
                    var bmnhan=options.bmnhan;
                    
                    if(!bmnhan){
                      alert("K đc để trống bm nhận ck iu");
                      return;
                    }
                    // var result = document.getElementById("quyen").value;
                    // if(result.includes("Admin")){
                    //     result="281423141961500";
                    // }    
                    // else if(result.includes("Cáo")){
                    //     result="461336843905730";
                    // }
                    var tkqc = JSON.stringify(list_acc);
                    var choose=(options.dong1)?1:2;
                    var data =new URLSearchParams({
                        tokenvia: options.tokenvia,
                        tkqc:tkqc,
                        proxy: options.proxy.id,
                        bmnhan:bmnhan,
                        dong:choose,
                        edenhazard:options.edenhazard,
                        chelsea_fc:options.chelsea_fc,
                        // role:result,
                        type:3

                    });
                    self.data_acc_is_stop=true;
                    var url="./api_tool/check_limit_ads";
                        $.ajax({  // em post lên file php nãy thôi bác , action là nút bắt đầu
                            url: url,
                            type: 'POST',
                            dataType: 'text',
                            contentType: 'application/x-www-form-urlencoded',
                            data: data,
                            processData: false,
                            success: function(result) {
                                try{
                                        var object = JSON.parse(result);
                                        console.log("OB",object);
                                        
                                        if (object.status==false) {
                                            alert(object.message);
                                            return;
                                        }
                                        object.data.forEach((item,index)=>{
                                            var indexnek=item.index;
                                            var stt =item.stt;
                                            var status=item.status;
                                            if(status){
                                                self.data_acc[indexnek].class='text-success';
                                                showNotify('success',stt);
                                            }else{
                                                self.data_acc[indexnek].class='text-danger';
                                                showNotify('error',stt);
                                            }
                                            self.data_acc[indexnek].status=stt;

                                        });
                                    
                                    }catch(e){
                                        console.log("ex:",e.message);
                                        alert("Lỗi nặng:"+e.message);
                                        showNotify('error',e.message);
                                    }
                            },
                            error: function(xhr, status, error){
                                // var errorMessage = xhr.status + ': ' + xhr.statusText
                                showNotify('error',  xhr.statusText);
                                alert("Lỗi sever nặng:"+xhr.statusText)
                            },
                            complete:function(){
                                self.data_acc[i].checked =false;
                                self.data_acc_is_stop = false;

                            }
                        
                        });
                        
                },
                run_share_pixel:function(){
               
                    var self=this;
                    var options = self.options;
                    var input=options.tokenvia;
                    this.data_acc_selected = [];
                    for (let [index, row] of Object.entries(this.data_acc)) {
                        if (row.checked == true) {
                            row.index = index;
                            this.data_acc_selected.push(row);
                        }
                    }
                    if (this.data_acc_selected.length < 1) {
                        alert('Chưa chọn tkqc để share pixel vào!');
                        return;
                    }
                    if(!input){
                        alert("Vui lòng điền token via....");
                        return;
                    }
                        
                    if(input.includes('EAAG')){
                        // alert("Vui lòng nhập Token / Cookies Via nhận \n Hoặc tích vào chỉ kết bạn và nhập uid dạng 1000....");
                        // return;
                    }else{
                        alert("Bắt buộc phải nhập token EAAG .... vào");
                        showNotify('error','Bắt buộc phải nhập token EAAG..... vào');
                        return;
                    }

                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                 
                    var idbm=options.idbm;
                    var idpixel=options.idpixel;
                    
                    if(!idbm||!idpixel){
                      alert("k đc để trống id bm , id pixel");
                      return;
                    }
                    if(this.data_acc_is_stop===true){
                        alert("Lỗi:"+self.options.status);
                        return;
                    }
                    var list_acc=[];
                    if(this.data_acc_selected.length>this.options.so_luong){
                        alert("Số ặc chọn chạy không được lớn hơn số luồng");
                        return;
                    }
                    for(var i=0;i<this.data_acc_selected.length;i++){
                        var index=self.data_acc_selected[i].index;
                        var kakarot={
                            vitri:index,
                            idads:self.data_acc[index].idads
                        }
                        self.data_acc[index].class = 'text-danger';
                        self.data_acc[index].status = 'Đang share....';
                        list_acc.push(kakarot);
                    }
                    var tkqc =JSON.stringify(list_acc);
                    self.data_acc_is_stop=true;
                    showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");
                    var data =new URLSearchParams({
                        tokenvia: options.tokenvia,
                        tkqc:tkqc,
                        proxy: options.proxy.id,
                        idbm:idbm,
                        edenhazard:options.edenhazard,
                        chelsea_fc:options.chelsea_fc,
                        idpixel:idpixel,
                        guid:uuidv4(),
                        role:result,
                        type:4

                    });
                    var url="./api_tool/check_limit_ads";
                        $.ajax({  // em post lên file php nãy thôi bác , action là nút bắt đầu
                            url: url,
                            type: 'POST',
                            dataType: 'text',
                            contentType: 'application/x-www-form-urlencoded',
                            data: data,
                            processData: false,
                            success: function(result) {
                                try{
                                        var object = JSON.parse(result);
                                        console.log("OB",object);
                                        
                                        if (object.status==false) {
                                            alert(object.message);
                                            return;
                                        }

                                        object.data.forEach((item,index)=>{
                                            var indexnek=item.index;
                                            var stt =item.stt;
                                            var status=item.status;
                                            if(status){
                                                self.data_acc[indexnek].class='text-success';
                                                showNotify('success',stt);
                                            }else{
                                                self.data_acc[indexnek].class='text-danger';
                                                showNotify('error',stt);
                                            }
                                            self.data_acc[indexnek].status=stt;

                                        });
                                    
                                    }catch(e){
                                        console.log("ex:",e.message);
                                        alert("Lỗi nặng:"+e.message);
                                        showNotify('error',e.message);
                                    }
                            },
                            error: function(xhr, status, error){
                                // var errorMessage = xhr.status + ': ' + xhr.statusText
                                showNotify('error',  xhr.statusText);
                                alert("Lỗi sever nặng:"+xhr.statusText)
                            },
                            complete:function(){
                                self.data_acc[i].checked =false;
                                self.data_acc_is_stop = false;
                            }
                        
                        });
                        
                }, 
                run_send_kb:function(){
                    var self=this;
                    var options = self.options;
                    var input=options.tokenvia;
                    this.data_acc_selected = [];
               

                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                    var uidketban=options.uidketban;
                    if(!uidketban){
                        alert("Điền uid or link kết bạn vào");
                        return;
                    }else if(!uidketban.includes('100')&& uidketban.includes('www')){
                        alert("Uid dang 100xxxxxxx hoac Link facebook www.facebook.com/noname2d");
                        return;
                    }
                  
                    var guid=uuidv4();
                    showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");
                    var data =new URLSearchParams({
                        tokenvia: options.tokenvia,
                        proxy: options.proxy.id,
                        uidketban:uidketban,
                        edenhazard:options.edenhazard,
                        chelsea_fc:options.chelsea_fc,
                        guid:uuidv4(),
                        type:5

                    });
                    var url="./api_tool/check_limit_ads";
                        $.ajax({  // em post lên file php nãy thôi bác , action là nút bắt đầu
                            url: url,
                            type: 'POST',
                            dataType: 'text',
                            contentType: 'application/x-www-form-urlencoded',
                            data: data,
                            processData: false,
                            success: function(result) {
                                try{
                                        var object = JSON.parse(result);
                                        console.log("OB",object);
                                        if (object.status==false) {
                                            alert(object.message);
                                            return;
                                        }
                                        var data=object['message'];
                                        if (object['status']==false) {
                                            showNotify('error',data);
                                        }else{
                                            alert(data);
                                            showNotify('success',data);
                                        }
                                    
                                    
                                    }catch(e){
                                        console.log("ex:",e.message);
                                        alert("Lỗi nặng:"+e.message);
                                        showNotify('error',e.message);
                                    }
                            },
                            error: function(xhr, status, error){
                                // var errorMessage = xhr.status + ': ' + xhr.statusText
                                showNotify('error',  xhr.statusText);
                                alert("Lỗi sever nặng:"+xhr.statusText)
                            },
                            complete:function(){

                            }
                        
                        });
                        
                },
                run_get_link:function(){
                    // var self=this;
                    // var options = self.options;
                    // var input=options.tokenvia;
                    // this.data_acc_selected = [];
                    // for (let [index, row] of Object.entries(this.data_acc)) {
                    //     if (row.checked == true) {
                    //         if(row.bm.includes('BM')){
                    //             row.index = index;
                    //             this.data_acc_selected.push(row);
                    //         }else{
                    //             alert("Chọn lại đi ck iu ? Chỉ những tài khoản quảng cáo \"BM\" mới lấy được link mời làm quản trị viên");
                    //             return;
                    //         }

                    //     }
                    // }
                    // if (this.data_acc_selected.length < 1) {
                    //     alert('Chưa chọn tkqc để lấy link');
                    //     return;
                    // }
                    // if(!input){
                    //     alert("Vui lòng token via....");
                    //     return;
                    // }
                    // if(input.includes('EAAG')){
                    //     // alert("Vui lòng nhập Token / Cookies Via nhận \n Hoặc tích vào chỉ kết bạn và nhập uid dạng 1000....");
                    //     // return;
                    // }else{
                    //     alert("Bắt buộc phải nhập token EAAG .... vào");
                    //     showNotify('error','Bắt buộc phải nhập token EAAG..... vào');
                    //     return;
                    // }

                    // if(!this.options.tmproxy&&!this.options.proxy.id){
                    //     alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                    //     return;
                    // }
                    // if(this.data_acc_is_stop===true){
                    //     alert("Lỗi:"+self.options.status);
                    //     return;
                    // }
                    // var list_acc=[];
                    // if(this.data_acc_selected.length>this.options.so_luong){
                    //     alert("Số ặc chọn chạy không được lớn hơn số luồng");
                    //     return;
                    // }
                    // for(var i=0;i<this.data_acc_selected.length;i++){
                    //     var index=self.data_acc_selected[i].index;
                    //     var kakarot={
                    //         vitri:index,
                    //         idads:self.data_acc[index].idads
                    //     }
                    //     self.data_acc[index].class = 'text-danger';
                    //     self.data_acc[index].status = 'Đang share....';
                    //     list_acc.push(kakarot);
                    // }
                    // var tkqc =JSON.stringify(list_acc);
                    // self.data_acc_is_stop=true;
                    // showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");
                    // var data =new URLSearchParams({
                    //     tokenvia: options.tokenvia,
                    //     idbm:tkqc,
                    //     proxy: options.proxy.id,
                    //     edenhazard:options.edenhazard,
                    //     chelsea_fc:options.chelsea_fc,
                    //     bmnhan:bmnhan,
                    //     guid:uuidv4(),
                    //     role:result,
                    //     type:6

                    // });
                    // var url="./api_tool/check_limit_ads";
                    //     $.ajax({  // em post lên file php nãy thôi bác , action là nút bắt đầu
                    //         url: url,
                    //         type: 'POST',
                    //         dataType: 'text',
                    //         contentType: 'application/x-www-form-urlencoded',
                    //         data: data,
                    //         processData: false,
                    //         success: function(result) {
                    //             try{
                    //                     var object = JSON.parse(result);
                    //                     console.log("OB",result);
                    //                     if (object.status==false) {
                    //                         alert(object.message);
                    //                         return; 
                    //                     }

                    //                     object.data.forEach((item,index)=>{
                    //                         var indexnek=item.index;
                    //                         var stt =item.stt;
                    //                         var status=item.status;
                    //                         if(status){
                    //                             self.data_acc[indexnek].class='text-success';
                    //                             showNotify('success',stt);
                    //                         }else{
                    //                             self.data_acc[indexnek].class='text-danger';
                    //                             showNotify('error',stt);
                    //                         }
                    //                         self.data_acc[indexnek].status=stt;

                    //                     });
                                    
                    //                 }catch(e){
                    //                     console.log("ex:",e.message);
                    //                     alert("Lỗi nặng:"+e.message);
                    //                     showNotify('error',e.message);
                    //                 }
                    //         },
                    //         error: function(xhr, status, error){
                    //             // var errorMessage = xhr.status + ': ' + xhr.statusText
                    //             showNotify('error',  xhr.statusText);
                    //             alert("Lỗi sever nặng:"+xhr.statusText)
                    //         },
                    //         complete:function(){
                    //             self.data_acc[i].checked =false;
                    //             self.data_acc_is_stop = false;
                    //         }
                        
                    //     });
                        
                },
                run_change_ads:function(){
                    var self=this;
                    var options = self.options;
                    var input=options.tokenvia;
                    console.log(this.options.tiente);
                    console.log(this.options.muigio);
                    this.data_acc_selected = [];
                    for (let [index, row] of Object.entries(this.data_acc)) {
                        if (row.checked == true) {
                            row.index = index;
                            this.data_acc_selected.push(row);
                        }
                    }
                    if (this.data_acc_selected.length < 1) {
                        alert('Chưa chọn tkqc để change tiền tệ');
                        return;
                    }
                
                    if(!input){
                        alert("Vui lòng nhập token EAAB or EAAG , EAAB ngon nhất nhé");
                        return;
                    }
                 

                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                    var tkqc="";
                    if(this.data_acc_is_stop===true){
                        alert("Lỗi:"+self.options.status);
                        return;
                    }
                    if(!this.options.tiente||!this.options.muigio){
                        alert("Vui lòng chọn đầy đủ múi giờ và tiền tệ"
                        +"\n"+"Nếu chỉ muốn đổi một cái thì vui lòng chọn lại thuộc tính tiền tệ or múi giờ mà nick đang sở hữu"
                        +"\n"+"Ví dụ b chỉ muốn đổi tiền tệ còn múi giờ giữ nguyên thì b chọn tiền tệ  và chọn múi giờ là múi giờ hiện tại của tài khoản đó là được");
                        return;
                    }
                    var list_acc=[];
                    if(this.data_acc_selected.length>this.options.so_luong){
                        alert("Số ặc chọn chạy không được lớn hơn số luồng");
                        return;
                    }
                    for(var i=0;i<this.data_acc_selected.length;i++){
                        var index=self.data_acc_selected[i].index;
                        var kakarot={
                            vitri:index,
                            idads:self.data_acc[index].idads
                        }
                        self.data_acc[index].class = 'text-danger';
                        self.data_acc[index].status = 'Đang chạy....';
                        list_acc.push(kakarot);
                    }
                    
                    showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");

                    var tkqc=JSON.stringify(list_acc);
                    
                    self.data_acc_is_stop = true;

                    var data =new URLSearchParams({
                        tokenvia: options.tokenvia,
                        tkqc:tkqc,
                        uidnhan:options.uidnhan,
                        proxy: options.proxy.id,
                        outtkqc:options.out_tkqc,
                        edenhazard:options.edenhazard,
                        chelsea_fc:options.chelsea_fc,
                        tiente:options.tiente,
                        muigio:options.muigio,
                        type:7

                    });
                    var url="./api_tool/check_limit_ads";
                    
                    $.ajax({  // em post lên file php nãy thôi bác , action là nút bắt đầu
                            url: url,
                            type: 'POST',
                            dataType: 'text',
                            contentType: 'application/x-www-form-urlencoded',
                            data: data,
                            processData: false,
                            success: function(result) {
                                try{
                                        // console.log("result change info ads",result);
                                        var object = JSON.parse(result);
                                        console.log("OB",object);
                                        
                                        if (object.status==false) {
                                            alert(object.message);
                                            return;
                                        }
                                        console.log("đến đây r");
                                        object.data.forEach((item,index)=>{
                                            var indexnek=item.index;
                                            var stt =item.stt;
                                            var status=item.status;
                                            if(status){
                                                self.data_acc[indexnek].class='text-success';
                                                
                                                showNotify('success',stt);
                                            }else{
                                                self.data_acc[indexnek].class='text-danger';
                                                showNotify('error',stt);
                                            }
                                            self.data_acc[indexnek].status=stt;

                                        });
                                    
                                    }catch(e){
                                        console.log("ex:",e.message);
                                        alert("Lỗi nặng:"+e.message);
                                        showNotify('error',e.message);
                                    }
                            },
                            error: function(xhr, status, error){
                                // var errorMessage = xhr.status + ': ' + xhr.statusText
                                showNotify('error',  xhr.statusText);
                                alert("Lỗi sever nặng:"+xhr.statusText)
                            },
                            complete:function(){
                                self.data_acc[i].checked =false;
                                self.data_acc_is_stop = false;
                            }
                        
                        });  
               
                },
                run_kick_tt:function(){
                    var self=this;
                    var options = self.options;
                    var input=options.tokenvia;
                    console.log(this.options.tiente);
                    console.log(this.options.muigio);
                    this.data_acc_selected = [];
                    for (let [index, row] of Object.entries(this.data_acc)) {
                        if (row.checked == true) {
                            row.index = index;
                            this.data_acc_selected.push(row);
                        }
                    }
                    if (this.data_acc_selected.length < 1) {
                        alert('Chưa chọn tkqc để kick trả trước');
                        return;
                    }
                
                
                    if(input.includes('c_user')&&input.includes('100')){

                    }else{
                        alert("Chức năng này phải nhập  Cookies vào ô Token via mới chạy được b nhé");
                        return;
                    }
                 

                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                    var tkqc="";
                    if(this.data_acc_is_stop===true){
                        alert("Lỗi:"+self.options.status);
                        return;
                    }
                    
                    var list_acc=[];
                    if(this.data_acc_selected.length>this.options.so_luong){
                        alert("Số ặc chọn chạy không được lớn hơn số luồng");
                        return;
                    }
                    for(var i=0;i<this.data_acc_selected.length;i++){
                        var index=self.data_acc_selected[i].index;
                        var kakarot={
                            vitri:index,
                            idads:self.data_acc[index].idads
                        }
                        self.data_acc[index].class = 'text-danger';
                        self.data_acc[index].status = 'Đang chạy....';
                        list_acc.push(kakarot);
                    }
                    
                    showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");

                    var tkqc=JSON.stringify(list_acc);
                    
                    self.data_acc_is_stop = true;

                    var data =new URLSearchParams({
                        tokenvia: options.tokenvia,
                        tkqc:tkqc,
                        uidnhan:options.uidnhan,
                        proxy: options.proxy.id,
                        edenhazard:options.edenhazard,
                        chelsea_fc:options.chelsea_fc,
                        type:8

                    });
                    var url="./api_tool/check_limit_ads";
                    
                    $.ajax({  // em post lên file php nãy thôi bác , action là nút bắt đầu
                            url: url,
                            type: 'POST',
                            dataType: 'text',
                            contentType: 'application/x-www-form-urlencoded',
                            data: data,
                            processData: false,
                            success: function(result) {
                                try{
                                        // console.log("result change info ads",result);
                                        var object = JSON.parse(result);
                                        console.log("OB",object);
                                        
                                        if (object.status==false) {
                                            alert(object.message);
                                            return;
                                        }
                                        console.log("đến đây r");
                                        object.data.forEach((item,index)=>{
                                            var indexnek=item.index;
                                            var stt =item.stt;
                                            var status=item.status;
                                            if(status){
                                                self.data_acc[indexnek].class='text-success';
                                                
                                                showNotify('success',stt);
                                            }else{
                                                self.data_acc[indexnek].class='text-danger';
                                                showNotify('error',stt);
                                            }
                                            self.data_acc[indexnek].status=stt;

                                        });
                                    
                                    }catch(e){
                                        console.log("ex:",e.message);
                                        alert("Lỗi nặng:"+e.message);
                                        showNotify('error',e.message);
                                    }
                            },
                            error: function(xhr, status, error){
                                // var errorMessage = xhr.status + ': ' + xhr.statusText
                                showNotify('error',  xhr.statusText);
                                alert("Lỗi sever nặng:"+xhr.statusText)
                            },
                            complete:function(){
                                self.data_acc[i].checked =false;
                                self.data_acc_is_stop = false;
                            }
                        
                        });  
                }    
                
            },
        })

     
        function view_tab(kyo) {
            var tab = window.open('about:blank', '_blank');
            tab.document.write('<pre>' + kyo + '</pre>');
            tab.document.close();
        }

   
        function uuidv4() {
            return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
              (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            );
        };
        async function swal_confirm() {
            try {
                let result = await Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                });
                return result;
            } catch (e) {
                console.error(e);
            }
        }
  
        function Chondongnek(){
            app.delete_check();
            var text= window.getSelection().toString();
            if(text.length<2){
                alert("Chọn chuẩn zô đi ck iuuu");
                return;
            }
            var haiz=0;
            var temp = text.split('\n');
            for (var item of temp) {

                console.log("item:",":"+item+":");
                if (/^([0-9]{1,3}	)/.test(item)) {
                    // console.log("Đã vô");
                    var index=/^([0-9]{1,3}	)/.exec(item);
                    var index= parseInt(index[1].trim());
                    if(index-haiz>=-1){

                    }
                    // console.log("Index là:",index);
                    app.selected_data(index-1);
                }
            }
        }
         // new context menustrip
        test_menu = {
        id: 'TEST-MENU',
        data: [
            // {
            //     header: 'Thư giãn đi ck iuu'
            // },
            {
                icon: 'fas fa-mouse-pointer',
                text: 'Chọn các dòng',
                action: function(e, selector) {
                   Chondongnek();
                   e.preventDefault();
                }
            },
            {
                icon: 'far fa-eye',
                text: 'Xem =>>',
                action: function(e, selector) { 
                    app.data_acc_view_selected();
                    e.preventDefault();
                }
            },
            {
                icon: 'fas fa-play',
                text: 'Load TKQC',
                action: function(e, selector) {
                     app.run_check_limit_ads() ;
                     e.preventDefault();
                    }
            },
            {
                icon: 'fas fa-star',
                text: 'Share TKQC đã chọn => Cá Nhân',
                action: function(e, selector) {
                    $("#modalSharetkqc").modal();
                    e.preventDefault();
                }   

            },
            {
                icon: 'fas fa-menorah',
                text: 'Thêm TKQC đã chọn vào BM',
                action: function(e, selector) {
                    $("#modalSharetkqcBM").modal();
                    e.preventDefault();
                }   

            },
            // {
            //     icon: 'fas fa-star',
            //     text: 'Get link mời BM',
            //     action: function(e, selector) {
            //         // $("#modalSharetkqcBM").modal();
            //         e.preventDefault();
            //     }   

            // },
            {
                icon: 'fas fa-shopping-bag',
                text: 'Share Pixel Vào TKQC đã chọn',
                action: function(e, selector) {
                     $("#sharepixel").modal();
                    e.preventDefault();
                }   

            },
            {
                icon: 'fas fa-users-cog',
                text: 'Gừi lời mời kết bạn tới',
                action: function(e, selector) {
                     $("#guiloimoikb").modal();
                    e.preventDefault();
                }   

            },
            {
                icon: 'fas fa-cart-plus',
                text: 'Change Tiền Tệ + Múi giờ',
                action: function(e, selector) {
                     $("#changeads").modal();
                    e.preventDefault();
                }   

            },
              {
                icon: 'fas fa-comments-dollar',
                text: 'Kích TKQC Sang Trả Trước',
                action: function(e, selector) { 
                    $("#kick_tt").modal();
                    e.preventDefault();
                 }
            },
            {
                icon: 'far fa-check-circle',
                text: 'Check Ip Hiện Tại',
                action: function(e, selector) {
                    app.check_proxy();
                    e.preventDefault();
                  }
            },
          
            {
                icon: 'far fa-file-word',
                text: 'Xuất File đã chọn',
                action: function(e, selector) { 
                    app.data_acc_export_selected();
                    e.preventDefault();
                 }
            },
            {
                divider: true
            },
            {
                header: 'Ads69.Net'
            },
            {
                icon: 'fas fa-trash-alt',
                text: 'Xóa dòng chọn',
                action: function(e, selector) {
                    app.data_acc_del_selected();
                    e.preventDefault();
                }
            }
        ]
};

context.init({preventDoubleContext: false});
context.attach('#NO_OPTIONS', test_menu);


</script>



<script>

</script>



