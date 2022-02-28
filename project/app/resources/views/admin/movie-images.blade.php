<x-admin>

    <div class="">

        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="">

            <h1>Edit images of a movie</h1>
            <div class="card-header text-center font-weight-bold">
                <h2>Upload Movie Images</h2>
            </div>

            <div class="">
                <form class="w-full max-w-sm" method="POST" enctype="multipart/form-data" id="upload-image" action="{{ url('save') }}">
                    @csrf
                    <div class="mb-6 flex">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="image">
                                Image:
                            </label>
                        </div>
                        <div class="w-full">
                            <input type="file" name="image" placeholder="Choose image" id="image">
                            @error('image')
                            <div class="">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <img id="preview-image-before-upload" src="" alt="preview image" style="max-height: 250px;">
                    </div>

                    <div class="md:w-2/3">
                        <button type="submit" class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" id="submit">Upload</button>
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

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>

</x-admin>