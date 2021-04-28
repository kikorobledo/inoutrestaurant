<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class AdminClients extends Component
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

    public $client_id;
    public $name;
    public $email;
    public $telephone;

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
            'email' => 'required|email|unique:clients,email,'. $this->client_id,
            'telephone' => 'required'
        ];
    }

    public function render()
    {
        if(auth()->user()->role == 1){
            $clients = Client::where('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('telephone', 'LIKE', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $clients = Client::where('establishment_id', '=', auth()->user()->establishment->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('telephone', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }
        else{
            $clients = Client::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('telephone', 'LIKE', '%' . $this->search . '%');
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }

        return view('livewire.admin-clients', compact('clients'));
    }

    public function openModalCreate(){

        $this->reset('name','email','telephone', 'client_id');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->edit = false;
        $this->modal = true;
        $this->create = true;
    }

    public function openModalEdit($client){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;
        $this->modal = true;
        $this->edit = true;

        $this->client_id = $client['id'];

        $client = Client::findorFail($this->client_id);

        $this->name = $client->name;
        $this->email = $client->email;
        $this->telephone = $client->telephone;
    }

    public function openModalDelete($client){

        $this->modalDelete = true;
        $this->client_id = $client['id'];
    }

    public function closeModal(){
        $this->reset('name','email','telephone', 'client_id');
        $this->modal = false;
        $this->modalDelete = false;
        $this->create = false;
        $this->edit = false;
    }

    public function create(){

        $this->validate();

        $client = Client::create([
            'name' => $this->name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'created_by' => auth()->user()->id,
            'establishment_id' => auth()->user()->establishment ? auth()->user()->establishment->id : auth()->user()->establishmentBelonging->id
        ]);

        $this->message = "El cliente ha sido creado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function update(){

        $client = Client::findorFail($this->client_id);

        $this->validate();

        $client->update([
            'name' => $this->name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'updated_by' => auth()->user()->id,
        ]);

        $this->message = "El cliente ha sido actualizado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function delete(){

        $client = Client::findorFail($this->client_id);
        $client->delete();

        $this->message = "El cliente ha sido eliminado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }
}
