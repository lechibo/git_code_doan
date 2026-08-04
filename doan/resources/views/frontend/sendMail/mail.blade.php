
<h2>Order Confirmation</h2>

    <p><strong>Customer:</strong> {{ $customer['name'] }}</p>
    <p><strong>Email:</strong> {{ $customer['email'] }}</p>
    <p><strong>Phone:</strong> {{ $customer['phone'] }}</p>

    <br>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

        @php
            $grandTotal = 0;
        @endphp

        @foreach($cart as $item)

            @php
                $price = ($item['sale'] == 0)
                    ? $item['price']
                    : $item['price'] * ((100 - $item['sale']) / 100);

                $Total = $price * $item['qty'];

                $grandTotal += $Total;
            @endphp

            <tr>
                <td>{{ $item['name'] }}</td>

                <td>
                    ${{ number_format($price,2) }}
                </td>

                <td align="center">
                    {{ $item['qty'] }}
                </td>

                <td>
                    ${{ number_format($Total,2) }}
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

    <br>

    <h3>
        Grand Total:
        ${{ number_format($grandTotal,2) }}
    </h3>

    <p>Thank you for your purchase!</p>

