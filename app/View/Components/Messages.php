<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Messages extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $parentClass;

    public function __construct($parentClass)
    {
        $this->parentClass = $parentClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.messages');
    }
}