@extends('layouts.adminlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>

    <form method="POST" action="{{ route('sup_reg') }}" style="width: 40%; margin-left: 30%; margin-top: 5%">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label style="color:black;" for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-2">
            <x-input-label style="color:black;" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Phone Number -->

        <div class="mt-2">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone1" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            <span id="valid-msg" class="hide"></span>
            <span id="error-msg" class="hide"></span>
            <input id="fullNumber" type="hidden" name="phone">
        </div>


        <div class="flex items-center justify-center mt-4">

            <x-primary-button style="background-color:black;" class="ml-2">
                {{ __('Register') }}
            </x-primary-button>
        </div>


        <input type="hidden" name="role" value="1">

    </form>
    <!-- Script for phone number -->

    <script>
        const input = document.querySelector("#phone");
        const errorMsg = document.querySelector("#error-msg");
        const validMsg = document.querySelector("#valid-msg");

        // here, the index maps to the error code returned from getValidationError - see readme
        const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialise plugin
        const iti = window.intlTelInput(input, {
            preferredCountries: ["ke", "us"],
            separateDialCode: true,
            utilsScript: "/intl-tel-input/js/utils.js?1684676252775"
        });


        const reset = () => {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };
        var iti1 = window.intlTelInputGlobals.getInstance(input);

        input.addEventListener('input', function() {
            var fullNumber = iti1.getNumber();
            document.getElementById('fullNumber').value = fullNumber;
        });

        // on blur: validate
        input.addEventListener('blur', () => {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                } else {
                    input.classList.add("error");
                    const errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
    </script>
@endsection