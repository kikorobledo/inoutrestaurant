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
    public $sort = 'name';
    public $direction = 'asc';


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

            $tables = Table::with('createdBy','updatedBy','establishmentBelonging', 'activeSale')->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere(function($q){
                            return $q->whereHas('establishmentBelonging', function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%');
                            });
                        })
                        ->orderBy($this->sort, $this->direction)
                        ->paginate(10);

        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){

            $tables = Table::with('createdBy','updatedBy','establishmentBelonging', 'activeSale')->where('establishment_id', '=', auth()->user()->establishment->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('establishmentBelonging', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->get();
        }
        else{

            $tables = Table::with('createdBy','updatedBy','establishmentBelonging', 'activeSale')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('establishmentBelonging', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                            })
                            ->orderBy($this->sort, $this->direction)
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

        $this->table_id = $table['id'];
        $this->name = $table['name'];
        $this->status = $table['status'];

    }

    public function openModalDelete($table){

        $this->modalDelete = true;
        $this->table_id = $table['id'];
    }

    public function closeModal(){
        $this->reset('status','name', 'table_id');
        $this->modal = false;
        $this->modalDelete = false;
    }

    public function create(){

        $this->validate();

        try {

            $table = Table::create([
                'name' => $this->name,
                'created_by' => auth()->user()->id,
                'establishment_id' => auth()->user()->establishment ? auth()->user()->establishment->id : auth()->user()->establishmentBelonging->id
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La mesa ha sido creada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function update(){

        $table = Table::findorFail($this->table_id);

        $this->validate();

        try {

            $table->update([
                'name' => $this->name,
                'updated_by' => auth()->user()->id,
            ]);

            $this->dispatchBrowserEvent('showMessage',['success', "La mesa ha sido actualizada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function delete(){

        $table = Table::findorFail($this->table_id);

        if($table->status == 'unavailable'){
            $this->dispatchBrowserEvent('showMessage',['error', "La mesa no puede ser eliminada teniendo una venta sin concluir."]);

            $this->closeModal();

            return;
        }

        try {

            $table->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "La mesa ha sido eliminada con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }
}
