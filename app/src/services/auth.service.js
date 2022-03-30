import axios from 'axios';
import authHeader from './auth-header';
const API_URL = 'http://localhost/api';
class AuthService {
  login(user) {
    return axios
      .post(API_URL + '/login', {
        email: user.username,
        password: user.password
      })
      .then(response => {
        if (response.data.token) {
          localStorage.setItem('user', JSON.stringify(response.data));
        }
        return response.data;
      });
  }
  me(){
    return axios
      .get(API_URL + '/users/me', { 
        headers: authHeader() 
      })
      .then(response => {
          var currentUser = JSON.parse(localStorage.getItem('user'));
          currentUser.email = response.data.email;
          currentUser.id = response.data.id;
          currentUser.roles = response.data.roles;
          currentUser.username = response.data.username;

          localStorage.setItem('user', JSON.stringify(currentUser)); 
          return currentUser;
      });
  }
  logout() {
    localStorage.removeItem('user');
  }
  register(user) {
    return axios.post(API_URL + '/users', {
      username: user.username,
      email: user.email,
      password: user.password
    });
  }
}
export default new AuthService();