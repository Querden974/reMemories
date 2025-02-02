<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardMemory extends Component
{
    public $memory;
    public $users;
    public $info;

    /**
     * Create a new component instance.
     */
    public function __construct($memory, $users, $info)
    {
        $this->memory = $memory;
        $this->users = $users;
        $this->info = $info;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-memory');
    }
}
