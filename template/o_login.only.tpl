({ext_include file="inc_header.tpl" INC_HEADER_is_login=true})

<div id="container_login"><div class="w_screen">

<!-- <img src="({t_img_url_skin filename=skin_login})" class="bg"> -->

({if $top_banner_html_before || $top_banner_html_after})
<div class="banner">
({$top_banner_html_before|smarty:nodefaults})
</div>
({elseif $INC_PAGE_HEADER.c_banner_id})
<div class="banner">
({strip})
({if $INC_PAGE_HEADER.a_href})
    <a href="({t_url m=pc a=do_o_click_banner})&amp;target_c_banner_id=({$INC_PAGE_HEADER.c_banner_id})" target="_blank">
        <img src="({t_img_url filename=$INC_PAGE_HEADER.image_filename})">
    </a>
({else})
    <img src="({t_img_url filename=$INC_PAGE_HEADER.image_filename})">
({/if})
({/strip})
</div>
({/if})

<div class="msg lh_130"><br>
<a style="font-size:1.5em; font-weight:bold; font-family:monospace;" href="({$smarty.const.OPENPNE_SSL_URL})shibboleth/({$requests.login_params})">Shibbolethをつかう</a>
({if $SSL_SELECT_URL})
<br><a href="({$SSL_SELECT_URL})">({if $HTTPS})標準(http)({else})SSL(https)({/if})はこちら</a>
({/if})
</div>
</form>
<div class="footer">

({$inc_page_footer|smarty:nodefaults})

</div>

</div></div>

({ext_include file="inc_footer.tpl" INC_FOOTER_is_login=true})
