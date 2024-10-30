@extends('layouts.layout_base')

@section('title_base')
    Login
@endsection

@section('body')
    <div class="bg-zinc-900 h-screen flex justify-center items-center">
        <div class="bg-slate-100 p-12 shadow-xl w-[550px]">
            <h1 class="text-5xl text-center">Registro</h1>
            <hr class="text-gray-500 md:mt-5 md:mb-10 my-4">
    
            <form action="{{route('register_submit')}}" method="POST">
                @csrf
                <div class="mb-6 md:flex md:flex-row md:gap-x-6">
                    <div class="md:mb-0 mb-6">
                        <label for="email" class="text-2xl">Nome de Usuário</label>
                        <input type="text" name="nameInput" id="name" value="{{old('nameInput')}}" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500">
                        @error('nameInput')                        
                            <p class="text-red-600 mt-2 text-justify">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="text-2xl">Tag de Usuário</label>
                        <input type="text" name="tagInput" id="tag" value="{{old('tagInput')}}" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500">
                        @error('tagInput')                        
                            <p class="text-red-600 mt-2 text-justify">{{$message}}</p>
                        @enderror
                    </div>
                </div>
    
                <div class="mb-6">
                    <label for="email" class="text-2xl">Email</label>
                    <input type="text" name="emailInput" id="email" value="{{old('emailInput')}}" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500">
                    @error('emailInput')
                        <p class="text-red-600 mt-2 text-justify">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="senha" class="text-2xl">Senha</label>
                    <div class="relative">
                        <input type="password" name="passwordInput" id="password" value="{{old('passwordInput')}}" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500">
                    <i class="fa-regular fa-eye absolute top-1/2 right-3 -translate-y-1/2 text-xl hover:cursor-pointer" id="toggle" onclick="togglePass()"></i>
                    </div>
                    @error('passwordInput')                        
                        <p class="text-red-600 mt-2 text-justify">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="senha" class="text-2xl">Confirme sua senha</label>
                    <div class="relative">
                        <input type="password" name="passwordInput_confirmation" id="confirmation" value="{{old('passwordInput_confirmation')}}" class="block w-full bg-slate-100 p-4 text-lg pb-2 border-0 border-b-2 border-gray-500 focus:ring-0 outline-none focus:border-fuchsia-500">
                    </div>
                    @error('passwordInput_confirmation')                        
                        <p class="text-red-600 mt-2 text-justify">{{$message}}</p>
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

    <script src="{{ asset('assets/js/registerAuth.js') }}"></script>
@endsection