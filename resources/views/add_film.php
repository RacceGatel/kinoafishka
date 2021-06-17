<div class="backg">
    <div class="container">
        <form id="add_film_cont">
            <div class="in_add">
                <label for="name"><b>Название фильма</b></label>
                <input v-model="name" type="text" placeholder="Введите название фильма" name="name">
            </div>

            <div class="in_add">
                <label for="describe"><b>Описание</b></label>
                <input v-model="describe" type="text" placeholder="Введите описание" name="describe">
            </div>
            <div class="in_add">
                <label for="lnk_trailer"><b>Ссылка на трейлер(YouTube)</b></label>
                <input v-model="lnk_trailer" type="text" placeholder="Введите ссылку" name="lnk_trailer">
            </div>

            <div class="in_add">
                <label for="age"><b>Ограничение по возрасту</b></label>
                <input v-model="age" type="text" placeholder="Введите ограничение" name="age">
            </div>

            <button class="btn btn-primary" v-on:click="add_film" type="button">Добавить</button>
        </form>
    </div>
</div>