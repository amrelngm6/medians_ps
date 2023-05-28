<template>
    <nav id="header" class="flex  w-full bg-white shadow-lg border-b border-gray-300 relative" >
        <div class="w-full flex items-center justify-between mt-0 px-6 py-0">
            <div class=" md:flex flex lg:flex  md:w-auto w-full order-3 md:order-1" id="menu">
                <div class="inline-flex mx-4">
                    <!-- Logo -->
                    <div class="mx-auto h-16  py-2 w-auto ">
                        <img style="max-height: 100%" :src="(setting.logo ? setting.logo : '/uploads/img/logo.png')" height="40">
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
        <ul class="nav user-menu flex">
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
            <li v-if="auth && lang"  class="nav-item has-arrow main-drop relative w-20">
                <a href="#" class="text-gray-600 flex w-14 gap gap-2" onclick="$('.dropped2').toggleClass('hidden')">
                    <svg fill="#666" height="50px" width="50px" version="1.1" id="XMLID_275_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve"><g id="language"><g><path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M9.5,17c0.6,3.1,1.7,5,2.5,5s1.9-1.9,2.5-5H9.5zM16.6,17c-0.3,1.7-0.8,3.3-1.4,4.5c2.3-0.8,4.3-2.4,5.5-4.5H16.6z M3.3,17c1.2,2.1,3.2,3.7,5.5,4.5c-0.6-1.2-1.1-2.8-1.4-4.5H3.3z M16.9,15h4.7c0.2-0.9,0.4-2,0.4-3s-0.2-2.1-0.5-3h-4.7c0.2,1,0.2,2,0.2,3S17,14,16.9,15z M9.2,15h5.7c0.1-0.9,0.2-1.9,0.2-3 S15,9.9,14.9,9H9.2C9.1,9.9,9,10.9,9,12C9,13.1,9.1,14.1,9.2,15z M2.5,15h4.7c-0.1-1-0.1-2-0.1-3s0-2,0.1-3H2.5C2.2,9.9,2,11,2,12 S2.2,14.1,2.5,15z M16.6,7h4.1c-1.2-2.1-3.2-3.7-5.5-4.5C15.8,3.7,16.3,5.3,16.6,7z M9.5,7h5.1c-0.6-3.1-1.7-5-2.5-5 C11.3,2,10.1,3.9,9.5,7z M3.3,7h4.1c0.3-1.7,0.8-3.3,1.4-4.5C6.5,3.3,4.6,4.9,3.3,7z"/></g></g></svg>
                </a>
                <ul class="py-4 px-2 w-40 bg-white border border-gray-300 rounded  absolute top-14 left-1 hidden dropped2" style="z-index: 9999;">
                    <li class="py-2 border-b border-gray-300" :class="lang.lang == 'ar' ? 'font-semibold' : ''"><a href="/switch-lang/arabic">Arabic</a></li>
                    <li class="py-2 border-b border-gray-300" :class="lang.lang == 'en' ? 'font-semibold' : ''"><a href="/switch-lang/english">English</a></li>
                </ul>
            </li>
            <li v-if="auth && lang"  class=" w-64 nav-item  has-arrow main-drop relative">
                <a href="#" class="flex w-64 gap gap-2" onclick="$('.dropped1').toggleClass('hidden')">
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
