<script setup>
import { ref } from 'vue'
import { CognifitSdk } from '@cognifit/launcher-js-sdk';
import { CognifitSdkConfig } from '@cognifit/launcher-js-sdk/lib/lib/cognifit.sdk.config';

const clientId = "12312d014a761b6b2d871ed2ca6ecc0a";
const cognifitUserAccessToken = "bcOqKr7Noo1p8egsgtJoypK4t4mALDT694WEWvkz";
const containerId = '#cogniFitContent';

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
    console.log("Response from Connifit API")
    console.log(response)
}).catch(error => {

});

const typeValue = "GAME";
const keyValue = "MAHJONG";

cognifitSdk.start(
    typeValue,
    keyValue
).subscribe({
    next: (cognifitSdkResponse) => {
        console.log("Test");
        if (cognifitSdkResponse.isSessionCompleted()) {
            cognifitSdkResponse.typeValue;
            cognifitSdkResponse.keyValue;
        }
        if (cognifitSdkResponse.isSessionAborted()) {
            console.log(isSessionAborted)
        }
        if (cognifitSdkResponse.isErrorLogin()) {
            console.log(isErrorLogin)
        }
        if (cognifitSdkResponse.isEvent()) {
            const eventPayloadValues = cognifitSdkResponse.eventPayload.getValues();
            console.log(eventPayloadValues)
        }
    },
    complete: (testComplete) => {
        console.log("🚀 ~ testComplete:", testComplete)
    },
    error: (reason) => {
        console.log("🚀 ~ reason:", reason)
    }
});

const errors = cognifitSdk.cognifitSdkError.getMessage()
console.log("🚀 ~ :68 ~ errors:", errors)


const count = ref(0)
</script>

<template>
    <div></div>
</template>