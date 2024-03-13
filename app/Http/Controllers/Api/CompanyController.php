<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Controllers\Controller;
use DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $company = Company::all();
        return $this->sendResponse(CompanyResource::collection($company), 'Companies retrieve successgully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response('hello world', 500);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        
        DB::beginTransaction();
        try {
            $input = $request->all();
            $company = Company::create($input);

            if ($company) {
                DB::commit();

                return $this->sendResponse(new CompanyResource($company), 'Company saved successfully', 200);


            } else {
                DB::rollBack();

                return $this->sendError(null, 'Failed to save company', 409);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company->id;

        if (is_null($company)) {
            return $this->sendError('Company not found');
        }
        return $this->sendResponse(new CompanyResource($company), 'Company retrieved successfully', 201);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $company->name = $input['name'];
            $company->description = $input['description'];
            $company::update($input);

            DB::commit();

            return $this->sendResponse(new CompanyResource($company), 'Company updated successfully', 202);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function archive(Company $company)
    {
        $company->id;
        $company->delete();
        return response()->json([], 204);
    }
}
