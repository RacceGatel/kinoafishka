<div class="backg">
    <div class="container">
        <div class="film_media">
            <div class="film_poster">
                <img src="<?= $data['src'] ?>" alt="">
            </div>
            <div class="film_trailer">
                <iframe src="<?= $data['lnk_trailer'] ?>" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
        <div class="film_back">
            <div class="head_block">
                <h1><?= $data['name'] ?></h1>
            </div>

            <div class="description_block">
                <div class="description">
                    <b>Жанр</b>
                    <p><?
                        if (count($data['genre']) > 1) {
                            $last = end($data['genre']);
                            foreach ($data['genre'] as $genre) {
                                echo $genre->name;
                                if ($genre != $last)
                                    echo ', ';
                            }
                        } else
                            echo $data['genre'][0]->name;
                        ?></p>
                </div>
                <div class="description">
                    <b>О фильме</b>
                    <p><?= $data['description'] ?></p>
                </div>
                <div class="rate_age_block">
                    <div class="age">
                        <b>Возрастное ограничение</b>
                        <p><?= $data['age'] ?>+</p>
                    </div>
                    <div class="rating">
                        <b>Рейтинг</b>
                        <p><?= round($data['rate'], 2) ?>/5</p>
                    </div>
                </div>
            </div>

            <div id="reserve_place" v-if="display == true" class="place_reserve_block">
                <b>Покупка билета</b>
                <div class="choice_block">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            {{cur_cinema}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li v-for='cinema in cinemas' v-on:click="ch_cinema(cinema)"><a class="dropdown-item">{{cinema}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            {{cur_date}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li v-for='dat in date' v-on:click="ch_date(dat)"><a class="dropdown-item">{{dat}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            {{cur_time}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li v-for='dat in time' v-on:click="ch_time(dat)"><a class="dropdown-item">{{dat}}</a>
                            </li>
                        </ul>
                    </div>

                    <button class="refresh_place" v-on:click="get_place()" type="button"></button>
                </div>

                <template v-if="places.length>0">
                    <div class="places_block">
                        <h1>{{hall}}</h1>
                        <div class="screen">ЭКРАН</div>
                        <div v-for="row in spots" class="row">
                            <div class="row_count">{{row[0]}}</div>
                            <button v-for="spot in row[1]" v-bind:price="spot[2]" v-bind:id='spot[0]'
                                    v-on:click="reserve" v-bind:class="spot[3]" v-bind:disabled="spot[3]!='free'">{{spot[1]}}
                            </button>
                            <div class="row_count">{{row[0]}}</div>
                        </div>
                    </div>
                    <?
                    /*
                    for ($i = 0; $i < 10; $i++) {
                        echo '<div class="row"><div class="row_count">' . ($i + 1) . '</div>';

                        for ($j = 0; $j < 24; $j++) {
                            echo '<button id="' . ($j + 1) . '" class="free">' . ($j + 1) . '</button>';
                        }
                        echo '<div class="row_count">' . ($i + 1) . '</div></div>';
                    }
                       */
                    ?>
                    <div class="price_buy_block">
                        <div class="price">
                            <b>Цена:</b>
                            <b id="price">{{sum}}</b><b> рублей</b>
                        </div>
                        <?
                            if(!Controller_Auth::check_login())
                                echo '<button type="button" id="btn-buy" data-bs-toggle="modal" data-bs-target="#reserveModal" v-bind:disabled="sel_place.length==0">Забронировать</button>';
                        ?>
                    </div>

                    <div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Бронирование билета</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td><b>Ряд</b></td>
                                            <td><b>Место</b></td>
                                            <td><b>Цена</b></td>
                                            <td><b>VIP</b></td>
                                        </tr>
                                        <tr v-for="place in sel_place">
                                            <td>{{places[place].row}}</td>
                                            <td>{{places[place].spot}}</td>
                                            <td>{{places[place].price}} рублей</td>
                                            <td>{{places[place].vip}}</td>
                                        </tr>
                                    </table>
                                    <br>
                                    <table>
                                        <tr>
                                            <td><b>Фильм</b></td>
                                            <td><b>Кинотеатр</b></td>
                                            <td><b>Дата</b></td>
                                            <td><b>Время</b></td>
                                            <td><b>Зал</b></td>
                                        </tr>
                                        <tr>
                                            <td><?= $data['name'] ?></td>
                                            <td>{{cur_cinema}}</td>
                                            <td>{{cur_date}}</td>
                                            <td>{{cur_time}}</td>
                                            <td>{{hall}}</td>
                                        </tr>
                                    </table>
                                    <br>
                                    <table>
                                        <tr>
                                            <td><b>Итого</b></td>
                                            <td>{{sum}} рублей</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" v-on:click="load_reserve" v-bind:disabled="sel_place.length==0" data-bs-dismiss="modal">ЗАБРОНИРОВАТЬ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>


        </div>
    </div>
</div>


<?
$auth = Controller_Auth::check_login();

echo '<div class="title_comments">Отзывы</div>
<div class="backg">';
if (!$auth && !$data['exist_comment']) {
    echo '
    <div class="container">
        <div id="add_comment" class="add_comment">
            <div class="header">Оставьте свой отзыв</div>
            <div class="body">
                <textarea v-model="comment" rows="4" wrap="soft" maxlength="512" name="text"></textarea>
            </div>
            <section>
                <input id="rad-1" name="rate" type="radio" value="1" v-model="rate">
                <label for="rad-1">1</label>
                <input id="rad-2" name="rate"  type="radio" value="2" v-model="rate">
                <label for="rad-2">2</label>
                <input id="rad-3" name="rate"  type="radio" value="3" v-model="rate">
                <label for="rad-3">3</label>
                <input id="rad-4" name="rate"  type="radio" value="4" v-model="rate">
                <label for="rad-4">4</label>
                <input id="rad-5" name="rate"  type="radio" value="5" v-model="rate">
                <label for="rad-5">5</label>
            </section>
            <button id="' . $data['id'] . '" v-on:click="add_comment">Добавить</button>
        </div>';
}
echo '</div>
</div>';

if (count($data['comments']) > 0) {
    foreach ($data['comments'] as $comment)
        echo '<div class="backg">
    <div class="container">
        <div id="' . $comment[''] . '" class="comments_block">
            <div class="header">
                <span>' . $comment['user'] . '</span>
                <span>' . $comment['date'] . '</span>
                <span>Оценка: ' . $comment['rate'] . '</span>
            </div>
            <div class="body">
                <p>' . $comment['comment'] . '</p>
            </div>
        </div>
    </div>
</div>';
} else {
    echo '<div class="backg">
    <div class="container">
        <div id="" class="comments_block">
            <div class="header">
            </div>
            <div class="body">
                <p>Отзывов пока нет</p>
            </div>
        </div>
    </div>
</div>';
}
?>

