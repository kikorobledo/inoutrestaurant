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
    public $message;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $category_id;
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
            'name' => 'required|unique:categories',
        ];
    }

    public function render()
    {

        $categories = Category::where('name', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate(10);

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

        $category = Category::findorFail($this->category_id);

        $this->name = $category->name;
    }

    public function openModalDelete($category){

        $this->modalDelete = true;
        $this->category_id = $category['id'];
    }

    public function create(){

        $this->validate();

        $category = Category::create([
            'name' => $this->name
        ]);

        $this->message = "La categoría ha sido creada con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function update(){

        $category = Category::findorFail($this->category_id);

        $this->validate();

        $category->update([
            'name' => $this->name
        ]);

        $this->message = "La categoría ha sido actualizada con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function delete(){

        $category = Category::findorFail($this->category_id);
        $category->delete();

        $this->message = "La categoría ha sido eliminada con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function closeModal(){
        $this->reset('name');
        $this->modal = false;
        $this->modalDelete = false;
        $this->create = false;
        $this->edit = false;
    }
}