@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Adicionar disciplina e professor na turma</h3>
            <class-teaching class-information="{{$class_information->id}}"></class-teaching>
            <br/><br/>
        </div>
    </div>
@endsection