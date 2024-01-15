document.addEventListener("DOMContentLoaded", function (event) {


  const nav = document.querySelectorAll('.js-keep-scroll');

  nav.forEach(element => {
    element.addEventListener('click', function () {
      storeScrollPosition();

    })
  });

});

window.onload = function () {
  restoreScrollPosition();
};



// restore stored scroll position
function restoreScrollPosition() {
  let scrollPosition = getCookie("scrollPosition");

  if (scrollPosition != null) {
    window.scrollTo(0, scrollPosition);
    document.cookie = "scrollPosition=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";

  }
}


// store scroll position when click listener 
function storeScrollPosition() {
  var scrollpos = window.scrollY;

  document.cookie = "scrollPosition=" + scrollpos;


}



function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return null;
}