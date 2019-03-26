import Vue from 'vue';
import navigation from './components/Navigation.vue';
import slider from './components/Slider.vue';
import namaz from './components/Namaz.vue';
import gallery from './components/Gallery.vue';
import hadis from './components/Hadis.vue';
import ayat from './components/Ayat.vue';
import feedback from './components/FeedBack.vue';

import './assets/styles/main.scss';

new Vue({
    el: '#app',
    components: {
        'navblock': navigation,
        'sliderblock': slider,
        'namaz': namaz,
        'hadis': hadis,
        'ayat': ayat,
        'e-gallery': gallery,
        'feedback': feedback
    }
});