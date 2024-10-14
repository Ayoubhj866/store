<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ProductsManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    public $filterDrawer = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public $categories = [];

    public $brands = [];

    public $headers = [
        ['key' => 'image', 'label' => '', 'sortable' => false],
        ['key' => 'id', 'label' => '#', 'class' => 'w-16', 'sortable' => false],
        ['key' => 'name', 'label' => 'Name', 'class' => 'w-72'],
        ['key' => 'brand_name', 'label' => 'Brand', 'class' => 'w-72'],
        ['key' => 'category_name', 'label' => 'Category', 'class' => 'w-72'],
        ['key' => 'price', 'label' => 'Price', 'class' => 'w-72'],
    ];

    public function updating($property, $value)
    {
        if ($property === 'categories') {
            $this->categories[] = $value;
        }

        if ($property === 'brands') {
            $this->brands[] = $value;
        }
    }

    #[Computed]
    public function getBrands()
    {
        return Brand::all();
    }

    #[Computed]
    public function getCategories()
    {
        return Category::all();
    }

    #[Computed]
    public function products()
    {
        return Product::with('category', 'brand')
            ->where('name', 'like', '%'.$this->search.'%')
            ->withAggregate('brand', 'name')
            ->withAggregate('category', 'name')
            ->orderBy(...array_values($this->sortBy))
            ->when(! empty($this->categories), function ($query) {
                return $query->whereIn('category_id', $this->categories);
            })
            ->when(! empty($this->brands), function ($query) {
                return $query->whereIn('brand_id', $this->brands);
            })
            ->paginate(8);
    }

    // *********************CLEAR FILTERS FUNCITIONS --START--
    public function clearCategoryFilter()
    {

        dd('test');
        unset($this->categories);
        $this->categories = [];
    }

    public function clearBrandFilter()
    {
        unset($this->brands);
        $this->brands = [];
    }

    public function clearFilter()
    {
        unset($this->brands);
        $this->brands = [];

        unset($this->categories);
        $this->categories = [];
    }
    // *********************CLEAR FILTERS FUNCITIONS --END--

    public function render()
    {
        return view('livewire.admin.products-management');
    }
}
