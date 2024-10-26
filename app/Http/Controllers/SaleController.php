<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Http\Requests\SaleRequest;

class SaleController extends Controller
{
    public function index()
    {
        // Logic to retrieve all sales
    }

    public function store(SaleRequest $request)
    {
        // Logic to store a new sale
    }

    public function show(Sale $sale)
    {
        // Logic to retrieve a specific sale
    }

    public function update(SaleRequest $request, Sale $sale)
    {
        // Logic to update a sale
    }

    public function destroy(Sale $sale)
    {
        // Logic to delete a sale
    }
}

