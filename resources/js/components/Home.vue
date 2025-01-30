<template>
    <div class="container">
      <h1>Welcome to the Home Page</h1>
      <p><router-link to="/login">Login</router-link> | <router-link to="/register">Register</router-link></p>
    </div>
  </template>

  <script>
  export default {
    name: 'Home'
  };
  </script>
