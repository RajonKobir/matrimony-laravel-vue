<?php

namespace App\Http\Controllers;

use App\Mail\CampaignEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;

class MailController extends Controller
{
    public function index()
    {
        return view('backend.mails.index');
    }

    public function sendMail(Request $request)
    {
        $mailData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        return redirect()->back()->with('error', 'tdgddbd');

        // $subscribers = Subscriber::all();
        // foreach ($subscribers as $subscriber) {
        //     Mail::to($subscriber->email)->send(new CampaignEmail($mailData));
        // }


        Mail::to($request->email)->send(new CampaignEmail($mailData));

        return redirect()->back()->with('success', 'A confirmation email has been sent to ' . $mailData['email']);

    }

    // public function selectedMail(){
    //     $emailservers = Emailserver::all();
    //     return view('backend.mails.selectedMail', compact('emailservers'));
    // }

    // public function sendSelectedMail(Request $request){

    //     // var_dump(config('mail.mailers.smtp'));
    //     // var_dump(config('mail.from'));
    //     // return;

    //     $emailservers = $request->emailservers;

    //     $mailData = $request->validate([
    //         'emails' => "required|string",
    //         'subject' => "required|string",
    //         'body' => "required|string",
    //     ]);

    //     $emails = $this->removeSpaces($request->emails);
    //     // Get emails from request and split them into an array
    //     // $emails = explode(',', $emails);
    //     $emails = preg_split('/[\s,;]+/', $emails);

    //     $emails = $this->filterValidEmails($emails);

    //     // var_dump($emails);
    //     // return;

    //     if (count($emails) > 0) {
    //         foreach($emails as $email) {
    //             if( $emailservers !== null ){
    //                 if( count($emailservers) > 0 ){
    //                     $emailserver = Emailserver::findOrFail($emailservers[array_rand($emailservers)]);
    //                     if( $emailserver ){
    //                         Config::set('mail.mailers.smtp', [
    //                             'transport' => $emailserver->MAIL_MAILER,
    //                             'url' => env('MAIL_URL'),
    //                             'host' => $emailserver->MAIL_HOST,
    //                             'port' => $emailserver->MAIL_PORT,
    //                             'encryption' => $emailserver->MAIL_ENCRYPTION,
    //                             'username' => $emailserver->MAIL_USERNAME,
    //                             'password' => $emailserver->MAIL_PASSWORD,
    //                             'timeout' => null,
    //                             'local_domain' => env('MAIL_EHLO_DOMAIN'),
    //                         ]);
    //                         Config::set('mail.from', [
    //                             'address' => $emailserver->MAIL_FROM_ADDRESS,
    //                             'name' => $emailserver->MAIL_FROM_NAME,
    //                         ]);
    //                     }
    //                 }
    //             }

    //             Mail::to($email)->send(new CampaignEmail($mailData));
    //         }
    //     }else {
    //         return redirect()->route('admin.mails.selectedMail')->with('error', 'No valid email addresses were provided.');
    //     }

    //     return redirect()->route('admin.mails.selectedMail')->with('success', 'Emails has been sent successfully!');
    // }


    public function filterValidEmails($emails) {
        $filteredEmails = [];
        foreach ($emails as $email) {
            // Validate email using filter_var
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $filteredEmails[] = $email;
            }
        }
        return $filteredEmails;
    }

    public function removeSpaces($string) {
        return str_replace(' ', '', $string);
    }
}

