

@include('_head')

@include('_nav')

        <h1 class="text-3xl font-semibold text-gray-900 text-center mt-4">
            Settings
        </h1>
        <?php use Illuminate\Support\Facades\Auth; 
        ?>
        
        <article class="max-w-fw mx-auto flex flex-col items-center border-solid border-2 border-white max-h-64 my-5 bg-white rounded p-5">   
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

            @if (session()-> has('status'))
                <div x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    id="status" class="text-green-600 transition-opacity" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </article>
      
       
                   
                

    </div>

</body>
</html>