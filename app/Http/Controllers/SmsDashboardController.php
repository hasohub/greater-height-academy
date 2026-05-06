<?php

namespace App\Http\Controllers;

use App\Models\SmsMessage;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SmsDashboardController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }

   /**
    * SMS Dashboard — compose and quick send
    */
   public function index()
   {
       // Get recent SMS history
       $recentMessages = SmsMessage::orderBy('created_at', 'desc')
                                    ->limit(20)
                                    ->get();

       // Group SMS by recipient (for quick select)
       $students = \App\Models\StudentRecord::with('user')->get();
       $teachers = \App\Models\TeacherRecord::with('user')->get();
       $parents = \App\Models\ParentRecord::with('user')->get();

       return view('sms.dashboard', compact('recentMessages', 'students', 'teachers', 'parents'));
   }

   /**
    * Send SMS (single or bulk)
    */
   public function send(Request $request)
   {
       $validated = $request->validate([
           'recipients' => 'required|array',
           'recipients.*' => 'string',
           'message' => 'required|string|max:160',
           'type' => ['required', Rule::in(['general', 'attendance', 'fees', 'exam', 'notice'])],
       ]);

       $smsService = new SmsService();
       $recipients = $validated['recipients'];
       $message = $validated['message'];
       $type = $validated['type'];

       $successCount = 0;
       $failedCount = 0;

       foreach ($recipients as $recipient) {
           $result = $smsService->send($recipient, $message);

           // Save to DB
           SmsMessage::create([
               'recipient' => $recipient,
               'message' => $message,
               'sender_id' => config('services.africastalking.sender_id', 'GHA'),
               'message_id' => $result['messageId'] ?? null,
               'status' => $result['success'] ? 'sent' : 'failed',
               'type' => $type,
               'sender_id_user' => Auth::id(),
               'metadata' => [
                   'provider_response' => $result,
               ],
           ]);

           if ($result['success']) {
               $successCount++;
           } else {
               $failedCount++;
           }

           // Small delay to avoid hitting rate limit
           usleep(200000); // 0.2 second
       }

       return back()->with('success', "SMS sent! {$successCount} delivered, {$failedCount} failed.");
   }

   /**
    * SMS history page
    */
   public function history(Request $request)
   {
       $query = SmsMessage::with('sender')->orderBy('created_at', 'desc');

       // Filter by type
       if ($request->has('type') && $request->type) {
           $query->where('type', $request->type);
       }

       // Filter by status
       if ($request->has('status') && $request->status) {
           $query->where('status', $request->status);
       }

       // Date range
       if ($request->has('from') && $request->from) {
           $query->whereDate('created_at', '>=', $request->from);
       }
       if ($request->has('to') && $request->to) {
           $query->whereDate('created_at', '<=', $request->to);
       }

       $messages = $query->paginate(50);

       return view('sms.history', compact('messages'));
   }

   /**
    * Destroy SMS record
    */
   public function destroy(SmsMessage $sms)
   {
       $sms->delete();
       return back()->with('success', 'SMS record deleted.');
   }

   /**
    * SMS templates page
    */
   public function templates()
   {
       // Predefined templates for common messages
       $templates = [
           'attendance_alert' => [
               'title' => 'Attendance Alert',
               'body' => "Dear Parent,\n\nThis is to inform you that your child {{student_name}} was absent/absenteee on {{date}}.\n\nPlease ensure regular attendance.\n\nGreater Height Academy",
           ],
           'fee_reminder' => [
               'title' => 'Fee Reminder',
               'body' => "Dear Parent,\n\nThis is a gentle reminder that the fee payment of \${{amount}} for {{term}} is due by {{due_date}}.\n\nPlease make payment to avoid late fees.\n\nGreater Height Academy",
           ],
           'exam_notification' => [
               'title' => 'Exam Notification',
               'body' => "Dear Student,\n\nYour {{exam_name}} is scheduled for {{date}} at {{time}} in {{venue}}.\n\nPlease be prepared.\n\nGreater Height Academy",
           ],
           'welcome_message' => [
               'title' => 'Welcome to Greater Height Academy!',
               'body' => "Welcome to Greater Height Academy! We are thrilled to have you.\n\nYour login details:\nEmail: {{email}}\nPortal: {{portal_url}}\n\nLet's make it a great year!\n\nGreater Height Academy",
           ],
       ];

       // Also load saved templates from DB (if stored in a table)
       return view('sms.templates', compact('templates'));
   }

   /**
    * SMS settings page
    */
   public function settings()
   {
       $settings = [
           'provider' => config('services.africastalking.username') ?? '',
           'sender_id' => config('services.africastalking.sender_id') ?? '',
           'auto_sms_attendance' => true,
           'auto_sms_fees' => true,
           'auto_sms_results' => true,
       ];

       return view('sms.settings', compact('settings'));
   }

   /**
    * Update SMS settings
    */
   public function updateSettings(Request $request)
   {
       $validated = $request->validate([
           'africastalking_username' => 'required|string',
           'africastalking_api_key' => 'required|string',
           'africastalking_sender_id' => 'nullable|string|max:11',
           'auto_sms_attendance' => 'boolean',
           'auto_sms_fees' => 'boolean',
           'auto_sms_results' => 'boolean',
       ]);

       // Update .env or config (we'll update .env file for now)
       $envPath = base_path('.env');
       $env = file_get_contents($envPath);

       $env = str_replace("AFRICASTALKING_USERNAME=" . env('AFRICASTALKING_USERNAME'), "AFRICASTALKING_USERNAME=" . $validated['africastalking_username'], $env);
       $env = str_replace("AFRICASTALKING_API_KEY=" . env('AFRICASTALKING_API_KEY'), "AFRICASTALKING_API_KEY=" . $validated['africastalking_api_key'], $env);
       $env = str_replace("AFRICASTALKING_SENDER_ID=" . env('AFRICASTALKING_SENDER_ID'), "AFRICASTALKING_SENDER_ID=" . ($validated['africastalking_sender_id'] ?? 'GHA'), $env);

       // Persist auto-SMS flags
       foreach (['attendance', 'fees', 'results'] as $type) {
           $key = 'auto_sms_' . $type;
           $value = $validated[$key] ? 'true' : 'false';
           $env = str_replace(strtoupper($key) . '=' . env(strtoupper($key)), strtoupper($key) . '=' . $value, $env);
       }

       file_put_contents($envPath, $env);

       // Also clear config cache so changes take effect immediately
       \Cache::forget('env');
       config(['services.africastalking.username' => $validated['africastalking_username']]);
       config(['services.africastalking.api_key' => $validated['africastalking_api_key']]);
       config(['services.africastalking.sender_id' => $validated['africastalking_sender_id'] ?? 'GHA']);

       return back()->with('success', 'SMS settings updated.');
   }
}
