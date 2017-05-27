
<style>
@media(max-width:499px){ .popup_ck { display: none; } }
</style>
<div class="popup_ck">
    <div class="popup_float">
        <a href="javascript:" onclick="popup_ads();" rel="nofollow">Tắt thông báo- X</a>
    </div>
    <div class="content_popup" id="content_popup">
    </div>
</div>

<script>
    function popup_ads()
    {
        if($('#content_popup').is(':hidden')){
            $('#content_popup').show();
        }
        else {
            $('#content_popup').hide();
        }
    }
</script>