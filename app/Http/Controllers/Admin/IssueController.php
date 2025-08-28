<?php
// app/Http/Controllers/Admin/IssueController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Post;
use App\Models\User;
use App\Models\Notification;
use App\Models\IssueReaction;

class IssueController extends Controller
{
    public function index(Request $request)
    {
        $query = Issue::with('user');

        // Apply filters
        if ($request->has('status')) {
            if ($request->status === 'resolved') {
                $query->where('fixed_count', '>', 0);
            } elseif ($request->status === 'pending') {
                $query->where('fixed_count', 0);
            }
        }

        if ($request->has('district')) {
            $query->where('district', $request->district);
        }

        if ($request->has('ward')) {
            $query->where('ward', $request->ward);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('heading', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        $issues = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.issues.index', compact('issues'));
    }

    public function show($id)
    {
        $issue = Issue::with(['user', 'reactions', 'comments.user'])->findOrFail($id);
        return view('admin.issues.show', compact('issue'));
    }

    public function delete($id)
    {
        $issue = Issue::findOrFail($id);

        // Delete related records
        Post::where('issue_id', $id)->delete();
        IssueReaction::where('issue_id', $id)->delete();
        DB::table('issue_comments')->where('issue_id', $id)->delete();

        $issue->delete();

        return redirect()->route('admin.issues.index')->with('success', 'Issue deleted successfully.');
    }

    public function sendNotification(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'target' => 'required|in:all,engaged,verified,district,region,ward',
            'image' => 'nullable|image|max:2048',
        ]);

        $issue = Issue::findOrFail($id);

        // Determine target users
        $users = $this->getTargetUsers($issue, $request->target);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notifications', 'public');
        }

        // Create notifications
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->user_id,
                'author_id' => auth('admin')->id(),
                'author_name' => auth('admin')->user()->name,
                'action' => $request->title,
                'issue_id' => $id,
                'issue_description' => $issue->heading,
                'is_read' => false,
            ]);
        }

        // Here you would also send push notifications or emails

        return redirect()->back()->with('success', 'Notification sent to ' . count($users) . ' users.');
    }

    private function getTargetUsers($issue, $target)
    {
        switch ($target) {
            case 'all':
                return User::all();

            case 'engaged':
                // Users who reacted or commented on the issue
                $userIds = array_merge(
                    IssueReaction::where('issue_id', $issue->id)->pluck('user_id')->toArray(),
                    DB::table('issue_comments')->where('issue_id', $issue->id)->pluck('user_id')->toArray()
                );
                return User::whereIn('user_id', array_unique($userIds))->get();

            case 'verified':
                return User::where('is_verified', 1)->get();

            case 'district':
                return User::where('district', $issue->district)->get();

            case 'ward':
                return User::where('ward', $issue->ward)->get();

            default:
                return collect();
        }
    }
}
