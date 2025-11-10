<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TodoController extends Controller
{
    /**
     * 一覧画面を表示。
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $sortOptions = [
            'due_date' => '期限日順',
            'created_at' => '作成日順',
            'status' => '状態順',
            'priority' => '優先度順',
        ];
        $sort = $request->input('sort', 'due_date');
        if (! array_key_exists($sort, $sortOptions)) {
            $sort = 'due_date';
        }

        $direction = $request->input('direction', 'asc');
        if (! in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'asc';
        }

        $secondaryDirection = $direction === 'asc' ? 'asc' : 'desc';

        $query = Task::ownedBy($user);

        match ($sort) {
            'created_at' => $query->orderBy('created_at', $direction),
            'status' => $query->orderBy('is_completed', $direction)->orderBy('updated_at', $secondaryDirection),
            'priority' => $query->orderBy('priority', $direction)->orderBy('created_at', $secondaryDirection),
            default => $query->orderBy('due_date', $direction)->orderBy('created_at', $secondaryDirection),
        };

        $tasks = $query->get();

        $nextDirection = $direction === 'asc' ? 'desc' : 'asc';

        return view('index', [
            'tasks' => $tasks,
            'sort' => $sort,
            'sortOptions' => $sortOptions,
            'direction' => $direction,
            'nextDirection' => $nextDirection,
        ]);
    }

    /**
     * タスクを新規作成。
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:2000'],
            'due_date' => ['nullable', 'date'],
            'priority' => ['nullable', 'integer', 'min:0', 'max:5'],
        ]);

        Task::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'priority' => $validated['priority'] ?? 0,
            'is_completed' => false,
        ]);

        return redirect()->route('todos.index')->with('status', 'タスクを追加しました。');
    }

    /**
     * タスクを更新。
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorizeTask($task);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:2000'],
            'due_date' => ['nullable', 'date'],
            'priority' => ['nullable', 'integer', 'min:0', 'max:5'],
        ]);

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'priority' => $validated['priority'] ?? 0,
        ]);

        return redirect()->route('todos.index')->with('status', 'タスクを更新しました。');
    }

    /**
     * タスクを削除。
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->authorizeTask($task);
        $task->delete();

        return redirect()->route('todos.index')->with('status', 'タスクを削除しました。');
    }

    /**
     * 完了状態をトグル。
     */
    public function complete(Task $task): RedirectResponse
    {
        $this->authorizeTask($task);

        $completed = ! $task->is_completed;
        $task->update([
            'is_completed' => $completed,
            'completed_at' => $completed ? now() : null,
        ]);

        return redirect()->route('todos.index')->with('status', '完了状態を更新しました。');
    }

    /**
     * 自分のタスクであることを担保。
     */
    private function authorizeTask(Task $task): void
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
