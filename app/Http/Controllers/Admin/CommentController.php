<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class CommentController extends Controller
{
    /**
     * 评论列表
     *
     * @param Comment $commentModel
     * @return mixed
     */
    public function index(Request $request)
    {
        $wd = $request->input('wd');
        $data = Comment::with([
                'article' => function ($query) {
                    return $query->select('id', 'title');
                },
                'oauthUser' => function ($query) {
                    return $query->select('id', 'name');
                }
            ])
            ->when($wd, function ($query) use ($wd) {
                return $query->where('content', 'like', "%$wd%");
            })
            ->orderBy('comments.created_at', 'desc')
            ->withTrashed()
            ->paginate(15);
        $assign = compact('data');
        return view('admin.comment.index', $assign);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Comment $commentModel)
    {
        $map = [
            'id' => $id
        ];
        $result = $commentModel->destroyData($map);
        if ($result) {
            // 更新缓存
            Cache::forget('common:newComment');
        }
        return redirect()->back();
    }

    /**
     * 恢复删除的评论
     *
     * @param         $id
     * @param Comment $commentModel
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore($id, Comment $commentModel)
    {
        $map = [
            'id' => $id
        ];
        $result = $commentModel->restoreData($map);
        if ($result) {
            // 更新缓存
            Cache::forget('common:newComment');
        }
        return redirect()->back();
    }

    /**
     * 彻底删除评论
     *
     * @param         $id
     * @param Comment $commentModel
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function forceDelete($id, Comment $commentModel)
    {
        $map = compact('id');
        $commentModel->forceDeleteData($map);
        return redirect()->back();
    }
}
