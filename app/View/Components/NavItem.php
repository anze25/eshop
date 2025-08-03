<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavItem extends Component
{
    public string $icon;
    public string $text;
    public ?string $route;
    public array $subMenu;

    public function __construct(string $icon, string $text, ?string $route = null, array $subMenu = [])
    {
        // dd($text); // Check if it's an array
        $this->icon = $icon;
        $this->text = is_array($text) ? implode(' ', $text) : $text;
        $this->route = $route;
        $this->subMenu = $subMenu;
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.nav-item');
    }
}
