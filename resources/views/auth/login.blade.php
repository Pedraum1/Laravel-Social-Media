@extends('layouts.layout_base')

@section('title_base')
    Login
@endsection

@section('body')
    <body class="bg-zinc-900 h-screen flex justify-center items-center">

        <div class="bg-slate-100 p-12 shadow-xl w-[450px]">
            <h1 class="text-5xl text-center">Login</h1>
            <hr class="text-gray-500 mt-5 mb-10">

            <form action="{{route('login_submit')}}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="email" class="text-2xl">Email</label>
                    <input type="text" name="emailInput" id="email" value="{{old('emailInput')}}" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500 transition ease-in-out">
                    @error('emailInput')
                        <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="senha" class="text-2xl">Senha</label>
                    <div class="relative">
                        <input type="password" name="passwordInput" id="password" value="{{old('passwordInput')}}" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500 transition ease-in-out">
                        <i class="fa-regular fa-eye absolute top-1/2 right-3 -translate-y-1/2 text-xl hover:cursor-pointer" id="toggle"></i>
                    </div>
                    @error('passwordInput')
                        <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                
                <p class="text-center">esqueceu a senha? <a href="" class="text-fuchsia-600 underline">Clique aqui</a></p>
                
                <div class="mt-8 mb-12">
                    <button type="submit" class="text-2xl bg-fuchsia-600 py-3 px-5 text-slate-100 shadow-xl w-full mb-4 hover:bg-fuchsia-500 active:bg-fuchsia-700 transition ease-in-out">
                        ENTRAR
                    </button>
                    @if (session('validation_errors'))                        
                        <p class="text-red-600">Email ou senha incorretos. Tente novamente.</p>
                    @endif
                </div>

            </form>


            <p class="text-center">Não possui conta? <a href="{{route('register')}}" class="text-fuchsia-600 underline">Cadastre-se</a></p>
        </div>

        <script src="{{ asset('assets/js/loginAuth.js') }}"></script>
    </body>
@endsection