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

                <!--modal post-->
                <aside id="modal-post" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <form action="">
                            <!-- Modal content -->
                            <div class="relative rounded-lg shadow bg-zinc-900 border border-zinc-700">
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 flex justify-center gap-x-5">
                                    <div>
                                        <img src="{{ asset('storage').'/'.session('user.profile_img')}}" class="w-14 rounded-full">
                                    </div>
                                    <div class="w-5/6">
                                        <textarea name="" id="" rows="5" maxlength="150" placeholder="O que está pensando?" class="w-full bg-zinc-900 outline-none focus:ring-0 border-none resize-none text-xl" oninput="autoGrow(this); countCharacters(this)"></textarea>
                                        <p class="text-end" id="charCount">0/150</p>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-zinc-700 rounded-b">
                                    <button data-modal-hide="modal-post" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-white outline-none bg-zinc-900 rounded-lg border border-zinc-700 hover:bg-zinc-700 hover:border-zinc-600">
                                        Cancelar
                                    </button>
                                    <button data-modal-hide="modal-post" type="submit" class="text-white bg-fuchsia-600 hover:bg-fuchsia-700 ring-0 outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        Postar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </aside>
                <!--fim modal post-->
                
                <!--sidebar mobile-->
                <div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 ps-0 overflow-y-auto transition-transform -translate-x-full bg-zinc-900 w-80" tabindex="-1" aria-labelledby="drawer-label">
                    <div class="ms-5">
                        <ul>
                            <a href=""><li class="mt-8 mb-4 ms-4">
                                <img src="assets/images/noProfile.webp" class="w-20 rounded-full">
                                <h1 class="text-3xl font-semibold mt-5">Fulano</h1>
                                <p class="text-zinc-400">@fulano</p>
                                <p class="text-zinc-400"><span class="font-semibold text-white">XX</span> seguidores - <span class="font-semibold text-white">XX</span> seguindo</p>
                            </li></a>
                            <a href="">
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
                            <a href="">
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

                @yield('content')

                <button class="md:hidden absolute bottom-10 right-10 bg-fuchsia-600 rounded-full text-xl font-semibold text-center p-4 w-16 h-16" data-modal-target="modal-post" data-modal-toggle="modal-post">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
        
            </article>
            <!--fim da barra principal-->

            @include('partials.searchBar')
        </main>
        @yield('scripts')
    </body>
@endsection