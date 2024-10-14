<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Mary\Traits\Toast;

#[Layout('layouts/app')]
class CreateProduct extends Component
{
    use Toast , WithFileUploads;

    #[Validate()]
    public $name;

    #[Validate()]
    public $description;

    #[Validate()]
    public $price;

    #[Validate()]
    public $image;

    #[Validate()]
    public $categoryId;

    #[Validate()]
    public $brandId;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:25', 'unique:products,name'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'mimes:png,jpg,jpeg'],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'categoryId' => ['required', 'exists:categories,id'],
            'brandId' => ['required', 'exists:brands,id'],
        ];
    }

    #[Computed()]
    public function brands()
    {
        return Brand::all();
    }

    #[Computed()]
    public function categories()
    {
        return Category::all();
    }

    /**
     * create : create new product on database
     *
     * @return void
     */
    public function create()
    {
        $validatedData = $this->validate();

        DB::beginTransaction();

        try {
            $product = Product::create(
                [
                    'name' => $validatedData['name'],
                    'description' => $validatedData['description'],
                    'price' => $validatedData['price'],
                    'category_id' => $validatedData['categoryId'],
                    'brand_id' => $validatedData['brandId'],
                    'image' => Storage::disk('public')->putFile('productsImages', $validatedData['image']),
                ]
            );
            // // store image
            // $validatedData['image'] = Storage::disk('public')->putFile('productsImages', $validatedData['image']);

            // save
            $product->save();

            DB::commit();

            $this->success(
                title: 'Product create with success',
                position: 'bottom-end',
                redirectTo: '/products'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $this->error(
                title: 'Erro when creating product : '.$th->getMessage(),
                position: 'bottom-end',
                redirectTo: '/products'
            );
        }

    }

    public function render()
    {
        return view('livewire.admin.create-product');
    }
}
