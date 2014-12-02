<?php


use MrJuliuss\Syntara\Controllers\BaseController;

class BlogController extends \BaseController {


	var $commentRules =  array(
        'comment' => 'required|min:3'
    );

	/**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Category Model
     * @var Cat
     */
    protected $category;

    /**
     * Comment Model
     * @var comment
     */
    protected $comment;


    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     * @param Cat $category
     */
    public function __construct(Post $post, User $user, Cat $category, Comment $comment)
    {
        $this->post = $post;
        $this->cat = $category;
        $this->user = $user;
        $this->comment = $comment;
    }

	/**
	 * Display a listing of the resource.
	 * GET /admin/categories
	 *
	 * @return Response
	 */
	public function indexCategories()
	{

		$cats = Cat::get();
		$lang = new Language();
		$langs = $lang->where(array('active' => 1))->take(3)->get();
        $this->layout = View::make('admin.blog.categories.index', compact('cats', 'langs'));
        $this->layout->title = trans('Categorias');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.categories');
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

		$lang = new Language();
		$langs = Language::where(array('active' => 1))->get();

		// Ajax search
        $postId = Input::get('postIdSearch');
        if(!empty($postId))
        {
            $posts = $posts->where('id', $catId);
        }
        $catname = Input::get('categoryNameSearch');
        if(!empty($catname))
        {
            $posts = $posts->where('name', 'LIKE', '%'.$catname.'%');
        }

        $posts = Post::paginate(Config::get('syntara::config.item-perge-page'));

        // ajax: reload only the content container
        if(Request::ajax())
        {
            $html = View::make('admin.blog.posts.list', array('posts' => $posts))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make('admin.blog.posts.index', compact('posts','langs'));
        $this->layout->title = trans('Posts');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.posts');
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
            $html = View::make('admin.blog.comments.list', array('comments' => $comments))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make('admin.blog.comments.index', compact('comments'));
        $this->layout->title = trans('Comments');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.comments');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/blog/category/new
	 *
	 * @return Response
	 */
	public function newCategory()
	{
		$lang = new Language();
		$langs = $lang->where(array('active' => 1))->get();
        $this->layout = View::make('admin.blog.categories.new', compact('langs'));
        $this->layout->title = trans('Categorias');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/blog/posts/new
	 *
	 * @return Response
	 */
	public function newPost()
	{
		$lang = new Language();
		$cats = CatData::where(array('lang_id' => Settings::get('site_admin_lang')))->get();
		$langs = Language::where(array('active' => 1))->get();
        $this->layout = View::make('admin.blog.posts.new', compact('langs', 'cats'));
        $this->layout->title = trans('Posts');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.posts');
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
		$cat = $this->cat->find($id);
		$lang = new Language();
		$langs = $lang->where(array('active' => 1))->get();
		$this->layout = View::make('admin.blog.categories.show', compact('cat', 'langs'));
        $this->layout->title = trans('Categorias');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.categories');
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
		$post = $this->post->find($id);
		$cats = CatData::where(array('lang_id' => Settings::get('site_admin_lang')))->get();
		$lang = new Language();
		$langs = $lang->where(array('active' => 1))->get();
		$this->layout = View::make('admin.blog.posts.show', compact('post', 'langs', 'cats'));
        $this->layout->title = trans('Posts');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.posts');
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
		$comment = $this->comment->find($id);
		$this->layout = View::make('admin.blog.comments.show', compact('comment'));
        $this->layout->title = trans('Comments');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.comments');
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
        	$catData->lang_id = explode('-', $key)[1];
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
        $post->active = (bool)Input::get('active');
        $post->tags = Input::get('tags');
        $post->category_id = Input::get('category');

        $lang = new Language();
		$langs = $lang->where(array('active' => 1))->get();

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
	        	$postData->lang_id = $lang->id;
	        	$postData->content = Input::get($lang->locale.'-content');
	        	$postData->title = Input::get($lang->locale.'-title');
	        	$postData->slug = Slug::generate(Input::get($lang->locale.'-title'));

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
        	$catData = new CatData();
        	$lang_id = explode('-', $key)[1];
        	$name = $value;
        	$catData->where(array('cat_id' => $id))->where(array('lang_id' => $lang_id))->update(array('name' => $name));
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
        $post->active = (bool)Input::get('active');
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
				$langs = Language::where(array('active' => 1))->get();
			    foreach ($langs as $lang) {
		        	$postData = new PostData();
		        	$postData->post_id = $id;
		        	$postData->lang_id = $lang->id;
		        	$postData->content = Input::get($lang->locale.'-content');
		        	$postData->title = Input::get($lang->locale.'-title');
		        	$postData->slug = Slug::generate(Input::get($lang->locale.'-title'));

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
        if(!$this->cat->find($id)->delete())
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
        if(!$this->post->find($id)->delete())
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
        if(!$this->comment->find($id)->delete())
        {
            return Response::json(array('commentDeleted' => false, 'errorMessages' =>'Error al borrar el comentario', 'messageType' => 'error'));
        }

        return Response::json(array('commentDeleted' => true, 'message' => trans('El comentario se ha borrado correctamente'), 'messageType' => 'success'));
	}

}