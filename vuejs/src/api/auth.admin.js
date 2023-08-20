import httpAdmin from "@/api/http.admin";
import router from "@/router";

const authAdmin = {
  currentUser: null,
  isLoggedIn() {
    return !!localStorage.getItem('ACCESS_TOKEN')
  },
  getToken() {
    return localStorage.getItem('ACCESS_TOKEN')
  },
  async login(formData) {
    try {
      const { status, data } = await httpAdmin.post('user/login', formData);
      if (status) {
        localStorage.setItem('ACCESS_TOKEN', data.access_token)
      }
      return {
        success: true
      }
    } catch (e) {
      return {
        success: false,
      }
    }
  },
  async register(formData) {
    try {
      const { status, data } = await httpAdmin.post('user/register', formData);
      if (data) {
        localStorage.setItem('ACCESS_TOKEN', data.access_token)
      }
      return {
        success: true
      }
    } catch (e) {
      return {
        success: false,
        errors: e.response.data
      }
    }
  },
  async logout() {
    try {
      const { data } = await httpAdmin.post('logout');
      if (data) {
        localStorage.removeItem('ACCESS_TOKEN');
        router.push('/login');
      }
      return {
        success: true
      }
    } catch (e) {
      return {
        success: false
      }
    }
  },
};

export default authAdmin;