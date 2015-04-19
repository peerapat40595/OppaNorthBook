<?php

class ShowPostController extends \BaseController {

	public function getIndex(){
		$posts = Post::orderBy('created_at', 'DESC')->paginate(10);
		$posts->setBaseUrl('secrettips');
        return View::make('tips.index')->with('posts', $posts);
	}

	public function getTip($id)
	{
		$post = Post::find($id);

		$date = $post->created_at;
		//setlocale(LC_TIME, 'America/New_York');
		$date = $date->formatlocalized('%A %d %B %Y');

        return View::make('tips.show')->with('post', $post)->with('date', $date);
	}

}