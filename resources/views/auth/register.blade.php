@extends('layouts.layout_base')

@section('title_base')
    Login
@endsection

@section('body')
    <div class="bg-zinc-900 h-screen flex justify-center items-center">
        <div class="bg-slate-100 p-12 shadow-xl w-[450px]">
            <h1 class="text-5xl text-center">Registro</h1>
            <hr class="text-gray-500 mt-5 mb-10">
    
            <form action="">
                <div class="mb-6">
                    <label for="email" class="text-2xl">Nome de Usuário</label>
                    <input type="text" name="nameInput" id="name" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500">
                    @error('nameInput')                        
                        <p class="text-red-600 mt-2">Nome de Usuário inválido. Tente novamente.</p>
                    @enderror
                </div>
    
                <div class="mb-6">
                    <label for="email" class="text-2xl">Email</label>
                    <input type="text" name="emailInput" id="email" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500">
                    @error('emailInput')
                        <p class="text-red-600 mt-2">Email já cadastrado. Tente novamente.</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="senha" class="text-2xl">Senha</label>
                    <div class="relative">
                        <input type="password" name="passwordInput" id="password" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500">
                    <i class="fa-regular fa-eye absolute top-1/2 right-3 -translate-y-1/2 text-xl hover:cursor-pointer" id="toggle" onclick="togglePass()"></i>
                    </div>
                    @error('passwordInput')                        
                        <p class="text-red-600 mt-2">Senha inválida, a senha deve ter no mínimo 1 letra maiúscula e 1 número. Tente novamente.</p>
                    @enderror
                </div>
                
                <div class="my-8">
                    <button type="submit" class="text-2xl bg-fuchsia-600 py-3 px-5 text-slate-100 shadow-xl w-full mb-4 hover:bg-fuchsia-500 active:bg-fuchsia-700 transition ease-in-out">
                        CADASTRAR
                    </button>
                </div>
    
            </form>
    
    
            <p class="text-center">Já possui conta? <a href="{{ route('login') }}" class="text-fuchsia-600 underline">Faça Login</a></p>
        </div>
    </div>

    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endsection