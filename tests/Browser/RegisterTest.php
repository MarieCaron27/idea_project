<?php

it('register a user', function () {
    visit('/auth/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'johndoe@example.com')
        ->fill('password', 'password123!')
        ->click('@register-button')
        ->assertPathIs('/');

});
