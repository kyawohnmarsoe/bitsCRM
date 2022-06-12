<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="max-width: 600px; margin: auto;">
                <div class="p-6 bg-white border-b border-gray-200">
       
                     <!-- Validation Errors -->
         <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('payments.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Name -->
                        <div>
                            {{-- <x-label for="customer_id" :value="__('Customer Name')" /> --}}
                            <label class="block font-medium text-sm text-gray-700" for="customer_id">
                                Customer Name <a href="{{ route('customers.create') }}" style="color:blue;"><small>( New Customer? )</small></a>
                            </label> 
            
                            {{-- <input id="customer_id" class="block mt-1 w-full" type="text" name="customer_id" :value="old('customer_id')"  autofocus /> --}}
                            <select name="customer_id" id="customer_id" class="block mt-1 w-full" required autofocus>
                               @foreach ($customers as $customer)
                               <option value="{{ $customer->id }}" >{{ $customer->name }}</option>
                               @endforeach
                            </select>
                        </div>
            
                        <!-- Amount -->
                        <div class="mt-4" >
                            <x-label for="amount" :value="__('Amount')" />
            
                            <x-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" required autofocus />
                        </div>
            
                         <!-- Payment Date -->
                         <div class="mt-4" >
                            <x-label for="payment_date" :value="__('Payment Date')" />

                            <x-input id="payment_date" class="block mt-1 w-full" type="date" name="payment_date" :value="old('payment_date')" required autofocus />

                            
                        </div>
                        

                         <!-- Comment -->
                         <div class="mt-4" >
                            <x-label for="comment" :value="__('Comment')" />

                            <x-input id="comment" class="block mt-1 w-full" type="text" name="comment" :value="old('comment')"  autofocus />

                            
                        </div>

                         <!-- Status -->
                         <div class="mt-4" >
                            <x-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="block mt-1 w-full" required autofocus>
                                <option value="Pending" selected>Pending</option>
                                <option value="Done" >Done</option>
                            </select>
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
