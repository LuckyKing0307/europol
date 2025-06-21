<form wire:submit="save" class="border rounded shadow-lg">
    <div class="flex justify-between p-4 font-medium border-b">
        <span class="text-xl">{{ ucfirst($type) }} {{ __('address.details') }}</span>
        @if ($type == 'shipping' && $editing)
            <label class="text-sm">
                <input type="checkbox" value="1" wire:model.live="shippingIsBilling" />
                {{ __('address.same_as_billing') }}
            </label>
        @endif
    </div>
    <div class="p-4 space-y-4">
        @if ($editing)
            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="{{ __('address.first_name') }}" :errors="$errors->get('address.first_name')" required>
                    <x-input.text wire:model.live="address.first_name" required />
                </x-input.group>

                <x-input.group label="{{ __('address.last_name') }}" :errors="$errors->get('address.last_name')">
                    <x-input.text wire:model.live="address.last_name" />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="{{ __('address.company_name') }}" :errors="$errors->get('address.company_name')" required>
                    <x-input.text wire:model.live="address.company_name" required />
                </x-input.group>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="{{ __('address.contact_phone') }}" :errors="$errors->get('address.contact_phone')">
                    <x-input.text wire:model.live="address.contact_phone" />
                </x-input.group>

                <x-input.group label="{{ __('address.contact_email') }}" :errors="$errors->get('address.contact_email')">
                    <x-input.text wire:model.live="address.contact_email" type="email" />
                </x-input.group>
            </div>

            <hr />

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="{{ __('address.line_one') }}" :errors="$errors->get('address.line_one')" required>
                    <x-input.text wire:model.live="address.line_one" required />
                </x-input.group>

                <x-input.group label="{{ __('address.line_two') }}" :errors="$errors->get('address.line_two')">
                    <x-input.text wire:model.live="address.line_two" />
                </x-input.group>

                <x-input.group label="{{ __('address.line_three') }}" :errors="$errors->get('address.line_three')">
                    <x-input.text wire:model.live="address.line_three" />
                </x-input.group>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="{{ __('address.city') }}" :errors="$errors->get('address.city')" required>
                    <x-input.text wire:model.live="address.city" required />
                </x-input.group>

                <x-input.group label="{{ __('address.state') }}" :errors="$errors->get('address.state')">
                    <x-input.text wire:model.live="address.state" />
                </x-input.group>

                <x-input.group label="{{ __('address.postcode') }}" :errors="$errors->get('address.postcode')" required>
                    <x-input.text wire:model.live="address.postcode" required />
                </x-input.group>
            </div>

            <div>
                <x-input.group label="{{ __('address.country') }}" required>
                    <select class="w-full p-4 text-sm border-2 border-gray-200 rounded-lg" wire:model.live="address.country_id">
                        <option value>Select a country</option>
                        @foreach ($this->countries as $country)
                            <option value="{{ $country->id }}" wire:key="country_{{ $country->id }}">
                                {{ $country->native }}
                            </option>
                        @endforeach
                    </select>
                </x-input.group>
            </div>
        @else
            <dl class="flex">
                <div class="w-1/2">
                    <div class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium">{{ __('address.first_name') }} {{ __('address.last_name') }}</dt>
                            <dd>{{ $address->first_name }} {{ $address->last_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">{{ __('address.company_name') }}</dt>
                            <dd>{{ $address->company_name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">{{ __('address.contact_phone') }}</dt>
                            <dd>{{ $address->contact_phone }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium">{{ __('address.contact_email') }}</dt>
                            <dd>{{ $address->contact_email }}</dd>
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <dt class="text-sm font-medium">{{ __('address.address') }}</dt>
                    <dd>
                        {{ $address->line_one }}<br>
                        @if ($address->line_two)
                            {{ $address->line_two }}<br>
                        @endif
                        @if ($address->line_three)
                            {{ $address->line_three }}<br>
                        @endif
                        @if ($address->city)
                            {{ $address->city }}<br>
                        @endif
                        {{ $address->state }}<br>
                        {{ $address->postcode }}<br>
                        {{ $address->country()->first()->native }}
                    </dd>
                </div>
            </dl>
        @endif
    </div>
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
            @if ($editing)
                <button type="submit" wire:key="submit_btn" class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                    {{ __('address.save') }}
                </button>
            @else
                <button type="button" wire:key="edit_btn" wire:click.prevent="$set('editing', true)" class="px-5 py-3 font-medium bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                    {{ __('address.edit') }}
                </button>
            @endif
        </div>
    </div>
</form>
