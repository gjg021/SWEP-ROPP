<?php
namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class ShippingPermitController extends Controller
{
    
    public function index()
    {
        return view('admin.shipping-permit.index');
    }


    public function userIndex()
    {
        return view('dashboard.shipping-permit.my-shipping-permits');
    }

    public function userShowApply(){
        return view('dashboard.shipping-permit.apply');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
