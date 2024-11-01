@extends('layouts.layout_base')

@section('title_base')
    Login
@endsection

@section('body')
    <body class="bg-zinc-900 h-screen flex justify-center items-center">

        <div class="bg-slate-100 p-12 shadow-xl w-[450px]">
            <h1 class="text-4xl text-center">Valide seu Email</h1>
            <hr class="text-gray-500 mt-5 mb-10">
            <div class="mb-5">
                <p class="text-justify mb-2">
                    &nbsp;Uma mensagem foi enviada para o endereço de email inserido no formulário de registro
                    <span class="text-blue-500">({{$email}})</span>.
                </p>
                <p class="text-justify">
                    &nbsp;Clique no link da mensagem para validar o seu Email e acessar a Tchola Social.
                </p>
            </div>

            <p class="text-center"><a href="{{route('login')}}" class="text-fuchsia-600 underline">Voltar para o Login</a></p>
        </div>

    </body>
@endsection