<template>
    <div v-if="hadis && hadis.text !== ''" class="hadis--container">
        <h1>Хадис</h1>
        <div class="hadis--text">
            <p>
                {{hadis.text}}
            </p>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: function () {
            return {
                hadis: [],
                errors: []
            }
        },
        created: function () {
            axios.get('api/get-hadis')
                .then(response => {
                    this.hadis = response.data.hadis;
                })
                .catch(e => {
                    this.errors.push(e);
                })
        }
    }
</script>

<style lang="scss">
    .hadis--container {
        h1 {
            margin: 0;
            padding: 0px 0px 10px 0px;
            text-align: center;
            font-size: 20px;
        }
        .hadis--text {

        }
    }
</style>