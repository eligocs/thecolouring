<?php

namespace App\Http\Livewire\Front\Contact;

use App\Models\ContactData;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
	
	public $name;
	public $email;
	public $phone;
	public $message;
	public $subject;
	
	public function create()
    {

        $validatedData = $this->validate([

            'name' => 'required',
			'email' => 'required|email',
			'message' => 'required',
			'subject' => 'required',

        ]);
	
			ContactData::create([
				'name' => $this->name,
				'email' => $this->email,
				'message' => $this->message,
				'subject' => $this->message,
			]);
			
			$details = [
			'title' => 'Mail from thecolouring.com',
			'name' => $this->name,
			'email' => $this->email,
			'messages' => $this->message,
			'subject' => $this->subject,
	    	];
	   
	//	\Mail::to('info@thecolouring.com')->send(new \App\Mail\ContactUs($details));
		
    	$replyemail = $this->email;
		$replyname = $this->name;
		
		\Mail::send('emails.contact', $details, function($message) use ($details, $replyemail, $replyname)
        {
            $message->to('info@thecolouring.com', 'thecoloring')
                ->replyTo($replyemail, $replyname)
                ->subject('Email From Contact Page');
        }); 
			
			session()->flash('message', 'Submitted Successfully.');
			$this->reset('name','email','phone','message', 'subject');
    }
	
    public function render()
    {
        return view('livewire.front.contact.index');
    }
}
