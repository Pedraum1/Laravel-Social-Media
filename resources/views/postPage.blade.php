@extends('layouts.layout_main')

@section('title')
    Post de {{$post->owner->tag}}
@endsection

@section('content')

        <!--navbar-->
        <div class="border-b-2 border-zinc-700 flex">
            <div class="mx-2 ms-5 py-3 text-lg font-bold text-center">
                <a href="{{route('home')}}"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
            <button class="ms-auto me-8 my-auto text-2xl md:hidden" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <!--fim da navbar-->

        <livewire:post :post_id="$post->id"/>
        @if ($comments)
            <div class="p-3">
                <h3 class="text-xl">Respostas:</h3>
            </div>
            @foreach ($comments as $comment)
                <livewire:post :post_id="$comment->id"/>
            @endforeach
        @endif


@endsection

@section('scripts')
    <script src="{{asset('assets/js/postInput.js')}}"></script>
@endsection