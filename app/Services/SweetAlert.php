<?php


namespace App\Services;


use Livewire\Component;

class SweetAlert
{
    private const NAME = 'toastr';

    private const TYPE_SUCCESS = 'success';

    private const TYPE_ERROR = 'error';

    /**
     * Alert success
     * @param Component $component
     * @param string $message
     * @return void
     */
    public static function alertSuccess(Component $component, string $message)
    {
        $component->emit(self::NAME, self::TYPE_SUCCESS, $message);
    }

    /**
     * Alert error
     * @param Component $component
     * @param string $message
     * @return void
     */
    public static function alertError(Component $component, string $message)
    {
        $component->emit(self::NAME, self::TYPE_ERROR, $message);
    }
}