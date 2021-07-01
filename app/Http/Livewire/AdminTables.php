<?php

namespace App\Http\Livewire;

use App\Models\Table;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTables extends Component
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


    public $table_id;
    public $status;
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
            'name' => 'required'
        ];
    }

    public function render()
    {

        if(auth()->user()->role == 1){

            $tables = Table::with('createdBy','updatedBy','establishmentBelonging')->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere(function($q){
                            return $q->whereHas('establishmentBelonging', function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%');
                            });
                        })
                        ->orderBy($this->sort, $this->direction)
                        ->paginate(10);

        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){

            $tables = Table::with('createdBy','updatedBy','establishmentBelonging')->where('establishment_id', '=', auth()->user()->establishment->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('establishmentBelonging', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                            })
                            ->get();
        }
        else{

            $tables = Table::with('createdBy','updatedBy','establishmentBelonging')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('establishmentBelonging', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                            })
                            ->get();
        }

        return view('livewire.admin-tables', compact('tables'));
    }

    public function openModalCreate(){

        $this->reset('status','name', 'table_id');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->edit = false;
        $this->modal = true;
        $this->create = true;
    }

    public function openModalEdit($table){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;
        $this->modal = true;
        $this->edit = true;

        $this->table = Table::findorFail($table['id']);

        $this->table_id = $table['id'];
        $this->name = $this->table->name;
        $this->status = $this->table->status;

    }

    public function openModalDelete($product){

        $this->modalDelete = true;
        $this->product_id = $product['id'];
    }

    public function closeModal(){
        $this->reset('status','name', 'table_id');
        $this->modal = false;
        $this->modalDelete = false;
        $this->create = false;
        $this->edit = false;
    }

    public function create(){

        $this->validate();

        $product = Table::create([
            'name' => $this->name,
            'created_by' => auth()->user()->id,
            'establishment_id' => auth()->user()->establishment ? auth()->user()->establishment->id : auth()->user()->establishmentBelonging->id
        ]);

        $this->message = "La mesa ha sido creado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }
}
