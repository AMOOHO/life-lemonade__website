/* **********************************************************************************************************************
 * SPLIDE-CONFIG.JS
 *
 * Initializes and configures all Splide.js sliders on the site.
 * Features:
 *   - Default gallery sliders with custom arrow controls
 *   - Quote sliders
 *   - Lightbox-enabled sliders with synchronized main/lightbox instances
 *   - Responsive breakpoints and gaps
 *   - GSAP animations for lightbox open/close and optional arrow hover effects
 *   - Integration with Lenis smooth scrolling (pause/resume on lightbox)
 *
 * Dependencies:
 *   - Splide.js
 *   - GSAP
 *   - Lenis (for smooth scroll integration)
 *
 * Copyright (c) 2025 OHO Design GmbH. All rights reserved.
 * Unauthorized copying, distribution, or use of this file is strictly prohibited.
 *
 * Author: OHO Design GmbH
 * Date: 2025-01-01
 **********************************************************************************************************************/

const splideSliders = document.querySelectorAll(".splide");
splideSliders.forEach((splideSlider) => {
  /* ***** Component Gallery Slider */

  if (splideSlider.classList.contains("splide-default")) {
    // const arrowLeft = splideSlider.querySelector(".icon-base_arrow-prev");
    // const arrowRight = splideSlider.querySelector(".icon-base_arrow-next");

    // const arrowLeftTL = gsap
    //   .timeline({
    //     paused: true,
    //   })
    //   .to(arrowLeft, {
    //     x: -8,
    //     duration: 0.4,
    //     ease: "power4.inOut",
    //   })
    //   .to(
    //     arrowLeft,
    //     {
    //       x: 0,
    //       duration: 0.35,
    //       ease: "power4.out",
    //     },
    //     ">"
    //   );

    // const arrowRightTL = gsap
    //   .timeline({
    //     paused: true,
    //   })
    //   .to(arrowRight, {
    //     x: 8,
    //     duration: 0.4,
    //     ease: "power4.inOut",
    //   })
    //   .to(
    //     arrowRight,
    //     {
    //       x: 0,
    //       duration: 0.35,
    //       ease: "power4.out",
    //     },
    //     ">"
    //   );

    const splideMain = new Splide(splideSlider, {
      type: "loop", // Unendlicher Loop
      pauseOnHover: true, // Animation pausieren, wenn die Maus drüber ist
      focus: "center", // Fokus auf das mittlere Element setzen
      gap: 30, // Abstand zwischen den Slides
      speed: 1500, // Geschwindigkeit der Animation
      easeing: "ease-in-out",
      pagination: false, // Pagination deaktivieren
      arrows: false, // Pfeile deaktivieren
      breakpoints: {
        576: {
          gap: 8,
        },
      },
    });

    splideSlider.querySelector(".prev-slide").addEventListener("click", () => {
      splideMain.go("<");
    });

    splideSlider.querySelector(".next-slide").addEventListener("click", () => {
      splideMain.go(">");
    });

    // splideSlider.querySelector(".prev-slide").addEventListener("mouseenter", () => {
    //   arrowLeftTL.restart();
    // });

    // splideSlider.querySelector(".next-slide").addEventListener("mouseenter", () => {
    //   arrowRightTL.restart();
    // });

    if (splideSlider.nextElementSibling.classList.contains("lightbox__splide")) {
      const lightboxWrap = splideSlider.nextElementSibling;
      const splideSliderLightbox = lightboxWrap.querySelector(".splide--default-lightbox");
      const close = lightboxWrap.querySelector(".lightbox__close");
      const bg = lightboxWrap.querySelector(".lightbox__bg");
      const splideLightbox = new Splide(splideSliderLightbox, {
        type: "loop", // Unendlicher Loop
        // autoplay: true, // Automatisches Abspielen
        // interval: 5000, // Zeit pro Slide in ms
        pauseOnHover: true, // Animation pausieren, wenn die Maus drüber ist
        focus: "center", // Fokus auf das mittlere Element setzen
        gap: 25, // Abstand zwischen den Slides
        speed: 1500, // Geschwindigkeit der Animation
        easeing: "ease-in-out",
        pagination: false, // Pagination deaktivieren
        arrows: false, // Pfeile deaktivieren
        breakpoints: {
          576: {
            gap: 8,
          },
        },
      });

      splideSliderLightbox.querySelector(".prev-slide").addEventListener("click", () => {
        splideLightbox.go("<");
      });

      splideSliderLightbox.querySelector(".next-slide").addEventListener("click", () => {
        splideLightbox.go(">");
      });

      splideMain.sync(splideLightbox);
      splideMain.mount();
      splideLightbox.mount();

      const openLightbox = () => {
        // console.log("open lightbox");
        lenis.stop();
        gsap.to(splideSliderLightbox, { visibility: "visible" });
        gsap.to(splideSliderLightbox, { pointerEvents: "all" });
        gsap.to(lightboxWrap, { visibility: "visible" });
        gsap.to(lightboxWrap, { pointerEvents: "all" });

        /* --- Close ScrollNavigation on Lightbox Open */
        desktopScrollNavTL.reverse();
        mobileScrollNavTL.play();
      };

      const closeLightbox = () => {
        // console.log("close lightbox");
        lenis.start();
        gsap.to(splideSliderLightbox, { visibility: "hidden" });
        gsap.to(splideSliderLightbox, { pointerEvents: "none" });
        gsap.to(lightboxWrap, { visibility: "hidden" });
        gsap.to(lightboxWrap, { pointerEvents: "none" });
      };

      // Lightbox Triggers
      splideSlider.querySelector(".splide__track").addEventListener("click", (event) => {
        openLightbox();
      });
      close.addEventListener("click", () => {
        closeLightbox();
      });
      bg.addEventListener("click", () => {
        closeLightbox();
      });
      document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
          closeLightbox();
        }
      });
    } else {
      splideMain.mount();
    }
  }

  if (splideSlider.classList.contains("splide-quote")) {
    const splideQuote = new Splide(splideSlider, {
      type: "loop", // Unendlicher Loop
      pauseOnHover: true, // Animation pausieren, wenn die Maus drüber ist
      focus: "center", // Fokus auf das mittlere Element setzen
      gap: 30, // Abstand zwischen den Slides
      speed: 1500, // Geschwindigkeit der Animation
      easeing: "ease-in-out",
      pagination: false, // Pagination deaktivieren
      arrows: false, // Pfeile deaktivieren
      breakpoints: {
        576: {
          gap: 8,
        },
      },
    }).mount();

    splideSlider.querySelector(".prev-slide").addEventListener("click", () => {
      splideQuote.go("<");
    });

    splideSlider.querySelector(".next-slide").addEventListener("click", () => {
      splideQuote.go(">");
    });
  }

  /* ***** Other Splide Sliders */
});
