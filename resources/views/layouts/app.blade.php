<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @php
        $navbar = Navbar::withBrand(config('app.name'), route('admin.dashboard'))->inverse();
            if(Auth::check()){
                if(\Gate::allows('admin')){
                    $arrayLinks = [
                        ['link' => route('admin.users.index'), 'title' => 'Usuário'],
                        ['link' => route('admin.subjects.index'), 'title' => 'Disciplina'],
                        ['link' => route('admin.class_informations.index'), 'title' => 'Turma'],
                    ];
                    $navbar->withContent(Navigation::links($arrayLinks));
                }

                $arrayLinksRight = [
                    [
                        Auth::user()->name,
                        [
                            [
                                'link' => route('admin.users.settings.edit'),
                                'title' => 'Configurações'
                            ],
                            [
                                'link' => route('logout'),
                                'title' => 'Logout',
                                'linkAttributes' => [
                                    'onclick' => "event.preventDefault();document.getElementById(\"form-logout\").submit();"
                                ]
                            ]
                        ]
                    ]
                ];
                $navbar->withContent(Navigation::links($arrayLinksRight)->right());

               $formLogout = FormBuilder::plain([
                    'id' => 'form-logout',
                    'url' => route('logout'),
                    'method' => 'POST',
                    'style' => 'display:none'
                ]);
            }
    @endphp
    {!! $navbar !!}

    @if(Auth::check())
        {!! form($formLogout) !!}
    @endif

    @if(Session::has('message'))
        <div class="container hidden-print">
            {!! Alert::success(Session::get('message'))->close() !!}
        </div>
    @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
