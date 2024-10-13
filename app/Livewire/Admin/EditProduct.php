<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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

    public function delete()
    {
        //AUTORISATION
        try {
            $this->product->delete();
            $this->toast('info', 'product deleted with success !', position: 'bottom-end',
                redirectTo: '/products');
        } catch (\Throwable $th) {
            $this->toast('error', "we can't delete this product", position: 'bottom-end');
        }
    }

    /**
     * saveChanges : save updated changes
     *
     * @return void
     */
    public function saveChanges()
    {
        $validatedData = $this->validate();

        // Begin database transation
        DB::beginTransaction();

        try {
            // check if another image is selected
            if ($this->image instanceof TemporaryUploadedFile) {
                // store the new image and get the path
                $validatedData['image'] = Storage::disk('public')->putFile('productsImages', $this->image);

                // delete the old image
                Storage::disk('public')->delete($this->product->image);
            }

            // save changes
            $this->product->update(Arr::only($validatedData, ['image', 'name', 'price', 'description']));

            // associated with new category
            $this->product->category()->associate($validatedData['categoryId']);

            // associate it with new brand
            $this->product->brand()->associate($validatedData['brandId']);

            // save changes
            $this->product->save();

            DB::commit();

            //flash message with redirect
            $this->success(
                'Product updated with success !',
                position: 'bottom-end',
                redirectTo: '/products'
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->error(
                'Error updating product !',
                position: 'bottom-end',
                // redirectTo: '/products'
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-product');
    }
}
