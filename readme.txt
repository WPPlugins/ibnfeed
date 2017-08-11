=== itsbooked.net feed reader ===
Contributors: alex.north
Donate link: http://itsbooked.net/
Tags: feed, consume, rss, itsbooked, booking, embed
Requires at least: 3.1.2
Tested up to: 3.1.2
Stable tag: 0.3

Embed session feed from itsbooked.net into WP

== Description ==

This plugin will consume the XML feed of sessions which have been marked as 'Active', 'Session is public' and has 'Allow new participants' checked on the session record.
This is managed from the 'Options' tab in the 'Session management' form inside of itsbooked.net.

== Changelog ==

v0.3 Provide formatted start and end date and times to include in returned content

v0.2 Split out user customisation into ibnfeed_output.php to make taking future updates easier

v0.1 Initial release

== Installation & Use ==

1. Upload `ibnfeed.php` and `ibnfeed_output.php` to the `/wp-content/plugins/ibnfeed/` directory (create the sub-directory if it doesn't already exist)
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `[ibnfeed ibn_site=mysite,camp_type=,location=shortcode]` in your WordPress pages or posts
1. Customise the `$htmlToAdd` string on the `ibnfeed_output.php` page to determine how the feed will be formatted

== Upgrade note ==

If upgrading from v0.1, be sure to copy any customisation you have made to generate content before uploading the new files. These elements live in `ibnfeed_output.php` as of v0.2.

If upgrading from v0.2 or later, do not overwrite `ibnfeed_output.php`, or you will lose your content customisations!

== Switches ==

The following switches are mandatory. If they are not included in the tag, the feed may not work as expected.

ibn_site      : This is the root of your itsbooked.net URL path eg:  https://secure.itsbooked.net/mysite/      ibn_site=mysite

camp_type     : Current options are green/blue/red/black. Leaving the switch empty is a valid option and will return camps of all levels

The following switches are optional.

location     : You can filter down so that only sessions for a specific location are rendered from the feed. This switch takes the 'shortcode' from the 'Location mangement' page in the system admin section of itsbooked.net.