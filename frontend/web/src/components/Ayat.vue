<template>
    <div v-if="koran" class="koran--container">
        <h1>Аят</h1>
        <div class="koran--text">
            <h2>Сура {{koran.sura}}:{{koran.ayat}}</h2>
            <p>
                {{koran.text}}
            </p>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: function () {
            return {
                koran: [],
                errors: []
            }
        },
        created: function () {
            axios.get('api/get-ayat')
                .then(response => {
                    this.koran = response.data.koran;
                })
                .catch(e => {
                    this.errors.push(e);
                })
        }
    }
</script>

<style lang="scss">
    .koran--container {
        h1 {
            margin: 0;
            padding: 0px 0px 10px 0px;
            text-align: center;
            font-size: 20px;
        }
        .koran--text {
            h2 {
                margin: 0 0 10px 0;
                text-align: center;
            }
        }
    }
</style>