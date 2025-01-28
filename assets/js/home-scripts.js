//Slideshow
const cover = document.querySelector(".cover");
const coverTitle = document.querySelector(".cover .title");
const coverBg = document.querySelector(".cover .cover__bg");

document.addEventListener("DOMContentLoaded", () => {
  initAnimation();
});

function initAnimation() {
  let index = 0;
  let bgColor = coverBg.getAttribute("data-style");

  if (cover.classList.contains("autoplay")) {
    setInterval(() => {
      index = index < wordsCover.length ? ++index : 0;
      coverTitle.innerText = wordsCover[index];
    }, 500);
  } else {
    
    window.addEventListener("scrollend", () => {
      index = index < wordsCover.length ? ++index : 0;
     
      let increment = 0.085;
      let opacity = 0;

      let instance1 = setInterval(function () {
        opacity = opacity + increment;
        coverTitle.innerText = wordsCover[index];
        coverTitle.style.opacity = opacity;
        if (opacity > 1) {
          clearInterval(instance1);
        }
      }, 100);
    });
    
  }

  setTimeout(() => {
    coverBg.querySelector("img, video").style.opacity =
      coverBg.classList.contains("overlay-applied") ? ".7" : "1";
    coverBg.style.backgroundColor = bgColor;
    coverBg.style.opacity = "1";
  }, 600);
}
