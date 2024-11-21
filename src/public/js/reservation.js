window.onload = function(){
    var getToday = new Date();
    var y = getToday.getFullYear();
    var m = getToday.getMonth() + 1;
    var d = getToday.getDate();
    var today = y + "-" + m.toString().padStart(2,'0') + "-" + d.toString().padStart(2,'0');
    document.getElementById("reservation-date").setAttribute("value",today);
    document.getElementById("reservation-date").setAttribute("min",today);
}

document.addEventListener('DOMContentLoaded', function () {
  const dateInput = document.getElementById('reservation-date');
  const timeSelect = document.getElementById('reservation-time');
  const numberSelect = document.getElementById('reservation-number');

  const confirmDate = document.getElementById('confirm-date');
  const confirmTime = document.getElementById('confirm-time');
  const confirmNumber = document.getElementById('confirm-number');

  dateInput.addEventListener('change', function() {
    confirmDate.textContent = dateInput.value;
  });

  timeSelect.addEventListener('change', function() {
    confirmTime.textContent = timeSelect.options[timeSelect.selectedIndex].text;
  });

  numberSelect.addEventListener('change', function() {
    confirmNumber.textContent = numberSelect.options[numberSelect.selectedIndex].text;
  });
});