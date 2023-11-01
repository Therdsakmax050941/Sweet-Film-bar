<template>
  <div class="q-pa-md header-box">
    <q-layout class="rounded-borders">
      <q-header reveal elevated class="bg-white text-white">
        <q-toolbar class="header">
          <q-toolbar-title>
            <p>CALL: 095-860-1168</p>
          </q-toolbar-title>
          <div>
          <q-btn label="Login" />
          <q-btn label="register" />
          <q-btn  label="Logout" />
        </div>
        </q-toolbar>
        <hr class="q-mx-auto" />

        <q-tabs v-model="tab" style="margin-top: 30px" class="header">
          <q-toolbar-title class="header">
            <div class="row">
              <img
                src="https://static.wixstatic.com/media/3ae61c_4f5f584a8d7a4c56808d5e5b9e990876~mv2.png/v1/fill/w_66,h_59,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/SWEET%20FILM%20BAR.png"
              />
              <div class="logo">
                <h5>SWEET FILM BAR</h5>
                <h6>NO FILM. NO DREAM!</h6>
              </div>
            </div>
          </q-toolbar-title>
          <q-tab to="/form" label="HOME" />
          <q-tab to="/" label="SHOP" />
          <q-tab to="/"  label="FILM LAB" />
          <q-tab to="/" label="WORKSHOP" />
          <q-tab to="/" label="PHOTOWALK" />
          <q-tab to="/" icon="facebook"/>
          <q-tab to="/">
            <img to="/" src="../assets/icon-ig.png" style="max-width: 20px;" />
          </q-tab>
          <q-tab to="/"  label="Contact Us" />
          
        </q-tabs>
        <p style="margin-top: 20px" />
      </q-header>

      <q-page-container>
        <slot></slot>
      </q-page-container>
    </q-layout>
  </div>
</template>
  
<script>
import { ref } from "vue";

export default {
  name: "Menu",
  setup() {
    const leftDrawerOpen = ref(false);

    return {
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
};
</script>

<style scoped>
* {
  color: black;
}
.bold-text {
  font-weight: bold;
}

p{
    margin-top:10px;
    font-size: 14px;
}
h5{
    font-weight: bold;
}
hr {
  width: 95%;
  border: none;
  height: 1px;
  background-color: black;
}
.logo {
  padding-left: 10px;
}
.header-box {
  height: 150px;
}
.header {
  padding-left: 80px;
  padding-right: 80px;
}
</style>