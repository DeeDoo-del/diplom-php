// Динамика для веб-приложения Book aBite

document.addEventListener('DOMContentLoaded', function() {
  // Инициализация каруселей
  initCarousels();
  
  // Инициализация фильтров
  initFilters();
  
  // Инициализация интерактивных элементов
  initInteractiveElements();
});

// Функция для инициализации каруселей
function initCarousels() {
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

    // Обработчики для стрелок
    leftBtn.addEventListener('click', function() {
      track.scrollBy({ left: -280, behavior: 'smooth' });
    });
    
    rightBtn.addEventListener('click', function() {
      track.scrollBy({ left: 280, behavior: 'smooth' });
    });

    // Показываем/скрываем стрелки в зависимости от возможности прокрутки
    updateArrowVisibility(track, leftBtn, rightBtn);
    
    track.addEventListener('scroll', function() {
      updateArrowVisibility(track, leftBtn, rightBtn);
    });
  });
}

// Функция для обновления видимости стрелок
function updateArrowVisibility(track, leftBtn, rightBtn) {
  const isAtStart = track.scrollLeft <= 0;
  const isAtEnd = track.scrollLeft >= track.scrollWidth - track.clientWidth;
  
  leftBtn.style.opacity = isAtStart ? '0.3' : '1';
  rightBtn.style.opacity = isAtEnd ? '0.3' : '1';
}

// Функция для инициализации фильтров
function initFilters() {
  const filterSelects = document.querySelectorAll('.filter-select');
  const filtersForm = document.getElementById('filtersForm');
  if (!filtersForm) return;
  filterSelects.forEach(function(select) {
    select.addEventListener('change', function() {
      filtersForm.submit();
    });
  });
}

// Функция для инициализации интерактивных элементов
function initInteractiveElements() {
  // Обработчики для кнопок
  document.querySelectorAll('.btn-book').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      console.log('Открытие формы бронирования');
      // Здесь можно добавить модальное окно для бронирования
      // openBookingModal();
    });
  });

  // Обработчики для кнопок меню
  document.querySelectorAll('.btn-menu').forEach(function(btn) {
    // Только если это кнопка, а не ссылка
    if (btn.tagName.toLowerCase() === 'button') {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Открытие меню ресторана');
        // Здесь можно добавить модальное окно с меню
        // openMenuModal();
      });
    }
  });

  // Обработчики для кнопок построения маршрута
  document.querySelectorAll('.btn-route').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      console.log('Построение маршрута');
      // Здесь можно добавить интеграцию с картами
      // openRouteBuilder();
    });
  });
}

// Функция для плавной прокрутки к элементам
function smoothScrollTo(element) {
  element.scrollIntoView({
    behavior: 'smooth',
    block: 'start'
  });
}

// Функция для показа уведомлений
function showNotification(message, type = 'info') {
  const notification = document.createElement('div');
  notification.className = `notification notification-${type}`;
  notification.textContent = message;
  
  document.body.appendChild(notification);
  
  // Показываем уведомление
  setTimeout(() => {
    notification.classList.add('show');
  }, 100);
  
  // Скрываем через 3 секунды
  setTimeout(() => {
    notification.classList.remove('show');
    setTimeout(() => {
      document.body.removeChild(notification);
    }, 300);
  }, 3000);
}

// Функция для валидации форм
function validateForm(form) {
  const inputs = form.querySelectorAll('input[required], select[required]');
  let isValid = true;
  
  inputs.forEach(function(input) {
    if (!input.value.trim()) {
      input.classList.add('error');
      isValid = false;
    } else {
      input.classList.remove('error');
    }
  });
  
  return isValid;
}

// Функция для загрузки данных с сервера (AJAX)
function loadData(url, callback) {
  fetch(url)
    .then(response => response.json())
    .then(data => {
      if (callback) callback(data);
    })
    .catch(error => {
      console.error('Ошибка загрузки данных:', error);
      showNotification('Ошибка загрузки данных', 'error');
    });
}

// Функция для отправки данных на сервер (AJAX)
function sendData(url, data, callback) {
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(result => {
    if (callback) callback(result);
  })
  .catch(error => {
    console.error('Ошибка отправки данных:', error);
    showNotification('Ошибка отправки данных', 'error');
  });
} 