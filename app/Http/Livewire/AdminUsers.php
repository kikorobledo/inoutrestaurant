<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\URL;
use App\Notifications\EmployeeNotification;

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
        if(auth()->user()->role == 1){
            $users = User::with('createdBy','updatedBy')->where('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->orWhere(function($q){
                                return $q->whereHas('roles', function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $users = User::with('createdBy','updatedBy')->where('establishment_id', '=', auth()->user()->establishment->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('roles', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }
        else{
            $users = User::with('createdBy','updatedBy')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                            ->where(function($q){
                                return $q->where('name', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                                            ->orWhere(function($q){
                                                return $q->whereHas('roles', function($q){
                                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                });
                                            });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }

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

        $this->role = $user->role;
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
            'password' => 'password',
            'created_by' => auth()->user()->id,
            'role' => $this->role,
            'establishment_id' => auth()->user()->establishment ? auth()->user()->establishment->id : auth()->user()->establishmentBelonging->id
        ]);

        $user->roles()->attach($this->role);

        $url = URL::signedRoute('invitation', $user);

        $user->notify(new EmployeeNotification($url, auth()->user()));

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
            'role' => $this->role,
            'updated_by' => auth()->user()->id,
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
