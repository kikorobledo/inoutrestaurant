<?php

namespace App\Http\Livewire;

use App\Models\Extra;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminExtras extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $modal = false;
    public $modalDelete = false;
    public $createBtn = false;
    public $edit = false;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $extra;
    public $extra_id;
    public $extra_number;
    public $name;
    public $price;
    public $selected_products = [];

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
            'price' => 'required',
        ];
    }

    public function render()
    {
        if(auth()->user()->role == 1){
            $extras = Extra::with('products','createdBy','updatedBy')->where('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('price', 'LIKE', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

            $products = Product::where('stock', -1)->orderBy('name')->get();


        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $extras = Extra::with('products','createdBy','updatedBy')->where('establishment_id', '=', auth()->user()->establishment->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('price', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

            $products = Product::where('establishment_id', '=', auth()->user()->establishment->id)->where('stock', -1)->orderBy('name')->get();

        }
        else{
            $extras = Extra::with('products','createdBy','updatedBy')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('price', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

            $products = Product::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->where('stock', -1)->orderBy('name')->get();

        }

        return view('livewire.admin-extras', compact('extras', 'products'));
    }

    public function openModalCreate(){

        $this->reset('name','price','selected_products');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->edit = false;
        $this->createBtn = true;
        $this->modal = true;
    }

    public function openModalEdit($extra){
        $this->reset('name','price','selected_products');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->extra_id = $extra['id'];
        $this->name = $extra['name'];
        $this->price = $extra['price'];
        foreach ($extra['products'] as $product) {
            array_push($this->selected_products, (string)$product['id']);
        }

        $this->createBtn = false;
        $this->edit = true;
        $this->modal = true;
    }

    public function openModalDelete($extra){

        $this->modalDelete = true;
        $this->extra_id = $extra['id'];
    }

    public function closeModal(){
        $this->reset('name','price','selected_products');
        $this->modalDelete = false;
        $this->modal = false;
    }

    public function create(){

        $this->validate();

        if(auth()->user()->role == 1){
            $this->extra_number = Extra::where('created_by', 1)->latest()->first();
        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $this->extra_number = Extra::where('establishment_id', '=', auth()->user()->establishment->id)->latest()->first();
        }else{
            $this->extra_number = Extra::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->latest()->first();
        }

        try {

            $extra = Extra::create([
                'extra_number' => $this->extra_number == null ? 1 : $this->extra_number->extra_number + 1,
                'name' => $this->name,
                'price' => $this->price,
                'created_by' => auth()->user()->id,
                'establishment_id' => auth()->user()->establishment ? auth()->user()->establishment->id : auth()->user()->establishmentBelonging->id
            ]);

            $extra->products()->attach($this->selected_products);

            $this->dispatchBrowserEvent('showMessage',['success', "El extra ha sido creado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function update(){

        $this->validate();

        $extra = Extra::findorFail($this->extra_id);

        try {
            $extra->update([
                'name' => $this->name,
                'price' => $this->price,
                'updated_by' => auth()->user()->id,
            ]);

            $extra->products()->sync($this->selected_products);

            /* $this->closeModal(); */

            $this->dispatchBrowserEvent('showMessage',['success', "El extra ha sido actualizado con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function delete(){

        $extra = Extra::findorFail($this->extra_id);

        try {

            $extra->extras()->detach();
            $extra->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "El extra ha sido eliminado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }

    }
}
