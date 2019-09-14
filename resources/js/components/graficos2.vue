<template>

    <la-cartesian  narrow :bound="[1]" :data="values" :width="900" :height="230">
    <la-bar animated prop="pv"></la-bar>

    <la-x-axis id="graf_2" prop="name"></la-x-axis>
      <la-y-axis></la-y-axis>

    <la-tooltip></la-tooltip>
  </la-cartesian>

</template>

<script>
import Echo from "laravel-echo";
import { EventEmitter } from "events";
window.Pusher = require("pusher-js");
import { Laue } from 'laue';
Vue.use(Laue);
export default {


     props: ["dato"],

  components: {

  },
  data() {
    return {
         values: [
                {
        name: "",
        pv: 0
    },

      ],
      tabla:false
      };
  },
  methods:{
      arti_max_() {
      let med = this;
      axios
        .post("api/learn_m")
        .then(function(response) {
         console.log(response.data);
         med.values = response.data;

        })
        .catch(function(error) {
          // handle error
          // console.log(error);
        })

        .then(function() {})
        //FUNCION QUE CARGA EN LOADING MIENTRAS LA PETICION ES COMPLETADA ,
        //AL COMPLETARSE PARASARA A SER FALSE Y ME MOSTRARA LA OTRA SECTION DEL TEMPLATE VUEJS
        .finally(() => (this.tabla = true));
    },
  },
  mounted(){
      this.arti_max_();

    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "ASDASD2121",
      wsHost: window.location.hostname,
      wsPort: 6001,
      disableStats: true
    });
    window.Echo.channel("channel-notif").listen("NotificacionEvent", e => {
    this.arti_max_();
    });
  }

};
</script>

<style lang="css">
#small2 {
  max-width: 300px;
  /* max-height: 500px; */
}
</style>
