document.addEventListener("DOMContentLoaded", function () {

    /* ================= REVEAL ON SCROLL ================= */

    const revealElements = document.querySelectorAll(".reveal-on-scroll");

    if (revealElements.length) {
        const revealObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("is-visible");
                        entry.target.classList.add("revealed");
                    }
                });
            },
            {
                threshold: 0.18
            }
        );

        revealElements.forEach(function (element) {
            revealObserver.observe(element);
        });
    }

    /* ================= PRODUCT FILTER ================= */

    const productCards = document.querySelectorAll(".product-card");
    const filterButtons = document.querySelectorAll(".product-filter-btn");
    const filterTriggers = document.querySelectorAll(".product-filter-trigger");

    function filterProducts(category) {
        productCards.forEach(function (card) {
            const cardCategory = card.getAttribute("data-category");

            if (category === "all" || cardCategory === category) {
                card.classList.remove("is-hidden");
            } else {
                card.classList.add("is-hidden");
            }
        });

        filterButtons.forEach(function (button) {
            button.classList.toggle("active", button.getAttribute("data-filter") === category);
        });
    }

    filterButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const category = button.getAttribute("data-filter");
            filterProducts(category);
        });
    });

    filterTriggers.forEach(function (trigger) {
        trigger.addEventListener("click", function () {
            const category = trigger.getAttribute("data-filter") || "all";

            setTimeout(function () {
                filterProducts(category);
            }, 350);
        });
    });

    /* ================= PRODUCT CARD COLOR DOTS ================= */

    const productDots = document.querySelectorAll(".product-dot");

    productDots.forEach(function (dot) {
        dot.addEventListener("click", function () {
            const card = dot.closest(".product-card");

            if (!card) {
                return;
            }

            const image = card.querySelector(".product-card-image");
            const newImage = dot.getAttribute("data-image");

            if (image && newImage) {
                image.src = newImage;
            }

            card.querySelectorAll(".product-dot").forEach(function (item) {
                item.classList.remove("active");
            });

            dot.classList.add("active");
        });
    });

    /* ================= PRODUCT DETAILS VARIANTS ================= */

    const mainProductImage = document.getElementById("mainProductImage");
    const selectedVariantInput = document.getElementById("selectedVariantInput");
    const detailVariantButtons = document.querySelectorAll(".detail-variant-thumb, .detail-variant-dot");

    detailVariantButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const newImage = button.getAttribute("data-image");
            const selectedVariantId = button.getAttribute("data-variant-id");

            if (mainProductImage && newImage) {
                mainProductImage.src = newImage;
            }

            if (selectedVariantInput && selectedVariantId) {
                selectedVariantInput.value = selectedVariantId;
            }

            detailVariantButtons.forEach(function (item) {
                item.classList.remove("active");
            });

            detailVariantButtons.forEach(function (item) {
                if (item.getAttribute("data-variant-id") === selectedVariantId) {
                    item.classList.add("active");
                }
            });
        });
    });

    /* ================= QUANTITY CONTROL ================= */

    const quantityValue = document.getElementById("quantityValue");
    const selectedQuantityInput = document.getElementById("selectedQuantityInput");
    const quantityButtons = document.querySelectorAll(".quantity-btn");

    quantityButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            if (!quantityValue) {
                return;
            }

            let currentValue = parseInt(quantityValue.textContent, 10);
            const action = button.getAttribute("data-action");

            if (action === "plus") {
                currentValue++;
            }

            if (action === "minus" && currentValue > 1) {
                currentValue--;
            }

            quantityValue.textContent = currentValue;

            if (selectedQuantityInput) {
                selectedQuantityInput.value = currentValue;
            }
        });
    });

    /* ================= AUTH PAGE TRANSITION ================= */

    const authTransitionLinks = document.querySelectorAll(".auth-transition-link");

    authTransitionLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            const authContent = document.querySelector(".auth-content");
            const url = link.getAttribute("href");

            if (authContent && url) {
                authContent.classList.add("auth-leaving");

                setTimeout(function () {
                    window.location.href = url;
                }, 430);
            }
        });
    });

    /* ================= CHECKOUT PAYMENT METHOD ================= */

    const paymentMethodInputs = document.querySelectorAll('input[name="payment_method"]');
    const paymentCardFields = document.getElementById("paymentCardFields");

    function updatePaymentFields(value) {
        if (!paymentCardFields) {
            return;
        }

        if (value === "card") {
            paymentCardFields.classList.remove("hidden");
        } else {
            paymentCardFields.classList.add("hidden");
        }
    }

    paymentMethodInputs.forEach(function (input) {
        input.addEventListener("change", function () {
            updatePaymentFields(input.value);
        });
    });

    const checkedPaymentInput = document.querySelector('input[name="payment_method"]:checked');

    if (checkedPaymentInput) {
        updatePaymentFields(checkedPaymentInput.value);
    }

    /* ================= COLLECTION PAGE PRODUCT FILTER ================= */

    const urlParams = new URLSearchParams(window.location.search);
    const collectionFilter = urlParams.get("filter");

    if (collectionFilter) {
        filterProducts(collectionFilter);

        const productsSection = document.querySelector("#products");

        if (productsSection) {
            setTimeout(function () {
                productsSection.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }, 300);
        }
    }

    /* ================= ABOUT SECTION ================= */

    const aboutSection = document.querySelector(".about-animate");

    if (aboutSection) {
        const aboutColumns = aboutSection.querySelectorAll(".about-column");

        const showAboutSection = function () {
            aboutColumns.forEach(function (column, index) {
                setTimeout(function () {
                    column.classList.add("is-visible");
                }, index * 180);
            });
        };

        const aboutObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        showAboutSection();
                        aboutObserver.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.15
            }
        );

        aboutObserver.observe(aboutSection);
    }

    /* ================= CONTACT FORM ================= */

    const contactForm = document.getElementById("contactForm");
    const contactSubmitBtn = document.getElementById("contactSubmitBtn");
    const contactSuccessMessage = document.getElementById("contactSuccessMessage");

    function showContactSuccess(event) {
        if (event) {
            event.preventDefault();
        }

        if (!contactForm || !contactSuccessMessage) {
            return;
        }

        if (!contactForm.checkValidity()) {
            contactForm.reportValidity();
            return;
        }

        contactSuccessMessage.classList.add("show");

        contactForm.reset();

        setTimeout(function () {
            contactSuccessMessage.classList.remove("show");
        }, 4000);
    }

    if (contactForm && contactSuccessMessage) {
        contactForm.addEventListener("submit", showContactSuccess);
    }

    if (contactSubmitBtn && contactForm && contactSuccessMessage) {
        contactSubmitBtn.addEventListener("click", showContactSuccess);
    }

    /* ================= ORDER HISTORY FILTER ================= */

    const orderTabs = document.querySelectorAll(".order-tab");
    const orderCards = document.querySelectorAll(".order-history-card");

    orderTabs.forEach(function (tab) {
        tab.addEventListener("click", function () {
            const filter = tab.getAttribute("data-order-filter");

            orderTabs.forEach(function (item) {
                item.classList.remove("active");
            });

            tab.classList.add("active");

            orderCards.forEach(function (card) {
                const status = card.getAttribute("data-order-status");

                if (filter === "all" || status === filter) {
                    card.classList.remove("is-hidden");
                } else {
                    card.classList.add("is-hidden");
                }
            });
        });
    });

});