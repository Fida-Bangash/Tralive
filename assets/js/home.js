document.querySelectorAll(".accordion-header").forEach(header => {
  header.addEventListener("click", () => {
    const item = header.parentElement;
    const body = item.querySelector(".accordion-body");
    const symbol = header.querySelector(".symbol");

    if (item.classList.contains("active")) {
    
      body.style.maxHeight = null;
      item.classList.remove("active");
      symbol.textContent = "+";
    } else {
      
      document.querySelectorAll(".accordion-item").forEach(i => {
        i.classList.remove("active");
        i.querySelector(".accordion-body").style.maxHeight = null;
        i.querySelector(".symbol").textContent = "+";
      });

    
      item.classList.add("active");
      body.style.maxHeight = body.scrollHeight + "px"; 
      symbol.textContent = "-";
    }
  });
});

// swiper slider open
document.addEventListener("DOMContentLoaded", function () {
  const carousel = document.querySelector("#eventCarousel");
  const carouselInner = carousel.querySelector(".carousel-inner");

  let bsCarousel = new bootstrap.Carousel(carousel, {
    interval: false, 
    wrap: true       
  });

  let startX = 0;
  let isDragging = false;


  carouselInner.addEventListener("mousedown", (e) => {
    isDragging = true;
    startX = e.pageX;
  });

  document.addEventListener("mouseup", (e) => {
    if (!isDragging) return;
    isDragging = false;

    let endX = e.pageX;
    if (startX - endX > 50) {
      bsCarousel.next(); 
    } else if (endX - startX > 50) {
      bsCarousel.prev(); 
    }
  });

  
  let touchStartX = 0;
  carouselInner.addEventListener("touchstart", (e) => {
    touchStartX = e.touches[0].clientX;
  });

  carouselInner.addEventListener("touchend", (e) => {
    let touchEndX = e.changedTouches[0].clientX;
    if (touchStartX - touchEndX > 50) {
      bsCarousel.next();
    } else if (touchEndX - touchStartX > 50) {
      bsCarousel.prev();
    }
  });
});
// swiper slider close


//  back to top open
const backToTop = document.getElementById("backToTop");

window.addEventListener("scroll", () => {
  if (window.scrollY > 200) {
    backToTop.style.display = "flex";
  } else {
    backToTop.style.display = "none";
  }
});

backToTop.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

//  back to top close 
