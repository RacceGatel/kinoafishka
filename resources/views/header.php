<header>
    <ul>
        <li><a href="/">Главная</a>
            <a href="/all">Все фильмы</a>

        </li>
        <li>
            <form id="search" class="d-flex" action="/search" method="get">
                <input name="name" id="input_search" type="search"
                       placeholder="Поиск фильма" aria-label="Search">

                <button class="btn-search" type="submit">Поиск</button>

                <button class="btn-genre dropdown-toggle" name="genre_s" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    По жанру
                </button>

                <ul id="search_genres" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?
                    include_once _app . '/models/model_genres.php';

                    foreach ((new model_genres)->get_all() as $genre) {
                        echo '<li id="' . $genre[1] . '" v-on:click="search_genre">' . $genre[1] . '</li>';
                    }
                    ?>
                </ul>
            </form>
        </li>

        <?

        $auth = Controller_Auth::check_login();

        if ($auth) {
            echo '<li>
                        <span class="btn-auth" data-bs-toggle="modal" data-bs-target="#registerModal">Регистрация</span>
                        <span class="btn-auth" data-bs-toggle="modal" data-bs-target="#enterModal">Войти</span></li>';
        } else {
            echo '<li>
                        <a class="user" id=' . $_SESSION['id'] . ' data-bs-toggle="modal" data-bs-target="#profileModal">Профиль</a>
                      <a class="exit" id="logout" v-on:click="logout">Выйти</a></li>';
        }
        ?>

    </ul>
</header>

<div id="profile_block">
    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button v-bind:class="is_class('profile')" type="button" v-on:click="open('profile')">Профиль
                    </button>
                    <button v-bind:class="is_class('reserve')" type="button"
                            v-on:click="open('reserve'),refresh_orders()">Бронирования
                    </button>
                    <button v-bind:class="is_class('options')" type="button" v-on:click="open('options')">Настройки
                    </button>
                    <?
                    if (!Controller_Auth::check_perm())
                        echo '<button onclick="location.href =\'admin\'" type="button" >Админ-панель</button>';
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div v-show="is_page('profile')" class="modal-body">
                    <h4>Основная информация: </h4>
                    <div class="main_info">
                        <h6 :id="user.id" class="modal-title">ID: <b>{{user.id}}</b></h6>
                        <h6>Статус: <b>{{user.perm}}</b></h6>
                        <h6>Логин: <b>{{user.name}}</b></h6>
                        <h6>Почта: <b>{{user.email}}</b></h6>
                        <h6>Телефон: <b>{{user.phone}}</b></h6>
                    </div>
                </div>
                <div v-show="is_page('profile')" class="modal-footer">
                    <button type="button" class="btn btn-danger" v-on:click="logout()">Выйти с аккаунта</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>


                <div v-show="is_page('reserve')" class="modal-body">
                    <table v-if="orders.length > 0">
                        <tr>
                            <td></td>
                            <td><b>Фильм</b></td>
                            <td><b>Кинотеатр</b></td>
                            <td><b>Дата</b></td>
                            <td><b>Время</b></td>
                            <td><b>Зал</b></td>
                            <td><b>Цена</b></td>
                            <td><b>VIP</b></td>
                            <td><b>Ряд</b></td>
                            <td><b>Место</b></td>

                        </tr>
                        <tr v-for="order in orders">
                            <td>
                                <button v-on:click="cur_idorder = order.id; cur_idplace = order.idplace"
                                        data-bs-toggle="modal"
                                        data-bs-target="#acceptModal" type="button">X
                                </button>
                            </td>
                            <td>{{order.film}}</td>
                            <td>{{order.name}}</td>
                            <td>{{new Date(order.date).toLocaleDateString()}}</td>
                            <td>{{order.time.slice(0,-3)}}</td>
                            <td>{{order.num}}</td>
                            <td>{{order.price}} рублей</td>
                            <td>{{order.vip}}</td>
                            <td>{{order.row}}</td>
                            <td>{{order.spot}}</td>
                        </tr>

                    </table>
                    <div v-else>
                        <h5>Здесь пока ничего нет</h5>
                    </div>
                </div>
                <div v-show="is_page('reserve')" class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>


                <div v-show="is_page('options')" class="modal-body options_block">
                    <div v-if="0">
                        <h5>Здесь пока ничего нет</h5>
                    </div>
                    <div class="edit_info">
                        <h4>Изменить информацию профиля: </h4>
                        <div class="row">
                            <input v-model="ch_name" type="text" placeholder="Введите новый логин" name="name">
                            <button class="btn btn-primary" v-on:click="change_login" type="button">Изменить логин</button>
                            <p>{{response_name}}</p>
                        </div>
                        <div class="row">
                            <input type="email" v-model="ch_email" placeholder="Введите почту" name="email">
                            <button class="btn btn-primary" v-on:click="change_email" type="button">Изменить почту</button>
                            <p>{{response_email}}</p>
                        </div>
                        <div class="row">
                            <input type="tel" v-model="ch_phone" placeholder="Введите номер" name="phone">
                            <button class="btn btn-primary" v-on:click="change_phone" type="button">Изменить номер телефона</button>
                            <p>{{response_phone}}</p>
                        </div>
                        <div class="row">
                            <input type="password" v-model="ch_psw" placeholder="Введите пароль" name="psw">
                            <button class="btn btn-primary" v-on:click="change_psw" type="button">Изменить пароль</button>
                            <p>{{response_psw}}</p>
                        </div>
                    </div>
                </div>
                <div v-show="is_page('options')" class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Accept Modal -->
    <div class="modal fade" id="acceptModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Вы уверены, что хотите отменить бронь?</h4>
                    <button v-on:click="delete_order" type="button" data-bs-dismiss="modal" class="btn btn-success">Да
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Регистрация</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="name"><b>Логин*</b></label>
                    <input v-model="name" type="text" placeholder="Введите логин" name="name">

                    <label for="email"><b>Email*</b></label>
                    <input type="email" v-model="email" placeholder="Введите почту" name="email">

                    <label for="phone"><b>Телефон</b>(без +)</label>
                    <input type="tel" v-model="phone" placeholder="Введите номер" name="phone">

                    <label for="psw"><b>Пароль*</b></label>
                    <input type="password" v-model="psw" placeholder="Введите пароль" name="psw">


                    <div id="errors">
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" v-on:click='register' type="button">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Enter Modal -->
<div class="modal fade" id="enterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Вход</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="name"><b>Логин</b></label>
                    <input v-model="name" type="text" placeholder="Введите логин" name="name">

                    <label for="psw"><b>Пароль</b></label>
                    <input type="password" v-model="psw" placeholder="Введите пароль" name="psw">

                    <div id="errors">
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" v-on:click='enter' type="button">Войти</button>
                </div>
            </form>
        </div>
    </div>
</div>

