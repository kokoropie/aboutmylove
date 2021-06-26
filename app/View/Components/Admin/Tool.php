<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Tool extends Component
{
    /**
     * Active name
     *
     * @var string
     */
    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active)
    {
        $this->active = mb_strtolower(trim($active), "UTF-8");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.tool');
    }
}
