const offcanvas = document.getElementById("offcanvasScrolling");
const bsOffcanvas = new bootstrap.Offcanvas(offcanvas);
const devices = window.matchMedia("(max-width: 767px)").matches ? 'mobile' : 'desktop';

$(document).ready(function () {
  devices == 'mobile' ? bsOffcanvas.hide() : bsOffcanvas.show();
});

let navbarShow = false;
$('.navbar-toggler').click(function () {
  navbarShow == false ? bsOffcanvas.show() : bsOffcanvas.hide();
  if (navbarShow == true) { navbarShow = false } else { navbarShow = true }
});