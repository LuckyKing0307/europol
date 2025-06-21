@push('page-styles')
    <link href="{{ asset('css/pages_style.css') }}" rel="stylesheet">
@endpush

<section class="warranty max-w-screen-2xl mx-auto">
    <div class="warranty__content">
        <div class="container">
            <div class="warranty__content">
                <h1 class="warranty__title">Гарантия качества от Europol</h1>
                <p class="warranty__descr">
                    Мы уверены в своей продукции и предоставляем официальную гарантию на все напольные покрытия.
                </p>
            </div>
            <img src="{{ asset('img/warranty-1.png') }}" alt="О нас" class="warranty__img"/>
        </div>
    </div>
    <div class="warranty__services warranty-services">
        <div class="container">
            <div class="warranty-services__card">
                <img src="{{ asset('img/warranty-2.png') }}" alt="О нас"/>
                <div class="warranty-services__txt">
                    <h3 class="warranty-services__subtitle">Укладка и монтаж</h3>
                    <p class="warranty-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="warranty-services__card">
                <img src="{{ asset('img/warranty-3.png') }}" alt="О нас"/>
                <div class="warranty-services__txt">
                    <h3 class="warranty-services__subtitle">Укладка и монтаж</h3>
                    <p class="warranty-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="warranty-services__card">
                <img src="{{ asset('img/warranty-4.png') }}" alt="О нас"/>
                <div class="warranty-services__txt">
                    <h3 class="warranty-services__subtitle">Укладка и монтаж</h3>
                    <p class="warranty-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
            <div class="warranty-services__card">
                <img src="{{ asset('img/warranty-5.png') }}" alt="О нас"/>
                <div class="warranty-services__txt">
                    <h3 class="warranty-services__subtitle">Укладка и монтаж</h3>
                    <p class="warranty-services__descr">Профессиональная укладка всех типов покрытий</p>
                </div>
            </div>
        </div>
    </div>
    <div class="faq">
        <div class="container">
            <h2 class="faq__title">Часто задаваемые вопросы по гарантии</h2>
            <div class="faq__list">
                <div class="faq-item">
                    <button class="faq-item__question">
                        <span class="faq-item__text">На сколько лет предоставляется гарантия?</span>
                        <span class="faq-item__icon">
										<span class="line horizontal"></span>
										<span class="line vertical"></span>
									</span>
                    </button>
                    <div class="faq-item__answer">
                        Срок гарантии зависит от конкретного бренда и модели. Обычно он составляет от 12 до 25 лет.
                        Точная информация указана в карточке товара или в гарантийном талоне.
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-item__question">
                        <span class="faq-item__text">Что делать, если товар пришёл с браком?</span>
                        <span class="faq-item__icon">
										<span class="line horizontal"></span>
										<span class="line vertical"></span>
									</span>
                    </button>
                    <div class="faq-item__answer">
                        В случае брака свяжитесь с нами для обмена или возврата. Мы проведем экспертизу и заменим
                        товар в рамках гарантийных обязательств.
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-item__question">
                        <span class="faq-item__text">Как вернуть товар?</span>
                        <span class="faq-item__icon">
										<span class="line horizontal"></span>
										<span class="line vertical"></span>
									</span>
                    </button>
                    <div class="faq-item__answer">
                        Вы можете вернуть товар в течение 14 дней, если он не был в употреблении и сохранён товарный
                        вид. Подробности уточняйте у менеджера.
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-item__question">
                        <span class="faq-item__text">Гарантия от производителя или магазина?</span>
                        <span class="faq-item__icon">
										<span class="line horizontal"></span>
										<span class="line vertical"></span>
									</span>
                    </button>
                    <div class="faq-item__answer">
                        Мы предоставляем гарантию от производителя. Все условия прописаны в гарантийном талоне,
                        прилагаемом к товару.
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-item__question">
                        <span class="faq-item__text">Гарантия действует после укладки?</span>
                        <span class="faq-item__icon">
										<span class="line horizontal"></span>
										<span class="line vertical"></span>
									</span>
                    </button>
                    <div class="faq-item__answer">
                        Да, гарантия сохраняется после профессиональной укладки при соблюдении всех условий монтажа,
                        указанных в инструкции. Да, гарантия сохраняется после профессиональной укладки при
                        соблюдении всех условий монтажа, указанных в инструкции. Да, гарантия сохраняется после
                        профессиональной укладки при соблюдении всех условий монтажа, указанных в инструкции.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="warranty-contact__title">Не нашли ответа? Напишите нам — мы поможем!</h2>
    <div class="flex justify-center">
        @livewire('contact-form')
    </div>
</section>
<script>
    document.querySelectorAll(".faq-item__question").forEach((button) => {
        button.addEventListener("click", () => {
            const item = button.closest(".faq-item");
            const answer = item.querySelector(".faq-item__answer");

            if (item.classList.contains("active")) {
                item.classList.remove("active");
                answer.style.maxHeight = "0";
            } else {
                item.classList.add("active");
                answer.style.maxHeight = answer.scrollHeight + 20 + "px";
            }
        });
    });
</script>
