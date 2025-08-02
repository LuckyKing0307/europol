<div class="pop_up-overlay" id="modal" x-data="{ currentStep: 1 }">
    <div class="pop_up-modal">
        <div class="pop_up_exit">
            <p class="pop_up_sub_text">Идеальный пол для любого помещения</p>
            <button class="pop_up-close-btn" @click="document.getElementById('modal').style.display = 'none'">×</button>
        </div>
       <div class="pop_up_sub_modal">
           <p class="pop_up_text">Ответьте на 4 вопроса и получите идеальный вариант под Вас и скидку 10% на вашу 1 покупку!</p>
           <div class="pop_up-progress-bar">
               <div class="pop_up-progress-fill" :style="{ width: ((currentStep - 1) / 3 * 100) + '%' }"></div>
           </div>
           <div class="pop_up-step" x-show="currentStep === 1" x-cloak>
               <h3 class="pop_up_text">Для какого помещения нужно напольное покрытие?</h3>
               <div class="image-radio-options">
                   <label class="image-radio-option">
                       <input type="radio" wire:model="q1" name="q1" value="Квартира" class="hidden">
                       <img loading="lazy" src="{{asset('popup/gost.webp')}}" alt="Квартира">
                       <span class="select_pop_up">Квартира</span>
                   </label>
                   <label class="image-radio-option">
                       <input type="radio" wire:model="q1" name="q1" value="Дача(участок)" class="hidden">
                       <img loading="lazy" src="{{asset('popup/docha.webp')}}" alt="Дача(участок)">
                       <span class="select_pop_up">Дача(участок)</span>
                   </label>

                   <label class="image-radio-option">
                       <input type="radio" wire:model="q1" name="q1" value="Коммерческое помещение" class="hidden">
                       <img loading="lazy" src="{{asset('popup/ofice.webp')}}" alt="Коммерческое помещение">
                       <span class="select_pop_up">Коммерческое помещение</span>
                   </label>
               </div>
           </div>

           <div class="pop_up-step" x-show="currentStep === 2" x-cloak>
               <h3 class="pop_up_text">Выберите цвет напольного покрытия</h3>
               <div class="image-radio-options">
                   <label class="image-radio-option">
                       <input type="radio" wire:model="q2" name="q2" value="Белый" class="hidden">
                       <img loading="lazy" src="{{asset('popup/Beliy.webp')}}" alt="Белый">
                       <span class="select_pop_up">Белый</span>
                   </label>
                   <label class="image-radio-option">
                       <input type="radio" wire:model="q2" name="q2" value="Натуральный" class="hidden">
                       <img loading="lazy" src="{{asset('popup/Naturalniy.webp')}}" alt="Натуральный">
                       <span class="select_pop_up">Натуральный</span>
                   </label>

                   <label class="image-radio-option">
                       <input type="radio" wire:model="q2" name="q2" value="Красный" class="hidden">
                       <img loading="lazy" src="{{asset('popup/krasniy.webp')}}" alt="Красный">
                       <span class="select_pop_up">Красный</span>
                   </label>

                   <label class="image-radio-option">
                       <input type="radio" wire:model="q2" name="q2" value="Коричневый" class="hidden">
                       <img loading="lazy" src="{{asset('popup/brown.webp')}}" alt="Коричневый">
                       <span class="select_pop_up">Коричневый</span>
                   </label>

                   <label class="image-radio-option">
                       <input type="radio" wire:model="q2" name="q2" value="Серый" class="hidden">
                       <img loading="lazy" src="{{asset('popup/gray.webp')}}" alt="Серый">
                       <span class="select_pop_up">Серый</span>
                   </label>

                   <label class="image-radio-option">
                       <input type="radio" wire:model="q2" name="q2" value="Черный" class="hidden">
                       <img loading="lazy" src="{{asset('popup/black.webp')}}" alt="Черный">
                       <span class="select_pop_up">Черный</span>
                   </label>
               </div>
           </div>

           <div class="pop_up-step" x-show="currentStep === 3" x-cloak>
               <h3>Вопрос 3:</h3>
               <div class="image-radio-options">
                   <label class="image-radio-option">
                       <input type="radio" wire:model="q3" name="q3" value="Паркет" class="hidden">
                       <img loading="lazy" src="{{asset('popup/Parket.webp')}}" alt="Паркет">
                       <span class="select_pop_up">Паркет</span>
                   </label>
                   <label class="image-radio-option">
                       <input type="radio" wire:model="q3" name="q3" value="Ламинат" class="hidden">
                       <img loading="lazy" src="{{asset('popup/Laminate.webp')}}" alt="Ламинат">
                       <span class="select_pop_up">Ламинат</span>
                   </label>

                   <label class="image-radio-option">
                       <input type="radio" wire:model="q3" name="q3" value="ПВХ/SPC" class="hidden">
                       <img loading="lazy" src="{{asset('popup/pvx.webp')}}" alt="ПВХ/SPC">
                       <span class="select_pop_up">ПВХ/SPC</span>
                   </label>

                   <label class="image-radio-option">
                       <input type="radio" wire:model="q3" name="q3" value="Ковролин" class="hidden">
                       <img loading="lazy" src="{{asset('popup/kovrolin.webp')}}" alt="Ковролин">
                       <span class="select_pop_up">Ковролин</span>
                   </label>
               </div>
           </div>

           <div class="pop_up-step" x-show="currentStep === 4" x-cloak>
               <input type="text" placeholder="Телефон" wire:model="phone" class="pop_up-input">
               <input type="text" placeholder="Имя" wire:model="name" class="pop_up-input">
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
</div>

@push('scripts')
    <script defer>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(()=>{
                document.querySelector('.pop_up-overlay').style.display = 'flex';
            },15000)
        });
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
@endpush
