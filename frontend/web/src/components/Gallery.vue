<template>
    <div class="gallery">
        <a v-for="image in images" :href="image.href">
            <img :src="image.src">
        </a>
    </div>
</template>

<script>
    import 'simplelightbox';
    export default {
        data: function () {
            return {
                images: []
            }
        },
        props: ['album'],
        created: function () {
            var album = JSON.parse(this.album);
            for (var i = 0; i < album.length; i++) {
                this.images.push({
                    src: album[i].mini_image,
                    href: album[i].medium_image
                })
            }
        },
        mounted: function () {
            var lightbox = $('.gallery a').simpleLightbox();
        }
    }
</script>

<style>
    @import '../assets/styles/gallery/simplelightbox.css';
</style>
<style lang="scss">
    @import '../assets/styles/gallery/gallery.scss';
</style>