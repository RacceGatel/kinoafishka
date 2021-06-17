<div id="admin_panel" class="container">
    <div class="action_content">
        <div class="add_cinema">
            <label for="name_cinema">Название кинотеатра</label><input placeholder="Киномакс" v-model="cinema_name"
                                                                       id="name_cinema"
                                                                       type="text">
            <button v-on:click="add_cinema">Добавить кинотеатр</button>
        </div>

        <div class="create_hall">

            <label for="num_hall">Номер холла(зал)</label><input placeholder="1" v-model="hall_num" id="num_hall"
                                                                 type="text">
            <label for="hall_size">Общее количество мест</label><input v-model="hall_size" id="hall_size" type="number">
            <label for="hall_row">Число рядов</label><input v-model="hall_row" id="hall_row" type="number">
            <label for="hall_spot">Число мест на ряд</label><input v-model="hall_spot" id="hall_spot" type="number">

            <button v-on:click="create_hall">Создать холл(зал)</button>
        </div>

        <div class="add_halls">
            <button class="btn-genre dropdown-toggle" name="genre_s" type="button"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{set_cinema}}
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?
                foreach ($data['cinemas'] as $row) {
                    echo '<li id="' . $row['id'] . '" v-on:click="set_cinema_set">id=' . $row['id'] . ' name=' . $row['name'] . '</li>';
                }
                ?>
            </ul>

            <button class="btn-genre dropdown-toggle" name="genre_s" type="button"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{set_hall}}
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?
                foreach ($data['halls'] as $row) {
                    echo '<li id="' . $row['id'] . '" v-on:click="set_hall_set">id=' . $row['id'] . ' num=' . $row['num'] . '</li>';
                }
                ?>
            </ul>

            <button v-on:click="add_hall">Добавить холл</button>
        </div>

        <div class="add_seance">
            <button class="btn-genre dropdown-toggle" name="genre_s" type="button"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{set_cinema_seance}}
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?
                foreach ($data['cinemas'] as $row) {
                    echo '<li id="' . $row['id'] . '" v-on:click="set_cinema_seance_set">id=' . $row['id'] . ' name=' . $row['name'] . '</li>';
                }
                ?>
            </ul>

            <button class="btn-genre dropdown-toggle" name="genre_s" type="button"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{set_hall_seance}}
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?
                foreach ($data['halls'] as $row) {
                    echo '<li id="' . $row['id'] . '" v-on:click="set_hall_seance_set">id=' . $row['id'] . ' num=' . $row['num'] . '</li>';
                }
                ?>
            </ul>

            <button class="btn-genre dropdown-toggle" name="genre_s" type="button"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{set_film}}
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?
                foreach ($data['films'] as $row) {
                    echo '<li id="' . $row['id'] . '" v-on:click="set_film_set">id=' . $row['id'] . ' name=' . $row['name'] . '</li>';
                }
                ?>
            </ul>

            <label for="set_date_seance">Дата: </label><input id="set_date_seance" v-model="set_date_seance"
                                                              type="date">
            <label for="set_time_seance">Время: </label><input id="set_time_seance" v-model="set_time_seance"
                                                               type="time">

            <button v-on:click="add_seance">Добавить сеанс</button>
        </div>

        <div class="add_places">
            <button class="btn-genre dropdown-toggle" name="genre_s" type="button"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{set_cinema_places}}
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?
                foreach ($data['cinemas'] as $row) {
                    echo '<li id="' . $row['id'] . '" v-on:click="set_cinema_places_set">id=' . $row['id'] . ' name=' . $row['name'] . '</li>';
                }
                ?>
            </ul>

            <button class="btn-genre dropdown-toggle" name="genre_s" type="button"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{set_hall_places}}
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?
                foreach ($data['halls'] as $row) {
                    echo '<li id="' . $row['id'] . '" v-on:click="set_hall_places_set">id=' . $row['id'] . ' num=' . $row['num'] . '</li>';
                }
                ?>
            </ul>

            <button v-on:click="add_places">Добавить места</button>
        </div>
    </div>


    <div class="info_content">

        <table>
            <h4>Кинотеатры</h4>
            <tr>
                <td></td>
                <td><b>id</b></td>
                <td><b>name</b></td>
            </tr>
            <?
            foreach ($data['cinemas'] as $row) {
                echo '<tr>
                        <td>
                                <button v-on:click="echo_delete_cinema('.htmlspecialchars(json_encode($row)).')"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal" type="button">X
                                </button>
                        </td>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['name'] . '</td>
                      </tr>';
            }
            ?>
        </table>

        <table>
            <h4>Фильмы</h4>
            <tr>
                <td></td>
                <td><b>id</b></td>
                <td><b>name</b></td>
            </tr>
            <?
            foreach ($data['films'] as $row) {
                echo '<tr>
                        <td>
                                <button v-on:click="echo_delete_film('.htmlspecialchars(json_encode($row)).')"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal" type="button">X
                                </button>
                        </td>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['name'] . '</td>
                      </tr>';
            }
            ?>
        </table>

        <table>
            <h4>Холлы(Залы)</h4>
            <tr>
                <td></td>
                <td><b>id</b></td>
                <td><b>num</b></td>
                <td><b>size</b></td>
                <td><b>rows</b></td>
                <td><b>spots</b></td>
            </tr>
            <?
            foreach ($data['halls'] as $row) {
                echo '<tr>
                        <td>
                                <button v-on:click="echo_delete_hall('.htmlspecialchars(json_encode($row)).')"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal" type="button">X
                                </button>
                        </td>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['num'] . '</td>
                        <td>' . $row['size'] . '</td>
                        <td>' . $row['rows'] . '</td>
                        <td>' . $row['spots'] . '</td>
                      </tr>';
            }
            ?>
        </table>

        <table>
            <h4>Связь: Кинотеатр - Зал</h4>
            <tr>
                <td></td>
                <td><b>idcinema</b></td>
                <td><b>idhall</b></td>
            </tr>
            <?
            foreach ($data['cinemas_halls'] as $row) {
                echo '<tr>
                        <td>
                                <button v-on:click="echo_delete_cinemas_halls('.htmlspecialchars(json_encode($row)).')"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal" type="button">X
                                </button>
                        </td>
                        <td>' . $row['idcinema'] . '</td>
                        <td>' . $row['idhall'] . '</td>
                      </tr>';
            }
            ?>
        </table>

        <table>
            <h4>Сеансы</h4>
            <tr>
                <td></td>
                <td><b>id</b></td>
                <td><b>idfilm</b></td>
                <td><b>idhall</b></td>
                <td><b>idcinema</b></td>
                <td><b>date</b></td>
                <td><b>time</b></td>
            </tr>
            <?
            foreach ($data['seance'] as $row) {
                echo '<tr>
<td>
                                <button v-on:click="echo_delete_seance('.htmlspecialchars(json_encode($row)).')"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal" type="button">X
                                </button>
                        </td>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['idfilm'] . '</td>
                        <td>' . $row['idhall'] . '</td>
                        <td>' . $row['idcinema'] . '</td>
                        <td>' . $row['date'] . '</td>
                        <td>' . $row['time'] . '</td>
                      </tr>';
            }
            ?>
        </table>

        <table>
            <h4>Пользователи</h4>
            <tr>
                <td></td>
                <td><b>id</b></td>
                <td><b>name</b></td>
                <td><b>perm</b></td>
            </tr>
            <?
            foreach ($data['users'] as $row) {
                echo '<tr>
                        <td>
                                <button v-on:click="echo_delete_user('.htmlspecialchars(json_encode($row)).')"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal" type="button">X
                                </button>
                        </td>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['perm'] . '</td>
                      </tr>';
            }
            ?>
        </table>

        <table>
            <h4>Бронирования</h4>
            <tr>
                <td></td>
                <td><b>idclient</b></td>
                <td><b>idseance</b></td>
                <td><b>idhall</b></td>
                <td><b>idplace</b></td>
            </tr>
            <?
            foreach ($data['orders'] as $row) {
                echo '<tr>
                        <td>
                                <button v-on:click="echo_delete_order('.htmlspecialchars(json_encode($row)).')"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal" type="button">X
                                </button>
                        </td>
                        <td>' . $row['idclient'] . '</td>
                        <td>' . $row['idseance'] . '</td>
                        <td>' . $row['idhall'] . '</td>
                        <td>' . $row['idplace'] . '</td>
                      </tr>';
            }
            ?>
        </table>


    </div>

    <!-- Accept Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Подтвердите действие</h4>
                    <h4>{{cur_action}}</h4>
                    <button v-on:click="confirm_action" type="button" data-bs-dismiss="modal" class="btn btn-success">Да
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
                </div>
            </div>
        </div>
    </div>
</div>

