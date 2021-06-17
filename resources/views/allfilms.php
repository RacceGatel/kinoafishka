<div class="sect_head">
    <p>Все фильмы
        <?
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm)
            echo '<a id="add_film_btn" href="/film/add">Добавить фильм</a>';
        ?>
    </p>
</div>


<?

foreach ($data as $film) {
    include _views . "blockfilm.php";
}

?>