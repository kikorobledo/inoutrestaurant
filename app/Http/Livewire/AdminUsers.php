<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsers extends Component
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

    public $user_id;
    public $name;
    public $email;
    public $status;
    public $role;

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
            'email' => 'required|email|unique:users,email,'. $this->user_id,
            'status' => 'required|in:activo,inactivo',
            'role' => 'required|integer|in:2,3,4'
        ];
    }

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate(10);

        return view('livewire.admin-users', compact('users'));
    }

    public function openModalCreate(){

        $this->reset('name','email','status', 'role', 'user_id');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->edit = false;
        $this->modal = true;
        $this->create = true;
    }

    public function openModalEdit($user){

        $this->resetErrorBag();
        $this->resetValidation();

        $this->create = false;
        $this->modal = true;
        $this->edit = true;

        $this->user_id = $user['id'];

        $user = User::findorFail($this->user_id);

        $this->role = $user->roles[0]->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->status = $user->status;
    }

    public function openModalDelete($user){

        $this->modalDelete = true;
        $this->user_id = $user['id'];
    }

    public function create(){

        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
            'password' => 'password'
        ]);

        $user->roles()->attach($this->role);

        $this->message = "El usuario ha sido creado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function update(){

        $user = User::findorFail($this->user_id);

        $this->validate();

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
        ]);

        $user->roles()->sync($this->role);

        $this->message = "El usuario ha sido actualizado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function delete(){

        $user = User::findorFail($this->user_id);
        $user->delete();

        $this->message = "El usuario ha sido eliminado con exito.";
        $this->emit('showMessage');

        $this->closeModal();
    }

    public function closeModal(){
        $this->reset('name','email','status', 'role', 'user_id');
        $this->modal = false;
        $this->modalDelete = false;
        $this->create = false;
        $this->edit = false;
    }

}
