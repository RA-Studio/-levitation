<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?/*
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
*/?>
    <?/*if($arResult["AUTH_SERVICES"]):?>
        <div class="bx-auth-title"><?echo GetMessage("AUTH_TITLE")?></div>
    <?endif*/?>
<noindex>
	<!--<div class="bx-auth-note"><?/*=GetMessage("AUTH_PLEASE_AUTH")*/?></div>-->
        <form name="form_auth" id="lk-acc1" class="lk-tab active" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <?if (strlen($arResult["BACKURL"]) > 0):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>
            <label class="lk-tab__label" for="email">E-mail</label>
            <input class="lk-tab__input" type="text" id="email" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="" required="">
            <label class="lk-tab__label" for="password"><?=GetMessage("AUTH_PASSWORD")?></label>
            <input class="lk-tab__input" type="password" id="password" name="USER_PASSWORD" value="" placeholder="" required="">
            <?if($arResult["SECURE_AUTH"]):?>
                <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                        <div class="bx-auth-secure-icon"></div>
                                    </span>
                <noscript>
                                    <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                        <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                    </span>
                </noscript>
                <script type="text/javascript">
                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                </script>
            <?endif?>
            <?if($arResult["CAPTCHA_CODE"]):?>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></td>
                </tr>
                <tr>
                    <td class="bx-auth-label"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:</td>
                    <td><input class="bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" /></td>
                </tr>
            <?endif;?>
            <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
                <label for="USER_REMEMBER" class="lk-tab__rowlabel">&nbsp;
                    <input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />
                    <span></span>
                    <span><?=GetMessage("AUTH_REMEMBER_ME")?></span>
                </label>
                <!--<input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />
                <label for="USER_REMEMBER">&nbsp;<?/*=GetMessage("AUTH_REMEMBER_ME")*/?></label>-->
            <?endif?>
            <a href="/personal/forgot/<?//=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="lk-form__forgot" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
            <input type="submit" class="lk-tab__submit"  name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
            <?if($arResult["AUTH_SERVICES"]):?>
                <div class="lk-block__title">Можно войти через соц. сети</div>
                <svg class="lk-form_line" width="51" height="1" viewBox="0 0 51 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line y1="0.5" x2="51" y2="0.5" stroke="#747474"></line>
                </svg>
                <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "socAuth",
                    array(
                        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                        "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
                        "AUTH_URL" => $arResult["AUTH_URL"],
                        "POST" => $arResult["POST"],
                        "SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
                        "FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
                        "AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
                    ),
                    $component,
                    array("HIDE_ICONS"=>"N")
                );?>
            <?endif?>
        </form>
<?/*
        <form class="lk-tab active" id="lk-acc2">
            <label for="email" class="lk-tab__label">Email</label>
            <input type="text" class="lk-tab__input" name="email" id="email" placeholder="">
            <label for="pass" class="lk-tab__label">Пароль</label>
            <input type="text" class="lk-tab__input" name="pass" id="pass" placeholder="">
            <label for="remember" class="lk-tab__rowlabel">
                <input type="checkbox" id="remember" name="remember">
                <span></span>
                <span>Запомнить меня</span>
            </label>
            <button class="lk-tab__submit">Создать</button>
        </form>
        */?>

</noindex>
<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>
