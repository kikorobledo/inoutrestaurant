<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Table;
use App\Models\Client;
use App\Models\Product;
use Livewire\Component;
use App\Models\SaleDetail;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;

class AdminSalesCreateEdit extends Component
{
    use WithPagination;

    public $search;
    public $search_client;
    public $sort = 'stock';
    public $direction = 'asc';
    public $message;
    public $sale_edit;
    public $modal = false;
    public $modalExtras = false;

    public $client_id;
    public $client_name;
    public $table_id;
    public $table_name;
    public $sale;
    public $sale_number;
    public $saleDetail;
    public $saleDetails;
    public $total_price;
    public $saleConfirmed;
    public $total_recived;
    public $payment_type;
    public $change;
    public $product_;
    public $selected_extras = [];

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
            'total_recived' => 'required|gte:' . $this->total_price,
            'payment_type' => 'required'
        ];
    }

    public function mount(){

        if($this->sale_edit){
            $this->sale = $this->sale_edit;
            $this->client_id = ($this->sale_edit->client_id == null) ? 0 : $this->sale_edit->client_id;
            $this->client_name = $this->sale_edit->client_name;
            $this->table_id = ($this->sale_edit->table_id == null) ? 0 : $this->sale_edit->table_id;
            $this->table_name = $this->sale_edit->table_name;
            $this->saleDetails = $this->sale_edit->saleDetails;

            foreach ($this->sale->saleDetails as $saleDetail) {
                if($saleDetail->status == 'not_confirmed')
                    $this->saleConfirmed = false;
            }
        }
    }

    public function render()
    {
        if(auth()->user()->role == 1){

            $clients = Client::where('name', 'LIKE', '%' . $this->search_client . '%')->orderBy('name')->get();

            $products2 = Product::with('extras')->where('name', 'LIKE', '%' . $this->search . '%')
                                ->where('stock', '!=', 0)
                                ->orderBy($this->sort, $this->direction)->simplePaginate(10);

            $products = Product::where('stock', '!=', 0)->get();

            $tables = Table::where('status', 'available')->get();

            $this->sale_number = Sale::latest()->first();

        }elseif(auth()->user()->role == 2 && auth()->user()->establishment != null){

            $clients = Client::where('establishment_id', '=', auth()->user()->establishment->id)->where('name', 'LIKE', '%' . $this->search_client . '%')->orderBy('name')->get();

            $products2 = Product::with('extras')->where('establishment_id', '=', auth()->user()->establishment->id)
                                ->where('stock', '!=', 0)
                                ->where(function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                })
                                ->orderBy($this->sort, $this->direction)
                                ->simplePaginate(10);

            $products = Product::where('establishment_id', '=', auth()->user()->establishment->id)
                                ->where('stock', '!=', 0)
                                ->get();

            $tables = Table::where('establishment_id', '=', auth()->user()->establishment->id)->where('status', 'available')->orderBy('name')->get();

            $this->sale_number = Sale::where('establishment_id', '=', auth()->user()->establishment->id)->latest()->first();
        }
        else{

            $clients = Client::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->where('name', 'LIKE', '%' . $this->search_client . '%')->orderBy('name')->get();

            $products2 = Product::with('extras')->where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                                ->where('stock', '!=', 0)
                                ->where(function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                })
                                ->orderBy($this->sort, $this->direction)
                                ->simplePaginate(10);

            $products = Product::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)
                                ->where('stock', '!=', 0)
                                ->get();

            $tables = Table::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->where('status', 'available')->orderBy('name')->get();

            $this->sale_number = Sale::where('establishment_id', '=', auth()->user()->establishmentBelonging->id)->latest()->first();
        }

        $sale0 = [
            'id' => 0,
            'name' => 'Venta de mostrador'
        ];

        $clients->prepend($sale0);

        $tables->prepend($sale0);

        return view('livewire.admin-sales-create-edit', compact('clients', 'products', 'tables', 'products2'));
    }

    public function openModalExtras(Product $product){

        if($this->table_id === null || $this->client_id === null){
            $this->message = "Complete los campos necesarios.";
            $this->dispatchBrowserEvent('unsetFields', ['table_id' => $this->table_id, 'client_id' => $this->client_id]);

            return;
        }

        $this->product_ = $product;

        if($this->product_->stock == -1){

            if(count($this->product_->extras) > 0){
                $this->modalExtras = true;
            }else{
                $this->selected_extras = [];
                $this->addProduct($this->product_);
            }

        }else{

            $this->selected_extras = [];
            $this->addProduct($this->product_);

        }
    }

    public function openModal(){
        $this->reset('payment_type','total_recived', 'change','total_price');
        $this->total_price = $this->sale->total_price;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->modal = true;
    }

    public function closeModal(){
        $this->modal = false;
        $this->modalExtras = false;
        $this->reset('payment_type','total_recived', 'change', 'total_price', 'selected_extras');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function addProduct(Product $product){

        if($this->table_id === null || $this->client_id === null){
            $this->message = "Complete los campos necesarios.";
            $this->dispatchBrowserEvent('unsetFields', ['table_id' => $this->table_id, 'client_id' => $this->client_id]);

            return;
        }

        $total_extras = 0;

        if($this->sale === null){

            $this->sale = Sale::create([
                'sale_number' => $this->sale_number == null ? 1 : $this->sale_number->sale_number + 1,
                'table_id' => ($this->table_id === 0) ? null : $this->table_id,
                'table_name' => $this->table_name,
                'client_id' => ($this->client_id === 0) ? null : $this->client_id,
                'client_name' => $this->client_name,
                'total_price' => $product->sale_price,
                'establishment_id' => auth()->user()->establishment ? auth()->user()->establishment->id : auth()->user()->establishmentBelonging->id,
                'created_by' => auth()->user()->id
            ]);

            $this->sale->table->update(['status' => 'unavailable']);

            $this->saleDetail = SaleDetail::create([
                'sale_id' => $this->sale->id,
                'product_name' => $product->name,
                'product_price' => $product->sale_price,
                'quantity' => 1,
            ]);

            if($product->stock != -1)
                $product->update(['stock' => $product->stock - 1]);
            else{
                if(count($this->selected_extras) > 0){

                    $this->saleDetail->extras()->attach($this->selected_extras);
                    foreach ($this->saleDetail->extras as $extra) {
                        $total_extras = $total_extras + $extra->price;
                    }

                    $this->saleDetail->update([
                        'product_price' => $this->saleDetail->product_price + $total_extras
                    ]);

                    $this->sale->update([
                        'total_price' => $this->saleDetail->product_price
                    ]);
                }
            }

            $this->saleDetails = $this->sale->saleDetails;

            $this->saleConfirmed = false;

        }else{

            $extras = [];
            $total_extras = 0;

            foreach($this->sale->saleDetails as $saleDetail){

                foreach ($saleDetail->extras as $extra) {
                    array_push($extras, (string)$extra->id);
                }

                if($saleDetail->product_name == $product->name && array_diff($extras,$this->selected_extras) === array_diff($this->selected_extras,$extras)){

                    $temp = SaleDetail::find($saleDetail->id);

                    $temp->update([
                        'quantity' => $temp->quantity + 1,
                        'status' => 'not_confirmed'
                    ]);

                    if($product->stock != -1){

                        $product->update(['stock' => $product->stock - 1]);

                        $this->sale->update([
                            'total_price' => $this->sale->total_price + $product->sale_price,
                            'updated_by' => auth()->user()->id,
                        ]);

                    }else{

                        $this->sale->update([
                            'total_price' => $this->sale->total_price + $temp->product_price,
                            'updated_by' => auth()->user()->id,
                        ]);
                    }

                    $this->saleDetails = $temp->sale->saleDetails;

                    $this->saleConfirmed = false;

                    $this->closeModal();

                    return;

                }
                $extras = [];
            }

            $this->saleDetail = SaleDetail::create([
                'sale_id' => $this->sale->id,
                'product_name' => $product->name,
                'product_price' => $product->sale_price,
                'quantity' => 1,
            ]);

            if($product->stock != -1){

                $product->update(['stock' => $product->stock - 1]);

            }else{
                if(count($this->selected_extras) > 0){

                    $this->saleDetail->extras()->attach($this->selected_extras);
                    foreach ($this->saleDetail->extras as $extra) {
                        $total_extras = $total_extras + $extra->price;
                    }

                    $this->saleDetail->update([
                        'product_price' => $this->saleDetail->product_price + $total_extras
                    ]);

                    $this->sale->update([
                        'total_price' => $this->sale->total_price + $this->saleDetail->product_price
                    ]);

                    $this->saleDetails = $this->saleDetail->sale->saleDetails;

                    $this->saleConfirmed = false;

                    $this->closeModal();

                    return;
                }
            }

            $this->sale->update([
                'total_price' => $this->sale->total_price + $product->sale_price,
                'updated_by' => auth()->user()->id
            ]);

            $this->saleDetails = $this->saleDetail->sale->saleDetails;

            $this->saleConfirmed = false;

        }

        $this->closeModal();

    }

    public function updateTable($table_name, $table_id){

        if($this->table_id != null){

            Table::find($this->table_id)->update(['status' => 'available']);

        }

        $this->table_id = $table_id;
        $this->table_name = $table_name;

        if($this->sale != null){
            if($this->sale->table_id != $this->table_id)
                $this->sale->update([
                    'table_id' => ($this->table_id === 0) ? null : $this->table_id,
                    'table_name' => $this->table_name,
                    'updated_by' => auth()->user()->id
                ]);

            if($this->table_id != null)
                Table::find($this->table_id)->update(['status' => 'unavailable']);
        }

    }

    public function updateClient($client_name, $client_id){
        $this->client_id = $client_id;
        $this->client_name = $client_name;

        if($this->sale != null){
            if($this->sale->client_id != $this->client_id)
                $this->sale->update([
                    'client_id' => ($this->client_id === 0) ? null : $this->client_id,
                    'client_name' => $this->client_name,
                    'updated_by' => auth()->user()->id
                ]);
        }
    }

    public function increaseDecreaseSaleDetail(SaleDetail $saleDetail, $val){

        $this->saleDetail = $saleDetail;

        $product = Product::where('name', $this->saleDetail->product_name)->first();

        if($val == 1){

            if($product->stock == 0){

                $this->dispatchBrowserEvent('showMessage',['warning', "No hay mas stock del producto."]);

                return;
            }

            $this->saleDetail->update([
                'quantity' => $this->saleDetail->quantity + 1,
                'status' => 'not_confirmed'
            ]);

            if($product->stock != -1)
                $product->update(['stock' => $product->stock - 1]);

            $this->sale->update([
                'total_price' => $this->sale->total_price + $this->saleDetail->product_price,
                'updated_by' => auth()->user()->id
            ]);

            $this->saleDetails = $this->saleDetail->sale->saleDetails;

            $this->saleConfirmed = false;
            $this->sale->refresh();
            $this->saleDetails = $this->sale->saleDetails;

        }else{

            $this->saleDetail->update([
                'quantity' => $this->saleDetail->quantity - 1,
                'status' => 'not_confirmed'
            ]);

            if($product->stock != -1)
                $product->update(['stock' => $product->stock + 1]);

            $this->sale->update([
                'total_price' => $this->sale->total_price - $this->saleDetail->product_price,
                'updated_by' => auth()->user()->id
            ]);

            $this->saleConfirmed = false;
            $this->sale->refresh();
            $this->saleDetails = $this->saleDetail->sale->saleDetails;

        }

    }

    public function deleteSaleDetail(SaleDetail $saleDetail){

        $this->saleDetail = $saleDetail;

        $product = Product::where('name', $this->saleDetail->product_name)->first();

        if($product->stock != -1)
            $product->update(['stock' => $product->stock + $this->saleDetail->quantity]);

        $this->sale->update([
            'total_price' => $this->sale->total_price - $this->saleDetail->product_price * $this->saleDetail->quantity,
            'updated_by' => auth()->user()->id
        ]);

        $this->saleDetail->extras()->detach();

        $this->saleDetail->delete();

        $this->sale->refresh();

        if(count($this->sale->saleDetails) === 0){

            if(!$this->sale_edit){

                $this->sale->delete();
                $this->sale->table->update(['status' => 'available']);

            }

            $this->sale = null;
            $this->saleDetails = null;

        }else{

            $this->saleDetails = $this->sale->saleDetails;

        }

    }

    public function confirmSale(){

        foreach ($this->sale->saleDetails as $saleDetail) {

            $salaDetail = SaleDetail::find($saleDetail->id);

            if($saleDetail->status != 'confirmed')
                $salaDetail->update(['status' => 'confirmed']);
        }

        $this->saleConfirmed = true;

        $this->sale->refresh();

        $this->saleDetails = $this->sale->saleDetails;
    }

    public function calculateChange(){
        if($this->total_recived > $this->sale->total_price){
            $this->change = $this->total_recived - $this->sale->total_price;
        }else{
            $this->change = 0;
        }
    }

    public function pay(){

        if($this->payment_type == 'card'){
            $this->total_recived = $this->sale->total_price;
            $this->change = 0;
        }else{
            $this->validate();
        }

        $this->sale->update([
            'payment_type' => $this->payment_type,
            'total_recived' => $this->total_recived,
            'change' => $this->change,
            'status' => 'paid_out'
        ]);

        if($this->table_id != null)
            Table::find($this->table_id)->update(['status' => 'available']);

        $this->dispatchBrowserEvent('pirnt-ticket', ['sale' => $this->sale->id]);
    }
}
