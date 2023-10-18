<x-mail::message>
# Applican informations

<strong>First Name</strong> : {{$data->firstName}} <br>
<strong>Last Name</strong> : {{$data->lastName}} <br>
<strong>Sur Name</strong> : {{$data->surName}} <br>
<strong>Address</strong> : {{$data->address}} <br>
<strong>Email Address</strong> : {{$data->emailAddress}} <br>
<strong>Phone Number</strong> : {{$data->phoneNumber}} <br>
<strong>Region</strong> : {{$data->region}} <br>
<strong>Pincode</strong> : {{$data->pincode}} <br>
<strong>Country</strong> : {{$data->country}} <br>
<strong>State</strong> : {{$data->state}} <br>
<strong>City</strong> : {{$data->city}} <br>
<strong>Qualification</strong> : {{$data->qualification}} <br>
<strong>Birth Date</strong> : {{$data->birth_date}} <br>
<strong>Gender</strong> : {{$data->genderOption}} <br>

Nearby, there are my image and my resume
<br>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
