
document.addEventListener("DOMContentLoaded", function (event) {



  scrollContainer.addEventListener('mouseenter', function () {
    isPaused = true;
  })

  scrollContainer.addEventListener('mouseleave', function () {
    isPaused = false;
  })
});


let isPaused = false;
const scrollContainer = document.querySelector('.js-h-scroll-animation');


const MOVE_SIZE = 10;
const MOVE_PER = 1;
const WAIT_TIME = 0;



const SCROLL_LENGHT = scrollContainer.scrollWidth - scrollContainer.clientWidth;
const PADDING_MOVE = MOVE_SIZE * MOVE_PER;

console.log(SCROLL_LENGHT);
if (SCROLL_LENGHT > 1000)
  setInterval(moveScroll, WAIT_TIME);



// move scroll horizontaly to display new gifts
function moveScroll() {

  if (isPaused) return;


  let currentScrollPosition = scrollContainer.scrollLeft;
  let newPos = currentScrollPosition + PADDING_MOVE;

  if (newPos > SCROLL_LENGHT) {
    newPos = 0;
  }

  scrollContainer.scrollLeft = newPos;
}



