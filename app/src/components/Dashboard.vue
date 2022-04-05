<template>
  <div class="container">
    <header class="jumbotron">
      <h3>
        <strong>{{currentUser.user.username}}</strong> Profile
      </h3>
    </header>
    <p>
      <strong>Token:</strong>
      {{currentUser.token.substring(0, 20)}} ... {{currentUser.token.substr(currentUser.token.length - 20)}}
    </p>
    <p>
      <strong>Id:</strong>
      {{currentUser.user.id}}
    </p>
    <p>
      <strong>Email:</strong>
      {{currentUser.user.email}}
    </p>
    <p>
      <strong>Username:</strong>
      {{currentUser.user.username}}
    </p>
    <strong>Authorities:</strong>
    <ul>
      <li v-for="role in currentUser.user.roles" :key="role">{{role}}</li>
    </ul>
  </div>
</template>
<script>
export default {
  name: 'DashboardPage',
  computed: {
    currentUser() {
      return this.$store.state.auth.user;
    }
  },
  mounted() {
    if (!this.currentUser) {
      this.$router.push('/login');
    }
  }
};
</script>