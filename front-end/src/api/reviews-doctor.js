import axios from 'axios';

const apiUrl = 'http://127.0.0.1:8000/api/';

const reviewsDoctorApi = {
    getAll(token) {
        const url = apiUrl + "reviews-doctor";
        const tokenApi = token;
        const config = {
            headers: {
                'Authorization': `Bearer ${tokenApi}`
            }
        };
        return axios.get(url, config);

    },

    // get(id) {
    //     const url = `/reviews-doctor/${id}`;
    //     return instance.get(url);
    // },

    // add(data) {
    //     const url = "/reviews-doctor";
    //     return instance.post(url, data);
    // },

    // update(data) {
    //     const url = `/reviews-doctor/${data.id}`;
    //     return instance.patch(url, data);
    // },

    // remove(id) {
    //     const url = `/reviews-doctor/${id}`;
    //     return instance.delete(url);
    // },
    // // getListReviews(params) {
    // //     const url = "/reviews-doctor";
    // //     return instance.get(url, params);
    // // },
};

export default reviewsDoctorApi;
