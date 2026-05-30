document.addEventListener("DOMContentLoaded", () => {
    const slider = document.querySelector(".featured-slider");
    const slides = document.querySelectorAll(".featured-slide");
    const dotsContainer = document.getElementById("featuredDots");

    if (!slider || slides.length === 0) return;

    const gap = 25;
    let slideIndex = 0;

    function getSlideWidth() {
        return slides[0].offsetWidth + gap;
    }

    function updateDots() {
        if (!dotsContainer) return;
        dotsContainer.querySelectorAll(".featured-dot").forEach((dot, i) => {
            dot.classList.toggle("active", i === slideIndex);
        });
    }

    if (dotsContainer) {
        slides.forEach((_, i) => {
            const dot = document.createElement("button");
            dot.className = "featured-dot" + (i === 0 ? " active" : "");
            dot.setAttribute("aria-label", "Go to slide " + (i + 1));
            dot.addEventListener("click", () => {
                slideIndex = i;
                slider.scrollTo({ left: slideIndex * getSlideWidth(), behavior: "smooth" });
                updateDots();
            });
            dotsContainer.appendChild(dot);
        });
    }

    function moveSlide(n) {
        slideIndex += n;
        if (slideIndex >= slides.length) slideIndex = 0;
        if (slideIndex < 0) slideIndex = slides.length - 1;
        slider.scrollTo({ left: slideIndex * getSlideWidth(), behavior: "smooth" });
        updateDots();
    }

    document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") moveSlide(-1);
        if (e.key === "ArrowRight") moveSlide(1);
    });

    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");
    if (prevBtn) prevBtn.addEventListener("click", () => moveSlide(-1));
    if (nextBtn) nextBtn.addEventListener("click", () => moveSlide(1));

    slider.addEventListener("scroll", () => {
        const newIndex = Math.round(slider.scrollLeft / getSlideWidth());
        if (newIndex !== slideIndex && newIndex >= 0 && newIndex < slides.length) {
            slideIndex = newIndex;
            updateDots();
        }
    });
});

































// Dashboard Images Remove Button

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('confirmationModal');
        const confirmDeleteBtn = document.getElementById('confirmDelete');
        const cancelDeleteBtn = document.getElementById('cancelDelete');
        let formToDelete = null;
        
        window.confirmDelete = function(button) {
            formToDelete = button.closest('form');
            modal.style.display = 'block';
            };
        
            confirmDeleteBtn.onclick = function() {
                if (formToDelete) {
                    formToDelete.submit();
                }
                modal.style.display = 'none';
            };
        
            cancelDeleteBtn.onclick = function() {
                modal.style.display = 'none';
            };
        });
        
// Dashboard Images changer
    
    document.addEventListener("DOMContentLoaded", function () {
        let images = document.querySelectorAll(".home-image"); // Get all images
        let index = 0; // Track current image

        function toggleImages() {
            if (images.length < 2) return; // Ensure there are at least 2 images

            // Hide all images
            images.forEach(img => img.style.display = "none");

            // Show the current image
            images[index].style.display = "block";

            // Update index (loop back to start)
            index = (index + 1) % images.length;
        }

        // Initial call
        toggleImages();

        // Set interval to switch images every 3 seconds
        setInterval(toggleImages, 5000);
});

