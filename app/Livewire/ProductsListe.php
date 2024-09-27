<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProductsListe extends Component
{
    public $category = [];

    #[Url(as: 'q')]
    public $search = '';

    public $brand = [];

    public function updating($property, $value)
    {
        if ($property === 'category') {
            $this->category[] = $value;
        }

        if ($property === 'brand') {
            $this->brand[] = $value;
        }
    }

    public function clearCategoryFilter()
    {
        unset($this->category);
        $this->category = [];
    }

    public function clearBrandFilter()
    {
        unset($this->brand);
        $this->brand = [];
    }

    public function clearFilter()
    {
        unset($this->brand);
        $this->brand = [];

        unset($this->category);
        $this->category = [];
    }

    #[Computed]
    public function products()
    {
        return Product::where('name', 'like', '%'.$this->search.'%')
            ->when(! empty($this->category), function ($query) {
                return $query->whereIn('category', $this->category);
            })
            ->when(! empty($this->brand), function ($query) {
                return $query->whereIn('brand', $this->brand);
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.products-liste');
    }
}
