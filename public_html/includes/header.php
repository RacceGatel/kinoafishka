<header class="header">
    <link rel="stylesheet" href="<?=_css?>css/header.css">
        <div class="container-fluid">
            <div class="row justify-content-center">
               <div class="col-lg-12 nav_header">
                <ul class="nav_head d-flex justify-content-center">
                    <div class="col-auto"><li><a href="../../index.php"><span>Главная</span></a></li></div>
                     <div class="col-auto"><li><a href="../../other/all_films/films.php"><span>Все фильмы</span></a></li></div>
                     <div class="col-auto">
                         <li>
                             <form class="d-flex" method="get">
                                 <input class="form-control me-2" name="id" id="input_search" type="search" placeholder="Поиск фильма" aria-label="Search">

                                 <button class="btn btn-outline-success btn_search" type="submit">Поиск</button>

                                 <div class="dropdown">
                                     <button class="btn btn-secondary dropdown-toggle" name="genre_s" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        По жанру
                                     </button>
                                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                         <?php 
                                            for ($i = 1; $i <= get_genre_count(); $i++) {
                                                
                                                echo '<li><a href="/other/all_films/films.php?genre='.$i.'" class="dropdown-item" id="'.$i.'">';
                                                echo get_genre_name($i);
                                                echo'</a></li>';
                                            }   
                                         ?>
                                     </ul>
                                 </div>
                                 <?php
                                
                                 if(isset($_GET['button_s'])){
                                     $search = $_GET['input_s'];
                                     //$genre = $_GET['genre_s'];
                                     $ids = searchFilm($search);
                                     if($ids != 0) {
                                         header("Location: /other/cinema/cinema.php?id=" . $ids);
                                     }
                                 }
                                 ?>
                             </form>
                         </li>
                     </div>

                </ul>
                </div>
            </div>
            <div class="row">
                <div class="head_header">
                    <div class="head_logo friedge_top row justify-content-center animated bounceInDown"><img src="img/logo.png" alt=""></div>
                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../../js/header.js"></script>

</header>