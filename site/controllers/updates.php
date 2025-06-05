<?php
return function($page) {

    // fetch the basic set of pages
    $posts = page('updates')->children()->listed()->sortBy(function ($page) {
      return $page->published()->toDate();
    })->flip();
  
    // fetch all tags
    $tags = $posts->pluck('tags', ',', true);
  
    // add the tag filter
    if($tag = param('tag')) {
        $posts = $posts->filterBy('tags', $tag, ',');
    }
  
    // apply pagination
    $posts = $posts->paginate(8);
    $pagination = $posts->pagination();
  
    return compact('posts', 'tags', 'tag', 'pagination');
  
  };