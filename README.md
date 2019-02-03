# Modular Native PHP Website Project
This is a website project using modular native PHP.
As known it's "modular native PHP", it doesn't use any framework.
And the front-end is only use Bootstrap and jQuery.

It might be a easy way to make a "beautiful" website instead of put all the php files in one folder.

## File Intro
`_include/variable/_enum_admin.php`
Pre-declare some vars which is frequently used.
Which is for role permissions.

`_include/config.php`
1. Define some website parameters.
2. The default functions that we provide you to use easily.
3. Some website settings.

`_include/constant.php`
The website define values.

`_include/database.php`
Database settings.

`_include/variable.php`
Pre-declare some vars which is frequently used.

`_layout/home`
The layout files (header and footer) for front site.

`_layout/manage`
The layout files for back site (administration site).

`_partial`
The details of layout files, which include css, footer, header, meta, navbar, and scripts.

`error`
Default error pages.

`manage`
Admin site.

`news`
Pages for news feature.

`src`
Sources.

`getfile.php`
A page to get the file from database.
