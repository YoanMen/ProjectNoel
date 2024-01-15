document.addEventListener("DOMContentLoaded", () => {

  const DAYS = document.querySelector(".js-countdown--days")
  const HOURS = document.querySelector(".js-countdown--hours")
  const MINUTES = document.querySelector(".js-countdown--minutes")
  const SECONDS = document.querySelector(".js-countdown--seconds")


  var currentTime = new Date();

  var countDownDate = new Date("Dec 25, " + currentTime.getFullYear() + " 0:0:0");
  if (currentTime <= countDownDate) {
    countdown();

  } else {
    var countDownDate = new Date("Dec 25, " + (currentTime.getFullYear() + 1) + " 0:0:0");
  }

  function countdown() {
    var now = new Date().getTime();

    var distance = countDownDate.getTime() - now;

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);


    DAYS.innerHTML = days;
    HOURS.innerHTML = hours;
    MINUTES.innerHTML = minutes;
    SECONDS.innerHTML = seconds;

  }

  setInterval(countdown, 1000);





})  