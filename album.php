<?
function myscandir($dir, $sort=0)
{
    $list = scandir($dir, $sort);

    // если директории не существует
    if (!$list) return false;

    // удаляем . и .. (я думаю редко кто использует)
    if ($sort == 0) unset($list[0],$list[1]);
    else unset($list[count($list)-1], $list[count($list)-1]);
    return $list;
}
$dir = 'img/'.$_POST['idAlb'];
$files = myscandir($dir);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><? echo file_get_contents($dir."/title.txt"); ?></title>
    <!--    STYLE-->
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        .btnPanel{
            margin: 1rem auto;
        }
        .parent{
            flex-direction: column;
        }
    </style>
    <!--    SCRIPT-->
    <script src="js/bootstrap.js"></script>
</head>
<body>
<div class="parent">
    <form action="album.php" method="post" id="nameAlbum" class="btnPanel">
        <a class="btnAlb " href="index.php" >ГЛАВНОЕ</a>
        <button name="idAlb" class="btnAlb" type="submit" value="muratov">ПАШКА БУШЛАТОВ</button>
        <button name="idAlb" class="btnAlb" type="submit" value="makarov">ДЕД МАКАР</button>
        <button name="idAlb" class="btnAlb" type="submit" value="sotnikov">СОТИК</button>
        <button name="idAlb" class="btnAlb" type="submit" value="afanasev">ШТАКЕТ</button>
        <button name="idAlb" class="btnAlb" type="submit" value="kushkeev">УЗБЕК</button>
        <button name="idAlb" class="btnAlb" type="submit" value="gusevskii">ГУСЬ</button>
        <button name="idAlb" class="btnAlb border-0" type="submit" value="litus">КЛИТУРУС</button>
    </form>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <?
                echo file_get_contents($dir."/text.txt");
                ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><? echo file_get_contents($dir."/description.txt"); ?></h5>
                <div id="albumList" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?
                        for ($i=0;$i < count($files)-3;$i++){
                            if($i==0) echo "<li data-target=\"#albumList\" data-slide-to=\"".$i."\" class=\"active\"></li>";
                            else echo "<li data-target=\"#albumList\" data-slide-to=\"".$i."\" ></li>";
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?
                        $i=0;
                        foreach ($files as $file){
                            if (substr($file,-3)!=='txt'){
                                $i++;
                                if($i==1){
                                    echo "<div class=\"carousel-item active\">
                                            <img class=\"d-block mx-auto\" height ='780px' src=\"".$dir."/".$file."\" alt=\"".$i." слайд\">
                                          </div>";
                                } else {
                                    echo "<div class=\"carousel-item\">
                                            <img class=\"d-block mx-auto\" height ='780px' src=\"".$dir."/".$file."\" alt=\"".$i." слайд\">
                                          </div>";
                                }
                            }
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#albumList" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#albumList" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
