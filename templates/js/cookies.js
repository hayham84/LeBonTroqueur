document.addEventListener("DOMContentLoaded", function () {
    if (!getCookie('cookie_consent')) {
        document.getElementById('cookieConsent').style.display = 'block';
    }

    document.getElementById('acceptCookies').addEventListener('click', function () {
        
        setCookie('cookie_consent', 'all', 365);
        document.getElementById('cookieConsent').style.display = 'none';
        
        window.location.reload();
    });
    
    document.getElementById('acceptEssentials').addEventListener('click', function () {
        setCookie('cookie_consent', 'essentials', 365);
        document.getElementById('cookieConsent').style.display = 'none';
        window.location.reload();
    })

    document.getElementById('customizeCookies').addEventListener('click', function () {
        setCookie('cookie_consent', 'personalized', 365);
        document.getElementById('cookieConsent').style.display = 'none';
        window.location.href = 'cookie-settings';
    });

    const selectElement = document.getElementById("bgColorSelect");

    selectElement.addEventListener("change", function () {
        const selectedColor = selectElement.value;
        setCookie("bg_color", selectedColor, 365);
        // Recharge la page pour appliquer la nouvelle couleur
        window.location.reload();
    });
});

function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

