## Installation

To install the extension, place the entire `VectorMenuSidebar` directory within your
MediaWiki `extensions` directory, then add the following line to your
`LocalSettings.php` file:

```php
wfLoadExtension( 'VectorMenuSidebar' );
```
## What is this extension

Create your own wikitext based sidebar for Vector skin

add `$wgVectorMenuSidebar = true;` in `LocalSettings.php` to activate MenuSidebar.

Sidebar style is built in backend, edit ./resources/MenuSidebar.css to customize MenuSidebar.

example for `Mediawiki:MenuSidebar` by default style settings:

	MenuTitle #1
	* '''NotLink Item must use Boldtext tag''' 
	** [externalLink Item]
	*** [[Item]]
	MenuTitle #2
	* [[Link Item]]
	** '''NotLink Item'''
	*** [[Item]]
	**** [[item Level can be infinite]]
	{{#Parser Function Item}}

Example site with MenuSidebar: www.gfwiki.org

## Custom styles
add your own style in `Mediawiki:MenuSidebar.css`

then apply `$wgEnableVMSCustomStyle = true;` in `LocalSettings.php` to activate，

Notice ：applying custom styles will disable default styles.

## Content after Sidebar
add content based on wikitext in `Mediawiki:MenuSidebarAfter` and add `$wgShowAfterMenuSidebar = true;`in `LocalSettings.php` to activate，

## Per-skin menu
If `Mediawiki:MenuSidebar-vector` exists it is used instead of `Mediawiki:MenuSidebar`. This is for wikis that
share `Mediawiki:MenuSidebar` with another skin rendering it on its own (e.g. Skin:Arknights) and want a few
entries to show up in Vector only, without keeping two copies of the menu:

`Mediawiki:MenuSidebar-vector`:

	{{MediaWiki:MenuSidebar|vector=1}}

`Mediawiki:MenuSidebar` (read directly by the other skin, where `{{{vector|}}}` is empty):

	* [[Shown everywhere]]{{#if:{{{vector|}}}|* [[Shown in Vector only]]}}
