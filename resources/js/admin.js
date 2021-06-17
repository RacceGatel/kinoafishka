new Vue({
    el:"#admin_panel",
    data: {
        cinema_name: null,
        set_cinema: "Выбрать кинотеатр",
        set_cinema_places: "Выбрать кинотеатр",
        set_cinema_seance: "Выбрать кинотеатр",
        set_hall: "Выбрать холл",
        set_hall_places: "Выбрать холл",
        set_hall_seance: "Выбрать холл",
        set_film: "Выбрать фильм",
        set_date_seance: null,
        set_time_seance: null,
        hall_num: null,
        hall_size: 0,
        hall_row: 0,
        hall_spot: 0,
        count_rows: 0,
        count_spot: 0,
        cur_action: "",
        cur_function: "",
        cur_function_data: []
    },
    mounted() {

    },
    methods: {
        add_cinema: function () {
            axios({
                method: 'post',
                url: '/admin/add_cinema',
                params: {
                    name:this.cinema_name
                }
            }).then((response) => {
                location.reload();
            })
        },
        create_hall: function () {
            axios({
                method: 'post',
                url: '/admin/create_hall',
                params: {
                    num:this.hall_num,
                    size:this.hall_size,
                    rows:this.hall_row,
                    spots:this.hall_spot
                }
            }).then((response) => {
                location.reload();
            })
        },
        add_hall: function () {
            axios({
                method: 'post',
                url: '/admin/add_hall',
                params: {
                    idcinema:this.set_cinema,
                    idhall:this.set_hall,
                }
            }).then((response) => {
                location.reload();
            })
        },
        add_places: function () {
            axios({
                method: 'post',
                url: '/admin/add_places',
                params: {
                    idcinema:this.set_cinema_places,
                    idhall:this.set_hall_places,
                }
            }).then((response) => {
                location.reload();
            })
        },

        add_seance: function () {
            axios({
                method: 'post',
                url: '/admin/add_seance',
                params: {
                    idfilm:this.set_film,
                    idhall:this.set_hall_seance,
                    idcinema:this.set_cinema_seance,
                    date:this.set_date_seance,
                    time:this.set_time_seance
                }
            }).then((response) => {
                location.reload();
            })
        },

        set_cinema_set: function (event) {
            this.set_cinema = event.target.id;
        },
        set_hall_set: function (event) {
            this.set_hall = event.target.id;
        },
        set_cinema_places_set: function (event) {
            this.set_cinema_places = event.target.id;
        },
        set_hall_places_set: function (event) {
            this.set_hall_places = event.target.id;
        },
        set_film_set: function (event) {
            this.set_film = event.target.id;
        },
        set_cinema_seance_set: function (event) {
            this.set_cinema_seance = event.target.id;
        },
        set_hall_seance_set: function (event) {
            this.set_hall_seance = event.target.id;
        },
        confirm_action: function (data) {
            this[this.cur_function](data);
        },
        echo_delete_cinema: function (data) {
            this.cur_action = "Удалить кинотеатр id = " + data.id + " name = " + data.name + "?";
            this.cur_function = "delete_cinema";
            this.cur_function_data = data;
        },
        delete_cinema: function () {
            axios({
                method: 'delete',
                url: '/admin/delete_cinema',
                params: {
                    id: this.cur_function_data.id,
                }
            }).then(response => {
                location.reload();
            });
        },
        echo_delete_hall: function (data) {
            this.cur_action = "Удалить холл(зал) id = " + data.id + "?";
            this.cur_function = "delete_hall";
            this.cur_function_data = data;
        },
        delete_hall: function () {
            axios({
                method: 'delete',
                url: '/admin/delete_hall',
                params: {
                    id: this.cur_function_data.id,
                }
            }).then(response => {
                //location.reload();
            });
        },
        echo_delete_cinemas_halls: function (data) {
            this.cur_action = "Удалить связь кинотеатр - холл(зал) id[кинотеатра] = " + data.idcinema + " id[холла] = " +
                data.idhall + "?";
            this.cur_function = "delete_cinemas_halls";
            this.cur_function_data = data;
        },
        delete_cinemas_halls: function () {
            axios({
                method: 'delete',
                url: '/admin/delete_cinemas_halls',
                params: {
                    idcinema: this.cur_function_data.idcinema,
                    idhall: this.cur_function_data.idhall,
                }
            }).then(response => {
                location.reload();
            });
        },
        echo_delete_seance: function (data) {
            this.cur_action = "Удалить сеанс id = " + data.id + "?";
            this.cur_function = "delete_seance";
            this.cur_function_data = data;
        },
        delete_seance: function () {
            axios({
                method: 'delete',
                url: '/admin/delete_seance',
                params: {
                    id: this.cur_function_data.id,
                }
            }).then(response => {
                location.reload();
            });
        },
        echo_delete_user: function (data) {
            this.cur_action = "Удалить пользователя id = " + data.id + " логин = " + data.name + "?";
            this.cur_function = "delete_user";
            this.cur_function_data = data;
        },
        delete_user: function () {
            axios({
                method: 'delete',
                url: '/admin/delete_user',
                params: {
                    id: this.cur_function_data.id,
                }
            }).then(response => {
                location.reload();
            });
        },
        echo_delete_order: function (data) {
            this.cur_action = "Удалить пользователя id[клиента]= " + data.id + " id[места] = " + data.idplace + "?";
            this.cur_function = "delete_order";
            this.cur_function_data = data;
        },
        delete_order: function () {
            axios({
                method: 'delete',
                url: '/admin/delete_order',
                params: {
                    id: this.cur_function_data.id,
                }
            }).then(response => {
                location.reload();
            });
        },
        echo_delete_film: function (data) {
            this.cur_action = "Удалить фильм id= " + data.id + " name = " + data.name + "?";
            this.cur_function = "delete_film";
            this.cur_function_data = data;
        },
        delete_film: function () {
            axios({
                method: 'delete',
                url: '/admin/delete_film',
                params: {
                    id: this.cur_function_data.id,
                }
            }).then(response => {
                location.reload();
            });
        }
    }
});

new Vue({
    el: "#add_film_cont",
    data: {
        name: null,
        describe: null,
        lnk_trailer: null,
        age: null,
    },
    methods: {
        add_film() {
            axios({
                method: 'post',
                url: '/all/add_film',
                data: {
                    name:this.name,
                    describe: this.describe,
                    lnk_trailer: this.lnk_trailer,
                    age: this.age
                }
            }).then(() => {
                location.reload();
            });
        }
    }
});