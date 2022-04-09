<template>
  <div class="container">
    <header class="jumbotron">
      <h3>
        <strong>{{username}}</strong> Profile
      </h3>
    </header>
    <p>
      <strong>Token:</strong>
      {{token.substring(0, 20)}} ... {{token.substr(token.length - 20)}}
    </p>
    <p>
      <strong>Id:</strong>
      {{id}}
    </p>
    <p>
      <strong>Email:</strong>
      {{email}}
    </p>
    <p>
      <strong>Username:</strong>
      {{username}}
    </p>
    <strong>Authorities:</strong>
    <ul>
      <li v-for="role in roles" :key="role">{{role}}</li>
    </ul>
  </div>
</template>
<script>
import UserService from '../services/user.service';
export default {
  name: 'DashboardPage',
  data() {
    return {
      username: '',
      token: '',
      email: '',
      id: 0,
      roles: []
    };
  },
  mounted() {
    UserService.getUserBoard().then(
      response => {
        this.username = response.data.username;
        this.token = JSON.parse(localStorage.getItem('user')).token;
        this.email = response.data.email;
        this.id = response.data.id;
        this.roles = response.data.roles;
      },
      error => {
        this.content =
          (error.response && error.response.data) ||
          error.message ||
          error.toString();
      }
    );
  }
};
</script>