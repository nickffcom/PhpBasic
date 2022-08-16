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
    <div class="row">
     
        <div class="col-12"> 
            <h3><span class="mr-2"><i class="fas fa-arrow-alt-circle-right"></i></span>Check Full Ads của 1 Via</h3>
        </div>
    

        <div class="col-12">
            <div class="col-12 col-xl-12 ft-description">
                <h4 class="text-danger"> Chức năng dùng để
                    <br>
                <span class="text-success">
                    + Kích tài khoản quảng cáo của con via/clone  trở nên có dạng thanh toán bằng momo , chạy trả trước chạy ngon ít chết
                    <br>

                </span>  
                </h4>   

            </div>
        </div>

        <div class="col-12">  
            <div class="col-12 col-xl-12 ft-description">
                    <h4 class="text-primary"> Hướng dẫn sử dụng
                        <br>
                    <span class="text-success">
                        + B1 : " Thêm " các nick muốn kích momo vào  , 
                        <br>
                        + B2 : Chọn Proxy để sử dụng  (Nếu chưa có thì ấn vào mua proxy );
                        <br>
                        + B3 : Ấn bắt đầu và ngồi rung đùi đợi kết quả thui =>> Ko cần làm gì thêm nha ck iu <#3333
                        <br>
                        <br>
                    </span>
                    Còn băn khoăn về cách sử dụng !!! Zào đây nha ck iuuuuu ơi<a class="text-danger" href="https://zalo.me/g/hztoxf367"> https://zalo.me/g/hztoxf367</a>  
                </h4>

            
            </div>
        </div>

        <div class="col-12" style="border-top: 3px solid salmon;margin-bottom:1%"></div>

        <div class="col-12">
            <div class="col-12">
                <button class="btn btn-primary btn-xs mt-2" @click="data_acc_add()"><span class="mr-2"><i class="fas fa-user-plus"></i></span>Thêm clone</button>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_del_selected()"><span class=" mr-2"><i class="far fa-trash-alt"></i></span>Xoá đã chọn</button>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_del_all()"><span class="fas fa-times mr-2"></span>Xoá tất cả</button>
                <div class="btn-group mt-2">
                    <button type="button" class="btn btn-secondary btn-xs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-hand-pointer mr-2"></i>Chọn theo trạng thái</button>
                    <button type="button" class="btn btn-secondary btn-xs dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-angle-down dropdown-arrow"></span> <span class="sr-only">Toggle Dropdown</span>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" @click="data_acc_select_status(item)" v-for="(item, index) in get_data_acc_status"><b>{{ item }}</b></a>
                    </div>

                </div>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_export_selected()"><span class="mr-2"><i class="fas fa-sign-out-alt"></i></span>Xuất đã chọn</button>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_view_selected()"><span class="fas fa-eye mr-2"></span>Xem đã chọn</button>
                <button class="btn btn-danger btn-xs mt-2" @click="so_luong_edit()"><span class="fas fa-edit mr-2"></span>Cập nhật số luồng (Hiện tại: {{ options.so_luong }})</button>
            </div>
            <div class="col-12">
                
                    <div class="btn-group mt-2">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-mouse-pointer mr-2"></i>Chọn proxy ({{ options.proxy.info }})</button>
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fas fa-angle-down dropdown-arrow"></span> <span class="sr-only">Toggle Dropdown</span>
                                                
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" @click="select_proxy(item)" v-for="(item, index) in user_proxy"><b class="badge bg-success">{{ item.info }}</b>
                                                    <b class="badge bg-info">{{ item.name }}</b> <img :src="item.flags" height="15"> <b class="badge bg-warning">{{ item.time_exp }}</b></a>
                                                </div>
                    </div>
                    <button class="btn btn-xs mt-2"><span class=" mr-2"><i class="fas fa-keyboard"></i></span>Or điền proxy của bạn vào</button>
                    <div class="input-group col-12 pl-0 mt-1">
                            <div class="col-5 pl-0">
                                <input type="text" class="form-control xs" placeholder="Điền Key Tm Proxy vào đây - Điền ở đây thì khỏi điền ở dưới nha ck" aria-label="" v-model="options.tmproxy">
                                <div class="input-group pt-2">
                                    <input type="text" class="form-control" placeholder="Nếu xài MinProxy thì điền key zào đâyyy" v-model="options.minproxy">
                                    <select class="custom-select" id="chelsea" @change="typeproxy($event)">
                                        <option selected value="6">MinProxy Mặc Định V6 !!!</option>
                                        <option value="4">Key của tôi là V4</option>

                                    </select>
                                </div> 
                            </div>
                            <div class="col-6">
                                <button class="btn btn-success btn-xs ml-1" @click="check_proxy()><span class="mr-2"><i class="far fa-check-circle"></i></span>Check Proxy</button>
                                <a href="http://localhost/code69/mua-proxy">
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
                                    <label>Phụ nữ như những con đường ->> đường càng cong càng nguy hiểm!  </label>
                                   
                                </div>
                                <div class="input-group-text">
                                    <label>Nhớ tham gia Group Zalo cùng 1k ae chém gió tool - tut nhé  </label>
                                   
                                </div>
                                <div class="input-group-text">
                                <label>Chúc các ck iuu ngày mới vui vẻ <#3333 </label>
                                </div>

                        </div>
                        
                 
                       
                  </div>
                        

                   
            </div>

        </div>

        <div class="col-12 mt-5 mb-3">
            <div class="col-12">
                <button class="btn btn-success btn-xs ml-3"  @click="run_kich_momo()"><span class="mr-2"><i class="far fa-star"></i></span>Bắt đầu</button>
                <button class="btn btn-danger btn-xs ml-3" @click="data_acc_stop()" :disabled="data_acc_is_stop" class="mr-2"><i class="fas fa-bomb"></i></span>Ngừng chạy</button>
                <button class="btn btn-info btn-xs ml-3" ><span class=""><i class="fas fa-battery-half mr-2"></i></span>Status</button>
                <button class="btn btn-success btn-xs ml-3" @click="check_uid_fb_selected()"> <span class="mr-2"><i class="far fa-kiss-wink-heart"></i></span>Check Live / Die Nick</button>
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
                        <div class="progress-bar bg-success" role="progressbar" v-bind:style="{ width: progress.percent + '%' }" v-bind:aria-valuenow="progress.value" v-bind:aria-valuemin="progress.min" v-bind:aria-valuemax="progress.max"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 pl-0"> -->
            <div class="col-12 pl-0">
            <div id="NO_OPTIONS" style="position: absolute; top:0; width: 100%;">
                    <div class="table-responsive ">
                        <table class="table table-striped table-hover table-sm" id="data_acc" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:10px">STT</th>
                                <th style="width:10px">
                                    <!-- <div class="form-check dashboard-check">
                                        <input class="form-check-input" type="checkbox" v-model="data_acc_select_all" @click="data_acc_select">
                                    </div> -->
                                </th>
                                <th>Uid</th>
                                <th>Pass</th>
                                <th>Key2FA</th>
                                <th>Cookies</th>
                                <th>Ads Id</th>
                                <th>Info khác</th>
                                <!-- <th>Info Khác</th> -->
                                <th>Trạng thái</th>
                                <th class="" style="max-width:30px;">Hành động</th>
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
                                    <td class="gioihan-pass"><b>{{ item.uid }}</b></td>
                                    <td class="gioihan-pass"><b>{{ item.pass }}</b></td>
                                    <td class="gioihan-pass"><b>{{ item.key2fa }}</b></td>
                                    <td class="gioihan-pass"><b>{{ item.cookie }}</b></td>
                                    <td class="gioihan-pass"><b>{{ item.ads_id }}</b></td>
                                    <!-- <textarea rows="2" readonly="">{{ item.cookie }}</textarea> -->
                                    <td class="gioihan"><b>{{ item.bm2 }}</b></td>
                                    <td class="gioihan"><b>{{ item.khac }}</b></td>
                                    <td class="gioihan-stt"><b><span v-bind:class="item.class">{{ item.status }}</span></b></td>
                                    <!-- v-if="data_acc_is_stop" -->
                                    <td class=""><button class="btn btn-danger btn-sm me-2" @click="data_acc_del(index)" ><span class="fas fa-times"></span> Xoá</button></td>
                                </tr>
                        </tbody>
                    </table>
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

<script>
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
                        id: 0,
                        info: '',
                    },
                    so_luong: 2,
                    run_done: 0,
                    typeminproxy:6
                },
                user_proxy: [],
                progress: {},
             
            },

            created: function() {  
                    //  var self = this;
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
                check_proxy:function(){
                    if(!this.options.tmproxy&&!this.options.minproxy){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                        var data =new URLSearchParams({
                        tmproxy:this.options.tmproxy,
                        minproxy:this.options.minproxy,
                        typeminproxy:this.options.typeminproxy,
                        type:1
                        });
                
                    const optionek = {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded',    
                        },
                        body: data
                    };
                    var url='./ajax/tools/check_changeproxy.php';
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
                change_proxy:function(){
                    if(!this.options.tmproxy&&!this.options.minproxy){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                        var data =new URLSearchParams({
                        tmproxy:this.options.tmproxy,
                        minproxy:this.options.minproxy,
                        typeminproxy:this.options.typeminproxy,
                        type:2
                        });
                
                    const optionek = {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded',    
                        },
                        body: data
                    };
                    var url=api('tools/check_changeproxy');
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
                typeproxy:function(event){
                    this.options.typeminproxy=event.target.value;
                    //  alert(this.options.typeminproxy);
                },
                get_proxy: function() {
                  
                },
                select_proxy: function(item) {
                    this.options.proxy = item;
                },
                data_acc_add: function() {
                    var get_data = prompt('Nhập danh sách clone theo 1 trong các định dạng sau \n  uid|token  (chạy nhanh) \n 1 mình cookie (chạy nhanh)\n uid|pass|2fa sẽ chạy lâu hơn 40-50s nhưng ít die \n Hoặc uid|pass|2fa|cookies|token \n Lưu ý : Ko dùng kí tự | ở cuối data', '');
                    
                    if (get_data){
                       
                        if(!get_data.includes('100')){
                            alert("Định dạng bạn nhập sai \n Uid|Pass|2FA| (Thêm Cookies nếu có ) | hoặc 1 mình Cookies" );
                            return;
                        }
                   
                        
                        
                    }else{
                        alert("Chưa nhập dữ liệu gì cả ? Nhập lại di ck iu");
                        return;
                    }
                    var get_datas = get_data.split('\n');
                    for (var item of get_datas) {
                        var info_data = item.split('|');
                        var infor = {
                            checked: true,
                            uid: '',
                            pass: '',
                            key2fa: '',
                            cookie: '',
                            ads_id: '',
                            khac: '',
                            class: '',
                            status: 'Đã thêm',
                            data: '',
                        };
                        if (info_data.length == 1) {
                            // console.log("Zô trg hợp 1 nè :"+info_data.includes('EAAG'));
                            // console.log(info_data);
                           if(info_data[0].includes('c_user')){
                            //    alert("ck");
                                infor.cookie=info_data[0];
                                infor.uid = info_data[0].match(/c_user=(\d+)/)[1];
                                
                            }else if(info_data[0].includes('100')){
                                // alert("zÔ UID");
                                infor.uid=info_data[0];
                            }else{
                                alert("Nhập định dạng sai web chấp nhận các định dạng sau:\n Cookies or  Uid|Pass|2FA");
                                return;
                            }
                           
                        }else if(info_data.length==3){
                            
                            if(info_data[0].includes('100')){
                                    infor.uid = info_data[0];
                                    infor.pass=info_data[1];
                                    infor.key2fa=info_data[2];
                            }else{
                                alert("Định dạng uid pass 2fa mà ,nhập lại đi ck iwu");
                            }

                        }else if(info_data.length==4){
                            
                            if(info_data[0].includes('100')){
                                infor.uid = info_data[0];
                                infor.pass=info_data[1];
                                infor.key2fa=info_data[2];
                                infor.cookie = info_data[3];
                            }else{
                                alert("Muốn nhập định dạng uid pass 2fa cookies đung hok , nhập sai oy");
                            }
                        } else {
                            infor.uid = info_data[0];
                            infor.pass = info_data[1];
                            infor.key2fa = info_data[2];
                            infor.cookie = info_data[3];
                            infor.ads_id=info_data[4];
                            infor.khac=info_data[5];
                            // infor.hcqc=info_data[6];
                            infor.data = item;
                        }
                        this.data_acc.push(infor);
                    }    
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
                            data += row.uid + '|' + row.pass + '|' + row.key2fa + '|' + row.cookie +'|'+row.ads_id+'|'+row.khac+'|'+row.status+'\n';
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
                            data += row.uid + '|' + row.pass + '|' + row.key2fa + '|' + row.cookie +'|'+row.ads_id+'|'+row.khac+'|'+row.status+'\n';
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
                run_kich_momo:function(){
                    var self=this;
                    var options = self.options;
                    this.data_acc_selected = [];
                    for (let [index, row] of Object.entries(this.data_acc)) {
                        if (row.checked == true) {
                            row.index = index;
                            this.data_acc_selected.push(row);
                        }
                    }
                    if (this.data_acc_selected.length < 1) {
                        alert('Chưa chọn clone!');
                        return;
                    }
                    if(!this.options.tmproxy&&!this.options.minproxy){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }

                    this.data_acc_is_stop = false;
                    this.options.run_done = 0;
                    this.progress.min = 0;
                    this.progress.max = this.data_acc_selected.length;
                    this.progress.value = 0;
                    this.progress.percent = 0;
                    showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");
                    for (var i = 0; i < this.options.so_luong; ++i) {
                        if (i < this.data_acc_selected.length) {
                        self.kich_momo(this.data_acc_selected[i].index, i, (0 + parseInt(this.options.so_luong)), this.data_acc_selected[i].cookie);
                        }
                    }

                },
                kich_momo:function(i, index, new_index, cookie){
                                      // this.push_selected("Đang Get Info");
                if(cookie.length>1&&!cookie.includes("c_user")){
                    alert("Cookies phải có c_user chứ bro ? Import lại đi ck iu");
                    self.data_acc[i].class = 'text-danger';
                    self.data_acc[i].status ="Cookies nhập zô sai kìa ck";
                    this.data_acc_is_stop=true;
                    return;
                }
                // var url =api('tools/kich_momo');
                var url='./ajax/tools/kich_momo.php';
                var self = this;
                var options = self.options;

                if (self.data_acc_is_stop) {
                    self.data_acc[i].status = 'Đang Dừng nha...';
                    return;
                }
                self.data_acc[i].class = 'text-danger';
                self.data_acc[i].status = 'Đang chạy....';
                // options.get_cookie = false;
            
                var data =new URLSearchParams({
                    uid: self.data_acc[i].uid,
                    pass: self.data_acc[i].pass,
                    key2fa: self.data_acc[i]._2fa,
                    cookies: cookie,
                    proxy: options.proxy.id,
                });
                // alert(data);
                
                // const optionek = {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type':'application/x-www-form-urlencoded',    
                //     },
                //     body: data
                // };
                // fetch(url,optionek)
                //     .then((response) =>{
                //         self.data_acc_is_stop = true;
                //       if(!response.ok){
                //             self.data_acc[i].class = 'text-danger';
                //             self.data_acc[i].status ="Sever k ổn / do proxy ";
                //             return;
                //         }
                //         return response.text();
                //     })
                //     .then((response)=>{
                //         // console.log("response lần đầu",response);
                //         var object = JSON.parse(response);
                //         // console.log("OB nè",object);
                //         // console.log("haizz",object['status']);
                //         if(object['status']){
                //             self.data_acc[i].class = 'text-success';
                //             self.data_acc[i].status =object['message'];
                //             self.data_acc[i].bm1=object['data']['mot'];
                //             self.data_acc[i].bm2=object['data']['hai'];
                //             self.data_acc[i].cookie=object['data']['ba'];
                //             if(object['data']['ba'].includes('c_user')){
                //                 self.data_acc[i].cookie=object['data']['ba'];
                //             }
                //         }else{
                //             self.data_acc[i].class = 'text-danger';
                //             self.data_acc[i].status =object['message'];
                //             if(object['data']['ba'].includes('c_user')){
                //                 self.data_acc[i].cookie=object['data']['ba'];
                //             }
                //             return;
                //         }
                      
                //     })
                //     .catch( response => {
                //      self.data_acc_is_stop = true;
                //      self.data_acc[i].status ="Lỗi:"+response;
                //     //   console.log("Lỗi rồi:"+response);
                // } );
                $.ajax({  // em post lên file php nãy thôi bác , action là nút bắt đầu
                        url: url,
                        type: 'POST',
                        dataType: 'text',
                        contentType: 'application/x-www-form-urlencoded',
                        data: data,
                        processData: false,
                        success: function(result) {
                            try{
                                    console.log("jax",result);
                                    var object = JSON.parse(result);
                                    console.log("OB",result);

                                    if (object['status']==false) {
                                        
                                        showNotify('error', object['message']);
                                        self.data_acc[i].class = 'text-danger';
                                        self.data_acc[i].status =object['message'];
                                        if(object['data']['ba'].includes('c_user')){
                                            self.data_acc[i].cookie=object['data']['ba'];
                                        }
                                    } else if(object['status']){
                                        showNotify('success',object['message']);
                                        self.data_acc[i].class = 'text-success';
                                        self.data_acc[i].status =object['message'];
                                        self.data_acc[i].ads_id=object['data']['mot'];
                                        self.data_acc[i].khac=object['data']['hai'];
                                        // self.data_acc[i].cookie=object['data']['ba'];
                                        if(object['data']['ba'].includes('c_user')){
                                            self.data_acc[i].cookie=object['data']['ba'];
                                        }
                                        
                                    }else{
                                        self.data_acc[i].class = 'text-danger';
                                        self.data_acc[i].status =result;
                                        showNotify('error',result);
                                    }
                                }catch(e){
                                    console.log("ex:",e.message);
                                    self.data_acc[i].class = 'text-danger';
                                    self.data_acc[i].status ="Lỗi:"+e.message;
                                    showNotify('error', self.data_acc[i].status);
                                }
                        },
                        error: function(xhr, status, error){
                            // var errorMessage = xhr.status + ': ' + xhr.statusText
                            showNotify('error',  self.data_acc[i].status);
                            self.data_acc[i].class = 'text-danger';
                            self.data_acc[i].status =xhr.statusText;
                        }
                       
                    }).done(function(){
                        this.data_acc_is_stop=false;
                        self.options.run_done = parseInt(self.options.run_done) + 1;
                        if (self.options.run_done == self.options.so_luong) {
                                this.data_acc_is_stop=true;
                        }
                        self.progress.value += 1;
                        self.progress.percent = Math.round(self.progress.value * 100 / self.options.so_luong);

                    });
                },
                data_acc_stop: function() {
                    this.data_acc_is_stop = true;
                },
                so_luong_edit: function() {
                    var get_data = prompt('Nhập số luồng', this.options.so_luong);
                    if (!get_data) {
                        return;
                    }
                    if (get_data >5) {
                        alert('Số luồng tối đa là 5!');
                        return;
                    }
                    this.options.so_luong = get_data;
                },
              
              
                
               
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

                // console.log("item:",":"+item+":");
                if (/^([0-9]{1,3}	)/.test(item)) {
                    // console.log("Đã vô");
                    var index=/^([0-9]{1,3}	)/.exec(item);
                    var index= parseInt(index[1].trim());
                    // if(index-haiz>=-1){

                    // }
                    // console.log("Index là:",index);
                    app.selected_data(index-1);
                }
            }
        }
        test_menu = {
        id: 'TEST-MENU',
        data: [
            {
                header: 'Thư giãn đi ck iuu'
            },
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
                text: 'Run ặc đã chọn',
                action: function(e, selector) { 
                    app.run_kich_momo();
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
                icon: 'fas fa-undo-alt',
                text: 'Reset Địa Chỉ Ip',
                action: function(e, selector) {
                    app.change_proxy();
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



