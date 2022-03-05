

@include('_head')

@include('_nav')

        <h1 class="text-3xl font-semibold text-gray-900 text-center mt-4">
            Settings
        </h1>
        <?php 
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Storage;
        ?>
        
        <article class="max-w-fw mx-auto flex flex-col items-center border-solid border-2 border-white max-h-full my-5 bg-white rounded p-5">

    
            <div class="py-8">
                 
                @if(isset($image))

                <?php
                    $path = substr($image->path, 6, strpos($image->path, ".jpg"));
                ?>

                <img src="{{ asset('storage'.$path)}}" alt="profile image" class="shadow object-cover w-36 h-36 align-middle border-none rounded-full">
                @else
                
                <img src="https://vectorified.com/images/generic-avatar-icon-12.jpg" alt="profile image" class="shadow object-cover w-36 h-36 align-middle border-none rounded-full" />
                @endif
            </div>
        
       

            
                
                <div class="flex gap-x-2">
                    @isset($image)
                        <div>
                        <a href="{{ url('/user/upload-image') }}" class="mb-4 text-sm text-gray-700 hover:text-gray-900 dark:text-gray-500 underline">Change avatar</a>
                        </div>
                        
                        <form action="{{ url('/delete-image', Auth::user()->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="mb-4 text-sm text-gray-700 hover:text-gray-900 dark:text-gray-500 underline cursor-pointer">Delete avatar</button>
                
                        </form>
                        
                    @else 
                        <a href="{{ url('/user/upload-image') }}" class="mb-4 text-sm text-gray-700 hover:text-gray-900 dark:text-gray-500 underline">Upload avatar</a>
                    @endisset
                </div>

                <form action="{{ url('user/update-settings/')}}" method="POST" class="mx-auto my-2 flex flex-col items-center w-4/5">
               
                @method('PUT')
                
                @csrf
        
                <div class="mb-4">
                    <label class="block" for="name">name</label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name}}" class="border rounded pl-2">
                </div>    
                <div class="mb-4">
                    <label class="block" for="email">email</label>
                    <input type="email" name="email" id="email" value="{{ Auth::user()->email}}" class="border rounded pl-2">
                </div>    
                <div class="mb-4">
                    <label class="block" for="password">new password</label>
                    <input type="password" name="password" id="password" class="border rounded pl-2">
                </div>    
                <div class="mb-4">
                    <label class="block" for="passConfirm">confirm password</label>
                    <input type="password" name="passConfirm" id="passConfirm" class="border rounded pl-2">
                </div>    
                <div class="mb-4">
                <button type="submit" class="bg-gray-500 text-white border border-gray-600 hover:bg-blue-300 font-bold py-1 px-4 rounded">Save</button>
                </div>    
            </form>

            @if (session()-> has('success') || session()-> has('status'))
                <div x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    id="status" role="alert">
                    <p class="text-green-600">{{ session('success') }}</p>
                    <p class="text-red-600">{{ session('status') }}</p> 
                </div>
            @endif
        </article>
      
       
                   
                

    </div>

</body>
</html>