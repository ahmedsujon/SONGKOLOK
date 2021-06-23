var timeID = document.getElementById('time');
var timeID2 = document.getElementById('time2');
var continueCounting = true;
var time_difference_h1 = $('#time_difference');
var nobabi_link = $('#nobabi_link');


setInterval(() => {
    var time = new Date();
    timeID.innerHTML = ' ';
    timeID.innerHTML = time.toLocaleTimeString();

    timeID2.innerHTML = ' ';
    timeID2.innerHTML = time.toLocaleTimeString();
}, 1000);

setInterval(() => {
    let start_date = new Date(time_difference_h1.attr('data-start-date'));
    let current_date = new Date();

    if ( start_date-current_date > 0 ){
        time_difference_h1.empty();
        nobabi_link.hide();
        time_difference_h1.append(timeDiffCalc(start_date, current_date));
    } else {
        time_difference_h1.hide();
        nobabi_link.show();
    }
}, 1000);


function timeDiffCalc(dateFuture, dateNow) {
    let diffInMilliSeconds = Math.abs(dateFuture - dateNow) / 1000;

    const days = Math.floor(diffInMilliSeconds / 86400);
    diffInMilliSeconds -= days * 86400;

    const hours = Math.floor(diffInMilliSeconds / 3600) % 24;
    diffInMilliSeconds -= hours * 3600;

    const minutes = Math.floor(diffInMilliSeconds / 60) % 60;
    diffInMilliSeconds -= minutes * 60;

    const seconds = Math.floor(diffInMilliSeconds % 60);
    return days + ' DAYS ' + hours + ' : ' + minutes + ' : ' + (( seconds/10 < 1 ) ? '0'+ String(seconds)  : seconds);
}
