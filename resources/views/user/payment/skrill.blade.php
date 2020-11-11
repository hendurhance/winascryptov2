<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$gnl->title}}</title>
</head>

<body>
    
    <form action="https://www.moneybookers.com/app/payment.pl" method="POST" id="payment_form">
        {{csrf_field()}}
        <input name="pay_to_email" value="{{$gatewayData->val1}}" type="hidden">
        
        <input name="transaction_id" value="{{$data->custom}}" type="hidden">
        
        <input name="return_url" value="{{route('deposit-fund')}}" type="hidden">
        
        <input name="return_url_text" value="Return {{$gnl->title}}" type="hidden">
        
        <input name="cancel_url" value="{{route('deposit-fund')}}" type="hidden">
        
        <input name="status_url" value="{{route('ipn.skrill')}}" type="hidden">
        
        <input name="language" value="EN" type="hidden">
        
        <input name="amount" value="{{$data->usd}}" type="hidden">
        
        <input name="currency" value="USD" type="hidden">
        
        <input name="detail1_description" value="{{$gnl->title}}" type="hidden">
        
        <input name="detail1_text" value="Deposit-fund To {{$gnl->title}}" type="hidden">
        
        <input name="logo_url" value="{{asset('assets/images/logo/logo.png')}}" type="hidden">
        
    </form>
    
    <script type="text/javascript">
        document.getElementById("payment_form").submit();
    </script>
</body>

</html>