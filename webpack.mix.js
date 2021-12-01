const mix = require("laravel-mix");

if (mix == "undefined") {
  const { mix } = require("laravel-mix");
}

require("laravel-mix-merge-manifest");

var publicPath = "public/themes/quimashop/assets";

mix.setPublicPath(publicPath).mergeManifest();
// mix.disableNotifications();

mix
  .js([__dirname + "/resources/assets/js/app.js"], "js/shop.js")
  // .copyDirectory(__dirname + "/resources/assets/images", publicPath + "/images")
  .sass(__dirname + "/resources/assets/sass/app.sass", "css/shop.css")
  .options({
    processCssUrls: false,
  });

if (!mix.inProduction()) {
  mix.sourceMaps();
}

if (mix.inProduction()) {
  mix.version();
}
