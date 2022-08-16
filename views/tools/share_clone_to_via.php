<style>
   #data_acc tbody .gioihan {
        max-width: 100px;
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
        max-width: 50px;
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
            <h3><span class="mr-2"><i class="fas fa-arrow-alt-circle-right"></i></span>Share TKQC Clone Sang Via</h3>
        </div>
    

        <div class="col-12">
            <div class="col-12 col-xl-12 ft-description">
                <h4 class="text-danger"> Chức năng dùng để
                    <br>
                <span class="text-success">
                    + Share (Chia sẻ quyền tài khoản quảng cáo của nick Clone sang Cho 1 Via duy nhất)
                    <br>
                    + Có thể chọn thoát (Out) khỏi tài khoản quảng cáo sau khi share ,Lưu ý : Tool sẽ lấy tkqc đầu tiên nó tìm được trong nick và share 
                    <br>
                    + Điền token dạng EAAB cho chắc cú nhé các bạn vì token EAAG đang fix và ko ổn định....
                    <br>
                </span>  
                </h4>   

            </div>
        </div>

        <div class="col-12">  
            <div class="col-12 col-xl-12 ft-description">
                    <h4 class="text-primary"> Hướng dẫn sử dụng xem tại <a class="text-danger" href="https://youtu.be/4WOn8q5JMWo">https://youtu.be/4WOn8q5JMWo</a>
                        <br>
                    <span class="text-success">
                        + B1 :Chuẩn bị các nick clone và 1 nick via chính để nhận tkqc ! Có thể mua tại website 
                        <br>
                        + B2 : Ấn nút Thêm Clone và nhập vào định dạng sau  uid | pass | 2FA | Cookies( nếu có ) | Token , hoặc chỉ cần uid | pass | 2fa là đủ
                        <br>
                        + B3 : Điền token hoặc Cookies Ặc Via muốn nhận tkqc vào 
                        <br>
                        + B4 : Chọn proxy ( Phải mua proxy trước thì mới chọn đc ) ! Ấn nút check proxy để tiến hành kiểm tra proxy còn sử dụng được không !!!
                        <br>
                        + B5 : Ấn nút bắt đầu và đợi tác vụ hoàn thành , nếu bỏ cookies vào thì sẽ chạy nhanh hơn định dạng uid|pass|2fa tầm 30-60s
                        <br>
                    </span>
                    Nếu chưa biết tác dụng và cách chạy thì bắt buộc xem video sau - Ko xem 100% là chạy sai: <a class="text-danger" href="https://zalo.me/g/hztoxf367">https://zalo.me/g/hztoxf367</a>  
                </h4>

            
            </div>
        </div>

        <div class="col-12" style="border-top: 3px solid salmon;margin-bottom:1%"></div>

        <div class="col-12">
            <div class="col-12">
                <button class="btn btn-primary btn-xs mt-2" @click="data_acc_add()" :disabled="data_acc_is_stop"><span class="mr-2"><i class="fas fa-user-plus"></i></span>Thêm clone</button>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_del_selected()" :disabled="data_acc_is_stop"><span class=" mr-2"><i class="far fa-trash-alt"></i></span>Xoá đã chọn</button>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_del_all()" :disabled="data_acc_is_stop"><span class="fas fa-times mr-2"></span>Xoá tất cả</button>
                <div class="btn-group mt-2">
                    <button type="button" class="btn btn-secondary btn-xs" :disabled="data_acc_is_stop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-hand-pointer mr-2"></i>Chọn theo trạng thái</button>
                    <button type="button" class="btn btn-secondary btn-xs dropdown-toggle dropdown-toggle-split"  :disabled="data_acc_is_stop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-angle-down dropdown-arrow"></span> <span class="sr-only">Toggle Dropdown</span>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" @click="data_acc_select_status(item)" v-for="(item, index) in get_data_acc_status"><b>{{ item }}</b></a>
                    </div>

                </div>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_export_selected()" :disabled="data_acc_is_stop"><span class="mr-2"><i class="fas fa-sign-out-alt"></i></span>Xuất đã chọn</button>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_view_selected()" :disabled="data_acc_is_stop"><span class="fas fa-eye mr-2"></span>Xem đã chọn</button>
                <button class="btn btn-danger btn-xs mt-2" @click="so_luong_edit()" :disabled="data_acc_is_stop"><span class="fas fa-edit mr-2"></span>Cập nhật số luồng (Hiện tại: {{ options.so_luong }})</button>
            </div>
            <div class="col-12">
                
                    <div class="btn-group mt-2">
                        <select class="form-select bg-success form-control" @change="select_proxy()" >
                                                        <option selected disabled>Chọn Proxy để chạy</option>
                                                        <option @click="select_proxy(item)" v-for="(item, index) in user_proxy" v-bind:value="item.id">
                                                         
                                                            <b class="badge bg-info">{{ item.name }}</b>
                                                            <b class="badge bg-warning">{{ item.time_exp }}</b>
                                                        </option>

                        </select>
                    </div>
                    <button class="btn btn-xs mt-2"><span class=" mr-2"><i class="fas fa-keyboard"></i></span>Or điền proxy của bạn vào</button>
                    <div class="input-group col-12 pl-0 mt-1">
                            <div class="col-5 pl-0">
                                <input type="text" class="form-control xs" placeholder="Điền Key Tm Proxy vào đây - Điền ở đây thì khỏi điền ở dưới nha ck" aria-label="" v-model="options.tmproxy">
                                <!-- <div class="input-group pt-2">
                                    <input type="text" class="form-control" placeholder="Nếu xài MinProxy thì điền key zào đâyyy" v-model="options.minproxy">
                                    <select class="custom-select" id="chelsea" @change="typeproxy($event)">
                                        <option selected value="6">MinProxy Mặc Định V6 !!!</option>
                                        <option value="4">Key của tôi là V4</option>

                                    </select>
                                </div>  -->
                            </div>
                            <div class="col-6">
                                <button class="btn btn-success btn-xs ml-1" @click="check_proxy()" :disabled="data_acc_is_stop"><span class="mr-2"><i class="far fa-check-circle"></i></span>Check Proxy</button>
                                <a href="mua-proxy">
                                <button class="btn btn-info btn-xs ml-2" :disabled="data_acc_is_stop">
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
                                    <label>Điền Token or Cookies nick nhận ! Nếu điền vào uid thì chỉ gửi lời mời kết bạn đến via nhận <input type="text" class="form-control" aria-label="Text input with checkbox" v-model="options.tokenvia">    </label>
                                   
                                </div>
                                <div class="input-group-text">
                                <label>Out TKQC Khi Share Xong ?<input class="ml-3"type="checkbox" v-model="options.out_tkqc">  Có  </label>
                                </div>
                                <div class="input-group-text">
                                    <label>
                                        Chọn Quyền Share
                                        <select class="form-control" id="quyen">
                                            <option>Admin</option>
                                            <option>Nhà Quảng Cáo</option>
                                            <option>Nhà Phân Tích</option>
                                        
                                        </select>
                                    </label>
                                </div>
                                <div class="input-group-text">
                                    <label>Bỏ qua kết bạn=> Share luôn ?<input class="ml-3"type="checkbox" value="" v-model="options.shareluon"></label>
                                </div>

                        </div>
                        
                 
                       
                  </div>
                        

                   
            </div>

        </div>

        <div class="col-12 mt-5 mb-3">
            <div class="col-12">
                <button class="btn btn-success btn-xs ml-3"  @click="run_share_tkqc_clone()" :disabled="data_acc_is_stop"><span class="mr-2"><i class="far fa-star"></i></span>Bắt đầu</button>
                <button class="btn btn-info btn-xs ml-3" :disabled="data_acc_is_stop"><span class=""><i class="fas fa-battery-half mr-2"></i></span>Status:{{options.status}}</button>
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
                        <div class="progress-bar bg-success" role="progressbar" v-bind:style="{ width: progress.percent + '%' }" v-bind:aria-valuenow="progress.value" v-bind:aria-valuemin="progress.min" v-bind:aria-valuemax="progress.max"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pl-0">
            <div id="NO_OPTIONS" style="position: absolute; top:0; width: 100%;">
                <div class="table-responsive ">
                    <table class="table table-striped table-hover table-sm" id="data_acc">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:10px">STT</th>
                                <th style="width:10px">
                                    <!-- <div class="form-check dashboard-check">
                                        <input class="form-check-input" type="checkbox" v-model="data_acc_select_all" @click="data_acc_select">
                                    </div> -->
                                </th>
                                <th>UID</th>
                                <th>Pass</th>
                                <th>2FA</th>
                                <th>Cookie</th>
                                <th>Token</th>
                                <th>ADS ID</th>
                                <th>ADS NAME</th>
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
                                    <td class="gioihan-pass"><b>{{ item._2fa }}</b></td>
                                    <td class="gioihan-pass"><b>{{ item.cookie }}</b></td>
                                    <td class="gioihan-pass"><b>{{ item.token }}</b></td>
                                    <!-- <textarea rows="2" readonly="">{{ item.cookie }}</textarea> -->
                                    <td class="gioihan"><b>{{ item.ads_id }}</b></td>
                                    <td class="gioihan"><b>{{ item.ads_name }}</b></td>
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
</body>

    <script>
    
       
    </script>
    <script>
      
    </script>
    <script>
    </script>
    <script>
        // var mix_admin = {

        // }
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
                        id: false,
                        info: '',
                    },
                    so_luong:0,
                    max_so_luong:0,
                    run_done: 0,
                    edenhazard:0,
                    chelsea_fc:0,
                    typeminproxy:6
                },
                user_bill: {},
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
                    type:1,
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
                           
                            var object = JSON.parse(response); 
                            self.options.status=object.data.msg;
                            self.options.so_luong=object.data.so_luong;
                            self.options.maxsoluong=object.data.so_luong;
                   
                            if(object.data.status){
                                
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
                select_proxy:function(item) {
                    item=event.target.value;
                    console.log("hài cốt",item);
                    this.options.proxy.id = Number.parseInt(item);  
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
                typeproxy:function(event){
                    this.options.typeminproxy=event.target.value;
                    //  alert(this.options.typeminproxy);
                },
               
                data_acc_get: function() {
                    this.data_acc = localStorage.getItem('data_acc') !== null ? JSON.parse(localStorage.getItem('data_acc')) : [];
                },
                data_acc_add: function() {
                    var get_data = prompt('Nhập danh sách clone theo 1 trong các định dạng sau \n  uid|token  (chạy nhanh) \n 1 mình cookie (chạy nhanh)\n uid|pass|2fa sẽ chạy lâu hơn 40-50s nhưng ít die \n Hoặc uid|pass|2fa|cookies|token \n Lưu ý : Ko dùng kí tự | ở cuối data', '');
                    
                    if (get_data){
                        // console.log(get_data);
              
                        if(get_data.includes('100')){}
                        else if(get_data.includes('EAAG')){
                            // alert("Có token");
                        }
                        else if(get_data.includes('c_user')){}
                        else{
                            alert("Định dạng bạn nhập sai \n Uid|Pass|2FA| (Thêm Cookies nếu có ) | hoặc 1 mình Cookies hoặc 1 mình token !" );
                        return;
                        }
                        
                    }else{
                        alert("Chưa nhập dữ liệu gì cả ? Nhập lại di ck iu");
                        return;
                    }
                    var get_datas = get_data.split('\n');
                    for (var item of get_datas) {
                        var info_data = item.split('|');
                        var info = {
                            checked: true,
                            uid: '',
                            pass: '',
                            _2fa: '',
                            cookie: '',
                            token:'',
                            ads_id: '',
                            ads_name: '',
                            class: '',
                            status: 'Thêm clone',
                            data: '',
                        };
                        if (info_data.length == 1) {
                            // console.log("Zô trg hợp 1 nè :"+info_data.includes('EAAG'));
                            // console.log(info_data);
                           if(info_data[0].includes('c_user')){
                            //    alert("ck");
                                info.cookie=info_data[0];
                                info.uid = info_data[0].match(/c_user=(\d+)/)[1];
                                
                            }else if(info_data[0].includes('100')){
                                // alert("zÔ UID");
                                info.uid=info_data[0];
                            }else{
                                alert("Nhập định dạng sai web chấp nhận các định dạng sau:\n Cookies / Token /  Uid|Pass|2FA");
                                return;
                            }
                           
                        }else if(info_data.length==2){
                            if(info_data[1].includes('EAAG')){
                                info.uid=info_data[0];
                                info.token=info_data[1];
                            }else{
                                alert("Định dạng là uid|token nhé ck iuuu ,nhập lại ik");
                            }
                       }else if(info_data.length==3){
                            
                            if(info_data[0].includes('100')){
                                    info.uid = info_data[0];
                                    info.pass=info_data[1];
                                    info._2fa=info_data[2];
                            }else{
                                alert("Định dạng uid pass 2fa mà ,nhập lại đi ck iwu");
                            }

                        }else if(info_data.length==4){
                            // alert("4");
                            if(info_data[0].includes('100')){
                                info.uid = info_data[0];
                                info.pass=info_data[1];
                                info._2fa=info_data[2];
                                info.cookie = info_data[3];
                            }else{
                                alert("Muốn nhập định dạng uid pass 2fa cookies đung hok , nhập sai oy");
                            }
                        } else {
                            info.uid = info_data[0];
                            info.pass = info_data[1];
                            info._2fa = info_data[2];
                            info.cookie = info_data[3];
                            info.token=info_data[4];
                            info.data = item;
                        }
                        this.data_acc.push(info);
                    }
                },
                selected_data:function(index){
                    console.log("Data ặc nè",this.data_acc);
                    this.data_acc[index].checked=true;
                },
                delete_check: function() {
           
                    for (let row of this.data_acc) {
                        row.checked = false;
                    }
                },
                data_acc_del: function(index) {
                    this.data_acc.splice(index, 1);
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
                data_acc_select: function() {
                    if (!this.data_acc_select_all) {
                        for (let row of this.data_acc) {
                            row.checked = true;
                        }
                    } else {
                        for (let row of this.data_acc) {
                            row.checked = false;
                        }
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
                            data += row.uid + '|' + row.pass + '|' + row._2fa + '|' + row.cookie + '\n';
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
                            data += row.uid + '|' + row.pass + '|' + row._2fa + '|' + row.cookie +'|'+row.ads_id+'|'+row.ads_name+'|'+row.status +'\n';
                        }
                    }
                    view_tab(data);
                },
                check_uid_fb_selected: function() {
                    // alert('Hài');
                    var self=this;
                    // alert(self.options.tokenvia);
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
                run_share_tkqc_clone:function(){
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
                        alert('Chưa chọn clone!');
                        return;
                    }
                    if(!input){
                        alert("Vui lòng nhập Token / Cookies Via nhận \n Hoặc tích vào chỉ kết bạn và nhập uid dạng 1000....");
                        return;
                    }else if(input.includes("c_user")||input.includes("EAA")){
                        
                    }else if(input.includes('100')&&!options.ketban){
                        // alert("Vui lòng nhập Token / Cookies Via nhận \n Hoặc tích vào chỉ kết bạn và nhập uid dạng 1000....");
                        // return;
                    }else{
                        alert("Bắt buộc phải nhập token hoặc cookies vào hoặc \n tích vào chỉ kết bạn và nhập uid dạng 1000..... vào");
                        return;
                    }

                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng Chọn hoặc nhập key proxy đã rồi tính tiếp ck iuuu");
                        return;
                    }
                   
                    if(this.data_acc_is_stop===true){
                        alert("Lỗi:"+self.options.status);
                        return;
                    }
                    this.data_acc_is_stop = true;
                    this.options.run_done = 0;
                    this.options.so_acc_chay=this.options.so_luong;
                    this.progress.min = 0;
                    this.progress.max = this.data_acc_selected.length;
                    this.progress.value = 0;
                    this.progress.percent = 0;
                    if(this.data_acc_selected.length<this.options.so_luong){
                        this.options.so_acc_chay=this.data_acc_selected.length;
                    }
                    showNotify('success', "Đang chạy =>> Vui lòng đợi xong hết");
                    for (var i = 0; i < this.options.so_luong; ++i) {
                        if (i < this.data_acc_selected.length) {
                        self.share_tkqc_clone(this.data_acc_selected[i].index, i, (0 + parseInt(this.options.so_luong)), this.data_acc_selected[i].cookie);
                        }
                    }
                    
                },
                share_tkqc_clone:function(i, index, new_index, cookie){
             
                var url="./api_tool/share_clone_to_via";
                var self = this;
                var options = self.options;
                self.data_acc[i].class = 'text-primary';
                self.data_acc[i].status = 'Đang chạy....';
                    if(!options.shareluon){
                        options.shareluon='';
                    }
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
                var data =new URLSearchParams({
                    uid: self.data_acc[i].uid,
                    pass: self.data_acc[i].pass,
                    key2fa: self.data_acc[i]._2fa,
                    cookies: cookie,
                    tokenvia: options.tokenvia,
                    tokenclone:self.data_acc[i].token,
                    proxy: options.proxy.id,
                    shareluon:options.shareluon,
                    outtkqc:options.out_tkqc,
                    edenhazard:options.edenhazard,
                    chelsea_fc:options.chelsea_fc,
                    guid:uuidv4(),
                    role:result

                });

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
                                    // console.log("OB",result);

                                    if (object['status']==false) {
                                        
                                        showNotify('error', object['message']);
                                        self.data_acc[i].class = 'text-danger';
                                        self.data_acc[i].status =object['message'];
                                        console.log("data3",object['data']['ba']);
                                        if(object['data']['ba'].includes('c_user')){
                                            self.data_acc[i].cookie=object['data']['ba'];
                                        }
                                    } else if(object['status']){
                                        showNotify('success',object['message']);
                                        self.data_acc[i].class = 'text-success';
                                        self.data_acc[i].status =object['message'];
                                        self.data_acc[i].ads_id=object['data']['mot'];
                                        self.data_acc[i].ads_name=object['data']['hai'];
                                        // console.log("data3",object['data']['ba']);
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
                        },
                        complete: function() {
                     
                            self.data_acc[i].checked =false;
                            self.options.run_done = self.options.run_done + 1;                        
                            if (self.options.run_done == self.options.so_acc_chay) {
                                self.data_acc_is_stop=false;
                            }
                            self.progress.value += 1;
                            self.progress.percent = Math.round(self.progress.value * 100 / self.options.so_luong);

                        }

                       
                    });
              


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
                    app.run_share_tkqc_clone();
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



