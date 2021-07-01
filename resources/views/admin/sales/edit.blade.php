@extends('layouts.admin')


@section('content')

    @livewire('admin-sales-create-edit', ['sale_edit' => $sale])

@stop
