# Genesis Theme Modified 
## HapIns Philippines Wordpress Website

#### Go to "themes" folder of your local development server
#### use MAMP for local server development
MAC - https://www.mamp.info/en/mac/
Windows - https://www.mamp.info/en/windows/

#### Install Wordpress
https://wordpress.org/

extract the wordpress zip file and put inside this directory of MAMP
For MAC - Applications/MAMP/htdocs

#### Clone the repo using SSH
~ git clone git@github.com:erickestillosoph/genesis_theme.git

#### Install dependencies on the "/theme" folder directory
~ npm install 

##### Install Gulp
~ npm install -g gulp
or 
~ sudo install -g gulp

##### Install the Gulp as save-dev
~ npm install --save-dev gulp
or 
~ sudo npm install --save-dev gulp

##### Install browser-sync
 ~ sudo npm install --save-dev browser-sync

--------------------------------------------------------
### what to change in
### gulpfile.js


``` js
function watch(done) {
  browserSync.init({
    proxy: "http://localhost/wordpress/",   <--- Change the wordpress word same as your folder name you name the wordpress at the htdocs you paste
  });
  gulp.watch("./**/*.css").on("change", browserSync.reload);
  gulp.watch("js/*.js").on("change", browserSync.reload);
  gulp.watch("./**/*.php").on("change", browserSync.reload);

  done();
}

```
once the proxy has been change to the right URL. Run on the directory `wp-content/themes`

~ `gulp watch`
