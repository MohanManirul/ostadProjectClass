<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\StoreApartmentRequest;
use App\Http\Resources\Apartment\ApartmentCollection;
use App\Jobs\SendApartmentCreatedEmailJob;
use App\Jobs\SendSingleApartmentNotificationJob;
use App\Models\Apartment;
use App\Models\Tenant;
use Exception;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Throwable;

class ApartmentController extends Controller
{

    public function index(Request $request)
    { 
        try{
            $apartments = Apartment::with('currentBooking.tenant')->get();

            return response()->json([
                'message' => 'Apartments retrieved successfully',
                'data' => new ApartmentCollection($apartments),
            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
        
    }

    public function create()
        {
            return view('backend.create') ;
        }
 
    public function store(StoreApartmentRequest $request)
    {

        $validatedData = $request->validated();
        try{
            $imagePath = null;
            if ($request->hasFile('image')){
                $imagePath = $request->file('image')->store('apartment','public');
            }
            $apartment = Apartment::create([
                'name' => $validatedData['name'],
                'rent' => $validatedData['rent'],
                'status' => $validatedData['status'],
                'descriptions' => $validatedData['descriptions'],
                'image' => $imagePath
            ]);

            // SendApartmentCreatedEmailJob::dispatch($apartment)->delay(now()->addMinutes(2));
            $tenants = Tenant::all(); // যে সকল Tenant কে notify করতে হবে
            $jobs = [];

            foreach ($tenants as $tenant) {
            $jobs[] = (new SendSingleApartmentNotificationJob($apartment, $tenant))
                        ->delay(now()->addMinutes(1)); // queue delay
                }
                
             // Batch dispatch
        Bus::batch($jobs)
            ->then(function (Batch $batch) {
                \Log::info('All notifications sent successfully!');
            })
            ->catch(function (Batch $batch, Throwable $e) {
                \Log::error('Some notifications failed: '.$e->getMessage());
            })
            ->finally(function (Batch $batch) {
                \Log::info('Notification batch finished!');
            })
            ->dispatch();

            return response()->json([
                'message' => 'Apartment created and notification batch started!',
                'data' => $apartment
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'Apartment creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
  
    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);

        // API response
        return response()->json([
            'success' => true,
            'data' => $apartment
        ]);
    }

    public function update(StoreApartmentRequest $request, $id)
    {
        $validatedData = $request->validated();

        try {
            $apartment = Apartment::findOrFail($id);

            // Update basic fields
            $apartment->name = $validatedData['name'];
            $apartment->rent = $validatedData['rent'];
            $apartment->status = $validatedData['status'];
            $apartment->descriptions = $validatedData['descriptions'];

            // Image handling
            if ($request->hasFile('image')) {
                // Old image delete
                if ($apartment->image) {
                    \Storage::disk('public')->delete($apartment->image);
                }

                // Save new image
                $apartment->image = $request->file('image')->store('apartment', 'public');
            }

            $apartment->save();

            return response()->json([
                'message' => 'Apartment updated successfully',
                'data' => $apartment
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Apartment update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);

        // Delete image if exists
        if($apartment->image && \Storage::disk('public')->exists($apartment->image)){
            \Storage::disk('public')->delete($apartment->image);
        }

        $apartment->delete();

        return response()->json([
            'message' => 'Apartment deleted successfully'
        ], 200);
    }


}
