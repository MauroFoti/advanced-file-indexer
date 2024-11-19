# Advanced file indexer

Advanced file indexer is similar to the default apache index page: it will list files and directories in the root of your site, but it's more advanced as it is completely customizable. It also makes it possible for you to disable direct file download, and instead use a form to perform any check you might need, or authenticate the user trying to download the file.

If so, you will need to change the file `download-form.php` to add all your desired logic.

**Warning.** This program uses the PHP function `readfile()` and could potentially expose sensible information and/or the entire filesystem. There are only a handful of checks on the files you can download, and I cannot guarantee the security of your files outside the root directory. This program is only intended to be used in a private network. **Use this program at your own risk**.

## Installation

The program is composed of various source snippets that are assembled togheter by `m4`. Just use the provided `Makefile` and it will assemble the file `index.php`; alternatively you can grab a pre-built `index.php` in the releases section of this repo. This is the only file you'll need, and you can copy it in the folder you want to index. In order to correctly (and transparently) handle URLs, your webserver needs to be properly configured.

An example of configuration for `apache2` is as following:

```apacheconf
<VirtualHost *:80>

    # server name and root
    ServerName    file.example.com
    DocumentRoot  /var/www/html/

    # set permissions and index page
    Options -Indexes
    DirectoryIndex  index.php

    # give path to index.php
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule (.*) /index.php/$1 [L]

</VirtualHost>
```

## Requirements

There are no particular requirements to run this program. The script has been tested with php 7.4.3, but should work with any recent version. To assemble the file you'll need `m4`, which should already be installed in most linux distro.

This program has only been tested with `apache2` on linux. Compatibility with other servers is unknown (but expected), windows compatibility is not expected and thus unknwown.

# Credits

Thanks [Ales Meub](https://alexmeub.com/old-windows-icons/) for the great old-school icons!
