<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasRequest;
use App\Http\Requests\UpdateClasRequest;
use App\Models\Clas;
use Illuminate\Http\RedirectResponse;

class ClasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Clas $clas
     * @return \Illuminate\Http\Response
     */
    public function show(Clas $clas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Clas $clas
     * @return \Illuminate\Http\Response
     */
    public function edit(Clas $clas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClasRequest  $request
     * @param Clas $clas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClasRequest $request, Clas $clas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Clas $clas
     * @return RedirectResponse
     */
    public function destroy(Clas $clas): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_clas'), 403);
        $clas->delete();
        return redirect()->back();
    }
}
