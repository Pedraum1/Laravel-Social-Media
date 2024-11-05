@extends('layouts.layout_main')

@section('title')
    {{$username}}
@endsection

@section('content')
    <!--profile section-->
    <section class=" mb-5">
        <img src="{{asset('storage/images').'/'.$banner_img}}" class="object-cover max-h-[175px] w-full flex flex-col">
        <div class="relative flex flex-row mb-24">
            <img src="{{asset('storage/images').'/'.$profile_img}}" class="w-40 absolute -translate-y-1/2 lg:left-6 left-2 rounded-full ">
            @if (session('user.tag')==$tag)
                <div class="absolute lg:right-6 right-2 lg:top-6 top-4" data-modal-target="editProfile-modal" data-modal-toggle="editProfile-modal">
                    <button class="p-4 bg-fuchsia-600 rounded-full hover:bg-fuchsia-500 font-bold">Editar Perfil</button>
                </div>
            @endif
        </div>
        <div class="mx-5">
            <h1 class="text-2xl font-semibold">{{$username}}</h1>
            <p class="text-zinc-400 hover:underline"><a href="/profile/{{$tag}}">@ {{$tag}}</a></p>
            <p class="text-justify mt-1 mb-4">
                {{$description}}
            </p>
            <p class="text-zinc-400">
                <a class="hover:underline" href=""><span class="font-bold text-white">{{$followers_num}}</span> seguidores</a>
                <a class="hover:underline" href=""><span class="font-bold text-white">{{$following_num}}</span class="text-bold text-white"> seguindo</a>
                <a class="hover:underline" href=""><span class="font-bold text-white">{{$posts_num}}</span> postagens</a>
            </p>
        </div>

        <!--Edit profile modal-->
        <div id="editProfile-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-zinc-800 rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 rounded-t">
                        <h3 class="text-xl font-semibold text-white">
                            Edite seu perfil
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="editProfile-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="">
                        <form class="space-y-4" action="{{route('profileUpdate')}}" method="POST" enctype="multipart/form-data">
                            <div class="relative mb-20">
                                <div class="relative">
                                    <img src="{{asset('storage/images').'/'.$banner_img}}" id="bannerImage" alt="banner" class="h-[200px] w-full object-cover">
                                    <div id="addBannerButton" class="absolute h-16 w-16 top-1/2 left-[35%] -translate-y-1/2 bg-zinc-950 opacity-40 rounded-full hover:opacity-70 transition-opacity duration-300 ease-in-out cursor-pointer">
                                        <i class="fa-solid fa-camera fa-2xl relative top-1/3 left-1/2 -translate-y-1/2 -translate-x-1/2"></i>
                                    </div>
                                    <div class="absolute h-16 w-16 top-1/2 right-[35%] -translate-y-1/2 bg-zinc-950 opacity-40 rounded-full hover:opacity-70 transition-opacity duration-300 ease-in-out cursor-pointer">
                                        <i class="fa-solid fa-x fa-2xl relative top-1/3 left-1/2 -translate-y-1/2 -translate-x-1/2"></i>
                                    </div>
                                </div>
                                <div class="absolute left-10">                                            
                                    <div class="relative w-32 h-32">
                                        <div class="absolute top-0 -translate-y-1/2 h-32 w-32 ">
                                            <img src="{{asset('storage/images').'/'.$profile_img}}" id="profileImage" alt="profile photo" class="rounded-full border-zinc-700">
                                        </div>
                                        <div id="addProfileButton" class="relative z-10 left-1/2 -translate-x-1/2 -translate-y-1/2 h-16 w-16 bg-zinc-950 opacity-40 rounded-full hover:opacity-70 transition-opacity duration-300 ease-in-out cursor-pointer flex justify-center items-center">
                                            <i class="fa-solid fa-camera fa-2xl"></i>
                                        </div>
                                    </div>
                                </div>
                                <input type="file" name="bannerInput" id="bannerInput" class="hidden">
                                <input type="file" name="profileInput" id="profileInput" class="hidden">
                                @csrf
                                <div class="absolute -bottom-30 right-4 max-w-[50%]">
                                    @error('profileInput')
                                        <p class="text-red-600 mt-2 text-end">{{$message}}</p>
                                    @enderror
                                    @error('bannerInput')
                                        <p class="text-red-600 mt-2 text-end">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="px-4 md:px-5">
                                <label for="nameInput" class="block mb-2 text-sm font-medium text-white">Nome</label>
                                <input type="text" name="nameInput" id="nameInput" value="{{!old('nameInput') ? $username : old('nameInput')}}" class="bg-zinc-700 border border-zinc-500 text-md font-semibold rounded-lg block w-full p-2.5 focus:ring-0"/>
                                @error('nameInput')
                                    <p class="text-red-600 mt-2 text-justify">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="px-4 md:px-5">
                                <label for="descriptionInput" class="block mb-2 text-sm font-medium text-white">Descrição</label>
                                <textarea name="descriptionInput" id="descriptionInput" class="bg-zinc-700 border border-zinc-500 text-sm rounded-lg block w-full p-2.5 resize-none focus:ring-0" rows="6">{{!old('descriptionInput') ? $description : old('descriptionInput')}}</textarea>
                                @error('descriptionInput')
                                    <p class="text-red-600 mt-2 text-justify">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="p-4 md:p-5">
                                <button type="submit" class="w-full  text-white bg-fuchsia-600 hover:bg-fuchsia-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--fim do Edit profile modal-->
        
    </section>
    <!--fim da profile section-->

    <!--profile navbar-->
    <div class="border-b-2 border-zinc-700 flex gap-x-1">
        <div class="text-lg font-bold border-fuchsia-500 border-b-2 text-center">
            <p class="p-3"><a href="">Postagens</a></p>
        </div>
        <div class="text-lg font-bold w-28 text-center">
            <p class="p-3"><a href="">Respostas</a></p>
        </div>
        <div class="text-lg font-bold w-28 text-center">
            <p class="p-3"><a href="">Mídia</a></p>
        </div>
        <button class="ms-auto me-8 my-auto text-2xl lg:hidden" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    <!--fim da profile navbar-->

@endsection

@section('scripts')
    <script src="{{asset('assets/js/postInput.js')}}"></script>
    <script src="{{asset('assets/js/editProfile.js')}}"></script>
@endsection