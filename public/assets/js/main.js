/**
 * Template Name: BizLand
 * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
 * Updated: Dec 05 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

(function () {
    "use strict";

    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    function toggleScrolled() {
        const selectBody = document.querySelector("body");
        const selectHeader = document.querySelector("#header");
        if (
            !selectHeader.classList.contains("scroll-up-sticky") &&
            !selectHeader.classList.contains("sticky-top") &&
            !selectHeader.classList.contains("fixed-top")
        )
            return;
        window.scrollY > 100
            ? selectBody.classList.add("scrolled")
            : selectBody.classList.remove("scrolled");
    }

    document.addEventListener("scroll", toggleScrolled);
    window.addEventListener("load", toggleScrolled);

    /**
     * Mobile nav toggle
     */
    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");

    function mobileNavToogle() {
        document.querySelector("body").classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
    }
    if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener("click", mobileNavToogle);
    }

    /**
     * Hide mobile nav on same-page/hash links
     */
    document.querySelectorAll("#navmenu a").forEach((navmenu) => {
        navmenu.addEventListener("click", () => {
            if (document.querySelector(".mobile-nav-active")) {
                mobileNavToogle();
            }
        });
    });

    /**
     * Toggle mobile nav dropdowns
     */
    document
        .querySelectorAll(".navmenu .toggle-dropdown")
        .forEach((navmenu) => {
            navmenu.addEventListener("click", function (e) {
                e.preventDefault();
                this.parentNode.classList.toggle("active");
                this.parentNode.nextElementSibling.classList.toggle(
                    "dropdown-active"
                );
                e.stopImmediatePropagation();
            });
        });

    /**
     * Preloader
     */
    const preloader = document.querySelector("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }

    /**
     * Scroll top button
     */
    let scrollTop = document.querySelector(".scroll-top");

    function toggleScrollTop() {
        if (scrollTop) {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        }
    }
    scrollTop.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    window.addEventListener("load", toggleScrollTop);
    document.addEventListener("scroll", toggleScrollTop);

    /**
     * Animation on scroll function and init
     */
    function aosInit() {
        AOS.init({
            duration: 600,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    }
    window.addEventListener("load", aosInit);

    /**
     * Initiate glightbox
     */
    const glightbox = GLightbox({
        selector: ".glightbox",
    });

    /**
     * Animate the skills items on reveal
     */
    let skillsAnimation = document.querySelectorAll(".skills-animation");
    skillsAnimation.forEach((item) => {
        new Waypoint({
            element: item,
            offset: "80%",
            handler: function (direction) {
                let progress = item.querySelectorAll(".progress .progress-bar");
                progress.forEach((el) => {
                    el.style.width = el.getAttribute("aria-valuenow") + "%";
                });
            },
        });
    });

    /**
     * Initiate Pure Counter
     */
    new PureCounter();

    /**
     * Init swiper sliders
     */
    function initSwiper() {
        document
            .querySelectorAll(".init-swiper")
            .forEach(function (swiperElement) {
                let config = JSON.parse(
                    swiperElement
                        .querySelector(".swiper-config")
                        .innerHTML.trim()
                );

                if (swiperElement.classList.contains("swiper-tab")) {
                    initSwiperWithCustomPagination(swiperElement, config);
                } else {
                    new Swiper(swiperElement, config);
                }
            });
    }

    window.addEventListener("load", initSwiper);

    /**
     * Init isotope layout and filters
     */
    document
        .querySelectorAll(".isotope-layout")
        .forEach(function (isotopeItem) {
            let layout = isotopeItem.getAttribute("data-layout") ?? "masonry";
            let filter = isotopeItem.getAttribute("data-default-filter") ?? "*";
            let sort =
                isotopeItem.getAttribute("data-sort") ?? "original-order";

            let initIsotope;
            imagesLoaded(
                isotopeItem.querySelector(".isotope-container"),
                function () {
                    initIsotope = new Isotope(
                        isotopeItem.querySelector(".isotope-container"),
                        {
                            itemSelector: ".isotope-item",
                            layoutMode: layout,
                            filter: filter,
                            sortBy: sort,
                        }
                    );
                }
            );

            isotopeItem
                .querySelectorAll(".isotope-filters li")
                .forEach(function (filters) {
                    filters.addEventListener(
                        "click",
                        function () {
                            isotopeItem
                                .querySelector(
                                    ".isotope-filters .filter-active"
                                )
                                .classList.remove("filter-active");
                            this.classList.add("filter-active");
                            initIsotope.arrange({
                                filter: this.getAttribute("data-filter"),
                            });
                            if (typeof aosInit === "function") {
                                aosInit();
                            }
                        },
                        false
                    );
                });
        });

    /**
     * Frequently Asked Questions Toggle
     */
    document
        .querySelectorAll(".faq-item h3, .faq-item .faq-toggle")
        .forEach((faqItem) => {
            faqItem.addEventListener("click", () => {
                faqItem.parentNode.classList.toggle("faq-active");
            });
        });

    /**
     * Correct scrolling position upon page load for URLs containing hash links.
     */
    window.addEventListener("load", function (e) {
        if (window.location.hash) {
            if (document.querySelector(window.location.hash)) {
                setTimeout(() => {
                    let section = document.querySelector(window.location.hash);
                    let scrollMarginTop =
                        getComputedStyle(section).scrollMarginTop;
                    window.scrollTo({
                        top: section.offsetTop - parseInt(scrollMarginTop),
                        behavior: "smooth",
                    });
                }, 100);
            }
        }
    });

    /**
     * Navmenu Scrollspy
     */
    let navmenulinks = document.querySelectorAll(".navmenu a");

    function navmenuScrollspy() {
        navmenulinks.forEach((navmenulink) => {
            if (!navmenulink.hash) return;
            let section = document.querySelector(navmenulink.hash);
            if (!section) return;
            let position = window.scrollY + 200;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                document
                    .querySelectorAll(".navmenu a.active")
                    .forEach((link) => link.classList.remove("active"));
                navmenulink.classList.add("active");
            } else {
                navmenulink.classList.remove("active");
            }
        });
    }
    window.addEventListener("load", navmenuScrollspy);
    document.addEventListener("scroll", navmenuScrollspy);
})();

document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("sgContactForm");
    const successMessage = document.getElementById("sgSuccessMessage");

    // Form submission
    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Simple validation
        const name = document.getElementById("sgName").value;
        const email = document.getElementById("sgEmail").value;
        const message = document.getElementById("sgMessage").value;

        if (name && email && message) {
            // Show success message
            successMessage.classList.add("show");

            // Reset form
            contactForm.reset();

            // Hide message after 4 seconds
            setTimeout(() => {
                successMessage.classList.remove("show");
            }, 4000);
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    class EnhancedHeroBanner {
        constructor() {
            this.slider = document.getElementById("heroSlider");
            this.container = document.getElementById("heroContainer");
            this.prevBtn = document.getElementById("prevBtn");
            this.nextBtn = document.getElementById("nextBtn");
            this.indicators = document.querySelectorAll(".indicator");
            this.progressBar = document.getElementById("progressBar");

            this.currentSlide = 0;
            this.totalSlides =
                this.slider.querySelectorAll(".hero-slide").length;
            this.autoSlideInterval = null;
            this.autoSlideDelay = 6000;
            this.progressInterval = null;
            this.progressValue = 0;
            this.isDragging = false;
            this.startX = 0;
            this.currentX = 0;
            this.threshold = 80;
            this.isAnimating = false;
            this.isHovered = false;

            this.init();
        }

        init() {
            this.setupEventListeners();
            this.updateSlide();
            this.preloadImages();

            setTimeout(() => {
                this.startAutoSlide();
            }, 2000);
        }

        preloadImages() {
            const slides = this.container.querySelectorAll(".hero-slide");
            slides.forEach((slide) => {
                const bgImage = slide.style.backgroundImage;
                if (bgImage) {
                    const imageUrl = bgImage.slice(5, -2);
                    const img = new Image();
                    img.src = imageUrl;
                }
            });
        }

        setupEventListeners() {
            this.prevBtn.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.prevSlide();
            });

            this.nextBtn.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.nextSlide();
            });

            this.indicators.forEach((indicator, index) => {
                indicator.addEventListener("click", (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    this.goToSlide(index);
                });
            });

            this.container.addEventListener("mousedown", (e) => {
                e.stopPropagation();
                this.startDrag(e);
            });
            this.container.addEventListener("mousemove", (e) => {
                e.stopPropagation();
                this.drag(e);
            });
            this.container.addEventListener("mouseup", (e) => {
                e.stopPropagation();
                this.endDrag();
            });
            this.container.addEventListener("mouseleave", (e) => {
                e.stopPropagation();
                this.endDrag();
            });

            this.container.addEventListener(
                "touchstart",
                (e) => {
                    e.stopPropagation();
                    this.startDrag(e);
                },
                {
                    passive: false,
                }
            );
            this.container.addEventListener(
                "touchmove",
                (e) => {
                    e.stopPropagation();
                    this.drag(e);
                },
                {
                    passive: false,
                }
            );
            this.container.addEventListener("touchend", (e) => {
                e.stopPropagation();
                this.endDrag();
            });

            this.container.addEventListener("mouseenter", () => {
                this.isHovered = true;
                this.pauseAutoSlide();
            });

            this.container.addEventListener("mouseleave", () => {
                this.isHovered = false;
                this.resumeAutoSlide();
            });

            this.container.addEventListener("keydown", (e) => {
                if (e.key === "ArrowLeft" || e.key === "ArrowUp") {
                    e.preventDefault();
                    e.stopPropagation();
                    this.prevSlide();
                }
                if (e.key === "ArrowRight" || e.key === "ArrowDown") {
                    e.preventDefault();
                    e.stopPropagation();
                    this.nextSlide();
                }
                if (e.key === "Home") {
                    e.preventDefault();
                    e.stopPropagation();
                    this.goToSlide(0);
                }
                if (e.key === "End") {
                    e.preventDefault();
                    e.stopPropagation();
                    this.goToSlide(this.totalSlides - 1);
                }
            });

            document.addEventListener("visibilitychange", () => {
                if (document.hidden) {
                    this.pauseAutoSlide();
                } else if (!this.isHovered) {
                    this.resumeAutoSlide();
                }
            });

            window.addEventListener("focus", () => {
                if (!this.isHovered) this.resumeAutoSlide();
            });

            window.addEventListener("blur", () => {
                this.pauseAutoSlide();
            });
        }

        startDrag(e) {
            if (this.isAnimating) return;

            this.isDragging = true;
            this.startX = e.type.includes("mouse")
                ? e.clientX
                : e.touches[0].clientX;
            this.currentX = this.startX;
            this.container.style.cursor = "grabbing";
            this.pauseAutoSlide();

            if (e.type.includes("touch")) {
                e.preventDefault();
            }
        }

        drag(e) {
            if (!this.isDragging || this.isAnimating) return;

            this.currentX = e.type.includes("mouse")
                ? e.clientX
                : e.touches[0].clientX;

            if (e.type.includes("touch")) {
                e.preventDefault();
            }
        }

        endDrag() {
            if (!this.isDragging) return;

            this.isDragging = false;
            this.container.style.cursor = "grab";

            const deltaX = this.currentX - this.startX;

            if (Math.abs(deltaX) > this.threshold) {
                if (deltaX > 0) {
                    this.prevSlide();
                } else {
                    this.nextSlide();
                }
            }

            setTimeout(() => {
                if (!this.isHovered) this.resumeAutoSlide();
            }, 500);
        }

        updateSlide() {
            if (this.isAnimating) return;

            this.isAnimating = true;
            const translateX = -this.currentSlide * 20;
            this.slider.style.transform = `translateX(${translateX}%)`;
            this.updateIndicators();

            setTimeout(() => {
                this.isAnimating = false;
            }, 800);
        }

        updateIndicators() {
            this.indicators.forEach((indicator, index) => {
                indicator.classList.toggle(
                    "active",
                    index === this.currentSlide
                );
            });
        }

        nextSlide() {
            if (this.isAnimating) return;

            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            this.updateSlide();
            this.resetProgress();
        }

        prevSlide() {
            if (this.isAnimating) return;

            this.currentSlide =
                this.currentSlide === 0
                    ? this.totalSlides - 1
                    : this.currentSlide - 1;
            this.updateSlide();
            this.resetProgress();
        }

        goToSlide(index) {
            if (this.isAnimating || index === this.currentSlide) return;

            this.currentSlide = index;
            this.updateSlide();
            this.resetProgress();
        }

        startAutoSlide() {
            this.clearAutoSlide();
            this.autoSlideInterval = setInterval(() => {
                if (
                    !this.isDragging &&
                    !this.isAnimating &&
                    !document.hidden &&
                    !this.isHovered
                ) {
                    this.nextSlide();
                }
            }, this.autoSlideDelay);
            this.startProgress();
        }

        pauseAutoSlide() {
            this.clearAutoSlide();
            this.pauseProgress();
        }

        resumeAutoSlide() {
            if (!this.isDragging && !document.hidden && !this.isHovered) {
                setTimeout(() => {
                    this.startAutoSlide();
                }, 300);
            }
        }

        clearAutoSlide() {
            if (this.autoSlideInterval) {
                clearInterval(this.autoSlideInterval);
                this.autoSlideInterval = null;
            }
        }

        startProgress() {
            this.progressValue = 0;
            this.pauseProgress();

            this.progressInterval = setInterval(() => {
                if (!this.isDragging && !document.hidden && !this.isHovered) {
                    this.progressValue += 100 / (this.autoSlideDelay / 50);
                    if (this.progressValue >= 100) {
                        this.progressValue = 100;
                    }
                    this.progressBar.style.width = this.progressValue + "%";
                }
            }, 50);
        }

        pauseProgress() {
            if (this.progressInterval) {
                clearInterval(this.progressInterval);
                this.progressInterval = null;
            }
        }

        resetProgress() {
            this.progressValue = 0;
            this.progressBar.style.width = "0%";
            this.pauseProgress();

            setTimeout(() => {
                if (this.autoSlideInterval) {
                    this.startProgress();
                }
            }, 200);
        }
    }

    if (document.getElementById("heroContainer")) {
        new EnhancedHeroBanner();
    }
});
