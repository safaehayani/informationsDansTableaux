document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.slider');
    let isTransitioning = false;

    function nextSlide() {
        if (!isTransitioning) {
            isTransitioning = true;
            slider.style.transition = 'transform 0.5s ease-in-out';
            slider.style.transform = 'translateX(-100%)';

            setTimeout(() => {
                const firstSlide = slider.firstElementChild;
                slider.appendChild(firstSlide);
                slider.style.transition = 'none';
                slider.style.transform = 'translateX(0)';
                isTransitioning = false;
            }, 500);
        }
    }

    setInterval(nextSlide, 3000); // Change slide every 3 seconds
});
