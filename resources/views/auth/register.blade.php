<x-layout>
    <x-forms.form title="Register an account" subtitle="Start tracking your ideas.">
        <form action="/auth/register" method="post" class="mt-10 space-y-4">

            @csrf

            <x-forms.field name="name" label="Name"></x-forms.field>
            <x-forms.field type="email" name="email" label="Email"></x-forms.field>
            <x-forms.field type="password" name="password" label="Password"></x-forms.field>

            <button type="submit" class="btn btn-neutral mt-4">Create my account</button>
        </form>
    </x-forms.form>
</x-layout>