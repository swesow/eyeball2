import axios from "axios";

export default axios.create({
    baseURL: "/",
    headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
    }
});