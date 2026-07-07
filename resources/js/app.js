import './app.css';
import Alpine from 'alpinejs';

// Carousel component
window.Carousel = () => ({
    currentIndex: 0,
    items: [],
    autoplay: true,
    interval: 5000,
    autoplayId: null,

    init() {
        this.items = this.$el.querySelectorAll('[x-ref="item"]');
        if (this.autoplay && this.items.length > 1) {
            this.startAutoplay();
        }
    },

    next() {
        this.currentIndex = (this.currentIndex + 1) % this.items.length;
        this.updateCarousel();
        if (this.autoplay) {
            this.resetAutoplay();
        }
    },

    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
        this.updateCarousel();
        if (this.autoplay) {
            this.resetAutoplay();
        }
    },

    goToSlide(index) {
        this.currentIndex = index;
        this.updateCarousel();
        if (this.autoplay) {
            this.resetAutoplay();
        }
    },

    updateCarousel() {
        this.items.forEach((item, index) => {
            item.style.display = index === this.currentIndex ? 'block' : 'none';
        });
    },

    startAutoplay() {
        this.autoplayId = setInterval(() => this.next(), this.interval);
    },

    resetAutoplay() {
        clearInterval(this.autoplayId);
        this.startAutoplay();
    },

    destroy() {
        if (this.autoplayId) {
            clearInterval(this.autoplayId);
        }
    }
});

Alpine.start();
