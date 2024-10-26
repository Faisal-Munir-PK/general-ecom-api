<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    private $response;

    public function __construct()
    {
        $this->response = config('response');
    }

    public function index() {
        return Company::whereIsActive(true)->orderBy('created_at', 'desc')->get();
    }

    public function defaultAddress(Company $company) {
        try {
            return $company->addresses()->map(function ($address) {
                if($address->is_default == true)
                    return $address;
            });
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function addresses(Company $company) {
        return $company->addresses;
    }

    public function store(CompanyRequest $request) {
        Company::create($request->all());
        return response()->json('Company added');
    }

    public function update(Company $company, CompanyRequest $request) {
        $company->update($request->all());
        return response()->json('Company updated');
    }

    public function destroy(Company $company) {
        $company->is_active == true ? $company->update(['is_active' => false]) : $company->update(['is_active' => true]);
        return response()->json('Success');
    }

    public function show(Company $company) {
        return $company;
    }
}