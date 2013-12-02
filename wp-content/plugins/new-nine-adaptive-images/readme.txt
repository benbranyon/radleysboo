=== New Nine Adaptive Images===
Contributors: New Nine
Author URI: http://www.newnine.com
Tags: adaptive images, responsive images, responsive design
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: trunk
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Detects your visitor's screen size and automatically creates, caches, and delivers device appropriate re-scaled versions of your uploaded images.

== Description ==

Built specifically for WordPress, the New Nine Adaptive Images plugin:

* Works on your existing site
* Requires no mark-up changes
* Device agnostic
* Mobile-first philosophy
* Easy & powerful customizations
* Up and running in seconds

Why? Because your site is being viewed on smaller, slower, low bandwidth devices. On those devices, your desktop-centric images load slowly, cause UI lag, and cost you and your visitors unnecessary bandwidth and money. The Adaptive Images Plugin fixes that.

This plugin was built by [New Nine Media & Advertising](http://www.newnine.com/ "New Nine Media & Advertising") based on the work done by [Matt Wilcox](http://adaptive-images.com/ "Matt Wilcox").

__Set Up is Easy__

Install the plugin and visit the 'Settings -> Media' section of your dashboard. You can leave the defaults in place or customize the options to match your breakpoints, desired image quality, etc.

Then, copy the .htaccess information and paste it in your site's .htaccess file.

You're done!

__Requirements__

To run the New Nine Adaptive Images plugin, your server needs:

* Apache 2
* PHP 5 or greater
* GD lib

These are fairly standard on today's servers. If the plugin isn't working, odds are that you need a better web host.

__Built for WordPress__

Matt Wilcox built his Adaptive Images for any website. We built this plugin specifically for WordPress (and you!) Want to learn more? Visit the FAQ section.

== Installation ==

Use the WordPress installer; or, download and unzip the files and put the folder `n9m-adaptive-images` into the `/wp-content/plugins/` directory.

Activate the plugin through the 'Plugins' menu in WordPress.

Visit 'Settings -> Media' in your dashboard, copy the .htaccess code, and paste it into your .htaccess file.

You can customize your breakpoints and more by visiting 'Settings -> Media' in your dashboard.

You are now adaptive (and awesome)!

== Frequently Asked Questions ==

= What should my breakpoints be? =

You can set them to whatever you want and have as many (or few) as you want; however, you probably want to set them to match your CSS breakpoints.

= What if my user doesn't have JavaScript turned on? =

Your original image in its original size is displayed, just as your site works now.

= What images will be "adaptive"? =

Any image you put in a page, post, or custom post type, and any image that is uploaded through your media uploader. Out of the box, any image that has been uploaded through your media uploader will become adaptive. If you know more advanced .htaccess directives, you can customize this further.

= Are there any shortcodes or functions to deal with? =

No. Just turn it on, update your .htaccess, and the plugin handles everything. You just add your images as you normally do. When they are accessed by a visitor, the plugin kicks in and handles the replacement, caching, etc.

= How do I edit my .htaccess file? =

You need to log into your server through your control panel's file manager or via FTP. In the directory where WordPress is installed, you should find a file called .htaccess. Open it, put in the directive we gave you under 'Settings -> Media', and save the file.

= Where can I learn more about how this works? =

Visit [Adaptive Images](http://adaptive-images.com/ "Matt Wilcox's adaptive images") website to understand the innerworkings of the code and browser interaction. You can also visit [our WordPress tutorials](http://www.newnine.com/learn "our WordPress tutorials") to learn more.

= Will this bloat or slow down my WordPress? =

No. The plugin only makes a few small options entries in your database which means it won't bloat your installation.

On your site, Adaptive Images includes a 140 byte JavaScript file in your header.

= What happens to my images if I deactivate/uninstall Adaptive Images? =

Nothing. They appear normally and your site functions and looks as it did before you used the plugin.

If you *uninstall* the plugin, the options are removed from your database to keep your WordPress clean. No bloat here!