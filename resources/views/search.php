<div class="sect_head">
    <p>Поиск: <?=$_GET['name']?></p>
</div>


<?
if (count($data) > 0)
    foreach ($data as $film) {
        include _views . "blockfilm.php";
    }
else
    echo '
    <div class="block_not_found">Извините, но нам не удалось ничего найти</div>';
?>