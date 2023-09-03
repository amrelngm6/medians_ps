<template>
    <ul   v-if="showMenu" class="overflow-y-auto" style="max-height: calc(100vh - 170px);">
        <li v-for="(menu, i) in pages">
            <a @click="dropList(i)" class="w-full font-thin uppercase flex items-center p-4 my-2 transition-colors duration-200 justify-start text-gray-500 dark:text-gray-200  dark:from-gray-700 dark:to-gray-800 " :class="currentMenu(menu, i) ? 'hover:text-blue-800 bg-gradient-to-r from-white  text-blue-500  border-blue-500 to-blue-100  border-r-4' : ''" :href="menu.link ? (url + menu.link) : 'javascript:;'">
                <span class="text-left">
                    <i class="fa" :class="menu.icon"></i>
                </span>
                <span class=" text-sm font-semibold"> {{menu.title}}  </span>
            </a>
            <ul v-if="menu.sub && menu.show_sub " class="pb-4" >
                <li v-for="submenu in menu.sub">
                    <a  class=" text-purple-800 hover:text-white" :class="currentMenu(submenu, i) ? 'active' : ''" :href="url+submenu.link">
                        <span class="mx-2 text-sm font-semibold" v-text="submenu.title"> </span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</template>
<script>
const axios = require('axios').default;

export default {
    computed: {},
    data() {
        return {
            showMenu: true,
            same_page: false,
            pages: []
        }
    },
    props: ['url','menus', 'samepage'],
    created: function() {
        this.pages = this.menus;
    },
    methods: {
        dropList(i=0)
        {
            this.showMenu = false;
            this.pages[i].show_sub = this.pages[i].show_sub ? false : true;
            this.showMenu = true;
        },
        currentMenu(menu, index)
        {
            if ('/'+menu.link == this.samepage && this.samepage != '/')
            {
                return true;
            }

            if (menu.sub && menu.sub.length)
            {
                for (var i = menu.sub.length - 1; i >= 0; i--) {
                    if('/'+menu.sub[i].link == this.samepage && this.samepage != '/')
                    {
                        this.pages[index].show_sub = true;
                        return true;
                    }
                }
            }
            return false
        },
    }
};
</script>