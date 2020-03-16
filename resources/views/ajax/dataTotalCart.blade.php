@if($findCoupon != 0)
  <tr class="cart-subtotal">
      <th>Subtotal</th>
      <td>
        <span class="amount" id="subtotalCart">
          <del>{{number_format($price,0, "", ".")}}</del>
        </span>
    </td>
  </tr>
  <tr class="shipping" style="color: green;" id="discountRow">
      <th id="couponTitle">Coupon (Discount {{$coupon->discount}} % )</th>
      <td>
        <span class="amount" id="discountCoupon" style="color: green;">
          {{number_format($discount,0, "", ".")}}
        </span>
      </td>
  </tr>
  <tr class="order-total">
      <th>Total</th>
      <td>
          <strong class="amount"><span class="amount" id="totalCart">
          	{{number_format($total,0, "", ".")}}
          </span></strong>
      </td>
  </tr>
@else
<tr class="order-total">
    <th>Total</th>
    <td>
        <strong class="amount">IDR <span class="amount" id="totalCart">
          {{number_format($price,0, "", ".")}}
        </span></strong>
    </td>
</tr>
@endif