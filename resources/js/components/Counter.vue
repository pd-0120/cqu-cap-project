<template>
    <div id="cogniFitContent"></div>
</template>

<script setup>
import { CognifitSdk } from '@cognifit/launcher-js-sdk';
import { CognifitSdkConfig } from '@cognifit/launcher-js-sdk/lib/lib/cognifit.sdk.config';

const clientId = "12312d014a761b6b2d871ed2ca6ecc0a";
const cognifitUserAccessToken = "GVoRX4BUC5bj37qUge1RaEaiRcOGHsmcIE7qAuGO";
const containerId = 'cogniFitContent';

const cognifitSdkConfig = new CognifitSdkConfig(
    containerId,
    clientId,
    cognifitUserAccessToken,
    {
        sandbox: false,
        appType: 'web',                 // 'web' or 'app'.
        theme: 'light',                 // 'light' or 'dark'.
        showResults: false,
        customCss: '',                  // Url to custom css file.
        screensNotToShow: [],           // List of screens not to show after the session.
        preferredMobileOrientation: '', // '' (empty), 'landscape' or 'portrait'. This applies only on mobile browsers or embedded webviews
        isFullscreenEnabled: true,      // Default true. If false the App will consider that the browser doesn't support fullscreen mode.
        scale: 100,                     // Default 800. Maximum value used to display values.
        listenEvents: true              // Default false. If true, events will be triggered during session life.
    }
);
const cognifitSdk = new CognifitSdk();
cognifitSdk.init(cognifitSdkConfig).then(response => {
    
    const typeValue = "GAME";
    const keyValue = "MAHJONG";

    cognifitSdk.start(
        typeValue,
        keyValue
    ).subscribe();
    
}).catch(error => {

});
</script>