<div
    x-data
    @enquiry-sent.window="
        $dispatch('notify', {text: 'Спасибо! Ваша заявка принята.'});
    "
    class="max-w-sm p-6 space-y-4" style="width: 50%; max-width: none;"
>

    <div class="container">
        <div class="warranty-form__wrapper">
    <form wire:submit.prevent="submit" class="space-y-4 warranty__form">
        <input type="text" wire:model.defer="name" placeholder="Имя"
               class="warranty-form__input"/>
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <input type="text" wire:model.defer="phone" placeholder="Телефон"
               class="warranty-form__input"/>
        @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <input type="email" wire:model.defer="email" placeholder="Электронная почта"
               class="warranty-form__input"/>
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <textarea rows="3" wire:model.defer="message" placeholder="Сообщение"
                  class="warranty-form__textarea"></textarea>
        @error('message') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <button type="submit"
                class="warranty-form__button"
                style="background: #000;">
            Отправить
        </button>
    </form>
        </div>
    </div>
</div>
