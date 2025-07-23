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
    </div>
    <div id="map"></div>
</div>

<script defer>
    /* 1) Подгружаем список адресов в массив (можно хранить в JSON или прямо в PHP) */
    const branches = [
        {
            id: 0,
            title: 'Филиал 1 - Яккасарайский р-н, ул. Бабура, 87Б/1',
            hint: 'Корзинка - Аэропорт',
            phone: '+998 91 007 00 06',
            lat:   41.270100,
            lon:   69.263105
        },
        {
            id: 1,
            title: 'Филиал 2 - Алмазарский район, ул. Нурафшон, 50',
            hint: 'ТЦ Riviera Mall',
            phone: '+998 555 10 01 02',
            lat:  41.341143,
            lon:  69.247667
        },
        {
            id: 2,
            title: 'Филиал 3 - Яшнабадски р-н, ул. Паркент, 6А',
            hint: 'Паркентский рынок',
            phone: '+998 97 400 03 44',
            lat:  41.316030,
            lon:  69.319074
        },
        {
            id: 3,
            title: 'Филиал 4 - Шайхантахурский р-н, ул. Фурката, 2А',
            hint: 'TashkentCity',
            phone: '+998 90 008 95 44',
            lat:  41.315512,
            lon:  69.242857
        },
        {
            id: 4,
            title: 'Филиал 5 - Юнусусабадский р-н, ул. Киёт, 38А',
            hint: 'Алайский базар - Монумент (Мужество)',
            phone: '+998 90 932 51 12',
            lat:  41.322869,
            lon:  69.277328
        },
        {
            id: 5,
            title: 'Филиал 6 - ТЦ Global Stroy Мирзо-Улугбекский район, Малая кольцевая дорога, 15',
            hint: 'Метро Пушкин',
            phone: '+998 93 003 35 63',
            lat:   41.332956,
            lon:   69.310818
        },
        {
            id: 6,
            title: 'Филиал 7 - Алмазарский р-н, ул. Карасарай 314',
            hint: 'Жоми базар',
            phone: '+998 99 362 14 00',
            lat:  41.356914,
            lon:  69.242170
        },
        {
            id: 7,
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
        Тел:  <a href="tel:${b.phone.replace(/\s+/g, '')}" class="phone_open">${b.phone}</a><br>
        <div class="sub_maps" id="sub_maps-${b.id}" style="width:100%;height:200px;"></div>
        <button class="show-btn map-focus-btn">Показать на карте</button>
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
            const mapId = 'sub_maps-' + b.id;
            const container = document.getElementById(mapId);
            if (!container) return;


            const sub_map = new ymaps.Map(container, {
                center: [b.lat, b.lon],
                zoom: 15,
                controls: ['zoomControl', 'fullscreenControl']
            });

            const sub_placemark = new ymaps.Placemark(
                [b.lat, b.lon],
                { balloonContent: `<img src="https://media.istockphoto.com/id/2037610555/photo/big-eyed-naughty-cat-looking-at-the-target-from-behind-the-marble-table.jpg?s=612x612&w=0&k=20&c=JEPwsOHRNumZPVwy_bvjGpeZ9ke4Pu4T9EiA8iyQ324=" alt=""><br><strong>${b.title}</strong><br>${b.hint}<br>${b.phone}` },
                { preset: 'islands#yellowDotIcon' }
            );

            sub_placemark.events.add('click', () => activateCard(i));
            sub_map.geoObjects.add(sub_placemark);
            const placemark = new ymaps.Placemark(
                [b.lat, b.lon],
                { balloonContent: `<img src="https://media.istockphoto.com/id/2037610555/photo/big-eyed-naughty-cat-looking-at-the-target-from-behind-the-marble-table.jpg?s=612x612&w=0&k=20&c=JEPwsOHRNumZPVwy_bvjGpeZ9ke4Pu4T9EiA8iyQ324=" alt=""><br><strong>${b.title}</strong><br>${b.hint}<br>${b.phone}` },
                { preset: 'islands#yellowDotIcon' }
            );
            placemark.events.add('click', () => activateCard(i));
            clusterer.add(placemark);
            b.placemark = placemark;
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
