<?php

function gravatar_url($email) {
    return "https://gravatar.com/avatar/".md5($email)."?s=60&d=https://leagui.ru/img/32.png";
}