<?php
// namespace App\Http\Controllers;
use App\Models\Movie;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
isset($_POST) ?  print_r(array_values($_POST)) : "";
if (isset($_GET)) {
    print_r($_GET['dynaInput']);
    $id = 15;
    $cast = [];
    //DB::table('movies')->where('id', $id)->update(['cast' => json_encode(array('Mr T', 'Jack', 'Gina'))]);
    //DB::table('movies')->where('id', $id)->update(['cast' => json_encode(array(array_values($_GET)))]); //this works
    for ($i = 0; $i < count($_GET['dynaInput']); $i++){
        $cast[] = array_values($_GET['dynaInput'][$i]);
   //Movie::where('id', $id)->update(['cast' => json_encode(array_values($_GET['dynaInput'][$i]))]);
   // DB::insert('INSERT INTO movies (cast) VALUES (?)', $_GET['dynaInput'][$i]); 
    };
    $flattened_cast =array_reduce($cast, 'array_merge', []);
    Movie::where('id', $id)->update(['cast' => json_encode(array_values($flattened_cast))]);
};
?>
<x-layout>
    <div class="container">
        <h1>Cast</h1>
        <!-- <form method="get" action="">         
 
        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <label for="cast2">Cast2</label>
        <input type="text" name="cast2" value="" class="" placeholder="" />
        <label for="cast3">Cast3</label>
        <input type="text" name="cast3" value="" class="" placeholder="" />
        <label for="cast4">Cast4</label>
        <input type="text" name="cast4" value="" class="" placeholder="" />
        <button type="submit">Submit</button>
    </form> -->

        <!-- add form table where rows can be added and removed dynamically -->
        <div class="">
            <form method="get" action="">
                <div class="flex justify-start" id="dynaForm">
                    <input type="text" name="dynaInput[0][row]" class="" />
                    <button type="button" id="addRemoveIp" class="">Add</button>
                </div>
                <div class="">
                    <button type="submit" class="">Submit</button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        let i = 0;
        $("#addRemoveIp").click(function() {
            ++i;
            $("#dynaForm").append('<div class="flex justify-start"><input type="text" name="dynaInput[' + i + '][row]"/><button type="button" class="">Delete</button></div>');
        });
        $(document).on('click', '.remove-item', function() {
            $(this).parent().remove();
        });
    </script>
<!-- 
keyboard.addEventListener("click", mainPlay);
  showPlaceholder('', selectedWord); / -->
</x-layout>