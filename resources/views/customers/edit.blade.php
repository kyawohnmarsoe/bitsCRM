<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Customer Info') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="max-width: 600px; margin: auto;">
                <div class="p-6 bg-white border-b border-gray-200">
         <!-- Validation Errors -->
         <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('customers.update', $customer) }}">
                        @method('PUT')
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />
            
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $customer->name }}" required autofocus />
                        </div>
            
                        <!-- Phone -->
                        <div class="mt-4" >
                            <x-label for="phone_no" :value="__('Phone No.')" />
            
                            <x-input id="phone_no" class="block mt-1 w-full" type="number" name="phone_no" value="{{ $customer->phone_no }}" required autofocus />
                        </div>
            
                         <!-- Address -->
                         <div class="mt-4" >
                            <x-label for="address" :value="__('Address')" />
            
                            {{-- <textarea rows="3" id="address" class="block mt-1 w-full" name="address" required autofocus >
                                {{ $customer->address }}
                            </textarea> --}}

                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $customer->address }}" required autofocus />

                            
                        </div>
            
                       
            
                        <div class="flex items-center justify-center mt-4">
                           
                            <x-button class="ml-3">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
