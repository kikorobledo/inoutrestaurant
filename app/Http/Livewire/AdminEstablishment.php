<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminEstablishment extends Component
{

    public $name;
    public $email;
    public $address;
    public $telephone;
    public $establishment_id;

    protected function rules(){
        return[
            'name' => 'required|unique:establishments,name,'. $this->establishment_id,
            'email' => 'required|email|unique:establishments,email,'. $this->establishment_id,
            'address' => 'required',
            'telephone' => 'required|numeric'
        ];
    }

    public function mount(){
        $this->name = auth()->user()->establishment->name;
        $this->email = auth()->user()->establishment->email;
        $this->address = auth()->user()->establishment->address;
        $this->telephone = auth()->user()->establishment->telephone;
        $this->establishment_id = auth()->user()->establishment->id;
    }

    public function render()
    {
        return view('livewire.admin-establishment');
    }

    public function updateEstablishment(){

        $this->validate();

        auth()->user()->establishment->update([
            'name' => $this->name,
            'email' => $this->email,
            'address' =>$this->address,
            'telephone' =>$this->telephone,
        ]);

        $this->emit('saved');
    }
}
