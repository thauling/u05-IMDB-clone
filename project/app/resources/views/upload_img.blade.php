@include ('_head')
@include ('_nav')

    <div class="max-w-fw mx-auto flex border-solid border-2 border-white max-h-64 my-5 bg-white rounded ">

        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="p-4 mx-auto">
            <div class="my-6">
                <h1 class="block text-black text-lg font-bold">Upload Movie Images</h1>
            </div>

            <div class="mb-6">
                <form class="w-full max-w-sm" method="POST" enctype="multipart/form-data" id="upload-image" action="{{ url('save') }}">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                    
                    <div class="mb-6 flex">
                        <div class="w-full flex">
                            <input type="file" name="image" placeholder="Choose image" id="image">

                            <svg id="delete" class="hidden w-6 h-6 text-red-700 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                            @error('image')
                            <div class="">{{ $message }}</div>
                            @enderror
                            <div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <img id="preview" src="" alt="preview image" style="max-height: 250px;">
                    </div>

                    <div class="md:w-2/3">
                        <button type="submit" class="bg-gray-500 text-white border border-gray-600 hover:bg-blue-300 font-bold py-2 px-4 rounded" id="submit">Upload</button>
                    </div>
            </div>
            </form>

        </div>

    </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {

            $('#image').change(function() {

                let reader = new FileReader();
                

                reader.onload = (e) => {

                    $('#preview').attr('src', e.target.result);
                    $('#preview').css('display', 'block');
                    $('#delete').css('display', 'block');
                    
                }

                reader.readAsDataURL(this.files[0]);

                

            });
            
            if($('#preview').attr('src') === "") {
                    $('#preview').css('display', 'none');
            }

            $('#delete').click(function() {
                $('#preview').attr('src', "");
                $('#preview').css('display', 'none');
                $('#delete').css('display', 'none');
            })


        });
    </script>

    <script src="../js/app.js"></script>

</body>
</html>