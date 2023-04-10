# Tenda F3 API

[<img src="img/logo.png" width="500"/>](img/logo.png)

---

*Developed by C.A Torino, TECHRAD Radical Technology*
* Links to TECHRAD ZA.
    * [Website](https://www.techrad.co.za)
    * [Tutorial website](https://tutorials.techrad.co.za)
    * [Support website](https://support.techrad.co.za)
    * [API](https://www.techrad.co.za/apisource/public/apps/fusio)

# Summary

Tested on F3 firmware version: `V12.01.01.52_multi`

API doc containing endpoints that can be called to leverage the Tenda F3 WiFi extender router.

These endpoints all run on the localhost `192.168.8.1` as an example.

- Usage examples: 
    - Automation scripts (run a routine)
    - Trigger events (if else etc.)
    - Automated logging (monitor specifics in your DIY script)
    - Send data to an endpoint that reaches out to the internet (reboot over internet securely)

# Index
- Summary
- Index
- Usage Examples
- Endpoint API Calls
    - Auth
    - sysReboot

# Usage Examples

JS example using `XMLHttpRequest()` to call `curl.php`

```JS
 var pass = "pass_here";
 var psd = base64_encode(pass);
 var ecos_pw = "";
 Auth(psd);

function AuthSuccess(response,Cookie) {
  console.log('AuthSuccess: '+response);
  const mo = JSON.parse(Cookie);
  ecos_pw = mo.Cookie;
  console.log('Cookie: '+Cookie);
  document.getElementById('cookie2').innerHTML = ecos_pw;
  sysReboot(ecos_pw);
}

function Auth(psd) {
  var postdata = 'password='+psd;
  var xhr = new XMLHttpRequest();
  xhr.onerror = error;
  xhr.open('POST', 'http://127.0.0.1/f3/curl.php?data=POST&url=http://192.168.8.102/login/Auth&postdata='+postdata, true);
  xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
        var response = xhr.responseText;
        var Cookie = xhr.getResponseHeader("Cookie");
        //var contentType =xhr.getAllResponseHeaders();
        AuthSuccess(response,Cookie);
        }
    }
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
  xhr.send(null);
}
```


# Endpoint API Calls

## 1. Auth

`Get Auth` [*Auth and login to router*]

-------------------

### Calling Parameters (Input)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`password`      |string |Https      |d2FsYWxhd2FzYWxh |

```
password=d2FsYWxhd2FzYWxh
```

### Interface Address

http://192.168.8.118/login/Auth

### Request Method

- HTTP 
- POST

### Response Parameters (Output)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`ecos_pw`            |string      |Https        |d2FsYWxhd2FzYWxh1qw  |
|`language`            |string      |Https        |cn                  |

```
Set-Cookie: ecos_pw=d2FsYWxhd2FzYWxh1qw:language=cn; path=/
```

### Example:

- Returned data: HTTP/1.0 302 Redirect
   - Set-Cookie: ecos_pw=d2FsYWxhd2FzYWxh1qw:language=cn; path=/
   - Location: http://192.168.8.118/index.html
- Example: 
   - ecos_pw
   - language
   - path

### Response Result Example
```JSON
No JSON
```

---
---
---

## 2. loginOut

`logout` [*logout of the router*]

-------------------

### Calling Parameters (Input)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`action`      |string |Https      |loginout |

```
action=loginout
```

### Interface Address

http://192.168.8.118/goform/loginOut

### Request Method

- HTTP 
- POST

### Response Parameters (Output)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`errCode`            |int      |Https        |0  |
|`language`            |string      |Https        |cn                  |
|`bLanguage`            |string      |Https        |en                 |
|`ecos_pw`            |string      |Https        |d2FsYWxhd2FzYWxhbcx  |

```
Cookie: bLanguage=en; ecos_pw=d2FsYWxhd2FzYWxhbcx:language=cn
```

### Example:

- Returned data: HTTP/1.0 200 OK
   - Cookie: bLanguage=en; ecos_pw=d2FsYWxhd2FzYWxhbcx:language=cn
   - Content-Type: application/x-www-form-urlencoded;
- Example: 
   - ecos_pw
   - language
   - bLanguage
   - errCode

### Response Result Example
```JSON
{"errCode":"0"}
```

---
---
---

## 3. getHomePageInfo

`Get getHomePageInfo` [*Get the home page info*]

-------------------

### Calling Parameters (Input)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`NULL`      |NULL |NULL      |NULL |

### Interface Address

http://192.168.8.118/goform/getHomePageInfo

### Request Method

- HTTP 
- GET

### Response Parameters (Output)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`hasLoginPwd`            |bool      |Https        |true                   |
|`username`            |string      |Https        |admin                          |
|`wifiRelayType`            |string      |Https        |client+ap   |
|`wifiRelaySSID`            |string      |Https        |name1   |
|`upperWifiSsid`            |string      |Https        |name1   |
|`extenderSsid`            |string      |Https        |name2   |
|`extenderPwd`            |string      |Https        |wifi_password   |
|`wifiRelayChannel`            |int      |Https        |6   |
|`wifiRelaySecurityMode`            |string      |Https        |wpawpa2/AES   |
|`wifiRelayPwd`            |string      |Https        |wifi_password   |
|`wifiRelayConnectStatus`            |string      |Https        |bridgeSuccess   |
|`connectState`            |string      |Https        |bridgeSuccess   |
|`connectDuration`            |int      |Https        |0   |

```
Cookie: bLanguage=en; ecos_pw=d2FsYWxhd2FzYWxhbcx:language=cn
```

### Example:

- Returned data: HTTP/1.1 200 OK
   - Cookie: bLanguage=en; ecos_pw=d2FsYWxhd2FzYWxh1qw:language=cn
   - Content-type: text/plain; charset=utf-8
- Example: 
   - hasLoginPwd          
   - username
   - wifiRelayType
   - wifiRelaySSID
   - upperWifiSsid  
   - extenderSsid       
   - extenderPwd     
   - wifiRelayChannel
   - wifiRelaySecurityMode
   - wifiRelayPwd      
   - wifiRelayConnectStatus
   - connectState  
   - connectDuration

### Response Result Example
```JSON
{
   "loginAuth":{
      "hasLoginPwd":"true",
      "username ":"admin"
   },
   "wifiRelay":{
      "wifiRelayType":"client+ap",
      "wifiRelaySSID":"name1",
      "upperWifiSsid":"name1",
      "extenderSsid":"name2",
      "extenderPwd":"wifi_password",
      "wifiRelayChannel":"6",
      "wifiRelaySecurityMode":"wpawpa2/AES",
      "wifiRelayPwd":"wifi_password",
      "wifiRelayConnectStatus":"bridgeSuccess",
      "connectState":"bridgeSuccess",
      "connectDuration":"0"
   }
}
```

---
---
---

## 4. getStatus

`Get Status` [*gets the Status*]

-------------------

### Calling Parameters (Input)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`NULL`      |NULL |NULL      |NULL |

### Interface Address

http://192.168.8.118/goform/getStatus

### Request Method

- HTTP 
- GET

### Response Parameters (Output)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`wanConnectStatus`    |string      |Https        |13022040  |
|`newLanIP`            |string      |Https        |255.255.255.255   |
|`lanWanIPConflict`    |string      |Https        |false   |
|`wifiRelayType`       |string      |Https        |client+ap   |
|`wifiRelaySSID`       |string      |Https        |name1   |
|`upperWifiSsid`       |string      |Https        |name1   |
|`extenderSsid`        |string      |Https        |name2   |
|`extenderPwd`         |string      |Https        |wifi_password   |
|`wifiRelayChannel`         |string      |Https        |6   |
|`wifiRelaySecurityMode`    |string      |Https        |wpawpa2/AES   |
|`wifiRelayPwd`             |string      |Https        |wifi_password   |
|`wifiRelayConnectStatus`   |string      |Https        |bridgeSuccess   |
|`connectState`             |string      |Https        |bridgeSuccess   |
|`connectDuration`          |string      |Https        |0   |

```
Cookie: bLanguage=en; ecos_pw=d2FsYWxhd2FzYWxhbcx:language=cn
```

### Example:

- Returned data: HTTP/1.1 200 OK
   - Content-type: text/plain; charset=utf-8

### Response Result Example
```JSON
{
   "internetStatus":{
      "wanConnectStatus":"13022040",
      "newLanIP":"255.255.255.255",
      "lanWanIPConflict":"false"
   },
   "wifiRelay":{
      "wifiRelayType":"client+ap",
      "wifiRelaySSID":"name1",
      "upperWifiSsid":"name1",
      "extenderSsid":"name2",
      "extenderPwd":"wifi_password",
      "wifiRelayChannel":"6",
      "wifiRelaySecurityMode":"wpawpa2/AES",
      "wifiRelayPwd":"wifi_password",
      "wifiRelayConnectStatus":"bridgeSuccess",
      "connectState":"bridgeSuccess",
      "connectDuration":"0"
   }
}
```

---
---
---

## 5. loginOut

`Get Status` [*Get Status*]

-------------------

### Calling Parameters (Input)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`NULL`      |NULL |NULL      |NULL |

### Interface Address

http://192.168.8.118/goform/getStatus

### Request Method

- HTTP 
- GET

### Response Parameters (Output)
| Parameter  |  Mode  | Description  | example values  |
| :------------ | :------------ | :------------ | :------------ |
|`null`            |string      |Https        |Cape Town                   |
|`null`            |string      |Https        |1                           |
|`null`            |string      |Https        |null   |
|`null`            |string      |Https        |null   |

### Example:

- Returned data: 
   - data
- Example: 
   - data
   - data

### Response Result Example
```JSON
{
   "internetStatus":{
      "wanConnectStatus":"13022040",
      "newLanIP":"255.255.255.255",
      "lanWanIPConflict":"false"
   },
   "deviceStastics":{
      "statusOnlineNumber":"0",
      "statusBlackNum":"0",
      "statusUpSpeed":"0",
      "statusDownSpeed":"0",
      "wifiRate":"-55",
      "routerName":"name1",
      "extendName":"name2"
   },
   "systemInfo":{
      "wanConnectTime":"0",
      "wanType":"dhcp",
      "statusWanMAC":"50:0F:F5:AE:23:F8",
      "macHost":"04:D9:F5:38:7A:CD",
      "lanIP":"192.168.0.1",
      "statusWanMask":"0.0.0.0",
      "statusWanIP":"0.0.0.0",
      "statusWanGaterway":"0.0.0.0",
      "statusWanDns1":"",
      "statusWanDns2":"",
      "softVersion":"V12.01.01.52_multi"
   },
   "wanAdvCfg":{
      "wanServerName":"",
      "wanServiceName":"",
      "wanType":"dhcp",
      "wanMTU":"1500",
      "wanMTUCurrent":"1500",
      "wanSpeed":"Auto",
      "wanSpeedCurrent":"100",
      "macClone":"default",
      "macRouter":"50:0F:F5:AE:23:F8",
      "macWifiDevice":"false",
      "macHost":"04:D9:F5:38:7A:CD",
      "macCurrentWan":"50:0F:F5:AE:23:F8"
   },
   "wifiRelay":{
      "wifiRelayType":"client+ap",
      "wifiRelaySSID":"name1",
      "upperWifiSsid":"name1",
      "extenderSsid":"name2",
      "extenderPwd":"wifi_password",
      "wifiRelayChannel":"6",
      "wifiRelaySecurityMode":"wpawpa2/AES",
      "wifiRelayPwd":"wifi_password",
      "wifiRelayConnectStatus":"bridgeSuccess",
      "connectState":"bridgeSuccess",
      "connectDuration":"0"
   }
}
```

---
---
---