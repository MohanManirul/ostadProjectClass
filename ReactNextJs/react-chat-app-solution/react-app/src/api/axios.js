import axios from 'axios';

const api = axios.create({
  baseURL: 'https://chat-api-vecx.onrender.com/api'
});

export default api;