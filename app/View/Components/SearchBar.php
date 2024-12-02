<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBar extends Component
{
    public $users;
    public $info;

    /**
     * Create a new component instance.
     */
    public function __construct($users, $info)
    {
        $this->users = $users;
        $this->info = $info;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-bar');
    }
}
