<!DOCTYPE html>
<html>

<style>
    td { 
        padding:10px
    }
    input[type="text"]{
        padding: 15px 0px;
        border:1px solid #ddd; 
        border-radius: 5px;
    }
    input[type="submit"]{
        padding: 10px 10px;
        border:1px solid #ddd; 
        border-radius: 5px;
    }
    #yukleniyor {color: #f00; margin-top: 20px; display:none}
    tr#table-head {
        background: #f1f1f1;
    }
</style>
<body>

<?php 

ini_set('memory_limit', '512M');
require __DIR__.'/setting.php';
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/excel_read.php';




   
?>
<form action="" method="post">
    <h2>Search By Column</h2> <br/>
   <table border="1">
    <tr>
    <?php foreach($columns as $column){ 
        echo sprintf('<td>%s</td>', $column); 
    } ?> 
    </tr>
    
    <tr>
        <?php foreach($columns as $key => $value){ 
            echo sprintf('<td><input type="radio" name="column" value="%s" required></td>', $key); 
        } ?> 
        
    </tr>

    <tr>
        <td colspan="<?php echo count($columns)-1?>"><input type="text" required name="seacrText" value="" style="width:100%" placeholder="Search by text"></td>
        <td><input id="submit" type="submit" value="Search"></td> 
    </tr>
   </table>

</form>

<div>
    <span id="yukleniyor">Dosya içinde arama yapılıyor...</span>
    <div style="display:block; margin-top:20px">
    <?php 
        if(@$_POST["seacrText"]){
            $seacrText = trim(htmlspecialchars($_POST["seacrText"]));
            $columnID  = trim(htmlspecialchars($_POST["column"]));
            excel_read_search($filePath, $columnID, $seacrText);
        }
    
    ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(function(){
        $("#submit").click(function(){
            $("#yukleniyor").css("display", "block");
        });
    })
</script>
</body>
</html>