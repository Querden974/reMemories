<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContextMenuArticle extends Component
{
    public $memory;

    public function __construct($memory)
    {
        $this->memory = $memory;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.context-menu-article');
    }
}
