@extends('layouts.layout_main')

@section('title')
    Página Inicial
@endsection

@section('content')

        <!--navbar-->
        <div class="border-b-2 border-zinc-700 flex">
            <div class="mx-2 ms-5 text-lg font-bold border-fuchsia-500 border-b-2 text-center">
                <p class="p-3"><a href="">Discover</a></p>
            </div>
            <div class="mx-2 text-lg w-28 text-center">
                <p class="p-3"><a href="">Following</a></p>
            </div>
            <button class="ms-auto me-8 my-auto text-2xl md:hidden" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <!--fim da navbar-->

@endsection

@section('scripts')
    <script src="{{asset('assets/js/postInput.js')}}"></script>
@endsection