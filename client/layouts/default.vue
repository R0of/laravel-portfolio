<template>
  <v-app id="app">
    <a href="https://github.com/FaZeRs/naurislinde.com" target="_blank">
      <img style="position: fixed; top: 0; left: 0; border: 0; z-index: 100" src="https://s3.amazonaws.com/github/ribbons/forkme_left_red_aa0000.png" alt="Fork me on GitHub">
    </a>
    <client-only>
      <nav-bar :transparent="true" :items="nav_items"/>
    </client-only>
    <v-img :src="jumbotronBg" :lazy-src="jumbotronBg" height="400" max-height="400" gradient="to top right, rgba(63,81,181, .7), rgba(25,32,72, .7)">
      <v-container fill-height text-center>
        <v-layout align-center justify-center>
          <v-flex>
            <h3 v-if="settings.name"  class="white--text font-weight-regular display-3"><span v-html="$t('hello_guys', { name: settings.name })"/></h3>
            <span v-if="settings.profession" class="font-weight-regular headline white--text">{{ $t('i_am') }} <span class="typelist-skill">{{ settings.profession }}</span></span>
            <v-divider class="my-3" dark/>
            <v-layout justify-space-around>
              <v-btn v-if="settings.facebook" :href="settings.facebook" target="_blank" outlined fab color="white">
                <v-icon class="fa-hover" dark>mdi-facebook</v-icon>
              </v-btn>
              <v-btn v-if="settings.twitter" :href="settings.twitter" target="_blank" outlined fab color="white">
                <v-icon class="fa-hover" dark>mdi-twitter</v-icon>
              </v-btn>
              <v-btn v-if="settings.linkedin" :href="settings.linkedin" target="_blank" outlined fab color="white">
                <v-icon class="fa-hover" dark>mdi-linkedin</v-icon>
              </v-btn>
              <v-btn v-if="settings.github" :href="settings.github" target="_blank" outlined fab color="white">
                <v-icon class="fa-hover" dark>mdi-github</v-icon>
              </v-btn>
              <v-btn v-if="settings.gitlab" :href="settings.gitlab" target="_blank" outlined fab color="white">
                <v-icon class="fa-hover" dark>mdi-gitlab</v-icon>
              </v-btn>
              <v-btn v-if="settings.bitbucket" :href="settings.bitbucket" target="_blank" outlined fab color="white">
                <v-icon class="fa-hover" dark>mdi-bitbucket</v-icon>
              </v-btn>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-container>
    </v-img>
    <v-main id="content">
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>

    <v-footer class="elevation-0 mt-5 mb-5" color="transparent">
      <v-layout row wrap align-center>
        <v-flex xs12>
          <div class="text-center">
            &copy; 2017 - {{ year }} <span v-if="settings.app_name">{{ settings.app_name }}</span>. {{ $t('all_rights_reserved') }}
          </div>
        </v-flex>
      </v-layout>
    </v-footer>
    <client-only>
      <cookie-law :message="$t('cookies_message')" :buttonText="$t('cookies_button_text')" theme="dark-blue"/>
      <back-to-top visible-offset="500"/>
    </client-only>
  </v-app>
</template>

<script>
import NavBar from '~/components/NavBar'
import BackToTop from '~/components/BackToTop'
import { mapGetters } from 'vuex'

export default {
  name: 'default_layout',
  components: {
    BackToTop,
    NavBar,
  },
  head() {
    return {
      title: this.app_name,
      titleTemplate: '%s | ' + this.app_name
    }
  },
  data: () => ({
    app_name: '',
    year: new Date().getFullYear(),
    jumbotronBg: require('~/assets/images/jumbotron-bg.jpg'),
    nav_items: [
      { icon: 'home', title: 'home', url: '/' },
      { icon: 'work', title: 'experience', url: 'experience' },
      { icon: 'build', title: 'services', url: 'services' },
      { icon: 'code', title: 'portfolio', url: 'portfolio' },
      { icon: 'contact_mail', title: 'contact', url: 'contact' },
      { icon: 'home', title: 'dashboard', url: '/admin/dashboard', auth: true },
    ]
  }),
  computed: {
    ...mapGetters({
      settings: 'settings/settings'
    })
  },
  mounted() {
    if(this.settings) {
      this.app_name = this.settings.app_name
    }
  },
}
</script>
