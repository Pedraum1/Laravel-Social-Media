        <!--sidebar-->
        <aside class="w-1/3 flex-grow border-e-2 border-zinc-700 md:flex md:justify-end hidden">
            <div class="mx-10">
                <ul>
                    <li class="mt-8 mb-4 ms-4">
                        <a href=""></a><img src="{{asset('storage').'/'.session('user.profile_img')}}" class="w-14 h-14 rounded-full">
                    </li>
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
                    <li class="mt-12 ms-4">
                        <button class="py-3 px-5 bg-fuchsia-600 rounded-full text-xl font-semibold text-center w-fit" data-modal-target="modal-post" data-modal-toggle="modal-post">
                            <i class="fa-regular fa-pen-to-square"></i> Postar
                        </button>
                    </li>
                </ul>
            </div>

        </aside>
        <!--fim da sidebar-->