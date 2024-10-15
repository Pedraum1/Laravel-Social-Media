@extends('layouts.layout_base')

@section('title_base')
    Bem-vindo
@endsection

@section('body')
    <body class="bg-zinc-900 flex justify-center text-white flex-col md:flex-row">
        <div class="md:w-[80%]">
            <div class="flex justify-center items-center h-screen">
                <div class="md:w-1/2">
                    <img class="md:mx-0 mx-auto" src="{{ asset("assets/images/banner_logo.png")}}">
                    <h1 class="mt-5 mb-10 md:text-7xl text-5xl font-semibold text-center md:text-start"><span class="text-yellow-300">Tchola</span> Social</h1>
                    <div class="md:w-1/2">
                        <p class="text-justify w-96 md:w-full">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Et, numquam fuga id iste ratione vero repellat tempore,
                            excepturi neque dicta reprehenderit, minima quasi eaque
                            corrupti eos quibusdam qui magni at!
                        </p>
                        <div class="flex justify-center mt-16">
                            <a href="login.html">
                                <button class="text-2xl bg-fuchsia-600 py-4 px-7 rounded-full active:translate-y-1 active:bg-fuchsia-700 transition ease-in-out">
                                    START NOW
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 md:block hidden">
                    <img src="{{ asset("assets/images/log.svg")}}">
                </div>
            </div>
        </div>
    </body>
@endsection