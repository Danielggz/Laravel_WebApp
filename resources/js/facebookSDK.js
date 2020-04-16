window.fbAsyncInit = function() {
    FB.init({
    appId      : '231124547961298',
    cookie     : true,
    xfbml      : true,
    version    : 'v6.0'
    });
    FB.AppEvents.logPageView();   
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(document).ready(function(){
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;
            console.log("connected");
        } else if (response.status === 'not_authorized') {
            console.log("not authorized");
        } else {
            console.log("unknown");
        }
    });
})