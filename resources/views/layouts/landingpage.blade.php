
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Dinarkripto Explorer </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/vendors/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="/vendors/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="/vendors/vendor/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendors/css/style.css">
</head>


<body>
@include('layouts.navbar')
    @yield('content')
@include('layouts.footer')
@yield('javascript')

<script>

    
function timeSince(date) {

var seconds = Math.floor((new Date() - date) / 1000);

var interval = Math.floor(seconds / 31536000);

if (interval > 1) {
  return interval + " years ago";
}
interval = Math.floor(seconds / 2592000);
if (interval > 1) {
  return interval + " months ago";
}
interval = Math.floor(seconds / 86400);
if (interval > 1) {
  return interval + " days ago";
}
interval = Math.floor(seconds / 3600);
if (interval > 1) {
  return interval + " hours ago";
}
interval = Math.floor(seconds / 60);
if (interval > 1) {
  return interval + " minutes ago";
}
return Math.floor(seconds) + " seconds  ago";
}

function getContent(type){
    var content = '';
    type.forEach(function(item, index) {
        var ts = new Date(item.timeStamp * 1000);
        var timestamp = moment(ts);
        content = content+ '<tr>';
        content = content+ '<td>';
        if(item.txreceipt_status=='0'){
            content = content + '<span class="red-star" style=" color: red;">*';
        }
        content = content+ '<a class="hash-width" href="#" id="singleContractTxn" onclick="getContract(this);">' + item.hash + '</a>';
        if(item.txreceipt_status=='0'){
            content = content + '</span>';
        }
        content = content+ '</td>';
        content = content+ '<td>';
        content = content+ item.blockNumber;
        content = content+ '</td>';
        content = content+ '<td>';
        content = content+  moment(ts).format("YYYY-MM-DD HH:mm:ss") + ' ('+ timeSince(ts)+ ')';
        content = content+ '</td>';
        content = content+ '</tr>';
    });
    return content;
}
    {{--Start Ajax Pagination--}}

    $("#contract_txn").click(function(){
        localStorage.setItem("activetab", "contract");
    });

    $("#token_txn").click(function(){
        localStorage.setItem("activetab", "token");
    });

    $(document).ready(function(){
        if(localStorage.getItem("activetab") == "contract"){
            $("#contract_txn").click();
        }else{
            $("#token_txn").click();
        }
    });
    {{--End Pagination--}}

    function getToken(a) {
        var hash = a.innerHTML;
        document.location.href = "/SingleTokenTransaction" + "/" + hash;
    }

    function getContract(a) {
        var hash = a.innerHTML;
        
        document.location.href = "/SingleContractTransaction" + "/" + hash;
    }


    function showContractTxn() {
        document.getElementById('contract').style.display = "block";
    }

    function showTokenTxn() {
        window.open("/TokenTransactions");

    }

    function myFunction() {
//        document.querySelector('data-clipboard-target="#copy-input-box"').value = 'Copied!';
//        document.querySelector('.btn_copy').value = 'Copied!';

//        var copyText = document.getElementById("contractadd");
//        copyText.select();
//        document.execCommand("copy");

    }

    function getContract(a) {
        var hash = a.innerHTML;
        document.location.href = "SingleContractTransaction" + "/" + hash;
    }

    //    Start Text Copy Tooltip

    $('button').tooltip({
        trigger: 'click',
        placement: 'bottom'
    });

    function setTooltip(btn, message) {
        btn.tooltip('hide')
            .attr('data-original-title', message)
            .tooltip('show');
    }

    function hideTooltip(btn) {
        setTimeout(function () {
            btn.tooltip('hide');
        }, 2000);
    }

    // Clipboard

    var clipboard = new Clipboard('button');

    clipboard.on('success', function (e) {
        var btn = $(e.trigger);
        setTooltip(btn, 'Copied!');
        hideTooltip(btn);
    });

    clipboard.on('error', function (e) {
        var btn = $(e.trigger);
        setTooltip('Failed!');
        hideTooltip(btn);
    });


</script>




<script>
    function myFunction() {
        var copyText = document.getElementById("contractadd");
        copyText.select();
        document.execCommand("copy");

    }
    //    Start Text Copy Tooltip

    $('button').tooltip({
        trigger: 'click',
        placement: 'bottom'
    });

    function setTooltip(btn, message) {
        btn.tooltip('hide')
            .attr('data-original-title', message)
            .tooltip('show');
    }

    function hideTooltip(btn) {
        setTimeout(function () {
            btn.tooltip('hide');
        }, 2000);
    }

    // Clipboard

    var clipboard = new Clipboard('button');

    clipboard.on('success', function (e) {
        var btn = $(e.trigger);
        setTooltip(btn, 'Copied!');
        hideTooltip(btn);
    });

    clipboard.on('error', function (e) {
        var btn = $(e.trigger);
        setTooltip('Failed!');
        hideTooltip(btn);
    });

    //    END Text Copy Tooltip

</script>
<script>
   



    function getToken(a) {
        var hash = a.innerHTML;
        document.location.href = "SingleTokenTransaction" + "/" + hash;
    }

    function getContract(a) {
        var hash = a.innerHTML;
        document.location.href = "SingleContractTransaction" + "/" + hash;
    }

    function getBlockCount() {
        $.ajax({
            type: "get",
            url: "get/block/count",
            datatype: "json",
            success: function (data) {
                $('.block-value').html(data);
                //console.log(data);
//            console.log(data.data);
                //do something with response data
            }
        });
    }

    function decodeInput(input){
        const abi = [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"approve","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"},{"name":"value","type":"uint256"}],"name":"MinterFunction","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"cap","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"unpause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"weiRaised","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"value","type":"uint256"}],"name":"burn","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isPauser","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newRate","type":"uint256"}],"name":"ChangeRate","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renouncePauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"value","type":"uint256"}],"name":"burnFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addPauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"_rate","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"pause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"renounceMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isMinter","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"beneficiary","type":"address"}],"name":"buyTokens","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_name","type":"string"},{"name":"_symbol","type":"string"},{"name":"_decimals","type":"uint8"},{"name":"_cap","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"purchaser","type":"address"},{"indexed":true,"name":"beneficiary","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"amount","type":"uint256"}],"name":"TokensPurchased","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"account","type":"address"}],"name":"Paused","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"account","type":"address"}],"name":"Unpaused","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"PauserAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"PauserRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"MinterAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"MinterRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"}];
        const decoder = new InputDataDecoder(abi);
        return decoder.decodeData(input);
    }


    function myFunction() {
        var copyText = document.getElementById("contractadd");
        copyText.select();
        document.execCommand("copy");
    }

    function showContractTxn() {
        window.open("/Transactions");

    }

    function getAccount(a) {
        var Account = a.innerHTML;
        document.location.href = "/SearchedAccountTransaction" + "/" + Account;

    }

    function getToken(a) {
        var hash = a.innerHTML;
        document.location.href = "/SingleTokenTransaction" + "/" + hash;
    }

    function getContract(a) {
        var hash = a.innerHTML;
        document.location.href = "/SingleContractTransaction" + "/" + hash;
    }


</script>



</body>
</html>
