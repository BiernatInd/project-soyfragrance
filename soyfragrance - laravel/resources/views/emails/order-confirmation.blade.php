<p>Dziękujemy za złożenie zamówienia w naszym sklepie SoyFragrance!</p>

<p>Szczegóły zamówienia: </p>
<p>Numer zamówienia: {{ $orderData['order_number'] }}</p>
<p>Produkty: {{ $orderData['purchased_products'] }}</p>
<p>Metoda dostawy: {{ $orderData['delivery'] }}</p>
<p>Metoda płatności: {{ $orderData['payment'] }}</p>
<p>Łączna kwota: {{ $orderData['total_price'] }}</p>

<p>Sprawdź swój status zamówienia:</p>
<a href="http://localhost:3000/status-zamowienia/{{ explode('/', $orderData['order_number'])[0] }}">
    http://localhost:3000/status-zamowienia/{{ explode('/', $orderData['order_number'])[0] }}
</a>