<div class="backg">
    <div class="container">
        <div class="sect_content">
            <a href="/film?id=<?= $film['id'] ?>">
                <div class="sect_film">
                    <div class="film_img">
                        <img src="<?= $film['src'] ?>" alt="">
                    </div>
                    <div class="film_text">
                        <h1><?= $film['name'] ?></h1>
                        <hr>
                        <div class="about_film">
                            <p><?= $film['description'] ?>Гадкий снаружи, но добрый внутри Грю намерен, тем не менее,
                                закрепить за
                                собой статус главного архизлодея в мире, для чего он решает выкрасть Луну при помощи
                                созданной
                                им армии миньонов. Дело осложняют конкуренты, вставляющие высокотехнические палки в
                                колеса, и
                                семейные обстоятельства в виде трех сироток, о которых Грю вынужден заботиться.</p>
                        </div>
                        <hr>
                        <div class="film_footer">
                            <div class="rating_film">
                                <p><?= $film['rate'] ?>/5</p>
                            </div>
                            <div class="age_film">
                                <p><?= $film['age'] ?>+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
