<div>
    <!-- Success message -->
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.93a1 1 0 01-1.415-1.414l2.93-2.93-2.931-2.929a1 1 0 111.415-1.414L10 8.586l2.93-2.93a1 1 0 111.414 1.415l-2.93 2.929 2.93 2.93a1 1 0 010 1.414z" />
                </svg>
            </span>
        </div>
    @endif

    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <form wire:submit.prevent="saveUser" class="p-6 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" required autofocus autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required autocomplete="last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                            <x-text-input wire:model="date_of_birth" id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" required />
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="contact_number" :value="__('Contact Number')" />
                            <x-text-input wire:model="contact_number" id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" required autocomplete="contact_number" />
                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                        </div>
    
                        <div class="col-span-2">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-textarea-input wire:model="address" id="address" class="block mt-1 w-full" name="address" required autocomplete="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="post_code" :value="__('Post Code')" />
                            <x-text-input wire:model="post_code" id="post_code" class="block mt-1 w-full" type="text" name="post_code" required autocomplete="post_code" />
                            <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input wire:model="city" id="city" class="block mt-1 w-full" type="text" name="city" required autocomplete="city" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="state" :value="__('State')" />
                            <x-text-input wire:model="state" id="state" class="block mt-1 w-full" type="text" name="state" required autocomplete="state" />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="usertype" :value="__('User Type')" />
                            <select wire:model="usertype" id="usertype" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="usertype" required>
                                <option value="">Set user as:</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
                        </div>                        
    
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
    
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
    
                    <x-primary-button class="bg-gray-500 text-white rounded hover:bg-gray-600">
                        {{ __('Add User') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </section>    
</div>
