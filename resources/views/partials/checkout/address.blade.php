<form wire:submit="saveAddress('{{ $type }}')"
      class="bg-white border border-gray-100 rounded-xl">
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-100">
        <h3 class="text-lg font-medium">
            {{ ucfirst($type) }} {{ __('address.details') }}
        </h3>

        @if ($type == 'shipping' && $step == $currentStep)
            <label class="flex items-center p-2 rounded-lg cursor-pointer hover:bg-gray-50">
                <input class="w-5 h-5 text-green-600 border-gray-100 rounded"
                       type="checkbox"
                       value="1"
                       wire:model.live="shippingIsBilling" />

                <span class="ml-2 text-xs font-medium">
                    {{ __('address.same_as_billing') }}
                </span>
            </label>
        @endif

        @if ($currentStep > $step)
            <button class="px-5 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-700"
                    type="button"
                    wire:click.prevent="$set('currentStep', {{ $step }})">
                {{ __('address.edit') }}
            </button>
        @endif
    </div>

    @if ($currentStep >= $step)
        <div class="p-6">
            @if ($step == $currentStep)
                <div class="grid grid-cols-6 gap-4">
                    <x-input.group class="col-span-3"
                                   label="{{ __('address.first_name') }}"
                                   :errors="$errors->get($type . '.first_name')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.first_name"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-3"
                                   label="{{ __('address.last_name') }}"
                                   :errors="$errors->get($type . '.last_name')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.last_name"
                                      required />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3"
                                   label="{{ __('address.contact_phone') }}"
                                   :errors="$errors->get($type . '.contact_phone')">
                        <x-input.text wire:model.live="{{ $type }}.contact_phone" />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3"
                                   label="{{ __('address.contact_email') }}"
                                   :errors="$errors->get($type . '.contact_email')"
                                   required>
                        <x-input.text wire:model.live="{{ $type }}.contact_email"
                                      type="email"
                                      required />
                    </x-input.group>

                </div>
            @elseif($currentStep > $step)
                <dl class="grid grid-cols-1 gap-8 text-sm sm:grid-cols-2">
                    <div>
                        <div class="space-y-4">
                            <div>
                                <dt class="font-medium">
                                    {{ __('address.first_name') }} {{ __('address.last_name') }}
                                </dt>
                                <dd class="mt-0.5">
                                    {{ $this->{$type}->first_name }} {{ $this->{$type}->last_name }}
                                </dd>
                            </div>

                            @if ($this->{$type}->company_name)
                                <div>
                                    <dt class="font-medium">
                                        {{ __('address.company_name') }}
                                    </dt>
                                    <dd class="mt-0.5">
                                        {{ $this->{$type}->company_name }}
                                    </dd>
                                </div>
                            @endif

                            @if ($this->{$type}->contact_phone)
                                <div>
                                    <dt class="font-medium">
                                        {{ __('address.contact_phone') }}
                                    </dt>
                                    <dd class="mt-0.5">
                                        {{ $this->{$type}->contact_phone }}
                                    </dd>
                                </div>
                            @endif

                            <div>
                                <dt class="font-medium">
                                    {{ __('address.contact_email') }}
                                </dt>
                                <dd class="mt-0.5">
                                    {{ $this->{$type}->contact_email }}
                                </dd>
                            </div>
                        </div>
                    </div>

                    <div>
                        <dt class="font-medium">
                            {{ __('address.line_one') }}
                        </dt>
                        <dd class="mt-0.5">
                            {{ $this->{$type}->line_one }}<br>
                            @if ($this->{$type}->line_two)
                                {{ $this->{$type}->line_two }}<br>
                            @endif
                            @if ($this->{$type}->line_three)
                                {{ $this->{$type}->line_three }}<br>
                            @endif
                            @if ($this->{$type}->city)
                                {{ $this->{$type}->city }}<br>
                            @endif
                            @if ($this->{$type}->state)
                                {{ $this->{$type}->state }}<br>
                            @endif
                            {{ $this->{$type}->postcode }}<br>
                            {{ $this->{$type}->country?->native }}
                        </dd>
                    </div>
                </dl>
            @endif

            @if ($step == $currentStep)
                <div class="mt-6 text-right">
                    <button class="px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500"
                            type="submit"
                            wire:key="submit_btn"
                            wire:loading.attr="disabled"
                            wire:target="saveAddress">
                        <span wire:loading.remove wire:target="saveAddress">
                            {{ __('address.save_address') }}
                        </span>
                        <span wire:loading wire:target="saveAddress">
                            {{ __('address.saving') }}
                        </span>
                    </button>
                </div>
            @endif
        </div>
    @endif
</form>
