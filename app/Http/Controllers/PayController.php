<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Mpay;

class PayController extends Controller
{
    private $baseUrl = 'https://sandbox.safaricom.co.ke'; // Use 'https://api.safaricom.co.ke' for production

    /**
     * Generate an OAuth token
     */
    private function generateAccessToken()
    {
        $consumerKey = env('io70lmkoSHUJRMiJlWoPKfGVv7muIxshTWqFjixQ8Qk5c5gL');
        $consumerSecret = env('E5ipHzUCC83HvAWtU5QCADFmHp76YjsT7b68qd4S2VQ1UBDKa8WaEsmh4oR08foY');
        $credentials = base64_encode($consumerKey . ':' . $consumerSecret);

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials,
        ])->get($this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials');

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception('Unable to generate M-Pesa access token.');
    }

    /**
     * Register URLs with Safaricom
     */
    public function RegisterUrl()
    {
        try {
            $accessToken = $this->generateAccessToken();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/mpesa/c2b/v1/registerurl', [
                'ShortCode' => env('174379'),
                'ResponseType' => 'Completed',
                'ConfirmationURL' => route('mlipa.confirmation'),
                'ValidationURL' => route('mlipa.validation'),
            ]);

            if ($response->successful()) {
                return response()->json(['message' => 'URLs registered successfully!', 'data' => $response->json()]);
            }

            return response()->json(['error' => 'Failed to register URLs', 'details' => $response->json()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Handle M-Pesa Validation
     */
    public function ValidationUrl(Request $request)
    {
        Log::info('Validation request received:', $request->all());
        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Validation passed']);
    }

    /**
     * Handle M-Pesa Confirmation
     */
    public function ConfirmationUrl(Request $request)
    {
        Log::info('Confirmation request received:', $request->all());

        // Save transaction details to the database
        $transactionData = $request->all();
  //extract item values from the Json mpesaresultset
        $mpayData = [
            'transaction_id' => $transactionData['TransID'] ?? null,
            'phone_number' => $transactionData['MSISDN'] ?? null,
            'amount' => $transactionData['TransAmount'] ?? null,
            'transaction_date' => now(),
            'confirmationId_code' => $transactionData['BillRefNumber'] ?? null,
            'description' => 'Payment Confirmation',
        ];

        if ($mpayData['transaction_id'] && $mpayData['phone_number'] && $mpayData['amount']) {
            Mpay::create($mpayData);

            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Confirmation received successfully']);
        }

        return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Invalid confirmation data']);
    }

    /**
     * Handle M-Pesa Callback
     */
    public function CallbackUrl(Request $request)
    {
        Log::info('M-Pesa Callback received:', $request->all());

        $callbackData = $request->all();

        if (isset($callbackData['Body']['stkCallback']['ResultCode'])) {
            $resultCode = $callbackData['Body']['stkCallback']['ResultCode'];
            $metadata = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'] ?? [];

            if ($resultCode == 0) { // Success
                $amount = collect($metadata)->where('Name', 'Amount')->pluck('Value')->first();
                $receipt = collect($metadata)->where('Name', 'MpesaReceiptNumber')->pluck('Value')->first();
                $phone = collect($metadata)->where('Name', 'PhoneNumber')->pluck('Value')->first();

                // Save the payment in the database
                Mpay::create([
                    'transaction_id' => $receipt,
                    'phone_number' => $phone,
                    'amount' => $amount,
                    'transaction_date' => now(),
                    'description' => 'Mpesa Rent Payment',
                ]);

                return response()->json(['message' => 'Payment processed successfully!'], 200);
            }

            return response()->json(['error' => 'Payment failed or canceled'], 400);
        }

        return response()->json(['error' => 'Invalid callback data'], 400);
    }

    /**
     * Initiate the M-Pesa payment
     */
    public function InitiateMpay(Request $request)
    {


        // Get data from the request
        $phone = $request->phone;
        $amount = $request->amount;
        $roomNumber = $request->room_number;
        $tenantName = $request->tenant_name;

        // Make the payment request to M-Pesa using Safaricom's API
        try {
            // Generate an access token
            $accessToken = $this->generateAccessToken();

            // Make a request to initiate the payment (using the STK Push API)
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', [
                'Shortcode' => env('174379'),
                'LipaNaMpesaOnlineShortcode' => env('174379'),
                'LipaNaMpesaOnlineShortcodeShortcode' => env('174379'),
                'PhoneNumber' => $phone,
                'Amount' => $amount,
                'RoomNumber' => $roomNumber,
                'TenantName' => $tenantName,
            ]);

            return response()->json(['success' => true, 'message' => 'Payment initiation successful!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    /**
     * Fetch Tenant Payments
     *
     * @param int $tenantId
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchTenantPayments($tenantId)
    {
        $payments = Mpay::forTenant($tenantId)->get();

        if ($payments->isEmpty()) {
            return response()->json(['message' => 'No payments found for this tenant.'], 404);
        }

        return response()->json(['data' => $payments]);
    }

    /**
     * Fetch All Payments
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchAllPayments()
    {
        $payments = Mpay::all();

        return response()->json(['data' => $payments]);
    }
}
