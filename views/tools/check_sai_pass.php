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
            <h3><span class="mr-2"><i class="fas fa-arrow-alt-circle-right"></i></span>Check Sai Pass Cho Account</h3>
        </div>
    

        <div class="col-12">
            <div class="col-12 col-xl-12 ft-description">
                <h4 class="text-danger"> Chức năng dùng để
                    <br>
                <span class="text-success">
                    + Check ặc uid | pass | 2fa có sai pass hay không ? 
                    + Dạng check này 1 ip có thể sử dụng để check đc tầm > 50 ặc , có thể 100 tùy loại ip...
                    + Logic là nó sẽ log vào kiểm tra ( Nhớ chú ý cái này để tránh 956 nhé);
                    <br>

                </span>  
                </h4>   

            </div>
        </div>

        <div class="col-12">  
            <div class="col-12 col-xl-12 ft-description">
                    <h4 class="text-primary"> Hướng dẫn sử dụng <a class="text-danger" href="https://youtu.be/HwxUNa6CCCU">https://youtu.be/HwxUNa6CCCU</a>
                        <br>
                    <span class="text-success">
                        + B1 : " Thêm " các nick muốn check vào  , 
                        <br>
                        + B2 : Chọn Proxy để sử dụng  (Nếu chưa có thì ấn vào mua proxy );
                        <br>
                        + B3 : Ấn bắt đầu và ngồi rung đùi đợi kết quả thui =>> Ko cần làm gì thêm nha ck iu <#3333
                        <br>
                        <br>
                    </span>
                    Zào đây tâm sự với ae nè ck iuuuuu <a class="text-danger" href="https://zalo.me/g/hztoxf367"> https://zalo.me/g/hztoxf367</a>  
                </h4>

            
            </div>
        </div>

        <div class="col-12" style="border-top: 3px solid salmon;margin-bottom:1%"></div>

        <div class="col-12">
            <div class="col-12">
                <button class="btn btn-primary btn-xs mt-2" @click="data_acc_add()" :disabled="data_acc_is_stop"><span class="mr-2"><i class="fas fa-user-plus"></i></span>Thêm Via</button>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_del_selected()" :disabled="data_acc_is_stop"><span class=" mr-2"><i class="far fa-trash-alt"></i></span>Xoá đã chọn</button>
                <button class="btn btn-secondary btn-xs mt-2" @click="data_acc_del_all()" :disabled="data_acc_is_stop"><span class="fas fa-times mr-2"></span>Xoá tất cả</button>
                <div class="btn-group mt-2">
                    <button type="button" class="btn btn-secondary btn-xs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" :disabled="data_acc_is_stop"><i class="fas fa-hand-pointer mr-2"></i>Chọn theo trạng thái</button>
                    <button type="button" class="btn btn-secondary btn-xs dropdown-toggle dropdown-toggle-split" :disabled="data_acc_is_stop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        
                  </div>
                        

                   
            </div>

        </div>

        <div class="col-12 mt-5 mb-3">
            <div class="col-12">
                <button class="btn btn-success btn-xs ml-3"  @click="run_check_sai_pass()" :disabled="data_acc_is_stop"><span class="mr-2"><i class="far fa-star"></i></span>Bắt đầu</button>
                <button class="btn btn-info btn-xs ml-3" ><span class=""><i class="fas fa-battery-half mr-2" :disabled="data_acc_is_stop"></i></span>Status:{{options.status}}</button>
                <button class="btn btn-success btn-xs ml-3" @click="check_uid_fb_selected()" :disabled="data_acc_is_stop"> <span class="mr-2"><i class="far fa-kiss-wink-heart"></i></span>Check Live / Die Nick</button>
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
                                <th>Khác</th>
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
                                    <td class="gioihan-pass"><b>{{ item.khac }}</b></td>
                                    <!-- <textarea rows="2" readonly="">{{ item.cookie }}</textarea> -->
                                    <!-- <td class="gioihan"><b>{{ item.bm2 }}</b></td> -->
                                    <!-- <td class="gioihan"><b>{{ item.khac }}</b></td> -->
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
                        id: false,
                        info: '',
                    },
                    so_luong: 2,
                    run_done: 0,
                    edenhazard:0,
                    chelsea_fc:0,
                    typeminproxy:6
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
                    type:5
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
                            infor.khac=info_data[4];
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
                            data += row.uid + '|' + row.pass + '|' + row.key2fa + '|' + row.cookie +'|'+row.khac+'|'+row.status+'\n';
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
                            data += row.uid + '|' + row.pass + '|' + row.key2fa + '|' + row.cookie +'|'+row.khac+'|'+row.status+'\n';
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
                run_check_sai_pass:function(){
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
                    
                    if(!this.options.tmproxy&&!this.options.proxy.id){
                        alert("Vui lòng nhập key proxy đã rồi tính tiếp ck iuuu");
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
                        self.check_sai_pass(this.data_acc_selected[i].index, i, (0 + parseInt(this.options.so_luong)), this.data_acc_selected[i].cookie);
                        }
                    }

                    

           
                },
                check_sai_pass:function(i, index, new_index, cookie){
                var self = this;
                var options = self.options;
                if(cookie.length>1&&!cookie.includes("c_user")){
                    alert("Cookies phải có c_user chứ bro ? Import lại đi ck iu");
                    self.data_acc[i].class = 'text-danger';
                    self.data_acc[i].status ="Cookies nhập zô sai kìa ck";
                    this.data_acc_is_stop=true;
                    return;
                }
                // var url =api('tools/reg_bm');
                var url="./api_tool/check_sai_pass";
                
                self.data_acc[i].class = 'text-primary';
                self.data_acc[i].status = 'Đang chạy....';
                // options.get_cookie = false;
                var data =new URLSearchParams({
                    uid: self.data_acc[i].uid,
                    pass: self.data_acc[i].pass,
                    key2fa: self.data_acc[i]._2fa,
                    cookies: cookie,
                    proxy: options.proxy.id,
                    edenhazard:options.edenhazard,
                    chelsea_fc:options.chelsea_fc,

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
                                var object = JSON.parse(result);
                                    if(object['status']){
                                        self.data_acc[i].class = 'text-success';
                                        self.data_acc[i].status =object['message'];
                                        self.data_acc[i].khac=object['data']['mot'];
                                        self.data_acc[i].cookie=object['data']['ba'];
                                        if(object['data']['ba'].includes('c_user')){
                                            self.data_acc[i].cookie=object['data']['ba'];
                                        }
                                    }else{
                                        self.data_acc[i].class = 'text-danger';
                                        self.data_acc[i].status =object['message'];
                                        if(object['data']['ba'].includes('c_user')){
                                            self.data_acc[i].cookie=object['data']['ba'];
                                        }
                                    
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
                    app.run_check_sai_pass();
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



