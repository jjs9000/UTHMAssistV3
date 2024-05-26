<div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 "
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input
                                wire:model.live.debounce.300ms = "search"  
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="">
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">User Gender :</label>
                            <select 
                                wire:model.live='gender'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>
                            <select 
                                wire:model.live='admin'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 bg-gray-50">
                            <tr>
                                @include('livewire.includes.table-sortable-th', ['name' => 'username', 'displayName' => 'Username'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'first_name', 'displayName' => 'Name'])
                                <th scope="col" class="px-4 py-3">IC</th>
                                @include('livewire.includes.table-sortable-th', ['name' => 'email', 'displayName' => 'Email'])
                                <th scope="col" class="px-4 py-3">Gender</th>
                                @include('livewire.includes.table-sortable-th', ['name' => 'usertype', 'displayName' => 'User Type'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'date_of_birth', 'displayName' => 'Date of Birth'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'contact_number', 'displayName' => 'Contact Number'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'address', 'displayName' => 'Address'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'city', 'displayName' => 'City'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'state', 'displayName' => 'State'])                                
                                <th scope="col" class="px-4 py-3">Joined</th>
                                <th scope="col" class="px-4 py-3">Last Update</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr wire:key="{{ $user->id }}" class="border-b group">
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $user->username }}</td>
                                <td class="px-4 py-3">{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td class="px-4 py-3 relative">
                                    <div class="absolute inset-0 bg-gray-300 text-gray-300 group-hover:bg-transparent group-hover:text-transparent transition-none">{{ $user->ic }}</div>
                                    <div class="group-hover:opacity-100 opacity-100">{{ $user->ic }}</div>
                                </td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ $user->gender }}</td>
                                <td class="px-4 py-3 text-green-500">{{ $user->usertype }}</td>
                                <td class="px-4 py-3">{{ $this->getFormattedDateOfBirth($user->date_of_birth) }}</td>
                                <td class="px-4 py-3">{{ $user->contact_number }}</td>
                                <td class="px-4 py-3">{{ $user->address }}</td>
                                <td class="px-4 py-3">{{ $user->city }}</td>
                                <td class="px-4 py-3">{{ $user->state }}</td>
                                <td class="px-4 py-3">{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                                <td class="px-4 py-3">{{ $user->updated_at->format('d-m-Y H:i:s') }}</td>
                                <td class="px-0 py-3 flex items-center justify-center space-x-0 ml-auto">
                                    @if(auth()->user()->id !== $user->id)
                                        <button wire:click="$dispatch('openModal', { component: 'delete-confirmation-modal', arguments: { userId: {{ $user->id }} }})" class="px-3 py-1 hover:bg-gray-100 text-white rounded flex items-center justify-center flex-shrink-0">
                                            <img src="{{ asset('svg/delete-icon.svg') }}" alt="Delete Icon" class="h-6 w-full">
                                        </button>
                                    @endif
                                    <button wire:click="openViewUserModal({{ $user->id }})" class="px-3 py-1 hover:bg-gray-100 text-white rounded flex items-center justify-center flex-shrink-0">
                                        <img src="{{ asset('svg/view-icon.svg') }}" alt="View Icon" class="h-6 w-full">
                                    </button>
                                </td>                                                                                                                                                               
                            </tr>
                            @empty
                            <tr>
                                <td colspan="14" class="px-4 py-3 text-center text-gray-900 text-lg font-semibold">
                                    No user found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select
                                wire:model.live='perPage'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>

</div>
