//Header
const siteHeader = document.querySelector(".site-header");
const mobileBtn = document.querySelector("#menu-mobile");
const menu = document.querySelector(".main-menu .menu");
const menuItems = document.querySelectorAll(".main-menu .menu>.menu-item");
const parentMenuItems = document.querySelectorAll(
  ".main-menu .menu-item-has-children"
);
const coverInner = document.querySelector(".cover-inner");
const coverBgInner = document.querySelector(
  "body:not(.home) .cover-inner .cover-inner__bg"
);
const extractedBlocks = document.querySelectorAll(
  ".page-template-default .main-content .block"
);

const sectionBlocks = document.querySelectorAll("body .block");

document.addEventListener("DOMContentLoaded", () => {
  numerateMenuItems();
  extractedBlocks && extractBlocks();
  if (sectionBlocks) {
    initSections();
    isVisibleInViewport();
  }
  eventListeners();
});

window.addEventListener("load", () => {
  //Section Visibility
  window.addEventListener("scroll", isVisibleInViewport);
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

  if (document.querySelector(".site-header.sticky"))
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
    coverBgInner.classList.add("scrolling");
  } else {
    siteHeader.classList.remove("scrolling");
    coverBgInner.classList.remove("scrolling");
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

//Blocks
function extractBlocks() {
  extractedBlocks.forEach((item) => {
    if (item.classList.contains("extract-block")) {
      document
        .querySelector(".site-footer")
        .insertAdjacentHTML("beforebegin", item.outerHTML);
      item.remove();
    }
  });
}

//Sections
function initSections() {
  sectionBlocks.forEach((section) => {
    section.setAttribute("data-visibility", "hidden");
  });
}

//Check section visibility on viewport
function isVisibleInViewport() {
  sectionBlocks.forEach((section) => {
    let item = section.offsetTop;

    if (
      window.scrollY >=
      item - siteHeader.clientHeight - 300
      // &&
      //item.bottom <= (window.innerHeight || document.clientHeight)
      //&& item.left >= 0 &&
      //item.right <= (window.innerWidth || document.documentElement.clientWidth)
    ) {
      section.setAttribute("data-visibility", "visible");
    }
  });
}
