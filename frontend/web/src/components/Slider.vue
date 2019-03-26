<template>
    <main>
        <agile v-if="slides && slides.length">
            <div  v-for="slide in slides" :class="slide.class_name">
                <img class="slide--image" :src="slide.src">
                <a :href="slide.href">
                    <h3>{{ slide.title }}</h3>
                    <p>{{ slide.text}}</p>
                </a>
            </div>
        </agile>
    </main>
</template>

<script>
    import axios from 'axios';
    import Vue from 'vue';
    import VueAgile from 'vue-agile';
    Vue.use(VueAgile);

    export default {
        data: function () {
            return {
                slides: [],
                errors: []
            }
        },
        created: function () {
            axios.get('/api/get-slides')
                .then(response => {
                    this.slides = response.data.slides;
                })
                .catch(e => {
                    this.errors.push(e);
                })
        }
    }
</script>

<style lang="scss">
    .agile {
        width: 1000px;
        margin: 0 auto;
        h3 {
            font-size: 32px;
            font-weight: 300;
            border: none;
            background: none;
            left: 100px;
            margin: 0;
            position: absolute;
            top: 17%;
        }
        p {
            border: none;
            background: none;
            left: 76px;
            margin: 0;
            position: absolute;
            top: 30%;
        }
        &__dots {
            bottom: 0;
            left: 50%;
            position: absolute;
            transform: translateX(-50%);
        }
        &__dot {
            button {
                background-color: transparent;
                border: 1px solid #fff;

                &:hover {
                    background-color: #fff;
                }
            }
            &--current {
                button {
                    background-color: #fff;
                }
            }
        }
        &__arrow {
            position: absolute;
            height: 100%;
            top: 0;
            width: 80px;
            background-color: transparent;
            border: none;
            &:hover {
                background-color: rgba(#000, .5);

                #arrow-svg {
                    fill: #fff;
                }
            }
            &[disabled] {
                display: none;
            }
            &--prev {
                left: 0;
            }
            &--next {
                right: 0;
            }
            #arrow-svg {
                fill: rgba(#fff, .4);
                height: 25px;
            }
        }
    }

    .slide {
        background: {
            position: center;
            size: cover;
        }
        height: 450px;
        &:before {
            background-color: rgba(#000, .2);
            content: '';
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }
        &--image {
            width: 100%;
            height: 100%;
        }
    }
</style>