  Galleria.loadTheme('/libraries/javascript/galleria/themes/classic/galleria.classic.js');
  
  Galleria.configure({
    imageCrop: 'width',
    thumbCrop: false,
    transition: 'fade',
    transitionSpeed: 950,
    // transition: "slide",
    // transitionSpeed: 375
    imagePan: true,
    lightbox: true,
    lightboxFadeSpeed: 200,
    lightboxTransitionSpeed: 400,
    // carousel: true,
    // carouselSpeed: 1200,
    responsive: true,
    swipe: true,
    _toggleInfo: false,
    autoplay: 2250,
    height: 566,
    showCounter: false
    });

  Galleria.run('#galleria');