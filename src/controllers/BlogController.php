<?php

namespace Ukadev\Blogfolio\Controllers;

use Ukadev\Blogfolio\Controllers\AdminController;
use Ukadev\Blogfolio\Helpers;
use Post;
use PostData;
use User;
use Cat;
use CatData;
use Comment;
use View;
use Response;
use URL;
use Language;
use Input;
use Config;
use Request;
use Settings;
use Sentry;
use Validator;

class BlogController extends AdminController {


	var $commentRules =  array(
        'comment' => 'required|min:3'
    );

	/**
	 * Display a listing of the resource.
	 * GET /admin/categories
	 *
	 * @return Response
	 */
	public function indexCategories()
	{

		$cats = Cat::get();
		$langs = Language::where(array('status' => 1))->take(3)->get();
        $this->layout = View::make('blogfolio::blog.categories.index', compact('cats', 'langs'));
        $this->layout->title = trans('Categorias');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.categories');
	}

	/**
	 * Display a listing of the resource.
	 * GET /admin/categories
	 *
	 * @return Response
	 */
	public function indexPosts()
	{

		$posts = Post::get();

		$langs = Language::where(array('status' => 1))->get();

		// Ajax search
        $postId = Input::get('postIdSearch');
        if(!empty($postId))
        {
            $posts = Post::where('id', $catId);
        }
        $catname = Input::get('categoryNameSearch');
        if(!empty($catname))
        {
            $posts = Post::where('name', 'LIKE', '%'.$catname.'%');
        }

        $posts = Post::paginate(Config::get('syntara::config.item-perge-page'));

        // ajax: reload only the content container
        if(Request::ajax())
        {
            $html = View::make('blogfolio::blog.posts.list', array('posts' => $posts))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make('blogfolio::blog.posts.index', compact('posts','langs'));
        $this->layout->title = trans('Posts');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.posts');
	}

	/**
	 * Display a listing of the resource.
	 * GET /admin/categories
	 *
	 * @return Response
	 */
	public function indexComments()
	{

		$comments = Comment::get();


		// Ajax search
        $commentId = Input::get('commentIdSearch');
        if(!empty($commentId))
        {
            $comments = $comments->where('id', $commentId);
        }

        $comments = Comment::paginate(Config::get('syntara::config.item-perge-page'));

        // ajax: reload only the content container
        if(Request::ajax())
        {
            $html = View::make('blogfolio::blog.comments.list', array('comments' => $comments))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make('blogfolio::blog.comments.index', compact('comments'));
        $this->layout->title = trans('Comments');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.comments');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/blog/category/new
	 *
	 * @return Response
	 */
	public function newCategory()
	{
		$langs = Language::where(array('status' => 1))->get();
        $this->layout = View::make('blogfolio::blog.categories.new', compact('langs'));
        $this->layout->title = trans('Categorias');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/blog/posts/new
	 *
	 * @return Response
	 */
	public function newPost()
	{
		$langs = Language::where(array('status' => 1))->get();

		$cats = CatData::where(array('lang' => Settings::get('site_admin_lang')))->get();
        $this->layout = View::make('blogfolio::blog.posts.new', compact('langs', 'cats'));
        $this->layout->title = trans('Posts');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.posts');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/blog/categories/s{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showCategory($id)
	{
		$cat = Cat::find($id);
		$allLang = Language::select('id')->where(array('status' => 1))->get();
		foreach ($allLang as $lang) {
			$allLangs[] = $lang->id;
		}
		$langs = Language::where(array('status' => 1))->get();
		$this->layout = View::make('blogfolio::blog.categories.show', compact('cat', 'langs', 'allLangs'));
        $this->layout->title = trans('Categorias');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.categories');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/blog/posts/s{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showPost($id)
	{
		$post = Post::find($id);
		$cats = CatData::where(array('lang' => Settings::get('site_admin_lang')))->get();
		$langs = Language::where(array('status' => 1))->get();

		$allLang = Language::select('id')->where(array('status' => 1))->get();
		foreach ($allLang as $lang) {
			$allLangs[] = $lang->id;
		}
		$statusLangs = Language::select('id')->where(array('status' => 1))->get();
		foreach ($statusLangs as $actual) {
			$actualLangs[] = $actual->id;
		}
		$this->layout = View::make('blogfolio::blog.posts.show', compact('post', 'langs', 'cats', 'actualLangs', 'allLangs'));
        $this->layout->title = trans('Posts');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.posts');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/blog/comments/s{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showComment($id)
	{
		$comment = Comment::find($id);
		$this->layout = View::make('blogfolio::blog.comments.show', compact('comment'));
        $this->layout->title = trans('Comments');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.comments');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin/blog/posts/new
	 *
	 * @return Response
	 */
	public function storeCategory()
	{
        $cat = new Cat();
        $cat->save();

        $all = Input::all();
        foreach ($all as $key => $value) {
        	if(empty($value)){
    			return Response::json(array('categoryCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
        	$catData = new CatData();
        	$catData->cat_id = $cat->id;
        	$catData->lang = explode('-', $key)[1];
        	$catData->name = $value;
        	$catData->save();
        }

        return Response::json(array('categoryCreated' => true, 'redirectUrl' => URL::route('indexCategories')));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin/blog/posts/new
	 *
	 * @return Response
	 */
	public function storePost()
	{
        $post = new Post();
        $post->user_id = Sentry::getUser()->id;
        $post->status = (bool)Input::get('status');
        $post->tags = Input::get('tags');
        $post->category_id = Input::get('category');

		$langs = Language::where(array('status' => 1))->get();

        $all = Input::all();

        // Validation
		foreach ($all as $key => $value) {
    		if(empty($value)){
    			return Response::json(array('postCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
    	}



    	if($post->save()){
		    foreach ($langs as $lang) {
	        	$postData = new PostData();
	        	$postData->post_id = $post->id;
	        	$postData->lang = $lang->locale;
	        	$postData->content = Input::get($lang->locale.'-content');
	        	$postData->title = Input::get($lang->locale.'-title');
	        	$postData->slug = $this->slug(Input::get($lang->locale.'-title'));

				$post->postData()->save($postData);
			}

	    	return Response::json(array('postCreated' => true, 'redirectUrl' => URL::route('indexPosts')));
	   }else{
	    	return Response::json(array('postCreated' => false, 'message' => 'Error trying to save the current post. Contact the Administrator', 'messageType' => 'danger'));
	    }
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /admin/blog/categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateCategory($id)
	{
		$all = Input::all();
        foreach ($all as $key => $value) {
        	$lang = explode('-', $key)[1];
        	$name = $value;
        	CatData::where(array('cat_id' => $id))->where(array('lang' => $lang))->update(array('name' => $name));
        }

        return Response::json(array('categoryUpdated' => true, 'message' => trans('La categoria se ha actualizado correctamente'), 'messageType' => 'success'));
	}


	/**
	 * Update a newly created resource in storage.
	 * POST /admin/blog/posts/new
	 *
	 * @return Response
	 */
	public function updatePost($id)
	{
		if(!$id){
			return Response::json(array('postUpdated' => false, 'message' => 'Invalid Post', 'messageType' => 'danger'));
		}

        $post = Post::find($id);
        $post->status = (bool)Input::get('status');
        $post->tags = Input::get('tags');
        $post->category_id = Input::get('category');

        $all = Input::all();
        // Validation
		foreach ($all as $key => $value) {
    		if(empty($value)){
    			return Response::json(array('postUpdated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
    	}

	    if($post->save()){

    		if(PostData::where(array('post_id' => $id))->delete()){
				$langs = Language::where(array('status' => 1))->get();
			    foreach ($langs as $lang) {
		        	$postData = new PostData();
		        	$postData->post_id = $id;
		        	$postData->lang = $lang->locale;
		        	$postData->content = (Input::get($lang->locale.'-content')) ? Input::get($lang->locale.'-content') : '';
		        	$postData->title = Input::get($lang->locale.'-title');
		        	$postData->slug =$this->slug(Input::get($lang->locale.'-title'));

					$post->postData()->save($postData);
				}

		    	return Response::json(array('postUpdated' => true, 'redirectUrl' => URL::route('indexPosts'), 'messageType' => 'success'));
			}
	    }else{
	    	return Response::json(array('postUpdated' => false, 'message' => 'Error trying to save the current post. Contact the Administrator', 'messageType' => 'danger'));
	    }
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin/blog/comments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateComment($id)
	{
		$validation = Validator::make(Input::all(), $this->commentRules);
		if($validation->fails()){
			return Response::json(array('commentUpdated' => false, 'message' => trans('All the fields are required'), 'messageType' => 'error'));
		}

		$comment = Comment::find($id);

        $comment->where(array('id' => $id))->update(array('comment' => Input::get('comment'), 'approved' => (bool)Input::get('approved')));

        return Response::json(array('commentUpdated' => true, 'message' => trans('El comentario se ha actualizado correctamente'), 'messageType' => 'success'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/blog/categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteCategory($id)
	{
		if(!$id){
			return Response::json(array('categoryDeleted' => false, 'errorMessages' =>'Invalid category', 'messageType' => 'error'));
		}
        if(!Cat::find($id)->delete())
        {
            return Response::json(array('categoryDeleted' => false, 'errorMessages' =>'Error al borrar la categoria', 'messageType' => 'error'));
        }

        return Response::json(array('categoryDeleted' => true, 'message' => trans('La categoria se ha borrado correctamente'), 'messageType' => 'success'));
	}


	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/blog/categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deletePost($id)
	{
		if(!$id){
			return Response::json(array('postDeleted' => false, 'errorMessages' =>'Invalid Post', 'messageType' => 'error'));
		}
        if(!Post::find($id)->delete())
        {
            return Response::json(array('postDeleted' => false, 'errorMessages' =>'Error al borrar el post', 'messageType' => 'error'));
        }

        return Response::json(array('postDeleted' => true, 'message' => trans('El post se ha borrado correctamente'), 'messageType' => 'success'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/blog/comments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deletecomment($id)
	{
		if(!$id){
			return Response::json(array('commentDeleted' => false, 'errorMessages' =>'Invalid Comment', 'messageType' => 'error'));
		}
        if(!Comment::find($id)->delete())
        {
            return Response::json(array('commentDeleted' => false, 'errorMessages' =>'Error al borrar el comentario', 'messageType' => 'error'));
        }

        return Response::json(array('commentDeleted' => true, 'message' => trans('El comentario se ha borrado correctamente'), 'messageType' => 'success'));
	}


	public static function slug($text)
	{
		$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);

        // trim
        $text = trim($text, '-');
        setlocale(LC_CTYPE, 'en_GB.utf8');
        // transliterate
        if (function_exists('iconv')) {
           $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w.]+~', '', $text);
        if (empty($text)) {
           return 'empty_$';
        }

        return $text;
	}

}