<template>
    <div v-if="times && times.length" class="namaz--container">
        <h1>Время намаза</h1>
        <div v-for="day in times" v-if="day.data.length" v-show="day.period !== period" class="namaz--day">
            <button @click="changePeriod">Посмотреть на {{period}}</button>
            <h2>{{ day.period }}</h2>
            <div v-for="time in day.data"  class="namaz--row">
                <div class="namaz--name">{{time.name}}</div>
                <div class="namaz--time">{{time.value}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: function () {
            return {
                times: [],
                errors: [],
                period: 'завтра'
            }
        },
        created: function () {
            axios.get('api/get-daily-namaz-times')
                .then(response => {
                    this.times = response.data.namaz;
                })
                .catch(e => {
                    this.errors.push(e);
                })
        },
        methods: {
            changePeriod: function () {
                if (this.period === 'сегодня') {
                    this.period = 'завтра';
                } else {
                    this.period = 'сегодня';
                }
            }
        }
    }
</script>

<style lang="scss">
    .namaz--container {
        padding: 10px 0px 10px 10px;
        h1 {
            margin: 0;
            text-align: center;
            font-size: 20px;
        }
        .namaz--day {
            text-align: center;
            h2 {
                font-size: 20px;
                padding: 0px 0 10px 0;
            }

            .namaz--row {
                padding: 10px;
                border: 1px solid #3d893d;
                font-size: 18px;
                text-align: center;

                .namaz--name {
                    width: 50%;
                    float: left;
                }
                .namaz--time {

                }
            }
        }
        button {
            float: left;
            background-color: white;
            color: black;
            border: 2px solid #25af30;
        }
    }
</style>