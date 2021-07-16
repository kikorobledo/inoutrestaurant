<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class AdminCategories extends Component
{
    use WithPagination;

    public $modal = false;
    public $modalDelete = false;
    public $create = false;
    public $edit = false;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $category_id;
    public $category_number;
    public $name;

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
        ];
    }

    public function render()
    {

        if(auth()->user()->role == 1){
            $categories = Category::with('createdBy','updatedBy')->where('name', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate(10);

        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $categories = Category::with('createdBy','updatedBy')->where('establishment_id', '=', auth()->user()->establishment->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

        }else{
            $categories = Category::with('createdBy','updatedBy')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

        }

        return view('livewire.admin-categories', compact('categories'));
    }

    public function openModalCreate(){

        $this->reset('name');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->edit = false;
        $this->modal = true;
        $this->create = true;
    }

    public function openModalEdit($category){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;
        $this->modal = true;
        $this->edit = true;

        $this->category_id = $category['id'];
        $this->name = $category['name'];
    }

    public function openModalDelete($category){

        $this->modalDelete = true;
        $this->category_id = $category['id'];
    }

    public function closeModal(){
        $this->reset('name');
        $this->modal = false;
        $this->modalDelete = false;
    }

    public function create(){

        $this->validate();

        if(auth()->user()->role == 1){
            $this->category_number = Category::where('created_by', 1)->latest()->first();
        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $this->category_number = Category::where('establishment_id', '=', auth()->user()->establishment->id)->latest()->first();
        }else{
            $this->category_number = Category::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->latest()->first();
        }

        try {

            $category = Category::create([
                'category_number' => $this->category_number == null ? 1 : $this->category_number->category_number + 1,
                'name' => $this->name,
                'created_by' => auth()->user()->id,
                'establishment_id' => auth()->user()->establishment ? auth()->user()->establishment->id : auth()->user()->establishmentBelonging->id
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La categoría ha sido creada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);
            $this->closeModal();
        }
    }

    public function update(){

        $category = Category::findorFail($this->category_id);

        $this->validate();

        try {

            $category->update([
                'name' => $this->name,
                'updated_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La categoría ha sido actualizada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function delete(){

        $category = Category::findorFail($this->category_id);

        try {

            $category->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "La categoría ha sido eliminada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }
}
