<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSales extends Component
{

    use WithPagination;

    public $modal = false;
    public $modalDelete = false;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $sale_active;

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
            $sales = Sale::with('createdBy','updatedBy','table','client')->where('table_id', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('id', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('sale_number', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('total_price', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('total_recived', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('change', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('payment_type', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('status', 'LIKE', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);

        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $sales = Sale::with('createdBy','updatedBy','table','client')->where('establishment_id', '=', auth()->user()->establishment->id)
                            ->where(function($q){
                                return $q->where('table_id', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('id', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('sale_number', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('total_price', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('total_recived', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('change', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('payment_type', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('status', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }
        else{
            $sales = Sale::with('createdBy','updatedBy','table','client')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                            ->where(function($q){
                                return $q->where('table_id', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('id', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('sale_number', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('total_price', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('total_recived', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('change', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('payment_type', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('status', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }

        return view('livewire.admin-sales', compact('sales'));
    }

    public function openModalShow(Sale $sale){
        $this->sale_active = $sale;
        $this->modal = true;
    }

    public function openModalDelete(Sale $sale){

        $this->modalDelete = true;
        $this->sale_active = $sale;
    }

    public function closeModal(){
        $this->reset('sale_active');
        $this->modal = false;
        $this->modalDelete = false;
    }

    public function delete(){

        try {

            $this->sale_active->delete();

            if($this->sale_active->table_id != null)
                $this->sale_active->table->update(['status' => 'available']);

            $this->dispatchBrowserEvent('showMessage',['success', "El cliente ha sido creado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }
}
