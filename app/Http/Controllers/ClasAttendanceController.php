<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasAttendanceRequest;
use App\Http\Requests\UpdateClasAttendanceRequest;
use App\Models\ClasAttendance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ClasAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreClasAttendanceRequest $request
     * @return Response
     */
    public function store(StoreClasAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param ClasAttendance $clasAttendance
     * @return Response
     */
    public function show(ClasAttendance $clasAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClasAttendance $clasAttendance
     * @return Response
     */
    public function edit(ClasAttendance $clasAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateClasAttendanceRequest $request
     * @param ClasAttendance $clasAttendance
     * @return Response
     */
    public function update(UpdateClasAttendanceRequest $request, ClasAttendance $clasAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClasAttendance $clasAttendance
     * @return RedirectResponse
     */
    public function destroy(ClasAttendance $clasAttendance): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_clas_attendance'), 403);
        $clasAttendance->delete();
        return redirect()->back();
    }
}
