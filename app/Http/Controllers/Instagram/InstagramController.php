<?php

namespace App\Http\Controllers\API\Instagram;

use App\Http\Requests\Instagram\RegisterInstagramAccount;
use App\Services\ControllersService\InstagramService;
use App\Services\Instagram\AccountManager;
use App\Tools\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstagramController extends Controller
{
    private $instagramService;

    public function __construct(InstagramService $instagramService)
    {
        $this->instagramService = $instagramService;
    }

    /**
     * @param AccountManager $accountManager
     * @return mixed
     */
    public function index(AccountManager $accountManager)
    {
    }

    /**
     * @param RegisterInstagramAccount $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterInstagramAccount $request)
    {
        return JsonResponse::successObject($this->instagramService->register($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
