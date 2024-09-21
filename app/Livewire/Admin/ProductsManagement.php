<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProductsManagement extends Component
{
    public function render()
    {
        return view('livewire.admin.products-management');
    }
}
