// detect browser from user agent string

const userAgent = navigator.userAgent;
let browser = "Unknown";

function getBrowser() {

    switch (true) {
    case userAgent.includes("Edg/"):
        browser = "Edge";
        break;
    case userAgent.includes("OPR/"):
        browser = "Opera";
        break;
    case userAgent.includes("Firefox/"):
        browser = "Firefox";
        break;
    case userAgent.includes("Chrome/"):
        browser = "Chrome";
        break;
    case userAgent.includes("Safari/"):
        browser = "Safari";
        break;
    case userAgent.includes("Brave/"):
        browser = "Brave";
        break;
    }
}
getBrowser();
console.log(browser);