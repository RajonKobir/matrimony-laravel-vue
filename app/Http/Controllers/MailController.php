<?php

namespace App\Http\Controllers;

use App\Mail\ProposalNotificationEmail;
use App\Mail\GeneralNotificationEmail;
use App\Mail\ContactUsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Emailserver;


class MailController extends Controller
{

    public function __construct(){
        // updating mail server on the fly
        $emailservers = Emailserver::all();
        if( $emailservers !== null ){
            if( count($emailservers) > 0 ){
                $emailserver = $emailservers[array_rand([0, 4])];
                // $emailserver = $emailservers[4];
                if( $emailserver ){
                    Config::set('mail.default', 'smtp'); // <-- VERY IMPORTANT

                    Config::set('mail.mailers.smtp', [
                        'transport' => 'smtp',
                        'url' => null,
                        'host' => $emailserver->MAIL_HOST,
                        'port' => $emailserver->MAIL_PORT,
                        'encryption' => $emailserver->MAIL_ENCRYPTION,
                        'username' => $emailserver->MAIL_USERNAME,
                        'password' => $emailserver->MAIL_PASSWORD,
                        'timeout' => null,
                        'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
                    ]);

                    Config::set('mail.from', [
                        'address' => $emailserver->MAIL_FROM_ADDRESS,
                        'name' => $emailserver->MAIL_FROM_NAME,
                    ]);
                }
            }
        }
    }


    public function index()
    {
        return view('backend.mails.index');
    }


    public function proposalNotifications(Request $request)
    {

        $mailData = $request->validate([
            'name' => 'required|string|min:2|max:200',
            'email' => 'required|email|min:2|max:500',
            'subject' => 'required|string|min:2|max:1000',
            'message' => 'required|string|min:2|max:3000',
        ]);


        Mail::to($mailData['email'])->send(new ProposalNotificationEmail($mailData));
        return $mailData;
        // return redirect()->back()->with('success', 'A confirmation email has been sent to ' . $mailData['email']);


        try {
            Mail::to($mailData['email'])->send(new ProposalNotificationEmail($mailData));
            return true;
            // return redirect()->back()->with('success', 'A confirmation email has been sent to ' . $mailData['email']);
        } catch (Exception $e) {
            Log::error('Email sending failed for '. $mailData['email'] .': ' . $e->getMessage()); // Log the error
            return 'Email sending failed for '. $mailData['email'] .': ' . $e->getMessage();
            // return redirect()->back()->with('error', 'Something went wrong while sending the email.');
        }
    }


    public function generalNotifications(Request $request)
    {

        $mailData = $request->validate([
            'name' => 'required|string|min:2|max:200',
            'email' => 'required|email|min:2|max:500',
            'subject' => 'required|string|min:2|max:1000',
            'message' => 'required|string|min:2|max:3000',
        ]);


        Mail::to($mailData['email'])->send(new GeneralNotificationEmail($mailData));
        return $mailData;
        // return redirect()->back()->with('success', 'A confirmation email has been sent to ' . $mailData['email']);


        try {
            Mail::to($mailData['email'])->send(new GeneralNotificationEmail($mailData));
            return true;
            // return redirect()->back()->with('success', 'A confirmation email has been sent to ' . $mailData['email']);
        } catch (Exception $e) {
            Log::error('Email sending failed for '. $mailData['email'] .': ' . $e->getMessage()); // Log the error
            return 'Email sending failed for '. $mailData['email'] .': ' . $e->getMessage();
            // return redirect()->back()->with('error', 'Something went wrong while sending the email.');
        }
    }


    public function contactUs(Request $request)
    {

        $mailData = $request->validate([
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email|min:2|max:50',
            'subject' => 'required|string|min:2|max:50',
            'message' => 'required|string|min:2|max:300',
        ]);

        Mail::to($request->email)->send(new ContactUsEmail($mailData));

        return redirect()->back()->with('success', 'A confirmation email has been sent to ' . $mailData['email']);
    }


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

