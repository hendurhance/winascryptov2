<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$gnl->title}}</title>
</head>

<body>
    <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="payment_form">
        <input type="hidden" name="PAYEE_ACCOUNT" value="{{ $perfect['value1'] }}">
        <input type="hidden" name="PAYEE_NAME" value="{{$gnl->title}}">
        <input type='hidden' name='PAYMENT_ID' value='{{ $perfect['track'] }}'>
        <input type="hidden" name="PAYMENT_AMOUNT"  value="{{$perfect['amount']}}">
        <input type="hidden" name="PAYMENT_UNITS" value="USD">
        <input type="hidden" name="STATUS_URL" value="{{route('ipn.perfect')}}">
        <input type="hidden" name="PAYMENT_URL" value="{{route('deposit-fund')}}">
        <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
        <input type="hidden" name="NOPAYMENT_URL" value="{{route('deposit-fund')}}">
        <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
        <input type="hidden" name="SUGGESTED_MEMO" value="{{Auth::user()->username}}">
        <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
    </form>
    
    <script>
        document.getElementById("payment_form").submit();
    </script>
</body>

</html>
