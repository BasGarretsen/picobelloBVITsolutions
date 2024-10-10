@extends('layout')

@section('content')

<section>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8 bg-yellow-400">
                <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl dark:text-white">
                    Registreer een account
                </h1>
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-center flex justify-center mx-auto text-red-400 px-4 py-3 my-3 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="space-y-4 md:space-y-6" action="{{ route('store') }}" method="post" onsubmit="return validateForm()">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="text-black border sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium dark:text-white">Naam</label>
                        <input type="text" name="name" id="name" class="text-black border sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium dark:text-white">Wachtwoord</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        <ul id="password-requirements" class="text-sm mt-2">
                            <li id="length" class="text-red-600">Minimaal 8 karakters</li>
                            <li id="uppercase" class="text-red-600">Minimaal één hoofdletter</li>
                            <li id="lowercase" class="text-red-600">Minimaal één kleine letter</li>
                            <li id="number" class="text-red-600">Minimaal één cijfer</li>
                            <li id="special" class="text-red-600">Minimaal één speciaal teken</li>
                        </ul>
                    </div>
                    <div>
                        <label for="repeat-password" class="block mb-2 text-sm font-medium dark:text-white">Bevestig Wachtwoord</label>
                        <input type="password" name="repeat-password" id="repeat-password" placeholder="••••••••" class="sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        <p id="password-error" class="text-red-600 text-sm mt-2 hidden">Wachtwoorden komen niet overeen.</p>
                    </div>
                    <button type="submit" id="register_button" class="w-full border border-white text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" disabled>Registreer</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('password').addEventListener('input', validatePasswords);
    document.getElementById('repeat-password').addEventListener('input', validatePasswords);

    function validatePasswords() {
        const password = document.getElementById('password');
        const repeatPassword = document.getElementById('repeat-password');
        const errorText = document.getElementById('password-error');
        const registerButton = document.getElementById('register_button');

        const length = document.getElementById('length');
        const uppercase = document.getElementById('uppercase');
        const lowercase = document.getElementById('lowercase');
        const number = document.getElementById('number');
        const special = document.getElementById('special');

        const passwordValue = password.value;

        const hasLength = passwordValue.length >= 8;
        const hasUppercase = /[A-Z]/.test(passwordValue);
        const hasLowercase = /[a-z]/.test(passwordValue);
        const hasNumber = /[0-9]/.test(passwordValue);
        const hasSpecial = /[@$!%*?&]/.test(passwordValue);

        length.classList.toggle('text-green-600', hasLength);
        length.classList.toggle('text-red-600', !hasLength);

        uppercase.classList.toggle('text-green-600', hasUppercase);
        uppercase.classList.toggle('text-red-600', !hasUppercase);

        lowercase.classList.toggle('text-green-600', hasLowercase);
        lowercase.classList.toggle('text-red-600', !hasLowercase);

        number.classList.toggle('text-green-600', hasNumber);
        number.classList.toggle('text-red-600', !hasNumber);

        special.classList.toggle('text-green-600', hasSpecial);
        special.classList.toggle('text-red-600', !hasSpecial);

        const isPasswordValid = hasLength && hasUppercase && hasLowercase && hasNumber && hasSpecial;

        if (!isPasswordValid) {
            registerButton.disabled = true;
            return;
        }

        if (repeatPassword.value && passwordValue !== repeatPassword.value || !isPasswordValid) {
            password.classList.add('border-red-600');
            repeatPassword.classList.add('border-red-600');
            errorText.classList.remove('hidden');
            registerButton.style.opacity = 0.5;
            registerButton.disabled = true;
        } else {
            password.classList.remove('border-red-600');
            repeatPassword.classList.remove('border-red-600');
            errorText.classList.add('hidden');
            registerButton.style.opacity = 1;
            registerButton.disabled = false;
        }
    }

    function validateForm() {
        const password = document.getElementById('password').value;
        const repeatPassword = document.getElementById('repeat-password').value;
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordPattern.test(password) || password !== repeatPassword) {
            return false;
        }
        return true;
    }
</script>

@endsection