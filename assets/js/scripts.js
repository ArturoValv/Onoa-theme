//Header
const siteHeader = document.querySelector(".site-header");
const mobileBtn = document.querySelector("#menu-mobile");
const menu = document.querySelector(".main-menu .menu");
const menuItems = document.querySelectorAll(".main-menu .menu>.menu-item");
const parentMenuItems = document.querySelectorAll(
  ".main-menu .menu-item-has-children"
);
const coverInner= document.querySelector(".cover-inner");
const coverBgInner = document.querySelector(
  "body:not(.home) .cover-inner .cover-inner__bg"
);

document.addEventListener("DOMContentLoaded", () => {
  eventListeners();
  numerateMenuItems();
});

function eventListeners() {
  //Header
  mobileBtn.addEventListener("click", showMenu);
  parentMenuItems.forEach((item) => {
    item.addEventListener("click", (e) => {
      if (e.target === item) {
        showSubmenu(e);
      }
    });
  });

  window.addEventListener("scroll", fadeInHeader);

  //Cover
  coverBgInner && initAnimation();
}

//Header
function numerateMenuItems() {
  menu.setAttribute("style", `--length: ${menuItems.length}`);
  menuItems.forEach((item, index) => {
    item
      .querySelector("a:first-child")
      .setAttribute("style", `--index: ${index}`);
  });
}

function showMenu() {
  mobileBtn.classList.toggle("active");
  siteHeader.classList.toggle("active");
}

function showSubmenu(e) {
  let currentItem = e.currentTarget;
  currentItem.children[1].classList.add("open");
  backBtn.style.display = "flex";
}

function hideSubMenu() {
  let allItems = document.querySelectorAll(".main-menu .sub-menu.open");
  let allItemsLength = allItems.length;

  if (allItemsLength > 0) {
    allItems[allItemsLength - 1].classList.remove("open");
  }
  if (allItemsLength == 1) {
    backBtn.style.display = "none";
  }
}

function fadeInHeader() {
  if (window.scrollY > 0) {
    siteHeader.classList.add("scrolling");
  } else {
    siteHeader.classList.remove("scrolling");
  }
}

//Cover
function initAnimation() {
  let bgColor = coverBgInner.getAttribute("data-style");
  setTimeout(() => {
    coverBgInner.querySelector("img, video").style.opacity =
      coverBgInner.classList.contains("overlay-applied") ? ".7" : "1";
    coverBgInner.style.backgroundColor = bgColor;
    coverBgInner.style.opacity = "1";
  }, 600);
}
