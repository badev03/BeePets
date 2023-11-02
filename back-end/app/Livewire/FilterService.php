<?php

namespace App\Livewire;

use App\Traits\QueryCommon;
use Livewire\Component;

class FilterService extends Component
{
    use QueryCommon;
    public $service_id;
    public $dataService;
    public $dataFilterService;
    public function render()
    {
        $this->dataFilterService=1;
        return view('livewire.filter-service');
    }
    public function Service() {
        $this->dataFilterService;
    }

}
