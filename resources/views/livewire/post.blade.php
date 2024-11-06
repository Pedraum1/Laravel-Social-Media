<div>
    <!--post com fotos-->
    <section class="flex flex-row pb-3 p-5 border-b-2 border-zinc-700">
        <div class="me-3">
            <img src="{{asset('storage/images').'/'}}{{!empty($post->owner->profile_image) ? $post->owner->profile_image->name->name : 'noProfile.webp'}}" class="w-14 rounded-full">
        </div>
        <div class="w-full">
            <!--header do post-->
            <div class="flex flex-row justify-between items-center">
                <div>
                    <p>
                        <span class="text-lg font-bold">{{$post->owner->username}}</span> <a class="text-zinc-400 hover:underline" href="{{route('profile',$post->owner->tag)}}">{{'@'.$post->owner->tag}}</a>  - {{$post->date}}
                    </p>
                </div>
                <div>
                    <a href="{{route('seePost',$id)}}"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
            <!--fim do header do post-->

            <!--texto do post-->
            <p class="text-justify mb-3">
                {{$post->text}}
            </p>
            <!--fim do texto do post-->

            <!--fotos do post-->
            <div class="flex flex-row gap-x-1 gap-y-1 max-w-[534px] max-h-[534px]">
                @foreach ($post->images as $image)                    
                    <div class="w-auto h-auto">
                        <img src="{{asset('storage/images/').'/'.$image->name}}" class="object-fit">
                    </div>
                @endforeach
            </div>
            <!--fim das fotos do post-->
            
            <!--funções do post-->
            <div class="flex flex-row mt-3">
                <livewire:reply-form :post_id="$id"/>
                <div class="mx-auto"><a href=""><i class="fa-solid fa-retweet"></i> {{$post->shares}}</a></div>
                <div class="mx-auto"><a href=""><i class="fa-regular fa-heart"></i> {{$post->likes}}</a></div>
                <i class="fa-solid fa-ellipsis mx-auto cursor-pointer" data-popover-target="popover-{{$id}}" data-popover-trigger="click"></i>
            </div>
            <!--other functions popover-->
            <div data-popover id="popover-{{$id}}" role="tooltip" class="absolute z-10 min-w-52 invisible inline-block text-sm text-white transition-opacity duration-300 bg-zinc-800 border border-zinc-700 rounded-lg shadow-sm opacity-0">
                <ul class="py-2 px-1">
                    @if (session('user.tag') == $post->owner->tag)
                        <li class="text-lg px-3 mb-2 hover:bg-zinc-700 hover:cursor-pointer rounded-md py-1"><i class="fa-solid fa-thumbtack fa-xs"></i> Fixar no seu perfil</li>
                        <a href="{{route('deletePost',$id)}}"><li class="text-lg px-3 mb-2 hover:bg-zinc-700 hover:cursor-pointer rounded-md py-1"><i class="fa-solid fa-trash fa-xs"></i> Excluir postagem</li></a>
                    @else
                        <li class="text-lg px-3 mb-2 hover:bg-zinc-700 hover:cursor-pointer rounded-md py-1"><i class="fa-solid fa-volume-xmark fa-xs"></i> Silenciar  {{'@'.$post->owner->tag}}</li>
                        <li class="text-lg px-3 mb-2 hover:bg-zinc-700 hover:cursor-pointer rounded-md py-1"><i class="fa-solid fa-ban fa-xs"></i> Bloquear {{'@'.$post->owner->tag}}</li>
                    @endif
                </ul>
            </div>
            <!--fimdo other functions popover-->
            <!--fim das funções do post-->
        </div>
    </section>
    <!--fim do post com fotos-->
</div>
