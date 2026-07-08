document.addEventListener("DOMContentLoaded", function () {
    var listItems = document.querySelectorAll(".room-item");
    var slides = document.querySelectorAll(".room-slide");
    var prevBtn = document.getElementById("prevSlide");
    var nextBtn = document.getElementById("nextSlide");
    var current = 0;

    function goTo(index) {
        if (index === current) return;

        var direction = index > current ? "next" : "prev";

        listItems.forEach(function (item) {
            var isActive = parseInt(item.getAttribute("data-slide"), 10) === index;
            item.classList.toggle("active", isActive);
        });

        slides.forEach(function (slide) {
            var slideIndex = parseInt(slide.getAttribute("data-slide"), 10);

            slide.classList.remove("exit-left", "exit-right");

            if (slideIndex === index) {
                slide.classList.add("active");
            } else if (slideIndex === current) {
                slide.classList.remove("active");
                slide.classList.add(direction === "next" ? "exit-left" : "exit-right");
            }
        });

        current = index;
    }

    listItems.forEach(function (item) {
        item.addEventListener("click", function () {
            goTo(parseInt(item.getAttribute("data-slide"), 10));
        });
    });

    if (prevBtn) {
        prevBtn.addEventListener("click", function () {
            var newIndex = (current - 1 + slides.length) % slides.length;
            goTo(newIndex);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", function () {
            var newIndex = (current + 1) % slides.length;
            goTo(newIndex);
        });
    }
});
