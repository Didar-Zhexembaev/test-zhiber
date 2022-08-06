import axios from "axios";

const api = axios.create({withCredentials: true, baseURL: import.meta.env.VITE_SESSION_DOMAIN + '/api/'});

export default api;