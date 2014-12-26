<?php

use Illuminate\Support\Facades\View;

class RegisterController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /home/register
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('home.register');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /home/register/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /home/register
	 *
	 * @return Response
	 */
	public function store()
	{
		return View::make('home.register');
	}

	/**
	 * Display the specified resource.
	 * GET /home/register/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /home/register/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /home/register/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /home/register/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}