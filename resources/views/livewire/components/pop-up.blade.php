<div class="pop_up-overlay" id="modal" x-data="{ currentStep: 1 }">
    <div class="pop_up-modal">
        <button class="pop_up-close-btn" @click="document.getElementById('modal').style.display = 'none'">×</button>

        <div class="pop_up-progress-bar">
            <div class="pop_up-progress-fill" :style="{ width: ((currentStep - 1) / 3 * 100) + '%' }"></div>
        </div>
        <h3>Идеальный пол для любого помещения</h3>
        <p>Ответьте на 4 вопроса и получите идеальный вариант под Вас и скидку 10% на вашу 1 покупку!</p>
        <div class="pop_up-step" x-show="currentStep === 1" x-cloak>
            <h3>Вопрос 1:</h3>
            <p>Как вы о нас узнали?</p>
            <div class="image-radio-options">
                <label class="image-radio-option">
                    <input type="radio" wire:model="q1" name="q1" value="Детская" class="hidden">
                    <img src="{{asset('popup/detskaya.png')}}" alt="Детская">
                </label>

                <label class="image-radio-option">
                    <input type="radio" wire:model="q1" name="q1" value="Кухня" class="hidden">
                    <img src="{{asset('popup/kitchen.png')}}" alt="Кухня">
                </label>

                <label class="image-radio-option">
                    <input type="radio" wire:model="q1" name="q1" value="Офис" class="hidden">
                    <img src="{{asset('popup/ofice.png')}}" alt="Офис">
                </label>

                <label class="image-radio-option">
                    <input type="radio" wire:model="q1" name="q1" value="Друзья" class="hidden">
                    <img src="{{asset('popup/gostinnaya.png')}}" alt="Друзья">
                </label>
            </div>
        </div>

        <div class="pop_up-step" x-show="currentStep === 2" x-cloak>
            <h3>Вопрос 2:</h3>
            <p>Что вам важно при выборе?</p>
            <label class="pop_up-label"><input type="radio" wire:model="q2" name="q2" value="Цена"> Цена</label>
            <label class="pop_up-label"><input type="radio" wire:model="q2" name="q2" value="Качество"> Качество</label>
            <label class="pop_up-label"><input type="radio" wire:model="q2" name="q2" value="Скорость доставки"> Скорость доставки</label>
        </div>

        <div class="pop_up-step" x-show="currentStep === 3" x-cloak>
            <h3>Вопрос 3:</h3>
            <p>Вы бы рекомендовали нас?</p>
            <label class="pop_up-label"><input type="radio" wire:model="q3" name="q3" value="Да"> Да</label>
            <label class="pop_up-label"><input type="radio" wire:model="q3" name="q3" value="Нет"> Нет</label>
            <label class="pop_up-label"><input type="radio" wire:model="q3" name="q3" value="Пока не знаю"> Пока не знаю</label>
        </div>

        <div class="pop_up-step" x-show="currentStep === 4" x-cloak>
            <h3>Ваш номер:</h3>
            <input type="text" placeholder="+998901234567" wire:model="phone" class="pop_up-input">
            <h3>Ваше Имя:</h3>
            <input type="text" placeholder="Алишер Авазов" wire:model="name" class="pop_up-input">
        </div>

        <div class="pop_up-buttons mt-4">
            <button class="pop_up-button" type="button" @click="if(currentStep > 1) currentStep--" x-bind:disabled="currentStep === 1">
                Назад
            </button>

            <template x-if="currentStep < 4">
                <button class="pop_up-button" type="button" @click="if (validateStep(currentStep)) currentStep++">
                    Далее
                </button>
            </template>

            <template x-if="currentStep === 4">
                <button class="pop_up-button" type="button" wire:click="submitData">
                    Отправить
                </button>
            </template>
        </div>
    </div>
</div>

<script>
    function validateStep(step) {
        if (step === 1 && !document.querySelector('input[name="q1"]:checked')) {
            alert("Выберите вариант в вопросе 1");
            return false;
        }
        if (step === 2 && !document.querySelector('input[name="q2"]:checked')) {
            alert("Выберите вариант в вопросе 2");
            return false;
        }
        if (step === 3 && !document.querySelector('input[name="q3"]:checked')) {
            alert("Выберите вариант в вопросе 3");
            return false;
        }
        return true;
    }

    Livewire.on('popup-submitted', () => {
        document.getElementById('modal').style.display = 'none';
        alert('Спасибо! Данные отправлены.');
    });
</script>
