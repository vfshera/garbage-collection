<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OrderReportView extends Component
{

    public $reportType;
    public $orders;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($reportType,$orders)
    {
        $this->reportType = $reportType;
        $this->orders = $orders;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order-report-view');
    }
}