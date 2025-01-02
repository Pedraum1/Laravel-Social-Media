@extends('layouts.layout_base')

@section('title_base')
    Recuperar senha
@endsection

@section('body')
    <body class="bg-zinc-900 h-screen flex justify-center items-center">

        <div class="bg-slate-100 p-12 shadow-xl w-[450px]">
            <h1 class="text-4xl text-center">Recupere sua senha</h1>
            <hr class="text-gray-500 mt-5 mb-5">
            <div class="mb-4">
                <p class="text-justify mb-2">                    
                    Preencha o campo abaixo com seu email cadastrado para que possamos enviar um link para redefinir sua senha.
                </p>
                <form action="{{route('sendResetEmail')}}" method="post">
                    @csrf
                    <div class="mb-5">
                        <input type="email" name="emailInput" value="{{old('emailInput')}}" placeholder="Email" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500 transition ease-in-out">
                        @error('emailInput')
                            <p class="text-red-600 text-center">{{$message}}</p>
                        @enderror
                        @if (session('recover_error'))
                            <p class="text-red-600 text-center">Email não encontrado, tente novamente.</p>
                        @endif
                        @if (session('recover_success'))
                        <p class="text-green-600 text-center">Um Email de recuperação de senha foi enviado.</p>
                        @endif
                    </div>
                    <input type="submit" value="submit" class="text-2xl bg-fuchsia-600 py-3 px-5 text-slate-100 shadow-xl w-full mb-4 cursor-pointer hover:bg-fuchsia-500 active:bg-fuchsia-700 transition ease-in-out">
                </form>
            </div>

            <p class="text-center"><a href="{{route('login')}}" class="text-fuchsia-600 underline">Voltar para o Login</a></p>
        </div>

    </body>
@endsection