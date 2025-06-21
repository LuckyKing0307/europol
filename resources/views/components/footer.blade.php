<footer class="footer">
    <div class="footer__container">
        <!-- Блок с лого и описанием -->
        <div class="footer__col footer__col--brand">
            <x-brand.logo class="footer__logo" />
            <p class="footer__desc">
                Европейское качество напольных покрытий в Узбекистане.<br>
                <span class="footer__desc-small">Более 15 лет на рынке.</span>
            </p>
        </div>
        <!-- Быстрые ссылки -->
        <div class="footer__col footer__col--links">
            <div class="footer__links-title">Быстрые ссылки</div>
            <div class="footer__links-list">
                <a href="#" class="footer__link">Главная</a>
                <a href="https://uzbekistan360.uz/ru/location/europolmke" class="footer__link" target="_blank">3D тур</a>
                <a href="{{route('about.view')}}" class="footer__link">О компании</a>
                <a href="{{route('work.view')}}" class="footer__link">Проекты</a>
                <a href="{{route('blogs.view')}}" class="footer__link">Блог</a>
                <a href="{{route('warranty.view')}}" class="footer__link">Гарантия</a>
            </div>
        </div>
        <!-- Контакты -->
        <div class="footer__col footer__col--contacts">
            <div class="footer__contacts-title">Контакты</div>
            <ul class="footer__contacts-list">
                <li><span class="footer__icon">📍</span> ул. Амира Темура, 12, Ташкент</li>
                <li><span class="footer__icon">📞</span> +998 12 345 67 89</li>
                <li><span class="footer__icon">✉️</span> info@site.com</li>
            </ul>
            <div class="footer__socials">
                <!-- Вставь svg или иконки, если нужны другие, поменяй тут -->
                <a href="#" class="footer__social"><svg width="22" height="22" fill="currentColor"><circle cx="11" cy="11" r="11"/></svg></a>
                <a href="#" class="footer__social"><svg width="22" height="22" fill="currentColor"><circle cx="11" cy="11" r="11"/></svg></a>
                <a href="#" class="footer__social"><svg width="22" height="22" fill="currentColor"><circle cx="11" cy="11" r="11"/></svg></a>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        © 2025 Europol. Все права защищены.
    </div>
</footer>
