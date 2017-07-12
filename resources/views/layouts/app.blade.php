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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @php
        $navbar = Navbar::withBrand(config('app.name'), route('admin.dashboard'))->inverse();
            if(Auth::check()){
                $arrayLinks = [
                    ['link' => route('admin.users.index'), 'title' => 'Usuário'],
                ];
                $arrayLinksRight = [
                    [
                        Auth::user()->name,
                        [
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
                $navbar->withContent(Navigation::links($arrayLinks))
                        ->withContent(Navigation::links($arrayLinksRight)->right());

               $formLogout = FormBuilder::plain([
                    'id' => 'form-logout',
                    'url' => route('logout'),
                    'method' => 'POST',
                    'style' => 'display:none'
                ]);
            }
    @endphp
    {!! $navbar !!}
    {!! form($formLogout) !!}
    @if(Session::has('message'))
        <div class="container">
            {!! Alert::success(Session::get('message'))->close() !!}
        </div>
    @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
