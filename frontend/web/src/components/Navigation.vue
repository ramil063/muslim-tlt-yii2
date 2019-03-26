<template>
    <div id="navigation">
        <div class="inner">
            <ul class="menu">
                <li v-for="item in navList">
                    <a :class="item.className" :href="item.href">{{ item.name }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    module.exports = {
        data: function () {
            return {
                navList: [
                    {
                        className: 'item-126',
                        href: '/',
                        name: 'Главная'
                    },
                    {
                        className: 'item-102',
                        href: '/news',
                        name: 'Новости'
                    },
                    {
                        className: 'item-142',
                        href: '/mosque-photo-gallery',
                        name: 'Фотогалерея'
                    },
                    {
                        className: 'item-140',
                        href: '/friday-sermon',
                        name: 'Пятничные проповеди'
                    },
                    {
                        className: 'item-136',
                        href: '/namaz-times',
                        name: 'Время намаза'
                    },
                ]
            }
        }
    }
</script>

<style lang="scss">
    #navigation {
        background-color: #31721F;
        height: 36px;
        margin: 0;
        min-width: 1000px;
        width: 100%;
        .menu {
            padding: 0px;
            margin: 0;
        }
        .inner {

        }
        ul {
            li {
                float: left;
                width: 20%;
                list-style: none;
                a {
                    background: url(/images/mark_white.png) no-repeat left center;
                    color: #ffffff;
                    display: block;
                    line-height: 36px;
                    margin: 0 0 0 -3px;
                    text-align: center;
                    text-decoration: none;
                    width: 100%;
                }
                &:first-child {
                    margin: 0;
                    a {
                        background: none;
                    }
                }
                &.active,
                &:hover {
                    background: #66B60A;
                }
            }
        }
    }
</style>