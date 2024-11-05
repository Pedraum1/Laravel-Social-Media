<div>
    <button wire:click="showPostModal" class="fixed bottom-[10%] md:right-[25%] right-[10%] bg-fuchsia-600 rounded-full text-xl font-semibold text-center p-4 w-16 h-16">
        <i class="fa-regular fa-pen-to-square"></i>
    </button>
    <!--modal post-->
    <aside class="{{ $hidden ? '' : 'hidden'}} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">
       <div class="{{ $hidden ? '' : 'hidden'}} absolute w-full h-full bg-black opacity-70"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-4 w-full max-w-2xl max-h-full">
            <form wire:submit.prevent="newPost">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-zinc-900 border border-zinc-700">
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 flex justify-center gap-x-5">
                        <div>
                            <img src="{{ asset('storage/images').'/'.session('user.profile_img')}}" class="w-14 rounded-full">
                        </div>
                        <div class="w-5/6">
                            <textarea name="textInput" id="" wire:model="textInput" rows="5" maxlength="150" placeholder="O que está pensando?" class="w-full bg-zinc-900 outline-none focus:ring-0 border-none resize-none text-xl" oninput="autoGrow(this); countCharacters(this)"></textarea>
                            <p class="text-end" id="charCount">0/150</p>
                            @error('textInput')
                                <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-zinc-700 rounded-b">
                        <button type="button" wire:click="showPostModal" class="py-2.5 px-5 ms-3 text-sm font-medium text-white outline-none bg-zinc-900 rounded-lg border border-zinc-700 hover:bg-zinc-700 hover:border-zinc-600">
                            Cancelar
                        </button>
                        <button class="text-white bg-fuchsia-600 hover:bg-fuchsia-700 ring-0 outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Postar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </aside>
    <!--fim modal post-->
</div>