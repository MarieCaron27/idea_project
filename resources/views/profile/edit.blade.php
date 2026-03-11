<x-layout>
    <x-forms.form title="Edit your account" subtitle="Need to make a tweak?">
        <form action="/profile" method="post" class="mt-10 space-y-4">

            @csrf
            @method('PATCH')

            <x-forms.field name="name" label="Name" :value="$user->name"></x-forms.field>
            <x-forms.field type="email" name="email" label="Email" :value="$user->email"></x-forms.field>
            <x-forms.field type="password" name="password" label="Password"></x-forms.field>

            <button type="submit" class="btn btn-neutral mt-4" dusk="update-profile-button">Update my account</button>        </form>
    </x-forms.form>
</x-layout>