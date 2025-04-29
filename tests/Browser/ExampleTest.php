<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('can open a modal and close', function () {
    $this->browse(function (Browser $browser) {
        $user = User::orderBy('name')->firstOrFail();

        $browser
            ->loginAs(1)
            ->visit(route('users.index'))
            ->waitFor('table')
            ->press('@edit-user-'.$user->id)
            ->waitFor('@modal-content')
            ->assertUrlIs(route('users.edit', $user))
            ->within('@modal-content', function (Browser $browser) {
                $browser->press('@btn-cancel');
            })
            ->waitUntilMissingText('@modal-wrapper')
            // ->pause(500) // I must wait changes in URL after close modal
            ->waitForRoute('users.index') // Or
            ->assertUrlIs(route('users.index'));
    });
});

it('can update a user', function () {
    $this->browse(function (Browser $browser) {
        $user = User::orderBy('name')->firstOrFail();

        $newName = fake()->name();
        $newEmail = fake()->safeEmail();

        $browser
            ->loginAs(1)
            ->visit(route('users.index'))
            ->waitFor('table')
            ->press('@edit-user-'.$user->id)
            ->waitFor('@modal-content')
            ->within('@modal-content', function (Browser $browser) use ($newName, $newEmail) {
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
});

it('can show a validation error within the modal', function () {
    $this->browse(function (Browser $browser) {
        $user = User::orderBy('name')->firstOrFail();

        $browser
            ->loginAs(1)
            ->visit(route('users.index'))
            ->waitFor('table')
            ->press('@edit-user-'.$user->id)
            ->waitFor('@modal-content')
            ->within('@modal-content', function (Browser $browser) {
                $browser->type('#email', 'not-valid-email')
                    ->press('@btn-update')
                    ->waitForText(__('validation.email', ['attribute' => __('validation.attributes.email')]));
            });

        expect($user->fresh()->email)
            ->not->toBe('not-valid-email');
    });
});
