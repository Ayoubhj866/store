<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsListe extends Component
{
    use WithPagination;

    public $category = [];

    public $perpage = 8;

    #[Url(as: 'q')]
    public $search = '';

    public $brand = [];

    public function loadMore()
    {
        sleep(1);
        $this->perpage += 8;
    }

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
            ->paginate($this->perpage);
    }

    public function render()
    {
        return view('livewire.products-liste');
    }
}
