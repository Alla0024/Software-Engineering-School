<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRate()
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        if ($response->successful()) {
            $rate = $response->json()['rates']['UAH'];
            return response()->json(['rate' => $rate], 200);
        } else {
            return response()->json(['error' => 'Unable to fetch rate'], 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 409);
        }

        Subscription::create(['email' => $request->email]);
        return response()->json(['message' => 'E-mail added'], 200);
    }
}
