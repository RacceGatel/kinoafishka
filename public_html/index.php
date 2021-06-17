<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include ".//includes/bd.php"; ?>
    <link href="https://fonts.googleapis.com/css?family=Forum" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="animation/animate.css">
    <link rel="stylesheet" href="https://yastatic.net/jquery/3.3.1/jquery.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
    
    <title>ПРО-Афиша</title>
</head>
<body>
    <?php include ".//includes/header.php" ?>
    
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="sect_special col-lg-12">
                    <ul class="d-flex justify-content-center">
                        <div class="col-2 animated movleft"><li></li></div>
                        <div class="col-2"><li></li></div>
                        <div class="col-2 animated movright"><li></li></div>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="sect_discrabe col-lg-12">
                    <ul class="d-flex justify-content-center">
                        <li class="col-3">
                            <h2>Билеты</h2>
                            <p>Покупка и бронь билетов</p>
                        </li>
                        <li class="col-3">
                            <h2>Афиша</h2>
                            <p>Вся информация о кино-релизах</p>
                        </li>
                        <li class="col-3">
                            <h2>Поиск</h2>
                            <p>Поиск фильма в два клика</p>
                        </li>
                    </ul>
                </div>
            </div>
                <div class="menu col-12">
                  <div class="row justify-content-center best_recipes"><h2>Лучшие фильмы недели</h2></div>
                   <div class="row">
                    
                    <div class="menu_2 col-12">
                       <div class="menu_2__back col-11">
                        <div class="bd-example">
                          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="/other/cinema/img/back1.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                  <a href="/other/cinema/cinema.php?id=1"><h2>
                                    <?
                                        echo get_film_name("1");
                                    ?>
                                  </h2></a>
                                </div>
                              </div>
                              <div class="carousel-item">
                                <img src="/other/cinema/img/back2.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                  <a href="/other/cinema/cinema.php?id=2"><h2>
                                    <?php
                                       echo get_film_name("2");
                                    ?>
                                    </h2></a>
                                </div>
                              </div>
                              <div class="carousel-item">
                                <img src="/other/cinema/img/back3.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                  <a href="/other/cinema/cinema.php?id=3"><h2>
                                    <?php
                                        echo get_film_name("3");
                                    ?>
                                    </h2></a>
                                </div>
                              </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
    </section>

    <footer class="footer">
      <div class="container-fluid">

       </div>
    </footer>
    </body>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script>
  $(window).scroll(function() {
    $('.movleft').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+700) {
        $(this).addClass('bounceInLeft');
      }
    });
  });
        
    $(window).scroll(function() {
    $('.movright').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+700) {
        $(this).addClass('bounceInRight');
      }
    });
  });
        
</script>
</html>