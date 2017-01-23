<?php namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\Comment;
use Modules\Admin\Models\Post;
use Modules\Admin\Models\PostTranslation;
use Illuminate\Support\Facades\Request;

class CommentController extends AdminController {
	
	public function getComment()
	{
		$post = [];
		if(\Request('p') != NULL && \Request('type') != NULL) {
			if (\Request('type') == 'post' && intval(\Request('p'))) {
				$post = Post::find(intval(\Request('p')));
			}
		}

		return view('admin::sections.comments.index', compact('post'));
	}

	public function ChangeCommentStatus($comment_id)
	{
		$comment = Comment::find($comment_id);

		if(count($comment) > 0) {
			$comment->comment_approved = $comment->comment_approved == 0 ? 1 : 0;
			$comment->save();
		}

		return back();
	}

	public function getCommentData()
	{


		$comments = Comment::join('users', 'users.id', '=', 'comments.comment_author')
							->where(function($query){

								if(\Request::get('p') != NULL ) {
									$query->where('comments.obj_id', intval(\Request::get('p')));
								}
								
								if(\Request::get('type') != NULL ) {
									$query->where('comments.obj_type', \Request::get('type'));
								}
								
							})
		                   ->select([
							   'comments.id as id',
							   'comments.obj_id as obj_id',
							   'comments.obj_type as obj_type',
							   'comments.comment_approved as comment_approved',
							   'comments.comment_author as comment_author',
							   'comments.comment_content as comment_content',
							   'comments.created_at as created_at',
							   'users.name as name',
							   'users.email as email',
						   ]);

		$datatables =  app('datatables')->of($comments);

		$datatables ->editColumn('comment_author', function ($comment) {

			return '<a href="'. route('admin.users.edit.get' , $comment->comment_author) .'">'. $comment->name . '<br>' . $comment->email . '</a>';
		});

		$datatables ->editColumn('comment_content', function ($comment) {
			$label_class = 'label-warning';
			$label_title = 'Approve';
			if($comment->comment_approved == 1) {
				$label_class = 'label-info';
				$label_title = 'UnApprove';
			}
			return '<small>' . $comment->comment_content . '<br><a  href="'.route('admin.comments.statusChange.get', $comment->id).'" class="changeCommentStatus ' . $label_class . '">' . $label_title . '</a></small>';
		});

		$datatables ->editColumn('obj_id', function ($comment)  {
			$return = '';
			if ($comment->obj_type == 'post'){
				$post = Post::find($comment->obj_id);
				$return = '<a href="' . route('admin.posts.edit.get', [$comment->obj_id, 'post_type=post']) . '">' . $post->post_title . '</a>';
			}
			$unapproved_comment = Comment::where('obj_id', $comment->obj_id)
				                         ->where('obj_type', $comment->obj_type)
				                         ->where('comment_approved', 0)
				                         ->count();

			if($unapproved_comment > 0) {
				$return .= '<br><a href="'. route('admin.comments.get', ['p' => $comment->obj_id, 'type' => $comment->obj_type]) .'"><span class="badge badge-danger"> ' . $unapproved_comment . ' </span></a>';
			}

			return $return;
		});

		
		$datatables ->addColumn('created_at', function ($comment) {
			return $comment->created_at->format('Y-m-d');
		});
		

		return  $datatables->make(true);
	}

}