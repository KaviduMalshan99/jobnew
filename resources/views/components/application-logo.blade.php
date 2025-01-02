@php
    $contact = App\Models\ContactUs::first();
@endphp

@if ($contact && $contact->logo_img)
    <img class="img-fluid" style="width: 200px" src="{{ asset('storage/' . $contact->logo_img) }}" alt="Application Logo">
@else
    <p>No logo available</p>
@endif
