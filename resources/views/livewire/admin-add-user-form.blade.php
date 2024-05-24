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
                <form wire:submit.prevent="saveUser" enctype="multipart/form-data" class="p-6 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" autofocus autocomplete="first_name" />
                        </div>
    
                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" autocomplete="last_name" />
                        </div>

                        <div>
                            <x-input-label for="ic" :value="__('Identification Card (IC)')" />
                            <x-text-input wire:model="ic" id="ic" class="block mt-1 w-full" type="text" name="ic" autocomplete="ic"/>
                        </div>
    
                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" autocomplete="username" />
                        </div>
    
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" autocomplete="email" />
                        </div>
    
                        <div>
                            <x-input-label for="contact_number" :value="__('Contact Number')" />
                            <x-text-input wire:model="contact_number" id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" autocomplete="contact_number" />
                        </div>

                        <div>
                            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                            <x-text-input wire:model="date_of_birth" id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" />
                        </div>

                        <div>
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select wire:model="gender" id="gender" name="gender" class="mt-1 block border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="text-red-500" />
                        </div>
                        
                        <div class="col-span-2">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-textarea-input wire:model="address" id="address" class="block mt-1 w-full" name="address" autocomplete="address" />
                        </div>
    
                        <div>
                            <x-input-label for="post_code" :value="__('Post Code')" />
                            <x-text-input wire:model="post_code" id="post_code" class="block mt-1 w-full" type="text" name="post_code" autocomplete="post_code" />
                        </div>
    
                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input wire:model="city" id="city" class="block mt-1 w-full" type="text" name="city" autocomplete="city" />
                        </div>
    
                        <div>
                            <x-input-label for="state" :value="__('State')" />
                            <x-text-input wire:model="state" id="state" class="block mt-1 w-full" type="text" name="state" autocomplete="state" />
                        </div>

                        <div>
                            <x-input-label for="usertype" :value="__('User Type')" />
                            <select wire:model="usertype" id="usertype" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="usertype" >
                                <option value="">Set user as:</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>                        
    
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                        </div>
    
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
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
