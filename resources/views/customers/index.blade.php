<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" >
                <div class="p-6 bg-white border-b border-gray-200">


                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">

                              <div class="flex items-center justify-space-between ">
                            <div class="flex items-center justify-start ">
                                <a href="{{ route('customers.create') }}" class="mr-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                               
                                    {{ __('Create New Customer') }}
                              </a>
                            </div>
                           
                            <div class="flex items-center justify-end " style="display: none;">
                               {{-- Search Form  --}}
                              <form method="POST" action="{{ route('customers.find') }}">
                                @method('POST')
                                @csrf
                                <div class="flex items-center justify-space-between ">
                                <span >Start :</span> 
                                <x-input 
                                    value="2022-06-23"
                                    max="2022-06-15" 
                                    id="start_date" class="block mt-1 w-half ml-3" type="date" name="start_date" :value="old('start_date')" required autofocus/>
                             <span class="ml-3" >End :</span> 
                             <x-input 
                                    max="2022-06-15" 
                                    max="2022-06-15" 
                                    id="end_date" class="block mt-1 w-half ml-3" type="date" name="end_date" :value="old('end_date')" required autofocus/>
                            
                                <x-button class="ml-3">
                                    {{ __('Find') }}
                                </x-button>
                                </div>
                              </form>
                            {{-- Search Form  --}}


                            <form method="POST" action="{{ route('customers.downloadpdf') }}">
                              @method('POST')
                              @csrf
                              <input type="hidden" value=" {{ json_encode($all_customers) }}" name="all_customers"/>
                              <x-button class="ml-3">
                                {{ __('Download') }}
                            </x-button>
                            </form>
                            
                            {{-- <a href="{{ route('customers.test', $customers ) }}" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                              {{ __('Download') }}
                            </a> --}}
                          </div>
                              </div>
                               
                              

                              <table class="min-w-full" style="min-width: 100%;">
                                <thead class="bg-white border-b" >
                                  <tr>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                        #
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                     Name
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                      Phone Number
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                        Address
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                        Action
                                    </td>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if(count($customers)<1)
                                  <tr class="bg-gray-100 border-b">
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" style="text-align: center;"> No Data Found! </td>
                                  </tr>
                             
                              @endif
                                    @foreach ($customers as $customer)
                                    <tr class="bg-gray-100 border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                          {{ $customer->id}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                          {{ $customer->name}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $customer->phone_no}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $customer->address}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('customers.edit', $customer ) }}">Edit</a> |
                                            <form method="POST" action="{{ route('customers.destroy', $customer) }}" style="display: inline;">
                                              @method('DELETE')
                                              @csrf
                                              <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                          
                                        </td>
                                      </tr>
                                    @endforeach

                                </tbody>
                              </table>
                              <div class="mt-4" >
                              {{ $customers->links() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
