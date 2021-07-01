<?php

namespace App\Http\Livewire;

use App\Models\Extra;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class AdminProducts extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $modal = false;
    public $modalDelete = false;
    public $create = false;
    public $edit = false;
    public $message;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $product;
    public $product_id;
    public $name;
    public $description;
    public $image_url;
    public $image;
    public $stock;
    public $purchase_price;
    public $sale_price;
    public $category_id;
    public $selected_extras = [];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function order($sort){

        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    protected function rules(){
        return[
            'name' => 'required',
            'description' => 'min:3|max:1000',
            'stock' => 'required|integer',
            'purchase_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'sale_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'category_id' => 'required'
        ];
    }

    public function mount(){
        $this->product = new Product();
    }

    public function render()
    {
        if(auth()->user()->role == 1){
            $products = Product::with('createdBy','updatedBy','category')->where('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('stock', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('purchase_price', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('sale_price', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('category_id', 'LIKE', '%' . $this->search . '%')
                            ->orWhere(function($q){
                                return $q->whereHas('category', function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

            $categories = Category::all();

            $extras = Extra::orderBy('name')->get();

        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $products = Product::with('createdBy','updatedBy','category')->where('establishment_id', '=', auth()->user()->establishment->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('description', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('stock', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('purchase_price', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('sale_price', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('category_id', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('category', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

            $categories = Category::where('establishment_id', '=', auth()->user()->establishment->id)->get();

            $extras = Extra::where('establishment_id', '=', auth()->user()->establishment->id)->orderBy('name')->get();
        }
        else{
            $products = Product::with('createdBy','updatedBy','category')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('description', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('stock', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('purchase_price', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('sale_price', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('category_id', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('category', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

            $categories = Category::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->get();

            $extras = Extra::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->orderBy('name')->get();
        }

        return view('livewire.admin-products', compact('products', 'categories', 'extras'));
    }

    public function openModalCreate(){

        $this->reset('name','description','stock', 'purchase_price', 'sale_price', 'category_id', 'image', 'selected_extras');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->edit = false;
        $this->create = true;
        $this->modal = true;

        $this->dispatchBrowserEvent('openModal', ['stock' => $this->stock]);
    }

    public function openModalEdit($product){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->product = Product::findorFail($product['id']);

        $this->product_id = $product['id'];

        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->stock = $this->product->stock;
        $this->purchase_price = $this->product->purchase_price;
        $this->sale_price = $this->product->sale_price;
        $this->category_id = $this->product->category_id;
        $this->image_url = $this->product->image_url;
        foreach ($this->product->extras as $extra) {
            array_push($this->selected_extras, (string)$extra->id);
        }

        $this->dispatchBrowserEvent('openModal', ['stock' => $this->stock]);

        $this->create = false;
        $this->edit = true;
        $this->modal = true;



    }

    public function openModalDelete($product){

        $this->modalDelete = true;
        $this->product_id = $product['id'];
    }

    public function closeModal(){
        $this->reset('name','description','stock', 'purchase_price', 'sale_price', 'category_id', 'image', 'selected_extras');
        $this->modal = false;
        $this->modalDelete = false;
        $this->create = false;
        $this->edit = false;
    }

    public function create(){

        $this->validate();

        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
            'category_id' => $this->category_id,
            'created_by' => auth()->user()->id,
            'establishment_id' => auth()->user()->establishment ? auth()->user()->establishment->id : auth()->user()->establishmentBelonging->id
        ]);

        if($this->image != null){
            $this->validate([
                'image' => 'image|max:1024|mimes:jpeg,png,jpg',
            ]);

            $image_rute = $this->image->store('product_images', 'public');

            $product->update(['image_url' => $image_rute]);
        }


        $product->extras()->attach($this->selected_extras);


        $this->message = "El producto ha sido creado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function update(){

        /* $client = Client::findorFail($this->client_id); */

        $this->validate();

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
            'category_id' => $this->category_id,
            'updated_by' => auth()->user()->id,
        ]);

        if($this->image){

            $this->validate([
                'image' => 'image|max:1024|mimes:jpeg,png,jpg',
            ]);

            $image_rute = $this->image->store('product_images', 'public');

            if($this->product->image_url){

                if(File::exists('storage/' . $this->product->image_url)){
                    File::delete('storage/' . $this->product->image_url);
                }

                $this->product->update([
                    'image_url' => $image_rute,
                ]);

            }else{

                $this->product->update([
                    'image_url' => $image_rute,
                ]);
            }

        }

        $this->product->extras()->sync($this->selected_extras);


        $this->message = "El producto ha sido actualizado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function delete(){

        $product = Product::findorFail($this->product_id);
        $product->extras()->detach();
        $product->delete();

        $this->message = "El producto ha sido eliminado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }
}
