new Vue({
    el: '#search',
    data: {
        genres: null
    },
    mounted() {
        axios
            .get('/film/get_cinemas?idfilm=' + this.cur_film_id)
            .then(response => {
                this.cinemas = response.data;
            });
    },
    methods: {
        search_genre: function (event) {
            location = "/search/genre?name=" + event.target.id;
        }
    }
});

new Vue({
    el:"#profile_block",
    data: {
        user: [],
        name: '',
        email: '',
        phone: '',
        psw: '',
        cur_idorder: 0,
        cur_idplace: 0,
        cur_page: 'profile',
        orders: [],
        ch_name: '',
        ch_email: '',
        ch_phone: '',
        ch_psw: '',
        response_name: "",
        response_email: "",
        response_phone: "",
        response_psw: ""

    },
    mounted() {
        this.get_id();
        this.name.value = this.user.name;
        this.refresh_orders();
    },
    methods: {
        get_id: function (event) {
            axios({
                method: 'get',
                url: '/profile/get_user_info',
            }).then(response => {
                this.user = response.data;
            });
        },
        refresh_orders() {
            let id = this.user.id;
            axios({
                method: 'get',
                url: '/profile/orders',
                params: {
                    idclient: id
                }
            }).then(response => {
                this.orders = response.data;
            });
        },
        delete_order: function (event) {
            axios({
                method: 'delete',
                url: '/profile/delete_order',
                params: {
                    idorder: this.cur_idorder,
                    idplace: this.cur_idplace
                }
            }).then(response => {
                this.refresh_orders();
            });
        },
        logout() {
            axios({
                method: 'post',
                url: '/auth/logout',
            }).then(() => {
                location.reload();
            });
        },
        open: function (event) {
            this.cur_page = event;
        },
        is_page: function(page) {
            return this.cur_page === page;
        },
        is_class: function(page) {
            return this.cur_page === page ? 'active' : '';
        },
        change_login: function (event) {
            if (!this.ch_name) {
                this.response_name = 'Логин не указан';
            } else if (!this.validName(this.ch_name)) {
                this.response_name = 'Укажите корректный логин';
            } else {
                axios({
                    method: 'post',
                    url: '/profile/change_login',
                    data: {
                        ch_login: this.ch_name
                    }
                }).then((response) => {
                    this.response_name = response.data;
                    this.get_id();
                    this.ch_name = "";
                    setTimeout(() => {
                        this.response_name = ""
                    }, 4000)
                });
            }
        },
        change_email: function (event) {
            if (!this.ch_email) {
                this.response_email = 'Почта не указана';
            } else if (!this.validEmail(this.ch_email)) {
                this.response_email = 'Укажите корректный адрес электронной почты';
            } else {
                axios({
                    method: 'post',
                    url: '/profile/change_email',
                    data: {
                        ch_email: this.ch_email
                    }
                }).then((response) => {
                    this.response_email = response.data;
                    this.get_id();
                    this.ch_email = "";
                    setTimeout(() => {
                        this.response_email = ""
                    }, 4000)
                });
            }
        },
        change_phone: function (event) {
            if (!this.ch_phone) {
                this.response_phone = 'Номер не указан';
            } else if (!this.validPhone(this.ch_phone)) {
                this.response_phone = 'Укажите корректный номер телефона';
            } else {
                axios({
                    method: 'post',
                    url: '/profile/change_phone',
                    data: {
                        ch_phone: this.ch_phone
                    }
                }).then((response) => {
                    this.response_phone = response.data;
                    this.get_id();
                    this.ch_phone = "";
                    setTimeout(() => {
                        this.response_phone = ""
                    }, 4000)
                });
            }
        },
        change_psw: function (event) {
            if (!this.ch_psw) {
                this.response_psw = 'Пароль не введен';
            } else if  (!this.validPsw(this.ch_psw)) {
                this.response_psw = 'Некорректный формат пароля';
            } else {
                axios({
                    method: 'post',
                    url: '/profile/change_psw',
                    auth: {
                        password: this.ch_psw
                    }
                }).then((response) => {
                    this.response_psw = response.data;
                    this.ch_psw = "";
                    setTimeout(() => {
                        this.response_psw = ""
                    }, 4000)
                });
            }
        },
        validName: function (name) {
            var re = /^[a-zA-Zа\-|0-9]{3,40}$/;
            return re.test(name);
        },
        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        validPhone: function (phone) {
            var re = /^((7|8)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
            return re.test(phone);
        },
        validPsw: function (psw) {
            var re = /^[\S]{6,40}$/;
            return re.test(psw);
        }
    }
});

var register_obj = new Vue({
    el: '#registerModal',
    data: {
        name: null,
        email: null,
        phone: null,
        psw: null,
        errors: []
    },
    methods: {
        register() {
            if (!this.checkForm()) {
                return;
            }
            axios({
                method: 'post',
                url: '/auth/register',
                auth: {
                    username: this.name,
                    password: this.psw
                },
                params: {
                    email: this.email,
                    phone: this.phone,
                }
            }).then((response) => {
                location.reload();
            }).catch((response) => {
                this.errors.push(response.response.data);
            });

        },
        clear_form() {
            this.name = null;
            this.email = null;
            this.phone = null;
            this.psw = null;
        },
        checkForm() {
            this.errors = [];

            if (!this.name) {
                this.errors.push('Требуется указать логин');
            } else if (!this.validName(this.name)) {
                this.errors.push('Укажите корректный логин');
            }

            if (!this.email) {
                this.errors.push('Требуется указать почту');
            } else if (!this.validEmail(this.email)) {
                this.errors.push('Укажите корректный адрес электронной почты');
            }

            if (this.phone && !this.validPhone(this.phone)) {
                this.errors.push('Укажите корректный номер телефона');
            }

            if (!this.psw) {
                this.errors.push('Пароль не введен');
            } else if  (!this.validPsw(this.psw)) {
                this.errors.push('Пароль должен содержать не менее 6 символов');
            }
            console.log(this.errors);
            if (this.errors.length === 0) {
                return true;
            }
        },
        validName: function (name) {
            var re = /^[a-zA-Zа\-|0-9]{3,40}$/;
            return re.test(name);
        },
        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        validPhone: function (phone) {
            var re = /^((7|8)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
            return re.test(phone);
        },
        validPsw: function (psw) {
            return psw.length >= 6;
        }
    }
});

new Vue({
    el: '#enterModal',
    data: {
        name: null,
        psw: null,
        errors: []
    },
    methods: {
        enter() {
            if (!this.checkForm()) {
                return;
            }
            axios({
                method: 'post',
                url: '/auth/enter',
                auth: {
                    username: this.name,
                    password: this.psw
                }
            }).then((response) => {
                this.errors.push("Успешно");
                location.reload();
            }).catch((response) => {
                this.errors.push("Не удалось авторизоваться");
            });

        },
        clear_form() {
            this.name = null;
            this.password = null;
        },
        checkForm() {
            this.errors = [];

            if (!this.name) {
                this.errors.push('Требуется указать логин');
            }

            if (!this.psw) {
                this.errors.push('Пароль не введен');
            }

            console.log(this.errors);
            if (this.errors.length === 0) {
                return true;
            }
        },
    }
});

new Vue({
    el: "#logout",
    methods: {
        logout() {
            axios({
                method: 'post',
                url: '/auth/logout',
            }).then(() => {
                location.reload();
            });
        }
    }
});

new Vue({
    el: '#add_comment',
    data: {
        comment: null,
        rate: null,
    },
    methods: {
        add_comment: function (event) {
            axios({
                method: 'post',
                url: '/film/add_comment',
                params: {
                    idfilm: event.target.id,
                    comment: this.comment,
                    rate: this.rate
                }
            }).then(() => {
                location.reload();
            });
        }
    }
});

new Vue({
    el: '#reserve_place',
    data: {
        display: false,
        cur_cinema_id: null,
        cur_film_id: null,
        cur_cinema: "Выбрать кинотеатр",
        cur_date: "Дата:",
        cur_time: "Время:",
        cur_seance_id: 0,
        cur_idhall: 0,
        hall: null,
        cinemas: [],
        date: [],
        time: [],
        halls: [],
        data: [],
        places: [],
        sel_place: [],
        sum: 0,
        response_reserve: false,
        name: "",
        email: "",
        phone: "",
        psw: ""
    },
    mounted() {
        let uri = window.location.search.substring(1);
        let params = new URLSearchParams(uri);
        this.cur_film_id = params.get("id");

        axios({
            method: 'get',
            url: '/film/get_film_seance_info',
            params: {
                idfilm: this.cur_film_id,
            }
        }).then((response) => {
            this.data = response.data;

            for (let k in this.data) {
                this.cinemas.push(this.data[k]['name']);
            }

            if ((this.data).length > 0)
                this.display = true;

            this.cinemas = Array.from(new Set(this.cinemas));
        })
    },
    computed: {
        spots: function () {
            let places = this.places;

            arr_rows = Array.from(new Set(places.map(function (item, index) {
                return item[1];
            })));

            arr_spots = Array.from(arr_rows.map(function (row, i) {
                arr_row = [];

                places.map(function (value, i) {
                    if (value[1] === row) {
                        let spot = value[2];
                        let price = value[3];
                        let vip = value[4];
                        let employ = null;
                        if (value[5]==1)
                            employ = "free";
                        else
                            employ = "occupied";
                        arr_row.push([i, spot, price, employ, vip]);
                    }
                });

                return [row, arr_row];
            }));

            return arr_spots;
        }
    },
    methods: {
        def_val() {
            this.cur_date = "Дата:";
            this.date = [];
            this.def_val_time();
        },
        def_val_time() {
            this.cur_time = "Время:";
            this.time = [];
            this.sum = 0;
            this.places = [];
            this.hall = null;
        },
        ch_cinema(cinema) {
            if (this.cur_cinema != cinema) {
                this.def_val();
                this.cur_cinema = cinema;
                for (let k in this.data) {
                    let datas = this.data[k]['date'];
                    this.date.push(new Date(datas).toLocaleDateString());
                }
                this.date = Array.from(new Set(this.date));
            }
        },
        ch_date(data) {
            if (this.cur_date != data) {
                this.def_val_time();
                this.cur_date = data;
                for (let k in this.data) {
                    if (new Date(this.data[k]['date']).toLocaleDateString() == this.cur_date) {
                        let datas = this.data[k]['time'];
                        this.time.push(datas.slice(0, -3));
                    }
                }
                this.time = Array.from(new Set(this.time));
            }
        },
        ch_time(data) {
            this.cur_time = data;

            for (let k in this.data) {
                if (this.data[k]['name'] == this.cur_cinema &&
                    new Date(this.data[k]['date']).toLocaleDateString() == this.cur_date &&
                    this.data[k]['time'].slice(0,-3) == this.cur_time)
                {
                    this.cur_seance_id = this.data[k]['id'];
                    this.cur_idhall = this.data[k]['idhall'];
                    this.hall = "Зал " + this.data[k]['num'];
                }
            }

            this.get_place();
        },
        get_place() {
            axios({
                method: 'get',
                url: '/film/get_places',
                params: {
                    idhall: this.cur_idhall,
                    idseance: this.cur_seance_id
                }
            }).then(response => {
                this.places = response.data;
            });
        },
        reserve: function (event) {
            const index = this.sel_place.indexOf(event.target.id);
            if (index > -1) {
                this.sel_place.splice(index, 1);
                this.sum -= parseInt(event.target.getAttribute("price"));
                event.target.setAttribute("class", "free");
            } else {
                this.sel_place.push(event.target.id);
                this.sum += parseInt(event.target.getAttribute("price"));
                event.target.setAttribute("class", "selected");
            }
        },
        load_reserve: function (event) {
            let this_evener = event;
            if (!this.response_reserve) {
                this.response_reserve = true;
                //let body = this_evener.target.parentNode.parentNode.querySelector('[class="modal-body"]');
                //body.innerHTML = "Загрузка";
                //this_evener.target.parentNode.parentNode.querySelector('[class="modal-footer"]').innerHTML = "";
                /*
                const instance = axios.create();
                instance.interceptors.request.use((config) => {

                    return config;
                }, (error) => {

                    return Promise.reject(error);
                });

                instance.interceptors.response.use((response) => {

                    return response;
                }, (error) => {

                    return Promise.reject(error);
                });*/

                let places = this.places;
                let spots = Array.from(this.sel_place.map(function (item,i) {
                    return places[item][0];
                }));

                axios({
                    method: 'post',
                    url: '/film/reserve_place',
                    params: {
                        idseance: this.cur_seance_id,
                        idhall: this.cur_idhall,
                        idplace: spots
                    },
                }).then(response => {

                    //body.innerHTML = "Успешно";
                    /*
                    setTimeout(function(){location.reload()}, 2000);
                    this.response_reserve = false;*/
                    this.get_place();
                    this.sum = 0;
                }).catch(response => {
                    body.innerHTML = "Ошибка";
                    setTimeout(function(){location.reload()}, 2000);
                    this.response_reserve = false;
                })

            }
        }
    }

});

