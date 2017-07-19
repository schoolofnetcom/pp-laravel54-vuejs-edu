@php
    $tabs = [
       ['title' => 'Informações','link' => route('admin.users.edit',['user' => $user->id])],
       ['title' => 'Perfil','link' => route('admin.users.profile.edit',['user' => $user->id])],
    ]
@endphp

<h3>Gerenciar usuário</h3>
<div class="text-right">
    {!! Button::link('Listar usuários')->asLinkTo(route('admin.users.index')) !!}
</div>
{!! \Navigation::tabs($tabs) !!}
<div>
    {!! $slot !!}
</div>