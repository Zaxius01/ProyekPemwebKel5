document.addEventListener('DOMContentLoaded', function () {
    var checkIn = document.getElementById('check-in');
    var checkOut = document.getElementById('check-out');

    if (!checkIn || !checkOut) {
        return;
    }

    var today = new Date();
    var localToday = new Date(today.getTime() - today.getTimezoneOffset() * 60000)
        .toISOString()
        .slice(0, 10);

    checkIn.min = localToday;
    checkOut.min = localToday;

    checkIn.addEventListener('change', function () {
        checkOut.min = checkIn.value || localToday;
        if (checkOut.value && checkOut.value <= checkIn.value) {
            checkOut.value = '';
        }
    });
});