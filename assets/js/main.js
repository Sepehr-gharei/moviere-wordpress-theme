
jQuery(document).ready(function () {

  jQuery(".reply").on("click", function (e) {
    let el = jQuery(this);
    let commentID = el.data("comment-id");
    jQuery("#comment_parent").val(commentID);
  });
});



let items = document.querySelectorAll('.header-slider .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let thumbnails = document.querySelectorAll('.thumbnail .item');

// config param
let countItem = items.length;
let itemActive = 0;
// event next click
next.onclick = function(){
    itemActive = itemActive + 1;
    if(itemActive >= countItem){
        itemActive = 0;
    }
    showSlider();
}
//event prev click
prev.onclick = function(){
    itemActive = itemActive - 1;
    if(itemActive < 0){
        itemActive = countItem - 1;
    }
    showSlider();
}
// auto run slider
let refreshInterval = setInterval(() => {
    next.click();
}, 5000000000)
function showSlider(){
    // remove item active old
    let itemActiveOld = document.querySelector('.header-slider .list .item.active');
    let thumbnailActiveOld = document.querySelector('.thumbnail .item.active');
    itemActiveOld.classList.remove('active');
    thumbnailActiveOld.classList.remove('active');

    // active new item
    items[itemActive].classList.add('active');
    thumbnails[itemActive].classList.add('active');
    setPositionThumbnail();

    // clear auto time run slider
    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => {
        next.click();
    }, 5000000000)
}
function setPositionThumbnail () {
    let thumbnailActive = document.querySelector('.thumbnail .item.active');
    let rect = thumbnailActive.getBoundingClientRect();
    if (rect.left < 0 || rect.right > window.innerWidth) {
        thumbnailActive.scrollIntoView({ behavior: 'smooth', inline: 'nearest' });
    }
}

// click thumbnail
thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => {
        itemActive = index;
        showSlider();
    })
})
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".dropdown-menu").forEach(function (element) {
      element.addEventListener("click", function (e) {
        e.stopPropagation();
      });
    });

    if (window.innerWidth < 992) {
      document
        .querySelectorAll(".dropdown-menu a")
        .forEach(function (element) {
          element.addEventListener("click", function (e) {
            let nextEl = this.nextElementSibling;
            if (nextEl && nextEl.classList.contains("submenu")) {
              e.preventDefault();
              if (nextEl.style.display == "block") {
                nextEl.style.display = "none";
              } else {
                nextEl.style.display = "block";
              }
            }
          });
        });
    }
  });


document.getElementById('header-navbar-buttom').addEventListener('click', function() {
  var element = document.getElementById('arrows');
  element.classList.remove('z-index-100'); // حذف کلاس highlight
});

document.getElementById('header-navbar-btn-close').addEventListener('click', function() {
  var element = document.getElementById('arrows');
  
  // تأخیر 1 ثانیه (1000 میلی‌ثانیه)
  setTimeout(function() {
      element.classList.add('z-index-100'); // اضافه کردن کلاس highlight
  }, 300);
});

document.getElementsByClassName('modal-backdrop').addEventListener('click', function() {
  var element = document.getElementById('arrows');
  
  // تأخیر 1 ثانیه (1000 میلی‌ثانیه)
  setTimeout(function() {
      element.classList.add('z-index-100'); // اضافه کردن کلاس highlight
  }, 300);
});

function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
