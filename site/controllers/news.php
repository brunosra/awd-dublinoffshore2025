<?php
return function($page) {

    // fetch the basic set of pages
    $articles = page('updates')->children()->listed()->sortBy(function ($page) {
      return $page->published()->toDate();
    })->flip();
  
    // fetch all tags
    $tags = $articles->pluck('tags', ',', true);
  
    // add the tag filter
    if($tag = urldecode(param('tag'))) {
      $articles = $articles->filterBy('tags', $tag, ',');
    }
  
    // apply pagination
    $articles   = $articles->paginate(8);
    $pagination = $articles->pagination();
  
    return compact('articles', 'tags', 'tag', 'pagination');
  
  };
