=== Premium Seo Pack - Light Version ===
Contributors: AA-Team
Donate link: http://premiumseopack.com/
Tags: premium seo plugin
Requires at least: 3.8
Tested up to: 3.8
Stable tag: trunk
License: GPLv2 
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Premium SEO Pack is the newest and most complete SEO Wordpress Plugin on the market! 
 
== Description ==

What’s Premium SEO Pack ? Premium SEO Pack is the newest and most complete SEO Wordpress Plugin on the market! The Premium SEO Pack Plugin has everything that you can possibly need, starting with page analisys, social stats, page validation, link builder and many many more !

Read more about [Premium SEO Pack](http://www.premiumseopack.com/ "Premium SEO Pack")

= On Page Optimization & On Categories Optimization! =
Another unique feature, we have optimization for categories as well! And for any custom taxonomies! Here you can set your Focus Keyword, Check the SEO Score, The Keyword Density, The Meta with - Rich Snippet Preview, SEO Title, Meta Description & Meta Keywords. You can also see a Page Status where you can check all the main elements, if they are in the right parameters. Also, you can setup Social Settings, for Facebook, to use Facebook Meta, Title , Description and Image. For advanced users we have some Advanced SEO, that includes the Meta Robots Index, Meta Robots Follow, Include in Sitemap & Canonical URL.


= Title & Meta Format =
Using this module you can set custom page titles, meta descriptions, meta keywords, meta robots and social meta using defined format tags for Homepage, Posts, Pages, Categories, Tags, Custom Taxonomies, Archives, Authors, Search, 404 Pages and Pagination.

= Media Smushit =
We’ve created a new module called Media Smushit that allows you to Optimize your Website Images! For this module we use the Smush.it API, that allows you to optimize the website images without changing their look or visual quality. Using this module, you can remove the unnecessary bytes from image files. After using it, you have a report on how many bytes are saved, by optimizing the images. How does it work? Using this module, the image will be downloaded on the Smush.it service (via URL) and then will return the new version of the image, optimized, which will be downloaded and will replace the original image from your server.

= Google Analytics =
Google Analytics can be a bit complicated if you don’t know what you’re looking for. We’ve made a module that takes the data from Google Analytics and transforms it into an easy to understand dashboard, that will allow you to see the impact on search engines, and not only that. 

= 404 Monitor =
Our SEO Pack also contains a 404 Monitor Module. Keep your users visiting experience at a high level by monitoring the 404 error pages. On this module you can see what URLs are referring visitors to 404 pages, how many hits it had and the possibility to redirect them to another page. This helps you keep your ranking without google downgrading you.

= Link Builder =
How does this module work? The Link Builder Module allows you to improve your site internal link building. You can create list of keywords and URLs, and they will automatically be created. You don’t have to bother to take each post and modify it, this module does that for you! All you have to do is to insert a keyword and a URL, and within all your articles the links will be published. Why do you need it? It Improves the user's experience around the website with internal links, It Improves SEO by spreading the link around your website and you can also create Links to sources or affiliate links whom you reference a lot. 

= 301 Link Redirect  =
Yep, we have an Automatic 301 redirect module also. This module is very useful for any permalink changes. The Link Redirect Module gives you an easy way of redirecting requests to other pages on your website or anywhere else on the web. It’s very useful if you want to move a Wordpress site, and you want to migrate the whole website. This way when migrating you can keep your URL structure. By setting up 301 Redirects from old pages to new pages, any incoming links will work, and your pagerank will not suffer or be downgraded by Google.

= File Edit =
File Edit Module allows you to edit the robots.txt and .htaccess files. It’s a bit difficult to do so, we’ve created a file edit module, from where you can easily modify / update those types of files. 

= Slug Optimization =
Slug Optimizer removes common words from the slug of a post or page. That way you can Increase in-URL keyword strength by removing “filler words” " (like "a," "am," "and," etc.) 


= Full features list =
* Works as plugin on any Wordpress Install (3.7+)
* Based on modules manager, you must activate the modules in order to work
* New feature - import SEO Settings from other Popular SEO Plugins.
* Monitoring Modules
	Google Analitycs
	404 Monitor - you can see what URLs are referring visitors to 404 pages, how many hits it had and redirect them to another page
* On page Optimization Modules
	On page optimization – optimize your pages / post types one by one, right on the post/page! It also works on categories and any other custom taxonomies
	Title & Meta Format - set custom page titles, meta descriptions, meta keywords, meta robots and social meta using defined format tags for Homepage, Posts, Pages, Categories, Tags, Custom Taxonomies, Archives, Authors, Search, 404 Pages and Pagination.
* 		SEO Slug Optimizer- Slug Optimizer removes common words from the slug of a post or page
* Off Page Optimization Modules
	Link Builder - improve your site internal link building.
	301 Link Redirect - useful for any permalink changes
* Advanced Setup Modules
	Files Edit - allows you to edit the robots.txt and .htaccess files.
	SEO Insert Code - Add custom code into < head > and wp_footer
	Media Smushit -For this module we use the Smush.it API, that allows you to optimize the website images without changing their look or visual quality.


== Installation ==

Instalation Via FTP Client Software 

Extract the .ZIP archive to a local folder on your PC. It should contain a subfolder named premium-seo-pack.zip

Upload unzipped 'premium-seo-pack' folder from Plugins folder to the '/wp-content/Plugins/' directory using your favorite FTP client software Make sure you have setup Transfer Mode - Binary, because files can be broken upon transfer with ASCII mode

Login to your WordPress admin dashboard, go to Plugins, Click 'Activate'


= Instalation Via WordPress Dashboard =

Log in to your WP Admin Panel and open the Plugins panel

Click 'Add new' and follow the instructions

When asked to select a file, choose the premium-seo-pack.zip file

After uploading the Plugin to your server, Click 'Activate'


= Install default Config =

Mandatory Step - You must install the default config in order to work.

/assets/setup.png

Import settings from Other SEO Plugins

This tool allows you to import SEO settings from other SEO Popular Plugins

/assets/import.png


= Google Analitycs Settings =

You can find the Settings in the Monitoring Module.

 In order to use the Google Analytics module, first you need to fill out some settings.

Create a Project in the Google APIs Console: https://code.google.com/apis/console/
Enable the Analytics API under Services
Under API Access: Create an Oauth 2.0 Client-ID
Give a Product-Name, choose Web Analytics Application depending on your needs
Web Application: Set a redirect-uri in the project which points to your apps url

After creating a project you must fill out the following options:

    Your client id: From the APIs console.
    Your client secret: From the APIs console.
    Redirect URI: Url to your app, must match one in the APIs console.
    Profile ID: Select your website profile from list. If list is empty please authorize first the app.
    Add Google Analytics javascript code on all pages.
    Google Analytics ID: Your Google Analytics ID to be used in tracking script
    Google Webmaster Tools:

Where to get the keys for the Google analytics keys.

Step 1 - Create new project

Step 2 - Go to API's

For the Google Analytics module, activate the Analitics API

Step 4 - Go to Credentials

From the Public API access - you get the API KEY

Now on OAuth , create new client ID

From here you get the Client ID, Secret

when creating a new client , you must add the redirect URL from the seo settings.
Once you filled out all those options, you can check the Audience Overview on the project you created. 


= 404 Monitor =

Here you can monitor your 404 error pages.

You can see a list with your website 404 page errors, how many hits it had, the bad link, the refferer URL, and the User Agent.

Using this module you have the possibility to delete those pages, or redirect them to a working page.


= Title & Meta Format =

Using this module you can set custom page titles, meta descriptions, meta keywords, meta robots and social meta using defined format tags for Homepage, Posts, Pages, Categories, Tags, Custom Taxonomies, Archives, Authors, Search, 404 Pages and Pagination.



= Slug Optimizer =

Slug Optimizer removes common words from the slug of a post or page. That way you can Increase in-URL keyword strength by removing “filler words” " (like "a," "am," "and," etc.)


= Link Builder =

How does this module work? The Link Builder Module allows you to improve your site internal link building.

You can create list of keywords and URLs, and they will automatically be created.

You don’t have to bother to take each post and modify it, this module does that for you!

All you have to do is to insert a keyword and a URL, and within all your articles the links will be published.

Why do you need it?

It Improves the user's experience around the website with internal links, It Improves SEO by spreading the link around your website and you can also create Links to sources or affiliate links whom you reference a lot.

How do you add a new link?

Simply Click on Add new Link button, and you will have the following options: Text, URL, Verify founds (if the text does not exist, no link will be added), rel, target and maximum replacements.

You can set if want to publish/unpublish the link, update or delete.


= 301 Link Redirect =

Yep, we have an Automatic 301 redirect module. This module is very useful for any permalink changes.

The Link Redirect Module gives you an easy way of redirecting requests to other pages on your site or anywhere else on the web.

It’s very useful if you want to move a Wordpress site, and you want to migrate the whole website. This way when migrating you can keep your URL structure.

By setting up 301 Redirects from old pages to new pages, any incoming links will work, and your pagerank will not suffer or be downgraded by Google.


= Files Edit =

File Edit Module allows you to edit the robots.txt and .htaccess files.

It’s a bit difficult to do so, we’ve created a file edit module, from where you can easily modify / update those types of files easily.


= Seo Insert Code =

This module allows you add custom code into your theme's < head > and wp-footer.


= Media Smushit Settings =

This module allows you to optimize your website images. Yahoo Smush.it API uses optimization techniques specific to image format to remove unnecessary bytes from image files. It is a "lossless" tool, which means it optimizes the images without changing their look or visual quality.

Here you have the following settings:

    Response timeout: enter the maximum number of seconds you want to wait for response from Smush.it service.
    Smush.it on Upload: smush.it on media image upload
    Image same domain: image url must be on same domain as website home url!

 
== Screenshots == 

1. 301 Redirect module
2. Google Analytics module
3. 404 Error module
4. Title and meta module
5. Smushit module



== Frequently Asked Questions == 

= Does this plugin work with custom taxonomies as well? =

Yes it does

== Changelog ==

= 1.0 =
 
== Upgrade Notice == 
= 1.1 =