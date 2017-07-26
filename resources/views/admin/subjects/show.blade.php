@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Ver disciplina</h3>
            @php
                $linkEdit = route('admin.subjects.edit',['subject' => $subject->id]);
                $linkDelete = route('admin.subjects.destroy',['subject' => $subject->id]);
            @endphp
            {!! Button::primary(Icon::pencil().' Editar')->asLinkTo($linkEdit) !!}
            {!!
            Button::danger(Icon::remove().' Excluir')->asLinkTo($linkDelete)
                ->addAttributes([
                    'onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"
                ])
            !!}
            @php
                $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'url' => $linkDelete,
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ])
            @endphp
            {!! form($formDelete) !!}
            <br/><br/>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{$subject->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$subject->name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
