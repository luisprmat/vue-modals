<?php

use App\Models\User;
use Tests\Browser;

function firstUser(): User
{
    return User::orderBy('name')->firstOrFail();
}

function openEditModal(Browser $browser, User $user, string $baseUrl): Browser
{
    return $browser
        ->loginAs(1)
        ->visit($baseUrl)
        ->waitFor('@edit-user-'.$user->id)
        ->press('@edit-user-'.$user->id)
        ->waitForModal();
}

dataset('baseUrl', [
    'Base URL users.index' => fn () => route('users.index'),
    'Base URL users.show' => fn () => route('users.show', firstUser()),
]);

it('can open a modal and close', function (string $baseUrl) {
    $this->browse(function (Browser $browser) use ($baseUrl) {
        $user = firstUser();

        openEditModal($browser, $user, $baseUrl)
            ->assertUrlIs(route('users.edit', $user))
            ->withinModal(fn (Browser $browser) => $browser->press('@btn-cancel'))
            ->waitUntilMissingModal()
            // ->pause(500) // I must wait changes in URL after close modal
            ->waitForLocation($baseUrl) // Or
            ->assertUrlIs($baseUrl);
    });
})->with('baseUrl');

it('can update a user', function (string $baseUrl) {
    $this->browse(function (Browser $browser) use ($baseUrl) {
        $user = firstUser();

        $newName = fake()->name();
        $newEmail = fake()->safeEmail();

        openEditModal($browser, $user, $baseUrl)
            ->withinModal(function (Browser $browser) use ($newName, $newEmail) {
                $browser->type('#name', $newName)
                    ->type('#email', $newEmail)
                    ->press('@btn-update');
            })
            ->waitForText(__('User updated successfully.'));

        $user->refresh();

        expect($user->name)
            ->toBe($newName)
            ->and($user->email)
            ->toBe($newEmail);
    });
})->with('baseUrl');

it('can show a validation error within the modal', function ($baseUrl) {
    $this->browse(function (Browser $browser) use ($baseUrl) {
        $user = User::orderBy('name')->firstOrFail();

        openEditModal($browser, $user, $baseUrl)
            ->withinModal(function (Browser $browser) {
                $browser->type('#email', 'not-valid-email')
                    ->press('@btn-update')
                    ->waitForText(__('validation.email', ['attribute' => __('validation.attributes.email')]));
            });

        expect($user->fresh()->email)
            ->not->toBe('not-valid-email');
    });
})->with('baseUrl');
