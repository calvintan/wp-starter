# My WP Starter Theme

A barebones WP starter template, with _just enough_ flavor added to get started. Clone this and start customising, as simple as that.

## Commands

`npm i`
Installs all the required packages.

`npm run start`
Starts the gulp process for SCSS and ES6 compilation, and reloads the browser upon any changes.

`npm run bundle`
Bundles the production-ready theme into a zipfile.

## Setup
```javascript
export const serve = (done) => {
  server.init({
    proxy: "http://localhost/(your local WP dir)/",
  });
  done();
};
```
Update `gulpfile.babel.js` with the URL of the WordPress installation on your machine.

Update the "name" in `package.json` to your desired WordPress theme name. 
This name will take effect when gulp exports the theme as a zipfile.

## Suggested Plugins/Addons

- Advanced Custom Fields
- Custom Post Type UI
- https://github.com/wp-bootstrap/wp-bootstrap-navwalker
