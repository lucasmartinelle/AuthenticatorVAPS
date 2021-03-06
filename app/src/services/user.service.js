import axios from 'axios';
import authHeader from './auth-header';
const API_URL = 'http://localhost/api/';
class UserService {
  getUserBoard() {
    return axios.get(API_URL + 'users/me', { headers: authHeader() });
  }
}
export default new UserService();