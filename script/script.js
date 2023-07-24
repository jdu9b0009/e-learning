// ナビゲーションバーのスクロールイベント
window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// ダークモード
function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle('dark-mode');
}

// カルーセル
const carouselSlide = document.querySelector('.carousel-slide');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

let slideIndex = 0;

prevBtn.addEventListener('click', () => {
    slideIndex = (slideIndex === 0) ? carouselSlide.children.length - 1 : slideIndex - 1;
    updateSlide();
});

nextBtn.addEventListener('click', () => {
    slideIndex = (slideIndex === carouselSlide.children.length - 1) ? 0 : slideIndex + 1;
    updateSlide();
});

function updateSlide() {
    carouselSlide.style.transform = `translateX(-${slideIndex * 100}%)`;
}