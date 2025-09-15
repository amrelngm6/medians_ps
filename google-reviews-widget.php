<?php
// Google Reviews Widget Component
// You can include this file in your existing pages

$googleReviews = [
    [
        'name' => 'Ra Sa',
        'date' => '2024.01.04',
        'rating' => 5,
        'text' => 'بشكر مستشفى بدايه ودكتور اسماعيل ابو الفتوح علي المعامله الحسنه وحسن الاستقبال وجوده الفحوصات المقدمه من المستشفي وكل الفريق والدكتور مريحين جدا في المعامله',
        'avatar' => 'https://lh3.googleusercontent.com/a/default-user=s40-c'
    ],
    [
        'name' => 'ysra mohammed',
        'date' => '2024.01.23',
        'rating' => 5,
        'text' => 'حقيقه انا بشكر جدا مستشفى بداية حقيقي تجربة ممتازة جدا وبشكر دكتورة منى شعبان علي التعامل الحلو وعلي لطافتها معايا شكرا يا دكتورة وربنا يوفقك ويسعدك يارب ❤️',
        'avatar' => 'https://lh3.googleusercontent.com/a/default-user=s40-c'
    ],
    [
        'name' => 'Nevissa Ely',
        'date' => '2023.12.31',
        'rating' => 5,
        'text' => 'انا من موريتانيا جيت للمستشفي من يومين ماشاء الله عليهم كل اللي سمعتو عنهم طلع حقيقي من نظافة و حسن المعاملة من الاطباء والممرضين والمستوي العالي للمستشفي',
        'avatar' => 'https://lh3.googleusercontent.com/a/default-user=s40-c'
    ],
    [
        'name' => 'نهال عبد القادر',
        'date' => '2024.02.15',
        'rating' => 5,
        'text' => 'الحمد لله ربنا رزقنا في مستشفى بدايه بعد تأخر حمل 5سنوات في السودان في مستشفي بدايه من اول محاولة تم الحمل وبشكر دكتور إسماعيل وجميع العاملين في مستشفى بدايه',
        'avatar' => 'https://lh3.googleusercontent.com/a/default-user=s40-c'
    ]
];

$averageRating = 4.8;
$totalReviews = 55;

function renderStars($rating) {
    $stars = '';
    for ($i = 0; $i < 5; $i++) {
        $stars .= '<i class="fas fa-star"></i>';
    }
    return $stars;
}
?>

<!-- Google Reviews Widget Component -->
<div class="google-reviews-widget-container">
    <!-- Header Section -->
    <div class="google-reviews-header">
        <div class="google-reviews-logo">
            <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png" alt="Google" class="google-logo">
        </div>
        <div class="google-reviews-summary">
            <div class="google-rating-overview">
                <div class="google-rating-score"><?php echo number_format($averageRating, 1); ?></div>
                <div class="google-rating-stars">
                    <?php echo renderStars(5); ?>
                </div>
                <div class="google-total-reviews"><?php echo $totalReviews; ?> مراجعة Google</div>
            </div>
            <button class="google-write-review-btn" onclick="window.open('https://g.page/r/YOUR_GOOGLE_BUSINESS_ID/review', '_blank')">
                <i class="fas fa-edit"></i>
                كتابة مراجعة
            </button>
        </div>
    </div>

    <!-- Reviews Carousel -->
    <div class="google-reviews-carousel">
        <button class="google-carousel-btn google-prev-btn" id="googlePrevBtn">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="google-reviews-container" id="googleReviewsContainer">
            <?php foreach ($googleReviews as $index => $review): ?>
            <div class="google-review-card">
                <div class="google-review-header">
                    <div class="google-reviewer-info">
                        <img src="<?php echo htmlspecialchars($review['avatar']); ?>" 
                             alt="<?php echo htmlspecialchars($review['name']); ?>" 
                             class="google-reviewer-avatar">
                        <div class="google-reviewer-details">
                            <h4 class="google-reviewer-name"><?php echo htmlspecialchars($review['name']); ?></h4>
                            <div class="google-review-date"><?php echo htmlspecialchars($review['date']); ?></div>
                        </div>
                    </div>
                    <div class="google-icon">
                        <i class="fab fa-google"></i>
                    </div>
                </div>
                <div class="google-review-rating">
                    <?php echo renderStars($review['rating']); ?>
                </div>
                <div class="google-review-text">
                    <p><?php echo htmlspecialchars($review['text']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <button class="google-carousel-btn google-next-btn" id="googleNextBtn">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <!-- Carousel Indicators -->
    <div class="google-carousel-indicators" id="googleIndicators">
        <?php for ($i = 0; $i < count($googleReviews); $i++): ?>
        <span class="google-indicator <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>"></span>
        <?php endfor; ?>
    </div>
</div>

<style>
/* Google Reviews Widget Styles - PHP Integration Version */
.google-reviews-widget-container {
    max-width: 800px;
    margin: 2rem auto;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
}

.google-reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 32px;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

.google-reviews-logo {
    display: flex;
    align-items: center;
}

.google-logo {
    height: 24px;
    width: auto;
}

.google-reviews-summary {
    display: flex;
    align-items: center;
    gap: 24px;
}

.google-rating-overview {
    text-align: center;
}

.google-rating-score {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a73e8;
    line-height: 1;
}

.google-rating-stars {
    margin: 8px 0;
    color: #fbbc04;
    font-size: 16px;
}

.google-rating-stars i {
    margin: 0 1px;
}

.google-total-reviews {
    font-size: 14px;
    color: #5f6368;
    font-weight: 500;
}

.google-write-review-btn {
    background: #1a73e8;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 24px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.google-write-review-btn:hover {
    background: #1557b0;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
}

.google-reviews-carousel {
    position: relative;
    padding: 32px 0;
    overflow: hidden;
}

.google-carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    border: 2px solid #e9ecef;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #5f6368;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.google-carousel-btn:hover {
    background: #f8f9fa;
    border-color: #1a73e8;
    color: #1a73e8;
    transform: translateY(-50%) scale(1.05);
}

.google-prev-btn {
    right: 16px;
}

.google-next-btn {
    left: 16px;
}

.google-reviews-container {
    display: flex;
    transition: transform 0.5s ease;
    padding: 0 80px;
    gap: 24px;
}

.google-review-card {
    width: 340px;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 16px;
    padding: 24px;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.google-review-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    border-color: #1a73e8;
}

.google-review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.google-reviewer-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.google-reviewer-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e9ecef;
}

.google-reviewer-details {
    flex: 1;
}

.google-reviewer-name {
    font-size: 16px;
    font-weight: 600;
    color: #202124;
    margin-bottom: 4px;
}

.google-review-date {
    font-size: 12px;
    color: #5f6368;
}

.google-icon {
    color: #4285f4;
    font-size: 20px;
}

.google-review-rating {
    margin-bottom: 16px;
    color: #fbbc04;
    font-size: 16px;
}

.google-review-rating i {
    margin: 0 1px;
}

.google-review-text {
    line-height: 1.6;
}

.google-review-text p {
    font-size: 14px;
    color: #3c4043;
    margin: 0;
}

.google-carousel-indicators {
    display: flex;
    justify-content: center;
    gap: 12px;
    padding: 0 32px 24px;
}

.google-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #dadce0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.google-indicator.active {
    background: #1a73e8;
    transform: scale(1.2);
}

.google-indicator:hover {
    background: #5f6368;
}

@media (max-width: 768px) {
    .google-reviews-widget-container {
        margin: 16px;
        border-radius: 12px;
    }
    
    .google-reviews-header {
        flex-direction: column;
        gap: 16px;
        padding: 20px;
        text-align: center;
    }
    
    .google-reviews-summary {
        flex-direction: column;
        gap: 16px;
    }
    
    .google-reviews-container {
        padding: 0 60px;
        gap: 16px;
    }
    
    .google-review-card {
        min-width: 280px;
        padding: 20px;
    }
    
    .google-carousel-btn {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }
    
    .google-prev-btn {
        right: 12px;
    }
    
    .google-next-btn {
        left: 12px;
    }
    
    .google-rating-score {
        font-size: 2rem;
    }
}
</style>

<script>
// Google Reviews Widget JavaScript - PHP Integration Version
document.addEventListener('DOMContentLoaded', function() {
    class GoogleReviewsWidget {
        constructor() {
            this.currentSlide = 0;
            this.totalSlides = 0;
            this.isAnimating = false;
            this.autoSlideInterval = null;
            this.init();
        }
        
        init() {
            this.reviewsContainer = document.getElementById('googleReviewsContainer');
            this.prevBtn = document.getElementById('googlePrevBtn');
            this.nextBtn = document.getElementById('googleNextBtn');
            this.indicators = document.getElementById('googleIndicators');
            
            if (!this.reviewsContainer) return;
            
            this.totalSlides = this.reviewsContainer.children.length;
            this.setupEventListeners();
            this.startAutoSlide();
            this.updateView();
            this.addTouchSupport();
        }
        
        setupEventListeners() {
            this.prevBtn?.addEventListener('click', () => this.previousSlide());
            this.nextBtn?.addEventListener('click', () => this.nextSlide());
            
            const indicatorElements = this.indicators?.querySelectorAll('.google-indicator');
            indicatorElements?.forEach((indicator, index) => {
                indicator.addEventListener('click', () => this.goToSlide(index));
            });
            
            this.reviewsContainer.addEventListener('mouseenter', () => this.pauseAutoSlide());
            this.reviewsContainer.addEventListener('mouseleave', () => this.startAutoSlide());
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
            const slideWidth = 100;
            const translateX = -this.currentSlide * slideWidth;
            
            this.reviewsContainer.style.transform = `translateX(${translateX}%)`;
            this.updateIndicators();
            
            setTimeout(() => {
                this.isAnimating = false;
            }, 500);
        }
        
        updateIndicators() {
            const indicatorElements = this.indicators?.querySelectorAll('.google-indicator');
            indicatorElements?.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === this.currentSlide);
            });
        }
        
        startAutoSlide() {
            this.pauseAutoSlide();
            this.autoSlideInterval = setInterval(() => {
                this.nextSlide();
            }, 5000);
        }
        
        pauseAutoSlide() {
            if (this.autoSlideInterval) {
                clearInterval(this.autoSlideInterval);
                this.autoSlideInterval = null;
            }
        }
        
        addTouchSupport() {
            let startX = 0;
            
            this.reviewsContainer.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                this.pauseAutoSlide();
            });
            
            this.reviewsContainer.addEventListener('touchend', (e) => {
                const endX = e.changedTouches[0].clientX;
                const deltaX = endX - startX;
                
                if (Math.abs(deltaX) > 50) {
                    if (deltaX > 0) {
                        this.previousSlide();
                    } else {
                        this.nextSlide();
                    }
                }
                
                this.startAutoSlide();
            });
        }
    }
    
    new GoogleReviewsWidget();
});
</script>
