<?php

use App\Models\Account;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);


it('can store a contact', function () {

    login()->post('/contacts', [
        'first_name' => $this->faker->firstName,
        'last_name' => $this->faker->lastName,
        'email' => $this->faker->email,
        'phone' => $this->faker->e164PhoneNumber,
        'address' => '1 Test Street',
        'city' => 'Testfield',
        'region' => 'Derbyshire',
        'country' => $this->faker->randomElement(['us', 'ca']),
        'postal_code' => $this->faker->postCode,
    ])->assertRedirect('/contacts')->assertSessionHas('success','Contact created.');

    $contact = Contact::latest()->first();

    expect($contact->first_name)->toBeString()->not()->toBeEmpty();
    expect($contact->last_name)->toBeString()->not()->toBeEmpty();
    expect($contact->email)->toBeString()->toContain('@');
    expect($contact->phone)->toBeString()->toStartWith('+');
    expect($contact->city)->toBe('Testfield');
    expect($contact->region)->toBe('Derbyshire');
    expect($contact->country)->toBeIn(['us', 'ca']);




});