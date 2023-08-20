import axios from 'axios';
import authAdmin from "@/api/auth.admin";

/** Default config for axios instance */
const API_ENDPOINT = process.env.VUE_APP_API_ENDPOINT || 'http://apl.tech.kz/';

let config = {
    baseURL: `${API_ENDPOINT}api/`
};

/** Creating the instance for axios */
const httpAdmin = axios.create(config);

/** Auth token interceptors */
const authInterceptor = config => {
    config.headers.Authorization = `Bearer ${authAdmin.getToken()}`;
    return config;
};


/** Adding the request interceptors */
httpAdmin.interceptors.request.use(authInterceptor);

/** Adding the response interceptors */
httpAdmin.interceptors.response.use(
    response => {
        /** TODO: Add any response interceptors */
        return response;
    },
);

export default httpAdmin;
