/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
window.$ = require("jquery");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component("venta", require("./components/ventas.vue").default);

//vue.component('categoria', require('./components/categoria.vue'));
Vue.component("art", require("./components/articuloVista.vue").default);
Vue.component("categoria", require("./components/categoriaVista.vue").default);
Vue.component("Boton", require("./components/notificacionExito.vue").default);
Vue.component(
    "gestion-ventas",
    require("./components/GestionVentas.vue").default
);
Vue.component("compa", require("./components/comprasArticulos.vue").default);
Vue.component("graficos", require("./components/graficos.vue").default);
Vue.component("graficos2", require("./components/graficos2.vue").default);
Vue.component("escritorio", require("./components/escritorio.vue").default);
Vue.component(
    "gestion-compras",
    require("./components/comprasList.vue").default
);
Vue.component("usuarios", require("./components/gestionUsuario.vue").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({

    el: "#app",
    props: ["dato"],
    data: {
        menu: 0,
        cargando: true,
        validar2: true
    },
    methods: {
        cargando_escrt() {
            let me = this;
            setTimeout(function() {
                return (me.cargando = false);
            }, 1500);
        },

        rote: function(dat) {
            var btn_f = document.getElementsByClassName("flotante");
            var btn_cp = document.getElementsByClassName("flotante2");
            var btn_vt = document.getElementsByClassName("flotante3");
            var btn_cps = document.getElementsByClassName("flotante4");
            var btn_hm = document.getElementsByClassName("flotante5");
            if (dat == true) {
                this.validar2 = false;

                anime({
                    targets: btn_f,
                    rotate: {
                        value: 90,
                        duration: 0,
                        easing: "easeInOutSine"
                    }
                });
                anime({
                    targets: btn_cp,
                    top: "80%",
                    duration: 0
                });
                anime({
                    targets: btn_vt,
                    top: "70%",
                    duration: 0
                });
                anime({
                    targets: btn_cps,
                    top: "60%",
                    duration: 0
                });
                anime({
                    targets: btn_hm,
                    top: "50%",
                    duration: 0
                });
            }
            if (dat == false) {
                this.validar2 = true;

                anime({
                    targets: btn_f,
                    rotate: {
                        value: 0,
                        duration: 0,
                        easing: "easeInOutSine"
                    }
                });
                anime({
                    targets: [btn_vt, btn_cp, btn_cps, btn_hm],
                    top: "90%",
                    duration: 0
                });
            }
        }
    },
    mounted() {
        this.cargando_escrt();
    },
    watch: {
        menu: function(Val) {
            this.validar2 = true;



            anime({
                targets: btn_f,
                rotate: {
                    value: 0,
                    duration: 0,
                    easing: "easeInOutSine"
                }
            });
            anime({
                targets: [btn_vt, btn_cp, btn_cps, btn_hm],
                top: "90%",
                duration: 0
            });
        }
    }
});
