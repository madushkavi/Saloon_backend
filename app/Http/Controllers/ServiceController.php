<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;


class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'serviceType' => 'required',
            'serviceName' => 'required',
            
            'price' => 'required|numeric',
        ]);

        $service = new Service();
        $service->serviceType = $request->input('serviceType');
        $service->serviceName = $request->input('serviceName');
        
        $service->price = $request->input('price');

       
        $service->save();

        return response()->json([
            'message' => 'Service added successfully',
            'service' => $service,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'serviceType' => 'required',
            'serviceName' => 'required',
            'price' => 'required|numeric',
        ]);

        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->serviceType = $request->input('serviceType');
        $service->serviceName = $request->input('serviceName');
    
        $service->price = $request->input('price');

        $service->save();

        return response()->json([
            'message' => 'Service updated successfully',
            'service' => $service,
        ]);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->delete();
    }
}
