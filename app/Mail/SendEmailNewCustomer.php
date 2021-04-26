<?php


namespace App\Mail;


use App\AsientoContable\Customers\Customer;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailNewCustomer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->view('emails.customer-credentials')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject("Bienvenido ".$this->customer->name)
            ->with([
                'customer' => $this->customer,
                'setting' => Setting::first()
            ]);
    }

}
