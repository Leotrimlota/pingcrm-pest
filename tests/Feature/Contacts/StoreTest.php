<?php

use App\Models\Contact;

use function Pest\Faker\faker;


it('can store a contact', function () {

    login()->post('/contacts', [
        'first_name' => faker()->firstName,
        'last_name' => faker()->lastName,
        'email' => faker()->email,
        'phone' => faker()->e164PhoneNumber,
        'address' => '1 Test Street',
        'city' => 'Testfield',
        'region' => 'Derbyshire',
        'country' => faker()->randomElement(['us', 'ca']),
        'postal_code' => faker()->postCode,
    ])->assertRedirect('/contacts')->assertSessionHas('success','Contact created.');

    expect(Contact::latest()->first())
        ->first_name->toBeString()->not()->toBeEmpty()
        ->last_name->toBeString()->not()->toBeEmpty()
        ->email->toBeString()->toContain('@')
        ->phone->toBePhoneNumber()
        ->city->toBe('Testfield')
        ->region->toBe('Derbyshire')
        ->country->toBeIn(['us', 'ca']);


});
