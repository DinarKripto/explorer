<div class="footer">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-6 col-md-6">
                <div class="copy_right">
                    Copyright © 2020 Dinarkripto All Rights Reserved.
                </div>
            </div>
            <div class="col-xl-6 col-md-6 text-lg-right text-center">
                <div class="social">
                    <a target="_blank" href="https://www.linkedin.com/company/dinar-coin/about/?viewAsMember=true"><i class="fa fa-linkedin"></i></a>
                    <a target="_blank" href="https://www.instagram.com/dinarcoindnc/?igshid=1rpwjxub3dpod"><i class="fa fa-instagram"></i></a>
                    <a target="_blank" href="https://twitter.com/dinar_coin"><i class="fa fa-twitter"></i></a>
                    <a target="_blank" href="https://www.reddit.com/user/DinarCoin_official"><i class="fa fa-reddit"></i></a>
                    <a target="_blank" href="https://www.facebook.com/DinarCoinDD/"><i class="fa fa-facebook"></i></a>
                    <a target="_blank" href="https://www.quora.com/profile/Nur-Ezdiani-Baharoddin"><i class="fa fa-quora"></i></a>
                    <a target="_blank" href="https://medium.com/@dinarcoinoffiicial"><i class="fa fa-medium"></i></a>
                    <a target="_blank" href="https://t.me/dinarcoin_official"><i class="fa fa-telegram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<script src="/vendors/vendor/jquery/jquery.min.js"></script>
<script src="/vendors/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/vendors/vendor/waves/waves.min.js"></script>

<!--    <script src="vendor/toastr/toastr.min.js"></script>-->
<!--    <script src="vendor/toastr/toastr-init.js"></script>-->

<script src="/vendors/vendor/circle-progress/circle-progress.min.js"></script>
<script src="/vendors/vendor/circle-progress/circle-progress-init.js"></script>


<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/dark.js"></script>



<!-- <script src="./js/dashboard.js"></script> -->

<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
<script src="{!! asset('/js/app.js') !!}"></script>
<script src="/vendors/js/scripts.js"></script>

<script>
        
    function search(e, ele) {
        if (e.keyCode === 13) {
            if (ele.value.length == '42') {
                document.location.href = "/SearchedAccountTransaction" + "/" + ele.value;
            } else if (ele.value.startsWith("0x")) {
                document.location.href = "/SearchedHashTransaction" + "/" + ele.value;
            } else if (ele.value.length <= '9') {
                document.location.href = "/SearchedBlockTransaction" + "/" + ele.value;
            }
        }
    }


</script>

