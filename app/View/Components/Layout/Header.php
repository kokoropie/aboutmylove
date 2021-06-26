<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Name page
     *
     * @var string
     */
    public $namePage;
    
    /**
     * List active navbar
     *
     * @var array
     */
    public $activeNavbar;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($namePage, $activeNavbar)
    {
        $this->namePage = $namePage;
        $this->activeNavbar = $activeNavbar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.layout.header');
    }
}
