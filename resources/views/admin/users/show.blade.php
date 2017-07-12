@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Ver usuário</h3>
            @php
                $linkEdit = route('admin.users.edit',['user' => $user->id]);
                $linkDelete = route('admin.users.destroy',['user' => $user->id]);
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
                    <td>{{$user->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td>{{$user->email}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
