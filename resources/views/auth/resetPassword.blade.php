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
                    Preencha o campo abaixo com sua nova senha.
                </p>
                <form action="{{route('resetPasswordSubmit')}}" method="post">
                    @csrf
                    <input type="hidden" name="idInput" value="{{$id}}">
                    <div class="mb-5">
                        
                        <div class="relative">
                        <input type="password" name="passwordInput" id="password" value="{{old('passwordInput')}}" placeholder="Nova senha" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500 transition ease-in-out">
                        <i class="fa-regular fa-eye absolute top-1/2 right-3 -translate-y-1/2 text-xl hover:cursor-pointer" id="toggle" onclick="togglePass()"></i>
                        </div>
                        @error('passwordInput')
                            <p class="text-red-600 text-center">{{$message}}</p>
                        @enderror

                        <input type="password" name="passwordInput_confirmation" id="confirmation" value="{{old('passwordInput_confirmation')}}" placeholder="Confirme sua nova senha" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500 transition ease-in-out">
                        @error('passwordInput_confirmation')
                            <p class="text-red-600 text-center">{{$message}}</p>
                        @enderror
                        
                        @if (session('recover_success'))
                        <p class="text-green-600 text-center">Um Email de recuperação de senha foi enviado.</p>
                        @endif
                    </div>
                    <input type="submit" value="submit" class="text-2xl bg-fuchsia-600 py-3 px-5 text-slate-100 shadow-xl w-full mb-4 cursor-pointer hover:bg-fuchsia-500 active:bg-fuchsia-700 transition ease-in-out">
                </form>
            </div>
        </div>

        <script src="{{ asset('assets/js/registerAuth.js') }}"></script>
    </body>
@endsection