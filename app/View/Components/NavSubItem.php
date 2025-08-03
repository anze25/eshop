<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavSubItem extends Component
{
    public string $text;
    public string $route;

    public function __construct(string $text, string $route)
    {
        $this->text = $text;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.nav-sub-item');
    }
}
