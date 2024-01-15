
document.addEventListener("DOMContentLoaded", function (event) {

  const treeContainer = document.querySelector('.js-light-chrismas-tree')

  const INTERVAL = 600;
  const FILES = ['http://localhost/public/assets/images/sapin_1.png', 'http://localhost/public/assets/images/sapin_2.png'];

  var currentFile = 0;


  // swith image for 'animate' chrismas tree
  setInterval(() => {
    treeContainer.src = FILES[currentFile];

    currentFile++;

    if (currentFile == FILES.length) {
      currentFile = 0;
    }


  }, INTERVAL);
});






