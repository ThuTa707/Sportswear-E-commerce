<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
   
    public $name, $type, $value, $getClass;

    public function __construct($name, $type, $value=null, $getClass=null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->getClass = $getClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
