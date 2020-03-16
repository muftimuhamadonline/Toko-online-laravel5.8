      
                                        <tr class="order-total">
                                            <th>SUBTOTAL</th>
                                            <td>
                                                <strong class="amount">
                                                    <span class="amount">
                                                    {{number_format($subtotal,0, "", ".")}}
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                        @if($discount != 0)
                                        <tr class="order-total">
                                            <th style="color: green;">DISCOUNT</th>
                                            <td>
                                                <strong class="amount">
                                                    <span class="amount" style="color: green;">
                                                    {{number_format($discount,0, "", ".")}}
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr class="order-total">
                                            <th>SHIPPING</th>
                                            <td>
                                                <strong class="amount"> 
                                                    <span class="amount" id="shipping">
                                                     {{number_format($ship,0, "", ".")}}
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr class="order-total" id="totalCheckout">
                                            <th>TOTAL</th>
                                            <td>
                                                <strong class="amount"> 
                                                    <span class="amount">
                                                    IDR &nbsp;{{number_format($final,0, "", ".")}}
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>                                         
                                    