<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
</head>

<style>

    @page{
        size:58mm 210mm;
        margin-top: 0;
        margin-bottom: 0;
    }

    #wrapper{
        width: 58mm;
        margin: 0 auto;
        margin-left: -37px
        color: #000;
        font-family: Arial,Helvetica;
        font-size: 12px;
    }

    #restaurant-name,
    .receipt-header,
    #receipt-footer p{
        text-align: center;
        margin-bottom: 0;
        line-height: .2;
    }

    .receipt-body{
        max-width: 100%;
    }

    .receipt-data p,{
        margin-bottom: 10;
        line-height: .2;
    }

    .tb-sale-detail,
    .tb-sale-total{
        font-size: 10px;
        margin: 12px 12px 12px 0;
    }

    .tb-sale-detail,
    .tb-sale-total{
        width: 100%;
        border-spacing: 0;
        margin-top: 10px;
    }

    .tb-sale-detail{
        text-align: center;
    }

    .tb-sale-detail th{
        border-bottom: 1px solid #000;
    }

    .tb-sale-detail td{
        text-align: right;

    }

    .tb-sale-detail td:nth-child(1){
        text-align: left;
    }

    .tb-sale-detail td:nth-child(2){
        text-align: center;
    }

    .tb-sale-detail td:nth-child(1) .extras p{
        margin:0;
        margin-left: 5px;
    }

    .tb-sale-detail td:nth-child(2){
        text-align: center;
    }
    .tb-sale-detail td{
        vertical-align: text-top;
    }

    .tb-sale-total{
        margin-bottom: 10px;
    }

    .tb-sale-total td{
        padding: 5px 0;
        padding-left: 1.5%;
        border-bottom: 1px solid #000 ;
    }

    .tb-sale-total tr:first-child td:nth-child(4){
        text-align: right;
        padding-left: 1.5%;
    }

    .tb-sale-total tr:not(:first-child){
        background-color: #ccc;
    }

    .tb-sale-total tr:not(:first-child),
    td:nth-child(2){
        text-align: right;
        padding-right: 1.5% ;
    }

    .footer p{
        margin:0;
        text-align: center;
    }

</style>

<body>
    <div id="wrapper">

        <div class="receipt-header">

            <h3 id="restaurant-name">{{ $sale->establishmentBelonging->name }}</h3>
            <p>{{ $sale->establishmentBelonging->address }}</p>
            <p>{{ $sale->establishmentBelonging->email }}</p>
            <p>{{ $sale->establishmentBelonging->telephone }}</p>

        </div>

        <div class="receipt-data">
            <p>Fecha: {{Carbon\Carbon::now()->format('d-m-Y')}}</p>
            <p>Hora: {{Carbon\Carbon::now()->format('H:i:s')}}</p>
            <p>Venta: {{ $sale->sale_number }}</p>
        </div>

        <div class="receipt-body">

            <table class="tb-sale-detail">

                <thead>

                    <tr>

                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($sale->saleDetails as $saleDetail)

                        <tr>

                            <td width="">
                                {{ $saleDetail->product_name }}
                                <div class="extras">
                                    @if(count($saleDetail->extras) > 0)
                                        @foreach($saleDetail->extras as $extra)
                                            <p>+{{$extra->name}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                            <td width="">{{ $saleDetail->quantity }}</td>
                            <td width="">{{ number_format($saleDetail->product_price, 2) }}</td>
                            <td width="">{{ number_format($saleDetail->product_price * $saleDetail->quantity, 2) }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            <table class="tb-sale-total">

                <tbody>

                    <tr>

                        <td colspan="2">Total</td>
                        <td colspan="2">${{ number_format($sale->total_price,2) }}</td>

                    </tr>

                    <tr>
                        <td colspan="2">Tipo de pago</td>
                        <td colspan="2">
                            @if($sale->payment_type == 'cash')
                                Efectivo
                            @else
                                Tarjeta
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">Total Recibido</td>
                        <td colspan="2">${{ number_format($sale->total_recived, 2) }}</td>
                    </tr>

                    <tr>
                        <td colspan="2">Cambio</td>
                        <td colspan="2">${{ number_format($sale->change, 2) }}</td>
                    </tr>

                </tbody>

            </table>

        </div>

        <div class="receipt-data">
            <p>Mesa: {{$sale->table_name}}</p>
            <p>Cliente: {{$sale->client_name}}</p>
            <p>Atendido por: {{ auth()->user()->name }}</p>
        </div>

        <div class="footer">
            <p>Ticket elaborado con</p>
            <p>www.inout.com</p>
        </div>

    </div>

</body>
</html>
