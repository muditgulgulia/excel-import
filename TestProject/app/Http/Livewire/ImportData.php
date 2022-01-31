<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\DatabaseService;

class ImportData extends Component
{
    public $headers = [
        'Name',
        'Email',
        'Number',
        'Address'
    ];

    public $tables = [];

    public function render(DatabaseService $databaseService)
    {
        $tables = $databaseService->tables();
        return view('livewire.import-data');
    }
}
