<div class="head_header">
    <img class="head_logo animated bounceInDown" src="<?= _images ?>logo.png" alt="">
</div>

<div class="backg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="sect_special">
                <ul class="d-flex justify-content-center">
                    <li>
                        <div class="image animated"></div>
                        <div class="describe">
                            <h2>Билеты</h2>
                            <p>Покупка и бронь билетов</p>
                        </div>
                    </li>
                    <li>
                        <div class="image animated"></div>
                        <div class="describe">
                            <h2>Афиша</h2>
                            <p>Вся информация о кино-релизах</p>
                        </div>
                    </li>
                    <li>
                        <div class="image animated"></div>
                        <div class="describe">
                            <h2>Поиск</h2>
                            <p>Поиск фильма в два клика</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="menu">
            <p>Лучшие фильмы недели</p>
            <div class="row">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?=$data[0]['src']?>" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <p><a href="/film?id=<?=$data[0]['id']?>"><?=$data[0]['name']?></a></p>

                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?=$data[1]['src']?>" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <p><a href="/film?id=<?=$data[1]['id']?>"><?=$data[1]['name']?></a></p>

                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?=$data[2]['src']?>" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <p><a href="/film?id=<?=$data[2]['id']?>"><?=$data[2]['name']?></a></p>

                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
