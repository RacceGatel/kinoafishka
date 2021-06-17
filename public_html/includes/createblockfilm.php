
<div class="col-12 sect">
    <a href="../cinema/cinema.php?id=<?php echo $id ?>">
        <div class="row">
            <div class="col-12 sect_recipe sect_recipe__1">
                <div class="row">
                    <div class="col-6 recipe_text">
                    <h1><?php echo get_film_name($id) ?></h1>
                    <div class = "about_film">
                        <p> <?php echo get_film_describe($id) ?></p>
                    </div>
                    <div class="rating_film">
                        <div>
                            <img src="img/rating.png" alt="">
                            <p><?php echo get_film_rate($id) ?>/5</p>
                        </div>
                    </div>
                    <div class="age_film">
                        <p><?php echo get_film_age($id) ?>+</p>
                    </div>
                    </div>
                    <div class="col-6 recipe_img">
                        <div><img src="/other/cinema/img/back<?php echo $id ?>.jpg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </a> 
</div>
