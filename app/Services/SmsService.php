<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
   protected $username;
   protected $apiKey;
   protected $senderId;
   protected $baseUrl;

   public function __construct()
   {
       $this->username = config('services.africastalking.username');
       $this->apiKey = config('services.africastalking.api_key');
       $this->senderId = config('services.africastalking.sender_id', 'GHA');
       $this->baseUrl = 'https://api.africastalking.com/version1/messaging';
   }

   /**
    * Send a single SMS
    */
   public function send($recipient, $message, $options = [])
   {
       $payload = [
           'username' => $this->username,
           'to' => $recipient,
           'message' => $message,
           'from' => $this->senderId,
       ];

       try {
           $response = Http::withHeaders([
               'Accept' => 'application/json',
               'apikey' => $this->apiKey,
           ])->post($this->baseUrl, $payload);

           $result = $response->json();

           if ($response->successful() &&isset($result['SMSMessageData']['Recipients'][0]['status']) && $result['SMSMessageData']['Recipients'][0]['status'] == 'Success') {
               return [
                   'success' => true,
                   'messageId' => $result['SMSMessageData']['MessageId'] ?? null,
                   'data' => $result,
               ];
           }

           Log::error('SMS send failed', ['response' => $result, 'recipient' => $recipient]);
           return ['success' => false, 'error' => $result['SMSMessageData']['Recipients'][0]['status'] ?? 'Unknown error'];
       } catch (\Exception$e) {
           Log::error('SMS exception', ['error' => $e->getMessage()]);
           return ['success' => false, 'error' => $e->getMessage()];
       }
   }

   /**
    * Send bulk SMS to multiple recipients
    */
   public function sendBulk(array $recipients, $message)
   {
       $results = [];
       foreach ($recipients as $recipient) {
           $results[] =$this->send($recipient, $message);
       }
       return $results;
   }

   /**
    * Fetch message delivery status
    */
   public function getDeliveryStatus($messageId)
   {
       $url = "https://api.africastalking.com/version1/messaging";

       try {
           $response = Http::withHeaders(['apikey' => $this->apiKey])
               ->get($url, ['username' => $this->username, 'messageId' => $messageId]);

           return $response->json();
       } catch (\Exception$e) {
           Log::error('SMS status check failed', ['error' => $e->getMessage()]);
           return null;
       }
   }
}
