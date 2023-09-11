<?php

namespace Medians\Contacts\Infrastructure;

use Medians\Contacts\Domain\Contact;


class ContactRepository 
{

    public function loadContacts()
    {
        return Contact::groupBy('wa_id')->where('id', '>', '1')->get();
    }



}
