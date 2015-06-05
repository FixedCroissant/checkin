/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var theTotal = 0;
$(".timeGroup").each(function () {
    theTotal += parseInt($(this).val());
});
$("#total").val(theTotal);
