const heroSection = document.getElementById("hero");
const navbar = document.getElementById("myNavbar");
const logo = document.getElementById("logo");
const searchContainer = document.querySelector(".search-container");
const searchInput = document.querySelector(".search-input");
const searchBtn = document.querySelector(".search-container");

let item = [];

if (heroSection) {
    const heroHeight = heroSection.offsetHeight;
    window.addEventListener("scroll", function () {
        if (window.scrollY > heroHeight) {
            navbar.classList.add("scrolled");
            logo.src = "/assets/logos/logo-red.png";
        } else if (window.scrollY > 120) {
            navbar.classList.add("blur");
            navbar.classList.remove("scrolled");
            logo.src = "/assets/logos/Logo.png";
        } else {
            navbar.classList.remove("scrolled");
            navbar.classList.remove("blur");
            logo.src = "/assets/logos/Logo.png";
        }
    });
} else {
    navbar.classList.add("scrolled");
    logo.src = "/assets/logos/logo-red.png";
}

function changeTab(tabId) {
    // Menonaktifkan semua konten tab
    document.querySelectorAll(".tab-content").forEach(function (tabContent) {
        tabContent.classList.remove("active");
    });

    // Menonaktifkan semua tombol tab
    document
        .querySelectorAll(".simulation-tab button")
        .forEach(function (tabButton) {
            tabButton.classList.remove("active");
        });

    // Mengaktifkan konten tab yang dipilih
    document.getElementById(`tab-content-${tabId}`).classList.add("active");

    // Mengaktifkan tombol tab yang dipilih
    document.getElementById(`btn-tab-${tabId}`).classList.add("active");
}

document.querySelectorAll(".accordion-item h2").forEach((accordionToggle) => {
    accordionToggle.addEventListener("click", () => {
        const allAccordionItems = document.querySelectorAll(".accordion-item");
        const accordionItem = accordionToggle.parentNode;
        const accordionContent = accordionToggle.nextElementSibling;

        // Close all other accordion items
        allAccordionItems.forEach((item) => {
            if (item !== accordionItem) {
                item.querySelector(".accordion-content").style.maxHeight = null;
                item.classList.remove("active");
            }
        });

        // If this accordion item is already open, close it.
        if (accordionContent.style.maxHeight) {
            accordionContent.style.maxHeight = null;
            accordionItem.classList.remove("active");
        } else {
            // Else, open this accordion item and close all others
            accordionContent.style.maxHeight =
                accordionContent.scrollHeight + "px";
            accordionItem.classList.add("active");
        }
    });
});

searchBtn.addEventListener("click", function (event) {
    event.preventDefault();
    searchInput.classList.add("active");
    searchInput.focus();
    searchContainer.classList.add("active");
});

document.addEventListener("click", function (event) {
    if (!searchContainer.contains(event.target)) {
        searchInput.classList.remove("active");
        searchContainer.classList.remove("active");
    }
});
