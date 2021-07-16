@extends('layouts.admin')


@section('content')

    @livewire('admin-sales-create-edit', ['table_id' => $table->id, 'table_name' => $table->name])

@stop
