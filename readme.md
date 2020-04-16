APP information

- The app is based on xampp (I have php7 and MySql there).
- The app was build under the laravel artisan server in localhost. Due to this, I have had problems with facebook login, since it requires   https webs to work. Instead of using the facebook API for login, I decided to replace it with the artisan auth system. The code I would   use for facebook login is in resources/js/facebookSDK.js
- Respect to the data storing, I decided to use a form that appears after clicking in get prize. User would be able to modify the data. 
  The other option would be directly store the values with an ajax call to store method. This method would not allow me to properly         redirect to the web.
- Since I only needed a unique page to display and store the data, I used the prices/index blade.
