<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
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

        <!-- Password -->
        <div class="mt-2">
            <x-input-label style="color:black;" for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2 mb-3">
            <x-input-label style="color:black;" for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <a tabindex="0" class="btn btn-lg " role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Password Guidelines" data-bs-content="
English uppercase letters (A through Z). English lower case letters (a through z). Numbers (0 through 9). Special characters and punctuation symbols (Example: _, -. Not more than 8 characters">
            <i class=" bi-info-circle text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"></i>
        </a>

        <div class="mt-2 justify-center">
            <div class=" justify-center">
                {!! app('captcha')->display() !!}
            </div>
            <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
        </div>

        <div class="w-full flex justify-center mx-2 mt-2">
            <a href="/auth/google/redirect" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                    <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path>
                </svg>
                Sign up with Google
            </a>
        </div>

        <h2 class="mt-0" style="margin-left: 50%;">OR</h2>

        <div class="flex items-center justify-center mt-2">
            <a class=" text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button style="background-color:black;" class="ml-2 justify-end">
                {{ __('Register') }}
            </x-primary-button>
        </div>


        <!-- Sign up with google -->


        <input type="hidden" name="role" value="2">

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
</x-guest-layout>
<script>
    const popover = new bootstrap.Popover('.popover-dismiss', {
        trigger: 'focus'
    })
</script>