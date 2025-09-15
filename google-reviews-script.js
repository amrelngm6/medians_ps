// Google Reviews Widget JavaScript
class GoogleReviewsWidget {
    constructor() {
        this.currentSlide = 0;
        this.totalSlides = 0;
        this.isAnimating = false;
        this.autoSlideInterval = null;
        
        this.init();
    }
    
    init() {
        this.reviewsContainer = document.getElementById('reviewsContainer');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.indicators = document.getElementById('indicators');
        
        if (!this.reviewsContainer) return;
        
        this.totalSlides = this.reviewsContainer.children.length;
        this.setupEventListeners();
        this.startAutoSlide();
        this.updateView();
        
        // Add touch/swipe support
        this.addTouchSupport();
    }
    
    setupEventListeners() {
        // Button clicks
        this.prevBtn?.addEventListener('click', () => this.previousSlide());
        this.nextBtn?.addEventListener('click', () => this.nextSlide());
        
        // Indicator clicks
        const indicatorElements = this.indicators?.querySelectorAll('.indicator');
        indicatorElements?.forEach((indicator, index) => {
            indicator.addEventListener('click', () => this.goToSlide(index));
        });
        
        // Pause auto-slide on hover
        this.reviewsContainer.addEventListener('mouseenter', () => this.pauseAutoSlide());
        this.reviewsContainer.addEventListener('mouseleave', () => this.startAutoSlide());
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => this.handleKeyNavigation(e));
    }
    
    nextSlide() {
        if (this.isAnimating) return;
        
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        this.updateView();
    }
    
    previousSlide() {
        if (this.isAnimating) return;
        
        this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.updateView();
    }
    
    goToSlide(slideIndex) {
        if (this.isAnimating || slideIndex === this.currentSlide) return;
        
        this.currentSlide = slideIndex;
        this.updateView();
    }
    
    updateView() {
        if (!this.reviewsContainer) return;
        
        this.isAnimating = true;
        
        // Calculate the number of visible slides based on screen width
        const containerWidth = this.reviewsContainer.parentElement.offsetWidth;
        const cardWidth = 340 + 24; // card width + gap
        const visibleSlides = Math.floor((containerWidth - 160) / cardWidth); // subtract padding
        
        // Adjust for mobile
        const isMobile = window.innerWidth <= 768;
        const slidesToShow = isMobile ? 1 : Math.max(1, Math.min(visibleSlides, 2));
        
        const slideWidth = 100 / slidesToShow;
        const translateX = -this.currentSlide * slideWidth;
        
        this.reviewsContainer.style.transform = `translateX(${translateX}%)`;
        
        // Update indicators
        this.updateIndicators();
        
        // Reset animation flag after transition
        setTimeout(() => {
            this.isAnimating = false;
        }, 500);
    }
    
    updateIndicators() {
        const indicatorElements = this.indicators?.querySelectorAll('.indicator');
        indicatorElements?.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === this.currentSlide);
        });
    }
    
    startAutoSlide() {
        this.pauseAutoSlide();
        this.autoSlideInterval = setInterval(() => {
            this.nextSlide();
        }, 5000); // Change slide every 5 seconds
    }
    
    pauseAutoSlide() {
        if (this.autoSlideInterval) {
            clearInterval(this.autoSlideInterval);
            this.autoSlideInterval = null;
        }
    }
    
    handleKeyNavigation(e) {
        if (e.key === 'ArrowLeft') {
            // In RTL, left arrow should go to next
            this.nextSlide();
        } else if (e.key === 'ArrowRight') {
            // In RTL, right arrow should go to previous
            this.previousSlide();
        }
    }
    
    addTouchSupport() {
        let startX = 0;
        let startY = 0;
        let startTime = 0;
        
        this.reviewsContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            startTime = Date.now();
            this.pauseAutoSlide();
        });
        
        this.reviewsContainer.addEventListener('touchend', (e) => {
            const endX = e.changedTouches[0].clientX;
            const endY = e.changedTouches[0].clientY;
            const endTime = Date.now();
            
            const deltaX = endX - startX;
            const deltaY = endY - startY;
            const deltaTime = endTime - startTime;
            
            // Check if it's a swipe (not a tap)
            if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50 && deltaTime < 300) {
                if (deltaX > 0) {
                    // Swipe right - go to previous (in RTL context)
                    this.previousSlide();
                } else {
                    // Swipe left - go to next (in RTL context)
                    this.nextSlide();
                }
            }
            
            this.startAutoSlide();
        });
    }
    
    // Method to dynamically add reviews
    addReview(reviewData) {
        const reviewCard = this.createReviewCard(reviewData);
        this.reviewsContainer.appendChild(reviewCard);
        this.totalSlides++;
        this.updateIndicators();
    }
    
    createReviewCard(data) {
        const card = document.createElement('div');
        card.className = 'review-card';
        
        card.innerHTML = `
            <div class="review-header">
                <div class="reviewer-info">
                    <img src="${data.avatar || 'https://lh3.googleusercontent.com/a/default-user=s40-c'}" alt="${data.name}" class="reviewer-avatar">
                    <div class="reviewer-details">
                        <h4 class="reviewer-name">${data.name}</h4>
                        <div class="review-date">${data.date}</div>
                    </div>
                </div>
                <div class="google-icon">
                    <i class="fab fa-google"></i>
                </div>
            </div>
            <div class="review-rating">
                ${this.generateStars(data.rating)}
            </div>
            <div class="review-text">
                <p>${data.text}</p>
            </div>
        `;
        
        return card;
    }
    
    generateStars(rating) {
        let stars = '';
        for (let i = 0; i < 5; i++) {
            stars += i < rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
        }
        return stars;
    }
    
    // Method to update the summary
    updateSummary(rating, totalReviews) {
        const ratingScore = document.querySelector('.rating-score');
        const totalReviewsElement = document.querySelector('.total-reviews');
        
        if (ratingScore) ratingScore.textContent = rating.toFixed(1);
        if (totalReviewsElement) totalReviewsElement.textContent = `${totalReviews} مراجعة Google`;
    }
}

// Initialize the widget when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const widget = new GoogleReviewsWidget();
    
    // Make it globally accessible for dynamic updates
    window.googleReviewsWidget = widget;
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.googleReviewsWidget) {
        window.googleReviewsWidget.updateView();
    }
});

// Example function to dynamically load reviews (you can integrate with Google Places API)
function loadGoogleReviews() {
    // This is a placeholder for actual Google Places API integration
    // You would replace this with actual API calls
    
    const sampleReviews = [
        {
            name: "أحمد محمد",
            date: "2024.03.01",
            rating: 5,
            text: "خدمة ممتازة والفريق الطبي محترف جداً. أنصح بشدة بمستشفى بداية.",
            avatar: "https://lh3.googleusercontent.com/a/default-user=s40-c"
        },
        {
            name: "فاطمة علي",
            date: "2024.02.28",
            rating: 5,
            text: "تجربة رائعة من البداية للنهاية. شكراً لكل العاملين في المستشفى.",
            avatar: "https://lh3.googleusercontent.com/a/default-user=s40-c"
        }
    ];
    
    // Example of how to add reviews dynamically
    // sampleReviews.forEach(review => {
    //     window.googleReviewsWidget.addReview(review);
    // });
}

// Intersection Observer for lazy loading and animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe review cards for animations
document.addEventListener('DOMContentLoaded', () => {
    const reviewCards = document.querySelectorAll('.review-card');
    reviewCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
