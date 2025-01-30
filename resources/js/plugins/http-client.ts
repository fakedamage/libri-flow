import axios from "axios";

axios.defaults.baseURL = "http://localhost:8000/api";
axios.defaults.headers["Content-Type"] = "application/json";
const HttpClient = axios;
export default HttpClient;
