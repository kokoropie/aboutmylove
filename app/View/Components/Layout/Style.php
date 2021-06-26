<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Style extends Component
{
    /**
     * Name page.
     *
     * @var string
     */
    public $namePage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($namePage)
    {
        $this->namePage = $namePage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.layout.style');
    }
}
