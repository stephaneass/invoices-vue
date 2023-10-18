<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My informations</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>
<body class="bg-secondary">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                    <form method="POST" action="{{route('informations.save')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <x-input field='firstName' labelle='First Name'/>
                            <x-input field='lastName' labelle='Last Name'/>
                        </div>
                        <div class="row">
                            <x-input field='surName' labelle='Sur Name'/>
                            <x-input field='emailAddress' labelle='Email Address' type='email'/>
                        </div>
                        <div class="row">
                            <x-input field='address' labelle='Address'/>
                            <x-input field='phoneNumber' labelle='Phone Number' type='tel'/>
                        </div>
                        <div class="row">
                            <x-input field='region' labelle='region'/>
                            <x-input field='pincode' labelle='Pin Code'/>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <select name='country' class="form-control form-control-lg">
                                    <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->name}}"> {{$country->name}} </option>
                                    @endforeach
                                </select>
                                <x-error field="country" />
                            </div>
                            <x-input field='state' labelle='State'/>
                        </div>
                        <div class="row">
                            <x-input field='city' labelle='City'/>
                            <x-input field='qualification' labelle='Qualification'/>
                        </div>
                        <div class="row">
                            <x-input field='birth_date' labelle='Birth date' type='date'/>
                            <div class="col-md-6 mb-4">
                                <h6 class="mb-2 pb-1">Gender: </h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genderOption" id="femaleGender" value="Female" checked />
                                    <label class="form-check-label" for="femaleGender">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genderOption" id="maleGender" value="Male" />
                                    <label class="form-check-label" for="maleGender">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genderOption" id="otherGender" value="Other" />
                                    <label class="form-check-label" for="otherGender">Other</label>
                                </div>
                            </div>
                            <x-error field="genderOption" />
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="form-outline">
                                    <input type="file" id="image" name="image" class="form-control form-control-lg" accept="image/*" value=""/>
                                    <label class="form-label" for="image">Image</label>
                                </div>
                                <x-error field="image" />
                            </div>
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="form-outline">
                                    <input type="file" id="fileResume" name="fileResume" class="form-control form-control-lg" accept="application/pdf" value=""/>
                                    <label class="form-label" for="fileResume">File / Resume</label>
                                </div>
                                <x-error field="fileResume" />
                            </div>
                        </div>
                        <div class="row">
                            <x-input field='password' labelle='Password' type='password'/>
                            <x-input field='password_confirmation' labelle='Confirmation' type='password' />
                        </div>
                        <div class="row">
                            <div class="form-check">
                                <input onclick="showPassword()" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                  Show Password
                                </label>
                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                        <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                        </div>
        
                    </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js" ></script>
    <script>
        function showPassword() {
            let password = document.getElementById('password');
            let confirmation = document.getElementById('password_confirmation');

            if (password.type == 'password') {
                password.type = 'text';
                confirmation.type = 'text';
            } else {
                password.type = 'password';
                confirmation.type = 'password';
            }
        }
    </script>
</body>
</html>