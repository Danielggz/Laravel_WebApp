@extends('layout')


@section('content')
    <div class="container">
        <h2>Prices</h2>
        <div>
            <div class="form-group">
                <label for="stock_symbol">Type a stock symbol:</label>
                <input type="text" class="form-control" id="stock_symbol" placeholder="AAPL, AMZN...">
            </div>
            <button id="pricebtn" class="btn btn-primary">Get Price</button>
        </div>
        <div id="storeInfo" style="margin-top:2em;">
            <form method="post" action="{{ route('prices.store') }}">
                <div class="form-group">
                    <label for="infoSymbol">Symbol:</label>
                    <input type="text" class="form-control" id="infoSymbol"/>
                    <label for="infoHigh">High:</label>
                    <input type="text" class="form-control" id="infoHigh"/>
                    <label for="infoLow">Low:</label>
                    <input type="text" class="form-control" id="infoLow"/>
                    <label for="infoPrice">Price:</label>
                    <input type="text" class="form-control" id="infoPrice"/>
                </div>
                <button type="submit" style="margin-top:1em;" class="btn btn-primary">Save</button>
            </form>
            
            
        </div>
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
                            console.log(response);
                            var pricesObj = response["Global Quote"];
                            console.log()
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
                url: "/",
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
@stop