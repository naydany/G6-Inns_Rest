<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-white">
      <div class="flex mt-2 mb-2 ml-2">
        <router-link to="/user-service">
          <span class="material-symbols-outlined" style="font-size: 40px"> arrow_back </span>
        </router-link>
        <h4 class="pt-2 pl-1">Back</h4>
      </div>
    </nav>
    
    <!-- Header -->
    <header class="bg-image mr-2 ml-2">
      <h4 class="text-white pt-120 pl-5">Paradise Cozy Guesthouse Sihanoukville</h4>
    </header>

    <!-- Container -->
    <div class="container">
      <div class="text-center mt-5 mb-5">
        <h1>Inns Rest Environment</h1>
        <h6>
          It is a long established fact that a reader will be distracted by the readable content of a
          page when
        </h6>
        <h6>looking at its layout.</h6>
      </div>
      
      <!-- Card Detail Component -->
      <ListRoom />
      <UserComment/>
    </div>

    <!-- Footer Layout -->
    <FooterLayout />
  </div>
</template>

<script>
import FooterLayout from "../../Components/Layouts/FooterLayout.vue";
import ListRoom from "./ListRoom.vue";
import UserComment from './UserComment.vue';

export default {
  name: "ServiceDetail",
  components: {
    ListRoom,
    UserComment,
    FooterLayout
  }
};
</script>

<style scoped>
.bg-image {
  background-image: url("../../Image/DetailHouse/HouseHeader.png");
  background-size: cover;
  background-position: center;
  height: 500px;
}
</style>