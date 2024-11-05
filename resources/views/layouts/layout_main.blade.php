@extends('layouts.layout_base')

@section('title_base')
    @yield('title')
@endsection

@section('body')
    <body class="bg-zinc-900 text-white">
        <main class="md:flex min-h-screen">
            @include('partials.sidebar')
            <!--barra principal-->
            <article class="md:w-1/3 flex-grow">
                
                <!--sidebar mobile-->
                <div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 ps-0 overflow-y-auto transition-transform -translate-x-full bg-zinc-900 w-80" tabindex="-1" aria-labelledby="drawer-label">
                    <div class="ms-5">
                        <ul>
                            <a href=""><li class="mt-8 mb-4 ms-4">
                                <img src="{{ asset('storage/images/').'/'.session('user.profile_img')}}" class="w-20 rounded-full">
                                <h1 class="text-3xl font-semibold mt-5">{{session('user.username')}}</h1>
                                <p class="text-zinc-400">{{'@'.session('user.tag')}}</p>
                                <p class="text-zinc-400"><span class="font-semibold text-white">XX</span> seguidores - <span class="font-semibold text-white">XX</span> seguindo</p>
                            </li></a>
                            <a href="{{route('home')}}">
                                <li class="my-2 p-4 text-xl font-semibold hover:bg-zinc-700 hover:rounded-xl">
                                    <i class="fa-solid fa-house"></i> Página Inicial
                                </li>
                            </a>
                            <a href="">
                                <li class="my-2 p-4 text-xl font-semibold hover:bg-zinc-700 hover:rounded-xl">
                                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                                </li>
                            </a>
                            <a href="">
                                <li class="my-2 p-4 text-xl font-semibold hover:bg-zinc-700 hover:rounded-xl">
                                    <i class="fa-regular fa-comment"></i> Mensagens
                                </li>
                            </a>
                            <a href="">
                                <li class="my-2 p-4 text-xl font-semibold hover:bg-zinc-700 hover:rounded-xl">
                                    <i class="fa-solid fa-hashtag"></i> Trending Topics
                                </li>
                            </a>
                            <a href="">
                                <li class="my-2 p-4 text-xl font-semibold hover:bg-zinc-700 hover:rounded-xl">
                                    <i class="fa-solid fa-list"></i> Listas
                                </li>
                            </a>
                            <a href="{{route('profile',session('user.tag'))}}">
                                <li class="my-2 p-4 text-xl font-semibold hover:bg-zinc-700 hover:rounded-xl">
                                    <i class="fa-solid fa-user"></i> Perfil
                                </li>
                            </a>
                            <a href="">
                                <li class="my-2 p-4 text-xl font-semibold hover:bg-zinc-700 hover:rounded-xl">
                                    <i class="fa-solid fa-gear"></i> Configurações
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
                <!--fim da sidebar mobile-->
                <livewire:post-form/>

                @yield('content')
        
            </article>
            <!--fim da barra principal-->

            @include('partials.searchBar')
        </main>
        @yield('scripts')
    </body>
@endsection