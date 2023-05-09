<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vacancy;
use App\Http\Requests\VacancyRequest;

class VacancyController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:vacancy-list|vacancy-create|vacancy-edit|vacancy-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:vacancy-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:vacancy-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:vacancy-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::all();
        return view('admin.vacancies.index', compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vacancies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VacancyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacancyRequest $request)
    {
        $vacancy = new Vacancy();
        $vacancy->name = $request->input('name');
        $vacancy->description = $request->input('description');
        $vacancy->content = $request->input('content');
        $vacancy->is_active = $request->input('is_active');
        $vacancy->published_at = $request->input('published_at');
        $vacancy->save();
        processSingleMedia($vacancy, 'image', 'image', $request);
        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacancy $vacancy)
    {
        return view('admin.vacancies.edit', compact('vacancy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VacancyRequest  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(VacancyRequest $request, Vacancy $vacancy)
    {
        $vacancy->name = $request->input('name');
        $vacancy->description = $request->input('description');
        $vacancy->content = $request->input('content');
        $vacancy->is_active = $request->input('is_active');
        $vacancy->published_at = $request->input('published_at');
        $vacancy->save();
        processSingleMedia($vacancy, 'image', 'image', $request);
        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy deleted.');
    }

}
