<template>
  <b-navbar
    type="light"
    toggleable="lg"
    variant="white"
    class="navbar navbar-toggleable-md navbar-light bg-faded py-5"
  >
    <div class="container d-flex">
      <div class="text-center flex-grow-1">
        <NuxtLink class="navbar-brand ml-5" to="/">
          <b-img src="@/assets/icons/logo.png" />
        </NuxtLink>
      </div>
      <b-navbar-nav>
        <NuxtLink to="/page/about-us" class="nav-link">About Us</NuxtLink>
        <b-nav-item-dropdown text="Issues" right>
          <b-dropdown-item to="/">Issue 1</b-dropdown-item>
        </b-nav-item-dropdown>
        <a href="https://freshdesk.com/" target="_blank" class="nav-link">
          <b-img src="@/assets/icons/freshworks-logo.png" />
        </a>
      </b-navbar-nav>
    </div>
  </b-navbar>
</template>

<script>
export default {
  name: "appNavbar",
};
</script>
