
                              <table class="min-w-full" style="min-width: 100%;">
                                <thead class="bg-white border-b" >
                                  <tr>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                        #
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                     Customer Name
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                      Amount
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                        Payment Date
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                        Comment
                                    </td>
                                    <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                      Status
                                  </td>
                                  {{-- <td scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Action
                                </td> --}}
                                  </tr>
                                </thead>
                                <tbody>
  
                                
                              
  
                                    @foreach ($payments as $payment)
                                    <tr class="bg-gray-100 border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                          {{ $payment->id}}
                                        </td>
                                        
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                          {{ $payment->customer->name}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $payment->amount}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $payment->payment_date}}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                          {{ $payment->comment}}
                                      </td>
                                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $payment->status}}
                                    </td>
                                        
                                      </tr>
                                    @endforeach
  
                                 
                                </tbody>
                              </table>
                             
  