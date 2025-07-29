<div class="pop_up-overlay" id="modal" x-data="{ currentStep: 1 }">
    <div class="pop_up-modal">
        <button class="pop_up-close-btn" @click="document.getElementById('modal').style.display = 'none'">×</button>

        <!-- Прогресс-бар -->
        <div class="pop_up-progress-bar">
            <div class="pop_up-progress-fill" :style="{ width: ((currentStep - 1) / 3 * 100) + '%' }"></div>
        </div>

        <!-- Шаг 1 -->
        <div class="pop_up-step" x-show="currentStep === 1" x-cloak>
            <h3>Вопрос 1:</h3>
            <p>Как вы о нас узнали?</p>
            <label class="pop_up-label"><input type="radio" wire:model="q1" name="q1" value="Google"> Google</label>
            <label class="pop_up-label"><input type="radio" wire:model="q1" name="q1" value="Instagram"> Instagram</label>
            <label class="pop_up-label"><input type="radio" wire:model="q1" name="q1" value="Друзья"> Друзья</label>
        </div>

        <!-- Шаг 2 -->
        <div class="pop_up-step" x-show="currentStep === 2" x-cloak>
            <h3>Вопрос 2:</h3>
            <p>Что вам важно при выборе?</p>
            <label class="pop_up-label"><input type="radio" wire:model="q2" name="q2" value="Цена"> Цена</label>
            <label class="pop_up-label"><input type="radio" wire:model="q2" name="q2" value="Качество"> Качество</label>
            <label class="pop_up-label"><input type="radio" wire:model="q2" name="q2" value="Скорость доставки"> Скорость доставки</label>
        </div>

        <!-- Шаг 3 -->
        <div class="pop_up-step" x-show="currentStep === 3" x-cloak>
            <h3>Вопрос 3:</h3>
            <p>Вы бы рекомендовали нас?</p>
            <label class="pop_up-label"><input type="radio" wire:model="q3" name="q3" value="Да"> Да</label>
            <label class="pop_up-label"><input type="radio" wire:model="q3" name="q3" value="Нет"> Нет</label>
            <label class="pop_up-label"><input type="radio" wire:model="q3" name="q3" value="Пока не знаю"> Пока не знаю</label>
        </div>

        <!-- Шаг 4 -->
        <div class="pop_up-step" x-show="currentStep === 4" x-cloak>
            <h3>Ваш номер:</h3>
            <input type="text" placeholder="+998901234567" wire:model="phone" class="pop_up-input">
            <h3>Ваше Имя:</h3>
            <input type="text" placeholder="Алишер Авазов" wire:model="name" class="pop_up-input">
        </div>

        <!-- Кнопки -->
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
