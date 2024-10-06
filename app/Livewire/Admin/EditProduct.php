<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Mary\Traits\Toast;

#[Layout('layouts/app')]
class EditProduct extends Component
{
    use Toast , WithFileUploads;

    #[Validate()]
    public Product $product;

    #[Validate()]
    public $brandId;

    #[Validate()]
    public $categoryId;

    #[Validate()]
    public $name;

    #[Validate()]
    public $price;

    #[Validate()]
    public $image;

    #[Validate()]
    public $description;

    // #[Rule('required|max:10')]
    public $file;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:25'],
            'price' => ['required'],
            'image' => [],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'categoryId' => ['required', 'exists:categories,id'],
            'brandId' => ['required', 'exists:brands,id'],
        ];
    }

    public function mount()
    {
        $this->brandId = $this->product->brand->id;
        $this->categoryId = $this->product->category->id;
        $this->name = $this->product->name;
        $this->price = $this->product->price;
        $this->image = $this->product->image;
        $this->description = $this->product->description;
    }

    #[Computed]
    public function brands()
    {
        return Brand::all();
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }

    public function saveChanges()
    {
        $validatedData = $this->validate();

        // check if the image chaged
        if ($this->image instanceof TemporaryUploadedFile) {
            $validatedData['image'] = Storage::disk('public')->putFile('productsImages', $this->image);
        }

        // save changes
        $this->product->update(Arr::only($validatedData, ['image', 'name', 'price', 'description']));

        $this->product->category()->associate($validatedData['categoryId']);
        $this->product->brand()->associate($validatedData['brandId']);
        $this->product->save();

        //flash message
        $this->success(
            'Product updated !',
            position: 'bottom-end',
            redirectTo: '/products'
        );
    }

    public function render()
    {
        return view('livewire.admin.edit-product');
    }
}
