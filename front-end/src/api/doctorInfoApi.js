import axios from 'axios';

const apiUrl = 'http://127.0.0.1:8000/api/';

const DoctorInfoApi = {
    getAll(token) {
        const url = apiUrl + "doctor-info";
        const tokenApi = token;
        const config = {
            headers: {
                'Authorization': `Bearer ${tokenApi}`
            }
        };
        return axios.get(url, config);

    },
};

export default DoctorInfoApi;