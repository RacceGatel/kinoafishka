<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $id = $_GET['id']; ?>
    <?php include "..//..//includes/bd.php"; ?>
    <link href="https://fonts.googleapis.com/css?family=Forum" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="css/cinema.css">
    
    <title><?php echo get_film_name($id) ?></title>
</head>
<body>
   <?php include "..//..//includes/header.php" ?>
   
   <section>
       <div class="container">
           <div class="row justify-content-center head_block" id=<?php echo $id ?>>
               <h2><?php echo get_film_name($id) ?></h2>
           </div>
           <div class="row justify-content-center">
               <div class="block_food">
                   <div class="col-12 block_food__all">
                      <div class="row block_main1">
                       <div class="col-6 block_1">
                           <iframe width="900" height="506" src="<?php echo get_film_trailer($id) ?>" frameborder="0"
                                   allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                   allowfullscreen>

                           </iframe>
                            
                       </div>
                       <div class="col-6 block_2">
                           <div class="block_img"><img src="img/back<?php echo $id ?>.jpg" alt=""></div>
                       </div>
                       </div>
                       <div class="row block_main2">
                           <div class="col-12 main">
                               <div class="row">
                                <div class="col-1 main_count">
                                    <div>1</div>
                                </div>
                                <div class="col-10 main_text">
                                    <h4>О фильме</h4>
                                    <?php echo get_film_describe($id) ?>
                                    <div class="main_rate">
                                        <div class="rating">
                                            <div class="name_rate">Рейтинг</div>
                                            <img class="img_rate" src="img/rating.png" alt="">
                                            <div class="rating">5/5</div>
                                        </div>
                                        <div class="age">
                                            <div class="name_age">Возрастное ограничение:</div>
                                            <div class="age_rate"><?php echo get_film_age($id)?>+</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 main_count">
                                    <div>2</div>
                                </div>
                                </div>
                                <div class="row">


                                </div>
                                <div class="row">

                                </div>
                                <div class="row">
                                <div class="col-1 main_count">
                                    <div>1</div>
                                </div>
                                <div class="col-10 main_text">
                                    <div class="kino_place">
                                        <h4>Покупка билета</h4>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Выбрать кинотеатр
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item">Искра</a></li>
                                                <li><a class="dropdown-item">Синема парк</a></li>
                                                <li><a class="dropdown-item">Семья</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="place_box">
                                        <div class="row_place row1 row justify-content-center"> 
                                        </div>
                                        <div class="row_place row2 row justify-content-center">
                                           
                                        </div>
                                        <div class="row_place row3 row justify-content-center">
                                            
                                        </div>
                                        <div class="row_place row4 row justify-content-center">
                                            
                                        </div>
                                    </div>
                                    <div class="price_place row">
                                        <div class="col-6 text"><h4>Цена билета:0</h4></div>
                                        <div class="col-6 but"><button>Купить</button></div>
                                    </div>
                                </div>
                                <div class="col-1 main_count">
                                    <div>2</div>
                                </div>
                                </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
   
  <footer>
      
  </footer>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="js/example.js"></script>
    </body>
</html>