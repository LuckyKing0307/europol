<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $open = false;
    public $currentLanguage;
    public $currentFlag;

    public $languages = [
        'ru' => 'Русский',
        'uz' => 'O‘zbek',
    ];

    public function mount()
    {
        $this->currentLanguage = session('locale', config('app.locale'));
        $this->currentFlag = $this->currentLanguage;
    }

    public function toggleDropdown()
    {
        $this->open = !$this->open;
    }

    public function switchLanguage($lang)
    {
        session()->put('locale', $lang);
        $this->currentLanguage = $lang;
        $this->currentFlag = $lang;

        return redirect()->to(request()->header('Referer') ?? '/');
        // Можешь перезагрузить страницу чтобы применились переводы
    }
    public function render()
    {
        return view('livewire.language-switcher');
    }
}
