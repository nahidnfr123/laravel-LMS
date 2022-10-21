<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Rules\NameValidate;
use App\Rules\PhoneMaxLength;
use App\Rules\PhoneMinLength;
use App\Rules\WordCountRule;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $contacts = ContactUs::all();
        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('contact_us');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
//            'name' => ['required', new NameValidate, 'min:3'],
            'email' => 'required|email',
            'contact' => ['required', 'numeric', 'regex:/(01)[0-9]{9}/', new PhoneMinLength, new PhoneMaxLength],
            'message' => ['required', 'string'],
            'user_id' => 'nullable',
        ], [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at-least 3 letters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Email must be an email.',

            'contact.required' => 'Contact is required.',
            'contact.numeric' => 'Contact must be numeric.',

            'message.required' => 'Message is required.',
        ]);

        if ($request->user_id == null) {
            $User_id = 0;
        } else {
            $User_id = $request->user_id;
        }

        if (str_word_count($request->message) > 200) {
            return back()->withErrors('error', 'Contact message must be under 200 words.');
        }

        ContactUs::Insert([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'phone' => $request->contact,
            'message' => ucfirst($request->message),
            'user_id' => $User_id,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Your message was received. We will reply soon in your email.');
    }

    /**
     * Display the specified resource.
     *
     * @param ContactUs $contactUs
     * @return Response
     */
    public function show(ContactUs $contactUs): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): Application|Factory|View
    {
        $contact = ContactUs::findOrFail($id);
        return view('admin.contact.form', compact('contact'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $contact = ContactUs::findOrFail($id);

        $data = [
            'contact' => $contact,
            'message' => $request->message,
            'subject' => $request->subject
        ];
        Mail::to($contact->email)->send(new \App\Mail\ContactUs($data));
        return redirect()->route('admin.content-us.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        ContactUs::findOrFail($id)->delete();
        return redirect()->back();
    }
}
