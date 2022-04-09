import axios from 'axios';
import VueJwtDecode from 'vue-jwt-decode';
const API_URL = 'https://api.lucasmartinelle.com/api';
class AuthService {
  login(user) {
    return axios
      .post(API_URL + '/login', {
        email: user.email,
        password: user.password
      })
      .then(response => {
        var JWTData = response.data;
        if (response.data.token) {
          JWTData = VueJwtDecode.decode(response.data.token);
          JWTData['token'] = response.data.token;
          localStorage.setItem('user', JSON.stringify(JWTData));
        }
        return JWTData;
      });
  }
  logout() {
    localStorage.removeItem('user');
  }
  register(user) {
    return axios
      .post(API_URL + '/users', {
        username: user.username,
        email: user.email,
        password: user.password
      });
  }
}
export default new AuthService();