// Динамика для горизонтальных каруселей на главной странице

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.carousel-section').forEach(function(section) {
    const track = section.querySelector('.carousel-track');
    if (!track) return;

    // Создаём стрелки
    const leftBtn = document.createElement('button');
    leftBtn.className = 'carousel-arrow left';
    leftBtn.innerHTML = '&#8592;';
    const rightBtn = document.createElement('button');
    rightBtn.className = 'carousel-arrow right';
    rightBtn.innerHTML = '&#8594;';
    section.appendChild(leftBtn);
    section.appendChild(rightBtn);

    leftBtn.addEventListener('click', function() {
      track.scrollBy({ left: -280, behavior: 'smooth' });
    });
    rightBtn.addEventListener('click', function() {
      track.scrollBy({ left: 280, behavior: 'smooth' });
    });
  });
}); 