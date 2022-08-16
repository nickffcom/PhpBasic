<?php
function RanDomText(){

}
function RandomNumber($min,$max){
    return rand($min,$max);
}
function RandomPassWord(){
    $lengh=RandomNumber(7,11);
    $temp= substr(md5(rand()), 0, $lengh);
    $rdnumber=(string)RandomNumber(1,10);
    $ketqua=$temp."".$rdnumber;

}
function generateRandomString($min,$max) {
    $length=rand($min,$max);
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    
}
function RandomName(){
    $arr=array(
        1=>'Annabella',
        2=>'Arianne',
        3=>'Blanche',
        4=>'Bridget',
        5=>'Ceridwen',
        6=>'Edana',
        7=>'Doris',
        8=>'Erica',
        9=>'Elain',
        10=>'Euphemia',
        11=>'Fidelma',
        12=>'Gladys',
        13=>'Aylmer',
        14=>'Cadell',
        15=>'Egbert',
        16=>'Gideon',
        17=>'Mortimer',
        18=>'Basil',
        19=>'Waldo',
        20=>'Roger',
        21=>'Edsel',
        22=>'Magnus',
        23=>'Orborne',
        24=>'Timothy',
        25=>'Charles',
        26=>'Harold',
        27=>'Walter',
        28=>'Stephen',
        29=>'Manfred',
        30=>'Grainne',
        31=>'Kiddo',
        32=>'Poppet',
        33=>'Snuggler',
        34=>'Zelda',
        35=>'Calliope',
        36=>'Delwyn',
        37=>'Heulwen',
        38=>'Misiu',
        39=>'Peanut',
    );
    $rand = rand(1,40);
    return $arr[$rand];
}
// $haha = RandomPassWord();
// $haha=generateRandomString();
// echo $haha;
?>