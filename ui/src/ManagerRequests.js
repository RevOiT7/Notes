export const SendRequestWithBody = (data, httpMethod, uri, redirectPath) => {

};

export const SendRequestWithAuthorization = (httpMethod, uri, redirectPath ) => {
    fetch(uri, {
        method: httpMethod,
        headers: {
            "Content-Type": "application/json; charset=utf-8",
            "Authorization": localStorage.getItem('Authorization')
        }
    })
        .then((response) => {
            if (response.status === 200) {
                localStorage.setItem('Authorization', '');
                window.location.replace('/#' + redirectPath);
            }
        })
        .catch( error => console.error(error) );
};
