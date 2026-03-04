<x-layout>
    <x-forms.form title="Log In" subtitle="Glad to have you back.">
        <form action="/auth/login" method="post" class="mt-10 space-y-4">

            @csrf

            <x-forms.field type="email" name="email" label="Email"></x-forms.field>
            <x-forms.field type="password" name="password" label="Password"></x-forms.field>

            <button type="submit" class="btn btn-neutral mt-4">Log In</button>
        </form>
    </x-forms.form>
</x-layout>