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
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $user_id;
    public $user_number;
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
            $users = User::with('createdBy','updatedBy','roles')->where('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->orWhere(function($q){
                                return $q->whereHas('roles', function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate(10);
        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $users = User::with('createdBy','updatedBy','roles')->where('establishment_id', '=', auth()->user()->establishment->id)
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
            $users = User::with('createdBy','updatedBy','roles')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
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
        $this->role = $user['roles'][0]['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->status = $user['status'];
    }

    public function openModalDelete($user){

        $this->modalDelete = true;
        $this->user_id = $user['id'];
    }

    public function closeModal(){
        $this->reset('name','email','status', 'role', 'user_id');
        $this->modal = false;
        $this->modalDelete = false;
    }

    public function create(){

        $this->validate();

        if(auth()->user()->role == 1){
            $this->user_number = User::where('created_by', 1)->latest()->first();
        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){
            $this->user_number = User::where('establishment_id', '=', auth()->user()->establishment->id)->latest()->first();
        }else{
            $this->user_number = User::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->latest()->first();
        }

        try {

            $user = User::create([
                'user_number' => $this->user_number == null ? 1 : $this->user_number->user_number + 1,
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

            $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido creado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

    public function update(){

        $user = User::findorFail($this->user_id);

        $this->validate();

        try {

            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
                'role' => $this->role,
                'updated_by' => auth()->user()->id,
            ]);

            $user->roles()->sync($this->role);

            $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido actualizado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }

    }

    public function delete(){

        $user = User::findorFail($this->user_id);

        try {

            $user->delete();

            $this->dispatchBrowserEvent('showMessage',['success', "El usuario ha sido eliminado con exito."]);

            $this->closeModal();

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('showMessage',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

            $this->closeModal();
        }
    }

}
