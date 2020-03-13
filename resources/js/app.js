require('./bootstrap');

$(document).ready(function(){
    let Axios = axios.create({
        baseURL: 'http://127.0.0.1:8000/api/',
        timeout: 1000,
        headers: {'Content-Type': 'text/json; charset=UTF-8', 'Accept': 'text/json; charset=UTF-8'}
    });
});