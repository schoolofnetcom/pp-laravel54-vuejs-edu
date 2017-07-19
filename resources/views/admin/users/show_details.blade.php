@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Usuário - {{$user->name}}</h3>
            {!! Button
                    ::normal('Listar usuários')
                    ->appendIcon(Icon::thList())
                    ->asLinkTo(route('admin.users.index'))
                    ->addAttributes([
                        'class' => 'hidden-print'
                    ])
            !!}
            <br/><br/>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
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
                <tr>
                    <th scope="row">Password</th>
                    <td>{!! Badge::withContents($user->password)!!}</td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
@endsection
