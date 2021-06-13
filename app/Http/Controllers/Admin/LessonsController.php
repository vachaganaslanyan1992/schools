<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lessons\DeleteRequest;
use App\Http\Requests\Lessons\StoreRequest;
use App\Http\Requests\Lessons\UpdateRequest;
use App\Models\Lesson\Lesson;
use App\Models\SchoolClass\SchoolClass;
use Symfony\Component\HttpFoundation\Response;

class LessonsController extends Controller
{

    /**
     * Function to get all data
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lessons = Lesson::all();
        return view('admin.lessons.index', compact('lessons'));
    }

    /**
     * Function to create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $classes = SchoolClass::all()->pluck('name', 'id');

        $teachers = User::all()->pluck('name', 'id');

        return view('admin.lessons.create', compact('classes', 'teachers'));

    }

    /**
     * Function to store
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {

        $lesson = Lesson::create($request->all());

        return redirect()->route('admin.lessons.index');

    }

    /**
     * Function to edit
     * @param Lesson $lesson
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Lesson $lesson)
    {

        $classes = SchoolClass::all()->pluck('name', 'id');

        $teachers = User::all()->pluck('name', 'id');

        $lesson->load('class', 'teacher');

        return view('admin.lessons.edit', compact('classes', 'teachers', 'lesson'));

    }

    /**
     * Function to update
     * @param UpdateRequest $request
     * @param Lesson $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Lesson $lesson)
    {

        $lesson->update($request->all());

        return redirect()->route('admin.lessons.index');

    }

    /**
     * Functio to show
     * @param Lesson $lesson
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Lesson $lesson)
    {

        $lesson->load('class', 'teacher');

        return view('admin.lessons.show', compact('lesson'));

    }

    /**
     * Function to destroy
     * @param Lesson $lesson
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Lesson $lesson)
    {

        $lesson->delete();

        return back();

    }

    /**
     * Function to delete selected items
     * @param DeleteRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function massDestroy(DeleteRequest $request)
    {

        Lesson::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
