document.addEventListener("DOMContentLoaded", function() {
    const slides = ['slide1', 'slide2', 'slide3','slide4', 'slide5'];
    let currentSlide = 0;

    function changeSlide() {
        document.body.className = slides[currentSlide];
        currentSlide = (currentSlide + 1) % slides.length;
    }

    document.body.classList.remove('initial-slide');

    setInterval(changeSlide, 5000);
});
