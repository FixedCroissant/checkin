/*
 * Title: clock.js
 * Version: 1.0
 * Updated: 06 09 2015
 * Description: This is a small javascript file that will display the current time inside what ever portion you specify within the DOM.
 * As of 06/05, it is working correctly by filling out a leading '0" based on how many hours, minutes and seconds there are on the clock.
 * the accuracy of this is completely dependant on the operating systems' clock being correct. Given that most OS receive their time updated
 * through the internet, it should be correct.
 */


function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var strcount;
var x = new Date();

    //If Hours & Minutes are Less than 10
    if(x.getHours()<10 && x.getMinutes()<10){
        var x1 ='0'+x.getHours()+":"+'0'+x.getMinutes()+ ":" + x.getSeconds();
    }
    //If Hours and Seconds are less than 10.
    else if (x.getHours()<10 && x.getSeconds()<10){
        var x1 = '0'+x.getHours()+":"+x.getMinutes() + ":" + '0' + x.getSeconds();
    }
    //If Hours are Less than 10
    else if(x.getHours()<10){
            var x1 ='0'+x.getHours()+":"+x.getMinutes()+ ":" + x.getSeconds();
        }
    //If Minutes are Less than 10
    else if(x.getMinutes()<10){
        var x1 =x.getHours()+":"+'0'+x.getMinutes()+ ":" + x.getSeconds();
        }
    //If Seconds are less than 10.
    else if (x.getSeconds()<10){
        var x1 = x.getHours()+":"+x.getMinutes() + ":" + '0' + x.getSeconds();
    }

    else{
            var x1=x.getHours()+":"+x.getMinutes() + ":" + x.getSeconds();
        }

document.getElementById('current_time').innerHTML = x1;
//document.getElementById('current_time').innerHTML = x;
document.getElementById('current_time').value = x1;
tt=display_c();


}