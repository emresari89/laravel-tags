Laravel Taggable Trait
============

[![Latest Stable Version](https://poser.pugx.org/emresari89/laravel-tags/v/stable.svg)](https://packagist.org/packages/emresari89/laravel-tags)
[![Total Downloads](https://poser.pugx.org/emresari89/laravel-tags/downloads.svg)](https://packagist.org/packages/emresari89/laravel-tags)
[![License](https://poser.pugx.org/emresari89/laravel-tags/license.svg)](https://packagist.org/packages/emresari89/laravel-tags)
[![Build Status](https://travis-ci.org/emresari89/laravel-tags.svg?branch=laravel-8)](https://travis-ci.org/emresari89/laravel-tags)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/emresari89/laravel-tags/badges/quality-score.png?b=laravel-8)](https://scrutinizer-ci.com/g/emresari89/laravel-tags/?branch=laravel-8)

This package is not meant to handle javascript or html in any way. This package handles database storage and read/writes only.

There are no real limits on what characters can be used in a tag. It uses a slug transform to determine if two tags are identical ("sugar-free" and "Sugar Free" would be treated as the same tag). Tag display names are run through Str::title()

```bash
composer require emresari89/laravel-tags
```

#### Install and then Run the migrations

The package should auto-discover when you composer update. Then publish the tagging.php and run the database migrations with these commands.

```bash
php artisan vendor:publish --provider="Emresari\Tagging\Providers\TaggingServiceProvider"
php artisan migrate
```

#### Setup your models
```php
class Article extends \Illuminate\Database\Eloquent\Model
{
	use \Emresari\Tagging\Taggable;
}
```

#### Quick Sample Usage

```php
$article = Article::with('tagged')->first(); // eager load

foreach($article->tags as $tag) {
	echo $tag->name . ' with url slug of ' . $tag->slug;
}

$article->tag('Gardening'); // attach the tag

$article->untag('Cooking'); // remove Cooking tag
$article->untag(); // remove all tags

$article->retag(array('Fruit', 'Fish')); // delete current tags and save new tags

$article->tagNames(); // get array of related tag names

Article::withAnyTag(['Gardening','Cooking'])->get(); // fetch articles with any tag listed

Article::withAllTags(['Gardening', 'Cooking'])->get(); // only fetch articles with all the tags

Article::withoutTags(['Gardening', 'Cooking'])->get(); // only fetch articles without all tags listed

Emresari\Tagging\Model\Tag::where('count', '>', 2)->get(); // return all tags used more than twice

Article::existingTags(); // return collection of all existing tags on any articles
```

[Documentation: More Usage Examples](docs/usage-examples.md)

[Documentation: Tag Groups](docs/tag-groups.md)

[Documentation: Tagging Events](docs/events.md)

[Documentation: Tag Suggesting](docs/suggesting.md)

### Configure

[See config/tagging.php](config/tagging.php) for configuration options.

###### Lumen Installation

[Documentation: Lumen](docs/lumen.md)

#### Credits

 - Emre Sarıoğlu - https://emresarioglu.com.tr

#### Further Reading
 - [Laravel News article on tagging with this library](https://laravel-news.com/how-to-add-tagging-to-your-laravel-app)
 - [3rd Party Posting on installation with Twitter Bootstrap 2.3](http://blog.stickyrice.net/archives/2015/laravel-tags-bootstrap-tags-input-emresari89)
