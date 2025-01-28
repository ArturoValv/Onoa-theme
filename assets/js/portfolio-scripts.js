//Portfolio
const portfolioCategories = document.querySelectorAll(
  ".page-template-template-portfolio .portfolio__categories .category"
);
const projects = document.querySelectorAll(
  ".page-template-template-portfolio .project"
);
const galleryBtns = document.querySelectorAll(
  ".page-template-template-portfolio .open-gallery"
);
const galleryOverlay = document.querySelector("#gallery-slideshow");

document.addEventListener("DOMContentLoaded", () => {
  //Portfolio
  if (portfolioCategories) {
    portfolioCategories.forEach((category) => {
      category.addEventListener("click", (e) => filterCategories(e, category));
    });
  }

  if (galleryBtns) {
    galleryBtns.forEach((element) => {
      element.addEventListener("click", (e) => showGallery(e));
    });
  }

  document.body.addEventListener("click", (e) => {
    if (
      e.target.classList.contains("gallery-overlay-close") ||
      e.target.parentElement.classList.contains("gallery-overlay-close")
    ) {
      closeGallery();
    }
  });
});

//Portfolio
function filterCategories(e, category) {
  let catSelected = category.getAttribute("data-cat");

  portfolioCategories.forEach((element) => {
    element.classList.remove("selected");
  });
  category.classList.add("selected");

  projects.forEach((project) => {
    project.classList.remove("visible");

    if (catSelected == "0") {
      project.style.display = "flex";
      setTimeout(() => {
        project.classList.add("visible");
      }, 400);
    } else {
      let catsStr = project.getAttribute("data-cat");
      let catArray = catsStr.split("-");

      if (catArray.includes(catSelected)) {
        project.style.display = "flex";
        setTimeout(() => {
          project.classList.add("visible");
        }, 300);
      }
    }
  });

  setTimeout(() => {
    document
      .querySelectorAll(
        ".page-template-template-portfolio .project:not(.visible)"
      )
      .forEach((element) => {
        element.style.display = "none";
      });
  }, 400);
}

//Show Projects Gallery
function showGallery(e) {
  e.preventDefault();

  let photosIDs = e.currentTarget.getAttribute("data-photosids").split("-");
  let currentOverlay = document.querySelector("#gallery-overlay");
  let currentIDs = currentOverlay
    ? currentOverlay.getAttribute("data-ids")
    : "";

  if (currentIDs !== e.currentTarget.getAttribute("data-photosids")) {
    currentOverlay && currentOverlay.remove();

    let overlay = galleryOverlay.content.cloneNode(true);
    bodyWrapper.appendChild(overlay);
    document
      .querySelector("#gallery-overlay")
      .setAttribute("data-ids", e.currentTarget.getAttribute("data-photosids"));

    photosIDs.forEach(async function (element, i = 0) {
      let photo = await fetchWPAPI(element);

      let photoSlide = document.createElement("IMG");
      photoSlide.setAttribute("id", "photo-slide-" + i);
      photoSlide.setAttribute("src", photo.guid.rendered);
      photoSlide.setAttribute("style", "opacity: 0");

      document
        .querySelector("#gallery-overlay .gallery-slide__inner")
        .appendChild(photoSlide);

      let photoSelector = document.createElement("A");
      photoSelector.setAttribute("href", "#photo-slide-" + i);
      let photoSelectorIMG = document.createElement("IMG");
      photoSelectorIMG.setAttribute(
        "src",
        photo.media_details.sizes.thumbnail.source_url
      );
      photoSelector.setAttribute("style", "opacity: 0");
      photoSelector.appendChild(photoSelectorIMG);

      document
        .querySelector("#gallery-overlay .gallery-selector__inner")
        .appendChild(photoSelector);

      i++;

      stylingEvent(i, photosIDs.length);
    });
  } else {
    currentOverlay.style.display = "flex";
  }
}

async function fetchWPAPI(element) {
  let response = await fetch(
    document.location.origin + "/wp-json/wp/v2/media/" + element
  );
  let photo = await response.json();

  return photo;
}

function stylingEvent(index, slidesCount) {
  let scrollElement = document.querySelector(
    "#gallery-overlay .gallery-slide__inner"
  );

  if (slidesCount % 2 !== 0) {
    scrollElement.scrollTop =
      (scrollElement.scrollHeight - scrollElement.clientHeight) / 2;
  } else {
    let scrollLength =
      ((slidesCount / 2) - 1) * ((scrollElement.clientHeight * 0.8) + 37.5);
    scrollElement.scrollTop = scrollLength;
  }

  if (slidesCount === index) {
    setTimeout(() => {
      document.querySelector("#gallery-overlay .spinner").style.display =
        "none";
      let slidesLoaded = document.querySelectorAll(
        "#gallery-overlay .gallery-slide__inner img"
      );
      let selectorsLoaded = document.querySelectorAll(
        "#gallery-overlay .gallery-selector__inner a"
      );
      slidesLoaded.forEach(function (element, i = 0) {
        element.style.opacity = "1";
        selectorsLoaded[i].style.opacity = "1";
        i++;
      });
    }, 500);
  } else {
    document.querySelector("#gallery-overlay .spinner").style.display = "block";
  }
}

function closeGallery() {
  document.querySelector("#gallery-overlay").style.display = "none";
}
