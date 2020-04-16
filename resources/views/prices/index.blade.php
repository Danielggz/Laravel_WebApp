@extends('prices.layout')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <h2>Prices</h2>
    <div>
        <div class="form-group">
            <label for="stock_symbol">Type a stock symbol:</label>
            <input type="text" class="form-control" id="stock_symbol" placeholder="AAPL, AMZN...">
        </div>
        <button id="pricebtn" class="btn btn-primary">Get Price</button>
    </div>
    <div id="saveResult"></div>
    <div id="storeInfo" style="margin-top:2em;">
        <form action="{{ route('prices.store') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="infoSymbol">Symbol:</label>
                <input type="text" name="symbol" class="form-control" id="infoSymbol"/>
                <label for="infoHigh">High:</label>
                <input type="text" name="high" class="form-control" id="infoHigh"/>
                <label for="infoLow">Low:</label>
                <input type="text" name="low" class="form-control" id="infoLow"/>
                <label for="infoPrice">Price:</label>
                <input type="text" name="price" class="form-control" id="infoPrice"/>
            </div>
            <button type="submit" style="margin-top:1em;" class="btn btn-primary">Save</button>
        </form>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
            <td>ID</td>
            <td>Symbol</td>
            <td>High</td>
            <td>Low</td>
            <td>Price</td>
            </tr>
        </thead>
        <tbody>
            @foreach($prices as $price)
            <tr>
                <td>{{$price->id}}</td>
                <td>{{$price->symbol}}</td>
                <td>{{$price->high}}</td>
                <td>{{$price->low}}</td>
                <td>{{$price->price}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ url('/destroyPrices') }}"><button id="dataClean" class="btn btn-danger">Reset table</button> </a>
        
</div>
    <script type="text/javascript">
        $('#pricebtn').click(function(){
            var apiKey = "0O18XUJW9P8QVGQJ";
            var stockSymbol = $('#stock_symbol').val();
            $.ajax({
                type:'GET',
                url:"https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=" + stockSymbol + "&apikey=" + apiKey,
                success:function(response){
                    if(response.hasOwnProperty("Error Message"))
                    {
                        alert("incorrect stock symbol");
                        $("#storeInfo").hide();
                    }else{
                        if(response.hasOwnProperty("Global Quote"))
                        {
                            var pricesObj = response["Global Quote"];
                            console.log(pricesObj);
                            // $.ajaxSetup({
                            //     headers: {
                            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            //     }
                            // });
                            // $.ajax({
                            //     url: "{{ route('prices.store') }}",
                            //     type: 'POST',
                            //     data: {
                            //         symbol: pricesObj["01. symbol"],
                            //         high: pricesObj["03. high"],
                            //         low: pricesObj["04. low"],
                            //         price: pricesObj["05. price"]
                            //     },
                            //     success:function(response) {
                            //         $('#saveResult').html("<div style='margin-top:10px; width:50%;' class='alert alert-success'>" + response + "</div>").fadeIn("slow").delay("3000").fadeOut("3000");
                            //     }
                            // });
                            $("#storeInfo").show();
                            $("#infoSymbol").val(pricesObj["01. symbol"]);
                            $("#infoHigh").val(pricesObj["03. high"]);
                            $("#infoLow").val(pricesObj["04. low"]);
                            $("#infoPrice").val(pricesObj["05. price"]);
                        }else{
                            $("#storeInfo").hide();
                        }
                    }
                }
            });
        });

        $("#storePrice").click(function(){
            var stock = $('#infoStock').val();
            var high = $('#infoHigh').val();
            var low = $('#infoLow').val();
            var price = $('#infoPrice').val();

            $.ajax({
                url: "{{ route('prices.store') }}",
                type: 'POST',
                data: {
                    stock: stock,
                    high: high,
                    low: low,
                    price: price
                },
                success:function(response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection