<style>
    /* Базовое расположение: список слева, карта справа */
    .addresses      {width:300px; overflow-y:auto; max-height:90vh;}
    .address-card   {background:#fafafa; border-radius:8px; padding:12px 14px; margin-bottom:12px;}
    .address-card.active {box-shadow:0 0 0 2px #e2c591 inset;}
    .show-btn       {margin-top:10px; display:block; width:100%; padding:8px 0;
        background:#e2c591; border:none; border-radius:6px; cursor:pointer;}
    #map            {flex:1 1 0; height:70vh; min-width:400px; max-width: 80%; border-radius:8px; margin-top: 0; margin-left: 30px}
</style>
<div class="max-w-screen-2xl mx-auto flex justify-between p-4">
    <div class="addresses" id="addressList">
        <!-- Карточки генерируем шаблонно (ниже покажу как) -->
        <!-- Пример одной карточки: -->
        <!--
        <div class="address-card" data-lat="41.319443" data-lon="69.248089">
          <strong>ул. Паркент, 7 (Мирзо-Улугбекский&nbsp;р-н)</strong><br>
          Ориентир: детсад&nbsp;№493<br>
          Тел.: +998 (97)&nbsp;400-03-44<br>
          <button class="show-btn">Показать на карте</button>
        </div>
        -->
    </div>

    <div id="map"></div>
</div>

<script defer>
    /* 1) Подгружаем список адресов в массив (можно хранить в JSON или прямо в PHP) */
    const branches = [
        {
            title: 'Филиал 1 - Яккасарайский р-н, ул. Бабура, 87Б/1',
            hint: 'Корзинка - Аэропорт',
            phone: '+998 91 007 00 06',
            lat:   41.270100,
            lon:   69.263105
        },
        {
            title: 'Филиал 2 - Алмазарский район, ул. Нурафшон, 50',
            hint: 'ТЦ Riviera Mall',
            phone: '+998 555 10 01 02',
            lat:  41.341143,
            lon:  69.247667
        },
        {
            title: 'Филиал 3 - Яшнабадски р-н, ул. Паркент, 6А',
            hint: 'Паркентский рынок',
            phone: '+998 97 400 03 44',
            lat:  41.316030,
            lon:  69.319074
        },
        {
            title: 'Филиал 4 - Шайхантахурский р-н, ул. Фурката, 2А',
            hint: 'TashkentCity',
            phone: '+998 90 008 95 44',
            lat:  41.315512,
            lon:  69.242857
        },
        {
            title: 'Филиал 5 - Юнусусабадский р-н, ул. Киёт, 38А',
            hint: 'Алайский базар - Монумент (Мужество)',
            phone: '+998 90 932 51 12',
            lat:  41.322869,
            lon:  69.277328
        },
        {
            title: 'Филиал 6 - ТЦ Global Stroy Мирзо-Улугбекский район, Малая кольцевая дорога, 15',
            hint: 'Метро Пушкин',
            phone: '+998 93 003 35 63',
            lat:   41.332956,
            lon:   69.310818
        },
        {
            title: 'Филиал 7 - Алмазарский р-н, ул. Карасарай 314',
            hint: 'Жоми базар',
            phone: '+998 99 362 14 00',
            lat:  41.356914,
            lon:  69.242170
        },
        {
            title: 'Филиал 8 - Яшнабадский р-н, Строй базар Гумбаз ',
            hint: 'Куйлюк',
            phone: '+998 555 10 01 02',
            lat:   41.246623,
            lon:   69.344480
        },
        // 41.269857, 69.262422
        // …добавьте остальные
    ];

    /* 2) Рендерим карточки в DOM */
    const listWrap = document.getElementById('addressList');
    listWrap.innerHTML = branches.map((b,i) => `
      <div class="address-card" data-index="${i}">
        <strong>${b.title}</strong><br>
        Ориентир.: ${b.hint}<br>
        Тел.:  <a href="tel:${b.phone}">${b.phone}</a><br>
        <button class="show-btn">Показать на карте</button>
        <button class="show-btn" onclick="goToYandexMap(${b.lat},${b.lon})">Построить маршрут</button>
      </div>
    `).join('');

    /* 3) Как только API загрузилась => инициализируем карту */
    ymaps.ready(() => {
        const map = new ymaps.Map('map', {
            center: [41.311158, 69.279737], // Центр Ташкента
            zoom: 11,
            controls: ['zoomControl', 'fullscreenControl']
        });

        // Группа для всех меток
        const clusterer = new ymaps.Clusterer({
            preset: 'islands#invertedYellowClusterIcons',
            clusterDisableClickZoom: false,
            zoomMargin: 40
        });

        // Создаём метки и вешаем события
        branches.forEach((b, i) => {
            const placemark = new ymaps.Placemark(
                [b.lat, b.lon],
                { balloonContent: `<strong>${b.title}</strong><br>${b.hint}<br>${b.phone}` },
                { preset: 'islands#yellowDotIcon' }
            );
            placemark.events.add('click', () => activateCard(i));
            clusterer.add(placemark);
            b.placemark = placemark; // Сохраняем ссылку для дальнейших вызовов
        });

        map.geoObjects.add(clusterer);

        /* 4) Обрабатываем клик по кнопке «Показать на карте» */
        listWrap.addEventListener('click', e => {
            if (!e.target.matches('.show-btn')) return;
            const card   = e.target.closest('.address-card');
            const index  = +card.dataset.index;
            activateCard(index, true);
        });

        /* 5) Подсветка активной карточки и перемещение карты */
        function activateCard(index, fromList = false) {
            // Снимаем старую подсветку
            document
                .querySelectorAll('.address-card')
                .forEach(c => c.classList.remove('active'));

            const card = document.querySelector(`.address-card[data-index="${index}"]`);
            card.classList.add('active');

            const { lat, lon, placemark } = branches[index];
            map.setCenter([lat, lon], 15, { checkZoomRange: true }).then(() => {
                placemark.balloon.open();
            });

            // Скроллим список, если вызов из карты
            if (!fromList) card.scrollIntoView({block: 'center', behavior: 'smooth'});
        }
    });
    function goToYandexMap($lat,$lon) {
        // Получаем координаты пользователя
        navigator.geolocation.getCurrentPosition(function(position) {
            const userLat = position.coords.latitude;
            const userLon = position.coords.longitude;
            const url = `https://yandex.ru/maps/?rtext=${userLat},${userLon}~${$lat},${$lon}&rtt=auto`;

            window.open(url, '_blank');
        }, function(error) {
            alert("Не удалось получить ваше местоположение");
        });
    }
</script>
