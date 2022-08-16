<?php
    $username=s($me->{'username'});
    if(!isset($username)){
        exit();
    }

    // $sql="SELECT * FROM history_tool where history_tool.user='$username' ORDER BY history_tool.time_su_dung DESC LIMIT 70";

    $sql="SELECT * FROM history_tool ORDER BY history_tool.time_su_dung DESC LIMIT 70";
    $lists = $db->rawQuery($sql);

    // $lists=$db->get('history_tool',70)->orderBy('time_su_dung DESC');

?>
<style>
 #history_tool{
    height: 70vh;
    overflow-x: hidden;
    overflow-y: scroll;
    box-shadow: 0 8px 60px 0 rgba(103, 151, 255, .11), 0 12px 90px 0 rgba(103, 151, 255, .11);

 }
 #history_item{
     width: 90vh;
     margin: 0 auto;
 }
 #color{
    background-color: rgba(226, 174, 138, 1); 
 }
</style>
<h1 class="text-danger">VÔ GROUP ZALO ĐỂ XEM CÁC TOOL FREE HIỆN CÓ 
500 ae đang đợi bạn <a class="text-primary" href="https://zalo.me/g/hztoxf367"> https://zalo.me/g/hztoxf367</a>
</h1>

<h1 class="text-success"> + Lịch sử dùng tool </h1>
<div class="block-content" id="color">
                <?php if (empty($lists)) { ?>
                <div class="text-center" style="font-size:20px;color:red;font-weight: bold;">Chưa có lịch sử <#33333 </div>
                <?php } else { ?>
                <div class="text-center mb-3" style="font-size:20px;color:red;font-weight: bold;">----------------  Ae sử dụng mạnh lên để mình có xiền đi á ò nào : Block + Trừ tiền vĩnh viễn các hành vi gian lận ----------------</div>

                <?php } ?>

                <div id="history_tool">
                <?php 
                            $counts = count($lists);
                            // // $time=time();
                            // for ($i = 0; $i < 1; $i++){
                            //     $haha=$db->insert('history_tool', array(
                            //         'user' => 'admin',
                            //         'time_su_dung'=>time(), // 1 là change ip . 0 là  không cho
                            //         'description' =>'Ko có rì',
                            //         'chuc_nang'=>'Quản Lý Ads Meta'
                            //     ));
                            // }
                            foreach ($lists as $x) {
                                $username_xx = $x['user'];
                                $username_xx = substr($username_xx, 0, 2) . '***' . substr($username_xx, 5);
                                $thoigian=date('H:i:s d/m',$x['time_su_dung']);
                                $counts--;
                ?>
                <div id="history_item">
                    <h4 class="text-primary">
                        <i class="fa fa-money-bill"></i>
                        +1         
                        User:   <?= $username_xx; ?> 
                        <span class="font-italic">--- Đã sử dụng chức năng <?= $x['chuc_nang']; ?></span>
                         -- Vào lúc <span class="text-dark"> <?= $thoigian; ?> </span>  
                    </h4>
                </div>
               
                <?php } ?>
                </div>
</div>



