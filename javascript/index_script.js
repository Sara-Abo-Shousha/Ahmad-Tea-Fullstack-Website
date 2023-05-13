
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
mybutton = document.getElementById("alwayson");
  if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
mybutton = document.getElementById("alwayson");
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0; 
}