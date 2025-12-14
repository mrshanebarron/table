<?php

namespace MrShaneBarron\table\View\Components;

use Illuminate\View\Component;

class table extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('ld-table::components.table');
    }
}
