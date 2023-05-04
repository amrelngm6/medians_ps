<template>
    <nav id="header" class="flex  w-full bg-white shadow-lg border-b border-gray-300 relative" >
        <div class="w-full flex items-center justify-between mt-0 px-6 py-0">
            <div class=" md:flex flex lg:flex  md:w-auto w-full order-3 md:order-1" id="menu">
                <div class="inline-flex mx-4">
                    <!-- Logo -->
                    <div class="mx-auto h-16  py-2 w-auto ">
                        <img style="max-height: 100%" :src="(conf.url ? conf.url : '/') + (setting.logo ? setting.logo : 'assets/img/logo.png')" height="40">
                        <!--end logo -->
                    </div>
                </div>
                <div class="lg:inline-flex ">
                    <ul class="md:flex items-center justify-center text-base text-gray-400  py-4 md:pt-0 lg:pt-0  ">
                        <li>
                            <a :href="conf.url"  v-text="setting.sitename"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <ul class="nav user-menu w-96 flex"> -->
        <ul class="nav user-menu w-64 flex">
            <li class="hidden nav-item dropdown w-20">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <i class="fa fa-bell-o"></i> <span class="badge rounded-pill">3</span>
                </a>
            </li>
            <li class="hidden nav-item dropdown w-20">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <i class="fa fa-comment-o"></i> <span class="badge rounded-pill">8</span>
                </a>
            </li>
            <li v-if="auth && lang"  class="nav-item  has-arrow main-drop w-full relative">
                <a href="#" class="flex w-full gap gap-2" onclick="$('.dropped1').toggleClass('hidden')">
                    <span class="user-img mt-3 ">
                        <img :src="auth.photo" alt="">
                        <span class="status online absolute top-0 right-0"></span>
                    </span>
                    <span v-text="auth.name"></span>
                </a>
                <ul class="py-4 px-2 w-full bg-white border border-gray-300 rounded  absolute top-14 left-1 hidden dropped1" style="z-index: 9999;">
                    <li class="py-2 border-b border-gray-300"><a href="/settings" v-text="lang.setting"></a></li>
                    <li class="py-2"><a href="/logout" v-text="lang.logout"></a></li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script>

export default {
  name: 'navbar',
  components: {
  },
  props: {
    auth:[Object, null],
    lang:[Object, null],
    setting:[Object, null],
    conf:[Object, null]
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
