/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var strcount;
var x = new Date();

//If Minutes are Less than 10
if(x.getMinutes()<10){
    var x1 =x.getHours()+":"+'5'+ x.getMinutes()+ ":" + x.getSeconds();
}
//If Hours are Less than 10
if(x.getHours()<10 && x.getSeconds()>10){
    var x1 ='0'+x.getHours()+":"+x.getMinutes()+ ":" + x.getSeconds();
}
//If Seconds and Hours are Less than 10
if(x.getSeconds()<10 && x.getHours()<10){
    var x1 ='0'+x.getHours()+":"+x.getMinutes()+ ":" +"0"+ x.getSeconds();
}
//If Seconds are Less than 10
if(x.getSeconds()<10){
    var x1 =x.getHours()+":"+x.getMinutes()+":" +"0"+ x.getSeconds();
}
else{    
    var x1=x.getHours()+":"+x.getMinutes() + ":" + x.getSeconds();
}



document.getElementById('current_time').innerHTML = x1;
//document.getElementById('current_time').innerHTML = x;
document.getElementById('current_time').value = x1;
tt=display_c();


}