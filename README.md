<p align="center">
  <img src="https://github.com/Lactu/Lactu/raw/master/custom/img/Lactu%40128w.png">
</p>


lactu
========

*Note:*
Lactu is the fork of moonmoon which is abandonned.
It keeps the same BSD licence and philosophy: a simple, hackable and reliable file-based feed agregator.
The main reason for a full fork is that the original project was a PHP 4 code base which I helped migrate to PHP 5.5 but we are now at PHP 8 and I have to maintain personal patches to keep it compatible.

Lactu is a web based aggregator similar to planetplanet.
It can be used to blend articles from different blogs with same interests into a single page.

Lactu is simple: it only aggregates feeds and spits them out in one single page.
It does not archive articles, it does not do comments nor votes.

Requirements
------------
You will need a web hosting with at least PHP 8.4.

If you are installing Lactu on a Linux private server (VPS, dedicated host),
please note that you will need to install the package `php-xml`.

License
-------

Lactu is free software and is released under the [BSD license](https://github.com/Lactu/Lactu/blob/master/LICENSE).
Third-party code differently licensed is included in this project, in which case mention is always made of
the applicable license.

Configuration options
---------------------
After installation, configuration is kept in a YAML formatted `custom/config.yml`:

```%yaml
url: http://planet.example.net  # your planet base URL
name: My Planet                 # your planet front page name
locale: en                      # front page locale
items: 10                       # how many items to show
refresh: 240                    # feeds cache timeout (in seconds)
cache: 10                       # front page cache timeout (in seconds)
cachedir: ./cache               # where is cache stored
postmaxlength: 0                # deprecated
shuffle: 0                      # deprecated
nohtml: 0                       # deprecated
categories:                     # only list posts that have one
                                # of these (tag or category)
debug: false                    # debug mode (dangerous in production!)
checkcerts: true                # check feeds certificates
```
