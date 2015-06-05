/* 
 * Name: startTimer
 * Date: 03/06/2015
 * Provided by robbmj @ stackoverflow.
 * jQuery version.
 */

$(function() {
    var threeSeconds = 3,
        display = $('#time'),
        mins, seconds;
    setInterval(function() {
        mins = parseInt(threeSeconds / 60)
        seconds = parseInt(threeSeconds % 60);
        seconds = (seconds < 3) ? "0" + seconds : seconds;

        display.text(mins + ":" + seconds);
        threeSeconds--;

        if (threeSeconds < 0) {
            threeSeconds = 3;
        }
    }, 1000);
});