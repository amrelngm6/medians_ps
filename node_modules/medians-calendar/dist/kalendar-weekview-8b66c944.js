import { i as isWeekend, a as isToday, g as getLocaleTime, b as _objectSpread2, c as cloneObject, d as __vue_normalize__, e as __vue_create_injector__, f as isBefore, h as getHourlessDate, j as addTimezoneInfo, k as _asyncToGenerator, l as _regeneratorRuntime } from './index-da933847.js';
import 'axios';
import 'vue';

function PromiseWorker (worker) {
  var messageIds = 0;
  var callbacks = {};
  worker.addEventListener("message", function (e) {
    return onMessage(e);
  });
  var onMessage = function onMessage(e) {
    var message = e.data;
    if (!Array.isArray(message) || message.length < 2) {
      return;
    }
    var messageId = message[0];
    var error = message[1];
    var result = message[2];
    var callback = callbacks[messageId];
    if (!callback) return;
    delete callbacks[messageId];
    callback(error, result);
  };
  return {
    initiateWorker: function initiateWorker(_worker) {},
    postMessage: function postMessage(userMessage) {
      var messageId = messageIds++;
      var messageToSend = [messageId, userMessage];
      return new Promise(function (resolve, reject) {
        callbacks[messageId] = function (error, result) {
          if (error) return reject(new Error(error.message));
          resolve(result);
        };
        if (typeof worker.controller !== "undefined") {
          // service worker, use MessageChannels because e.source is broken in Chrome < 51:
          // https://bugs.chromium.org/p/chromium/issues/detail?id=543198
          var channel = new MessageChannel();
          channel.port1.onmessage = function (e) {
            onMessage(e);
          };
          worker.controller.postMessage(messageToSend, [channel.port2]);
        } else {
          // web worker
          worker.postMessage(messageToSend);
        }
      });
    }
  };
}

const kIsNodeJS = Object.prototype.toString.call(typeof process !== 'undefined' ? process : 0) === '[object process]';
const kRequire = kIsNodeJS && typeof module.require === 'function' ? module.require : null; // eslint-disable-line

function browserDecodeBase64(base64, enableUnicode) {
    const binaryString = atob(base64);
    if (enableUnicode) {
        const binaryView = new Uint8Array(binaryString.length);
        Array.prototype.forEach.call(binaryView, (el, idx, arr) => {
            arr[idx] = binaryString.charCodeAt(idx);
        });
        return String.fromCharCode.apply(null, new Uint16Array(binaryView.buffer));
    }
    return binaryString;
}

function nodeDecodeBase64(base64, enableUnicode) {
    return Buffer.from(base64, 'base64').toString(enableUnicode ? 'utf16' : 'utf8');
}

function createBase64WorkerFactory(base64, sourcemap = null, enableUnicode = false) {
    const source = kIsNodeJS ? nodeDecodeBase64(base64, enableUnicode) : browserDecodeBase64(base64, enableUnicode);
    const start = source.indexOf('\n', 10) + 1;
    const body = source.substring(start) + (sourcemap ? `\/\/# sourceMappingURL=${sourcemap}` : '');

    if (kRequire) {
        /* node.js */
        const Worker = kRequire('worker_threads').Worker; // eslint-disable-line
        return function WorkerFactory(options) {
            return new Worker(body, Object.assign({}, options, { eval: true }));
        };
    }

    /* browser */
    const blob = new Blob([body], { type: 'application/javascript' });
    const url = URL.createObjectURL(blob);
    return function WorkerFactory(options) {
        return new Worker(url, options);
    };
}

/* eslint-disable */
var WorkerFactory = createBase64WorkerFactory('Lyogcm9sbHVwLXBsdWdpbi13ZWItd29ya2VyLWxvYWRlciAqLwpmdW5jdGlvbiBfaXRlcmFibGVUb0FycmF5TGltaXQoYXJyLCBpKSB7CiAgdmFyIF9pID0gbnVsbCA9PSBhcnIgPyBudWxsIDogInVuZGVmaW5lZCIgIT0gdHlwZW9mIFN5bWJvbCAmJiBhcnJbU3ltYm9sLml0ZXJhdG9yXSB8fCBhcnJbIkBAaXRlcmF0b3IiXTsKICBpZiAobnVsbCAhPSBfaSkgewogICAgdmFyIF9zLAogICAgICBfZSwKICAgICAgX3gsCiAgICAgIF9yLAogICAgICBfYXJyID0gW10sCiAgICAgIF9uID0gITAsCiAgICAgIF9kID0gITE7CiAgICB0cnkgewogICAgICBpZiAoX3ggPSAoX2kgPSBfaS5jYWxsKGFycikpLm5leHQsIDAgPT09IGkpIHsKICAgICAgICBpZiAoT2JqZWN0KF9pKSAhPT0gX2kpIHJldHVybjsKICAgICAgICBfbiA9ICExOwogICAgICB9IGVsc2UgZm9yICg7ICEoX24gPSAoX3MgPSBfeC5jYWxsKF9pKSkuZG9uZSkgJiYgKF9hcnIucHVzaChfcy52YWx1ZSksIF9hcnIubGVuZ3RoICE9PSBpKTsgX24gPSAhMCk7CiAgICB9IGNhdGNoIChlcnIpIHsKICAgICAgX2QgPSAhMCwgX2UgPSBlcnI7CiAgICB9IGZpbmFsbHkgewogICAgICB0cnkgewogICAgICAgIGlmICghX24gJiYgbnVsbCAhPSBfaS5yZXR1cm4gJiYgKF9yID0gX2kucmV0dXJuKCksIE9iamVjdChfcikgIT09IF9yKSkgcmV0dXJuOwogICAgICB9IGZpbmFsbHkgewogICAgICAgIGlmIChfZCkgdGhyb3cgX2U7CiAgICAgIH0KICAgIH0KICAgIHJldHVybiBfYXJyOwogIH0KfQpmdW5jdGlvbiBvd25LZXlzKG9iamVjdCwgZW51bWVyYWJsZU9ubHkpIHsKICB2YXIga2V5cyA9IE9iamVjdC5rZXlzKG9iamVjdCk7CiAgaWYgKE9iamVjdC5nZXRPd25Qcm9wZXJ0eVN5bWJvbHMpIHsKICAgIHZhciBzeW1ib2xzID0gT2JqZWN0LmdldE93blByb3BlcnR5U3ltYm9scyhvYmplY3QpOwogICAgZW51bWVyYWJsZU9ubHkgJiYgKHN5bWJvbHMgPSBzeW1ib2xzLmZpbHRlcihmdW5jdGlvbiAoc3ltKSB7CiAgICAgIHJldHVybiBPYmplY3QuZ2V0T3duUHJvcGVydHlEZXNjcmlwdG9yKG9iamVjdCwgc3ltKS5lbnVtZXJhYmxlOwogICAgfSkpLCBrZXlzLnB1c2guYXBwbHkoa2V5cywgc3ltYm9scyk7CiAgfQogIHJldHVybiBrZXlzOwp9CmZ1bmN0aW9uIF9vYmplY3RTcHJlYWQyKHRhcmdldCkgewogIGZvciAodmFyIGkgPSAxOyBpIDwgYXJndW1lbnRzLmxlbmd0aDsgaSsrKSB7CiAgICB2YXIgc291cmNlID0gbnVsbCAhPSBhcmd1bWVudHNbaV0gPyBhcmd1bWVudHNbaV0gOiB7fTsKICAgIGkgJSAyID8gb3duS2V5cyhPYmplY3Qoc291cmNlKSwgITApLmZvckVhY2goZnVuY3Rpb24gKGtleSkgewogICAgICBfZGVmaW5lUHJvcGVydHkodGFyZ2V0LCBrZXksIHNvdXJjZVtrZXldKTsKICAgIH0pIDogT2JqZWN0LmdldE93blByb3BlcnR5RGVzY3JpcHRvcnMgPyBPYmplY3QuZGVmaW5lUHJvcGVydGllcyh0YXJnZXQsIE9iamVjdC5nZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3JzKHNvdXJjZSkpIDogb3duS2V5cyhPYmplY3Qoc291cmNlKSkuZm9yRWFjaChmdW5jdGlvbiAoa2V5KSB7CiAgICAgIE9iamVjdC5kZWZpbmVQcm9wZXJ0eSh0YXJnZXQsIGtleSwgT2JqZWN0LmdldE93blByb3BlcnR5RGVzY3JpcHRvcihzb3VyY2UsIGtleSkpOwogICAgfSk7CiAgfQogIHJldHVybiB0YXJnZXQ7Cn0KZnVuY3Rpb24gX3R5cGVvZihvYmopIHsKICAiQGJhYmVsL2hlbHBlcnMgLSB0eXBlb2YiOwoKICByZXR1cm4gX3R5cGVvZiA9ICJmdW5jdGlvbiIgPT0gdHlwZW9mIFN5bWJvbCAmJiAic3ltYm9sIiA9PSB0eXBlb2YgU3ltYm9sLml0ZXJhdG9yID8gZnVuY3Rpb24gKG9iaikgewogICAgcmV0dXJuIHR5cGVvZiBvYmo7CiAgfSA6IGZ1bmN0aW9uIChvYmopIHsKICAgIHJldHVybiBvYmogJiYgImZ1bmN0aW9uIiA9PSB0eXBlb2YgU3ltYm9sICYmIG9iai5jb25zdHJ1Y3RvciA9PT0gU3ltYm9sICYmIG9iaiAhPT0gU3ltYm9sLnByb3RvdHlwZSA/ICJzeW1ib2wiIDogdHlwZW9mIG9iajsKICB9LCBfdHlwZW9mKG9iaik7Cn0KZnVuY3Rpb24gX2RlZmluZVByb3BlcnR5KG9iaiwga2V5LCB2YWx1ZSkgewogIGtleSA9IF90b1Byb3BlcnR5S2V5KGtleSk7CiAgaWYgKGtleSBpbiBvYmopIHsKICAgIE9iamVjdC5kZWZpbmVQcm9wZXJ0eShvYmosIGtleSwgewogICAgICB2YWx1ZTogdmFsdWUsCiAgICAgIGVudW1lcmFibGU6IHRydWUsCiAgICAgIGNvbmZpZ3VyYWJsZTogdHJ1ZSwKICAgICAgd3JpdGFibGU6IHRydWUKICAgIH0pOwogIH0gZWxzZSB7CiAgICBvYmpba2V5XSA9IHZhbHVlOwogIH0KICByZXR1cm4gb2JqOwp9CmZ1bmN0aW9uIF9zbGljZWRUb0FycmF5KGFyciwgaSkgewogIHJldHVybiBfYXJyYXlXaXRoSG9sZXMoYXJyKSB8fCBfaXRlcmFibGVUb0FycmF5TGltaXQoYXJyLCBpKSB8fCBfdW5zdXBwb3J0ZWRJdGVyYWJsZVRvQXJyYXkoYXJyLCBpKSB8fCBfbm9uSXRlcmFibGVSZXN0KCk7Cn0KZnVuY3Rpb24gX2FycmF5V2l0aEhvbGVzKGFycikgewogIGlmIChBcnJheS5pc0FycmF5KGFycikpIHJldHVybiBhcnI7Cn0KZnVuY3Rpb24gX3Vuc3VwcG9ydGVkSXRlcmFibGVUb0FycmF5KG8sIG1pbkxlbikgewogIGlmICghbykgcmV0dXJuOwogIGlmICh0eXBlb2YgbyA9PT0gInN0cmluZyIpIHJldHVybiBfYXJyYXlMaWtlVG9BcnJheShvLCBtaW5MZW4pOwogIHZhciBuID0gT2JqZWN0LnByb3RvdHlwZS50b1N0cmluZy5jYWxsKG8pLnNsaWNlKDgsIC0xKTsKICBpZiAobiA9PT0gIk9iamVjdCIgJiYgby5jb25zdHJ1Y3RvcikgbiA9IG8uY29uc3RydWN0b3IubmFtZTsKICBpZiAobiA9PT0gIk1hcCIgfHwgbiA9PT0gIlNldCIpIHJldHVybiBBcnJheS5mcm9tKG8pOwogIGlmIChuID09PSAiQXJndW1lbnRzIiB8fCAvXig/OlVpfEkpbnQoPzo4fDE2fDMyKSg/OkNsYW1wZWQpP0FycmF5JC8udGVzdChuKSkgcmV0dXJuIF9hcnJheUxpa2VUb0FycmF5KG8sIG1pbkxlbik7Cn0KZnVuY3Rpb24gX2FycmF5TGlrZVRvQXJyYXkoYXJyLCBsZW4pIHsKICBpZiAobGVuID09IG51bGwgfHwgbGVuID4gYXJyLmxlbmd0aCkgbGVuID0gYXJyLmxlbmd0aDsKICBmb3IgKHZhciBpID0gMCwgYXJyMiA9IG5ldyBBcnJheShsZW4pOyBpIDwgbGVuOyBpKyspIGFycjJbaV0gPSBhcnJbaV07CiAgcmV0dXJuIGFycjI7Cn0KZnVuY3Rpb24gX25vbkl0ZXJhYmxlUmVzdCgpIHsKICB0aHJvdyBuZXcgVHlwZUVycm9yKCJJbnZhbGlkIGF0dGVtcHQgdG8gZGVzdHJ1Y3R1cmUgbm9uLWl0ZXJhYmxlIGluc3RhbmNlLlxuSW4gb3JkZXIgdG8gYmUgaXRlcmFibGUsIG5vbi1hcnJheSBvYmplY3RzIG11c3QgaGF2ZSBhIFtTeW1ib2wuaXRlcmF0b3JdKCkgbWV0aG9kLiIpOwp9CmZ1bmN0aW9uIF90b1ByaW1pdGl2ZShpbnB1dCwgaGludCkgewogIGlmICh0eXBlb2YgaW5wdXQgIT09ICJvYmplY3QiIHx8IGlucHV0ID09PSBudWxsKSByZXR1cm4gaW5wdXQ7CiAgdmFyIHByaW0gPSBpbnB1dFtTeW1ib2wudG9QcmltaXRpdmVdOwogIGlmIChwcmltICE9PSB1bmRlZmluZWQpIHsKICAgIHZhciByZXMgPSBwcmltLmNhbGwoaW5wdXQsIGhpbnQgfHwgImRlZmF1bHQiKTsKICAgIGlmICh0eXBlb2YgcmVzICE9PSAib2JqZWN0IikgcmV0dXJuIHJlczsKICAgIHRocm93IG5ldyBUeXBlRXJyb3IoIkBAdG9QcmltaXRpdmUgbXVzdCByZXR1cm4gYSBwcmltaXRpdmUgdmFsdWUuIik7CiAgfQogIHJldHVybiAoaGludCA9PT0gInN0cmluZyIgPyBTdHJpbmcgOiBOdW1iZXIpKGlucHV0KTsKfQpmdW5jdGlvbiBfdG9Qcm9wZXJ0eUtleShhcmcpIHsKICB2YXIga2V5ID0gX3RvUHJpbWl0aXZlKGFyZywgInN0cmluZyIpOwogIHJldHVybiB0eXBlb2Yga2V5ID09PSAic3ltYm9sIiA/IGtleSA6IFN0cmluZyhrZXkpOwp9CgovL3RvZG86IHJlbW92ZSB0aGlzIGFuZCBmb3JrIHByb21pc2Utd29ya2VyIHRvIHByb3ZpZGUgRVNNCmZ1bmN0aW9uIGlzUHJvbWlzZShvYmopIHsKICAvLyB2aWEgaHR0cHM6Ly91bnBrZy5jb20vaXMtcHJvbWlzZUAyLjEuMC9pbmRleC5qcwogIHJldHVybiAhIW9iaiAmJiAoX3R5cGVvZihvYmopID09PSAib2JqZWN0IiB8fCB0eXBlb2Ygb2JqID09PSAiZnVuY3Rpb24iKSAmJiB0eXBlb2Ygb2JqLnRoZW4gPT09ICJmdW5jdGlvbiI7Cn0KZnVuY3Rpb24gcmVnaXN0ZXJQcm9taXNlV29ya2VyIChjYWxsYmFjaykgewogIGZ1bmN0aW9uIHBvc3RPdXRnb2luZ01lc3NhZ2UoZSwgbWVzc2FnZUlkLCBlcnJvciwgcmVzdWx0KSB7CiAgICBmdW5jdGlvbiBwb3N0TWVzc2FnZShtc2cpIHsKICAgICAgLyogaXN0YW5idWwgaWdub3JlIGlmICovCiAgICAgIGlmICh0eXBlb2Ygc2VsZi5wb3N0TWVzc2FnZSAhPT0gImZ1bmN0aW9uIikgewogICAgICAgIC8vIHNlcnZpY2Ugd29ya2VyCiAgICAgICAgZS5wb3J0c1swXS5wb3N0TWVzc2FnZShtc2cpOwogICAgICB9IGVsc2UgewogICAgICAgIC8vIHdlYiB3b3JrZXIKICAgICAgICBzZWxmLnBvc3RNZXNzYWdlKG1zZyk7CiAgICAgIH0KICAgIH0KICAgIGlmIChlcnJvcikgewogICAgICBwb3N0TWVzc2FnZShbbWVzc2FnZUlkLCB7CiAgICAgICAgbWVzc2FnZTogZXJyb3IubWVzc2FnZQogICAgICB9XSk7CiAgICB9IGVsc2UgewogICAgICBwb3N0TWVzc2FnZShbbWVzc2FnZUlkLCBudWxsLCByZXN1bHRdKTsKICAgIH0KICB9CiAgZnVuY3Rpb24gdHJ5Q2F0Y2hGdW5jKGNhbGxiYWNrLCBtZXNzYWdlKSB7CiAgICB0cnkgewogICAgICByZXR1cm4gewogICAgICAgIHJlczogY2FsbGJhY2sobWVzc2FnZSkKICAgICAgfTsKICAgIH0gY2F0Y2ggKGUpIHsKICAgICAgcmV0dXJuIHsKICAgICAgICBlcnI6IGUKICAgICAgfTsKICAgIH0KICB9CiAgZnVuY3Rpb24gaGFuZGxlSW5jb21pbmdNZXNzYWdlKGUsIGNhbGxiYWNrLCBtZXNzYWdlSWQsIG1lc3NhZ2UpIHsKICAgIHZhciByZXN1bHQgPSB0cnlDYXRjaEZ1bmMoY2FsbGJhY2ssIG1lc3NhZ2UpOwogICAgaWYgKHJlc3VsdC5lcnIpIHsKICAgICAgcG9zdE91dGdvaW5nTWVzc2FnZShlLCBtZXNzYWdlSWQsIHJlc3VsdC5lcnIpOwogICAgfSBlbHNlIGlmICghaXNQcm9taXNlKHJlc3VsdC5yZXMpKSB7CiAgICAgIHBvc3RPdXRnb2luZ01lc3NhZ2UoZSwgbWVzc2FnZUlkLCBudWxsLCByZXN1bHQucmVzKTsKICAgIH0gZWxzZSB7CiAgICAgIHJlc3VsdC5yZXMudGhlbihmdW5jdGlvbiAoZmluYWxSZXN1bHQpIHsKICAgICAgICBwb3N0T3V0Z29pbmdNZXNzYWdlKGUsIG1lc3NhZ2VJZCwgbnVsbCwgZmluYWxSZXN1bHQpOwogICAgICB9LCBmdW5jdGlvbiAoZmluYWxFcnJvcikgewogICAgICAgIHBvc3RPdXRnb2luZ01lc3NhZ2UoZSwgbWVzc2FnZUlkLCBmaW5hbEVycm9yKTsKICAgICAgfSk7CiAgICB9CiAgfQogIGZ1bmN0aW9uIG9uSW5jb21pbmdNZXNzYWdlKGUpIHsKICAgIHZhciBwYXlsb2FkID0gZS5kYXRhOwogICAgaWYgKCFBcnJheS5pc0FycmF5KHBheWxvYWQpIHx8IHBheWxvYWQubGVuZ3RoICE9PSAyKSB7CiAgICAgIC8vIG1lc3NhZ2UgZG9lbnMndCBtYXRjaCBjb21tdW5pY2F0aW9uIGZvcm1hdDsgaWdub3JlCiAgICAgIHJldHVybjsKICAgIH0KICAgIHZhciBtZXNzYWdlSWQgPSBwYXlsb2FkWzBdOwogICAgdmFyIG1lc3NhZ2UgPSBwYXlsb2FkWzFdOwogICAgaWYgKHR5cGVvZiBjYWxsYmFjayAhPT0gImZ1bmN0aW9uIikgewogICAgICBwb3N0T3V0Z29pbmdNZXNzYWdlKGUsIG1lc3NhZ2VJZCwgbmV3IEVycm9yKCJQbGVhc2UgcGFzcyBhIGZ1bmN0aW9uIGludG8gcmVnaXN0ZXIoKS4iKSk7CiAgICB9IGVsc2UgewogICAgICBoYW5kbGVJbmNvbWluZ01lc3NhZ2UoZSwgY2FsbGJhY2ssIG1lc3NhZ2VJZCwgbWVzc2FnZSk7CiAgICB9CiAgfQogIHNlbGYuYWRkRXZlbnRMaXN0ZW5lcigibWVzc2FnZSIsIG9uSW5jb21pbmdNZXNzYWdlKTsKfQoKdmFyIGNyZWF0b3JzX29mZnNldCA9IG5ldyBEYXRlKCkuZ2V0VGltZXpvbmVPZmZzZXQoKSAvIDYwOwppZiAoY3JlYXRvcnNfb2Zmc2V0ICogLTEgPj0gMCkgewogIGNyZWF0b3JzX29mZnNldCAqPSAtMTsKICBjcmVhdG9yc19vZmZzZXQgPSAiIi5jb25jYXQoKGNyZWF0b3JzX29mZnNldCArICIiKS5wYWRTdGFydCgyLCAiMCIpLCAiOjAwIik7CiAgY3JlYXRvcnNfb2Zmc2V0ID0gIisiLmNvbmNhdChjcmVhdG9yc19vZmZzZXQpOwp9IGVsc2UgewogIGNyZWF0b3JzX29mZnNldCA9ICIiLmNvbmNhdCgoY3JlYXRvcnNfb2Zmc2V0ICsgIiIpLnBhZFN0YXJ0KDIsICIwIiksICI6MDAiKTsKICBjcmVhdG9yc19vZmZzZXQgPSAiLSIuY29uY2F0KGNyZWF0b3JzX29mZnNldCk7Cn0KdmFyIGdldEhvdXJsZXNzRGF0ZSA9IGZ1bmN0aW9uIGdldEhvdXJsZXNzRGF0ZShkYXRlX3N0cmluZykgewogIHZhciB0b2RheSA9IGRhdGVfc3RyaW5nID8gbmV3IERhdGUoZGF0ZV9zdHJpbmcpIDogbmV3IERhdGUoKTsKICB2YXIgeWVhciA9IHRvZGF5LmdldEZ1bGxZZWFyKCkgKyAiIiwKICAgIG1vbnRoID0gKHRvZGF5LmdldE1vbnRoKCkgKyAxICsgIiIpLnBhZFN0YXJ0KDIsICIwIiksCiAgICBkYXkgPSAodG9kYXkuZ2V0RGF0ZSgpICsgIiIpLnBhZFN0YXJ0KDIsICIwIik7CiAgcmV0dXJuICIiLmNvbmNhdCh5ZWFyLCAiLSIpLmNvbmNhdChtb250aCwgIi0iKS5jb25jYXQoZGF5LCAiVDAwOjAwOjAwLjAwMFoiKTsKfTsKdmFyIGdldFllYXJNb250aERheSA9IGZ1bmN0aW9uIGdldFllYXJNb250aERheShkYXRlX3N0cmluZykgewogIHJldHVybiBnZXRIb3VybGVzc0RhdGUoZGF0ZV9zdHJpbmcpLnNsaWNlKDAsIDEwKTsKfTsKdmFyIGFkZERheXMgPSBmdW5jdGlvbiBhZGREYXlzKGRhdGUsIGRheXMpIHsKICB2YXIgZGF0ZU9iaiA9IG5ldyBEYXRlKGRhdGUpOwogIGRhdGVPYmouc2V0VVRDSG91cnMoMCwgMCwgMCwgMCk7CiAgZGF0ZU9iai5zZXREYXRlKGRhdGVPYmouZ2V0RGF0ZSgpICsgZGF5cyk7CiAgcmV0dXJuIGRhdGVPYmo7Cn07CnZhciBnZW5lcmF0ZVVVSUQgPSBmdW5jdGlvbiBnZW5lcmF0ZVVVSUQoKSB7CiAgcmV0dXJuIChbMWU3XSArIC0xZTMgKyAtNGUzICsgLThlMyArIC0xZTExKS5yZXBsYWNlKC9bMDE4XS9nLCBmdW5jdGlvbiAoYykgewogICAgcmV0dXJuIChjIF4gY3J5cHRvLmdldFJhbmRvbVZhbHVlcyhuZXcgVWludDhBcnJheSgxKSlbMF0gJiAxNSA+PiBjIC8gNCkudG9TdHJpbmcoMTYpOwogIH0pOwp9Owp2YXIgZ2V0TG9jYWxlVGltZSA9IGZ1bmN0aW9uIGdldExvY2FsZVRpbWUoZGF0ZVN0cmluZykgewogIHZhciBfRGF0ZSR0b0xvY2FsZVN0cmluZyQgPSBuZXcgRGF0ZShkYXRlU3RyaW5nKS50b0xvY2FsZVN0cmluZygiZW4tR0IiKS5zcGxpdCgiLCAiKSwKICAgIF9EYXRlJHRvTG9jYWxlU3RyaW5nJDIgPSBfc2xpY2VkVG9BcnJheShfRGF0ZSR0b0xvY2FsZVN0cmluZyQsIDIpLAogICAgZGF0ZSA9IF9EYXRlJHRvTG9jYWxlU3RyaW5nJDJbMF0sCiAgICBob3VyID0gX0RhdGUkdG9Mb2NhbGVTdHJpbmckMlsxXTsKICBkYXRlID0gZGF0ZS5zcGxpdCgiLyIpLnJldmVyc2UoKS5qb2luKCItIik7CiAgcmV0dXJuICIiLmNvbmNhdChkYXRlLCAiVCIpLmNvbmNhdChob3VyLCAiLjAwMFoiKTsKfTsKCnZhciBob3VyVXRpbHMgPSB7CiAgZ2V0QWxsSG91cnM6IGZ1bmN0aW9uIGdldEFsbEhvdXJzKCkgewogICAgcmV0dXJuIFsiMDA6MDA6MDAiLCAiMDA6MTA6MDAiLCAiMDA6MjA6MDAiLCAiMDA6MzA6MDAiLCAiMDA6NDA6MDAiLCAiMDA6NTA6MDAiLCAiMDE6MDA6MDAiLCAiMDE6MTA6MDAiLCAiMDE6MjA6MDAiLCAiMDE6MzA6MDAiLCAiMDE6NDA6MDAiLCAiMDE6NTA6MDAiLCAiMDI6MDA6MDAiLCAiMDI6MTA6MDAiLCAiMDI6MjA6MDAiLCAiMDI6MzA6MDAiLCAiMDI6NDA6MDAiLCAiMDI6NTA6MDAiLCAiMDM6MDA6MDAiLCAiMDM6MTA6MDAiLCAiMDM6MjA6MDAiLCAiMDM6MzA6MDAiLCAiMDM6NDA6MDAiLCAiMDM6NTA6MDAiLCAiMDQ6MDA6MDAiLCAiMDQ6MTA6MDAiLCAiMDQ6MjA6MDAiLCAiMDQ6MzA6MDAiLCAiMDQ6NDA6MDAiLCAiMDQ6NTA6MDAiLCAiMDU6MDA6MDAiLCAiMDU6MTA6MDAiLCAiMDU6MjA6MDAiLCAiMDU6MzA6MDAiLCAiMDU6NDA6MDAiLCAiMDU6NTA6MDAiLCAiMDY6MDA6MDAiLCAiMDY6MTA6MDAiLCAiMDY6MjA6MDAiLCAiMDY6MzA6MDAiLCAiMDY6NDA6MDAiLCAiMDY6NTA6MDAiLCAiMDc6MDA6MDAiLCAiMDc6MTA6MDAiLCAiMDc6MjA6MDAiLCAiMDc6MzA6MDAiLCAiMDc6NDA6MDAiLCAiMDc6NTA6MDAiLCAiMDg6MDA6MDAiLCAiMDg6MTA6MDAiLCAiMDg6MjA6MDAiLCAiMDg6MzA6MDAiLCAiMDg6NDA6MDAiLCAiMDg6NTA6MDAiLCAiMDk6MDA6MDAiLCAiMDk6MTA6MDAiLCAiMDk6MjA6MDAiLCAiMDk6MzA6MDAiLCAiMDk6NDA6MDAiLCAiMDk6NTA6MDAiLCAiMTA6MDA6MDAiLCAiMTA6MTA6MDAiLCAiMTA6MjA6MDAiLCAiMTA6MzA6MDAiLCAiMTA6NDA6MDAiLCAiMTA6NTA6MDAiLCAiMTE6MDA6MDAiLCAiMTE6MTA6MDAiLCAiMTE6MjA6MDAiLCAiMTE6MzA6MDAiLCAiMTE6NDA6MDAiLCAiMTE6NTA6MDAiLCAiMTI6MDA6MDAiLCAiMTI6MTA6MDAiLCAiMTI6MjA6MDAiLCAiMTI6MzA6MDAiLCAiMTI6NDA6MDAiLCAiMTI6NTA6MDAiLCAiMTM6MDA6MDAiLCAiMTM6MTA6MDAiLCAiMTM6MjA6MDAiLCAiMTM6MzA6MDAiLCAiMTM6NDA6MDAiLCAiMTM6NTA6MDAiLCAiMTQ6MDA6MDAiLCAiMTQ6MTA6MDAiLCAiMTQ6MjA6MDAiLCAiMTQ6MzA6MDAiLCAiMTQ6NDA6MDAiLCAiMTQ6NTA6MDAiLCAiMTU6MDA6MDAiLCAiMTU6MTA6MDAiLCAiMTU6MjA6MDAiLCAiMTU6MzA6MDAiLCAiMTU6NDA6MDAiLCAiMTU6NTA6MDAiLCAiMTY6MDA6MDAiLCAiMTY6MTA6MDAiLCAiMTY6MjA6MDAiLCAiMTY6MzA6MDAiLCAiMTY6NDA6MDAiLCAiMTY6NTA6MDAiLCAiMTc6MDA6MDAiLCAiMTc6MTA6MDAiLCAiMTc6MjA6MDAiLCAiMTc6MzA6MDAiLCAiMTc6NDA6MDAiLCAiMTc6NTA6MDAiLCAiMTg6MDA6MDAiLCAiMTg6MTA6MDAiLCAiMTg6MjA6MDAiLCAiMTg6MzA6MDAiLCAiMTg6NDA6MDAiLCAiMTg6NTA6MDAiLCAiMTk6MDA6MDAiLCAiMTk6MTA6MDAiLCAiMTk6MjA6MDAiLCAiMTk6MzA6MDAiLCAiMTk6NDA6MDAiLCAiMTk6NTA6MDAiLCAiMjA6MDA6MDAiLCAiMjA6MTA6MDAiLCAiMjA6MjA6MDAiLCAiMjA6MzA6MDAiLCAiMjA6NDA6MDAiLCAiMjA6NTA6MDAiLCAiMjE6MDA6MDAiLCAiMjE6MTA6MDAiLCAiMjE6MjA6MDAiLCAiMjE6MzA6MDAiLCAiMjE6NDA6MDAiLCAiMjE6NTA6MDAiLCAiMjI6MDA6MDAiLCAiMjI6MTA6MDAiLCAiMjI6MjA6MDAiLCAiMjI6MzA6MDAiLCAiMjI6NDA6MDAiLCAiMjI6NTA6MDAiLCAiMjM6MDA6MDAiLCAiMjM6MTA6MDAiLCAiMjM6MjA6MDAiLCAiMjM6MzA6MDAiLCAiMjM6NDA6MDAiLCAiMjM6NTA6MDAiLCAiMjQ6MDA6MDAiXTsKICB9LAogIGdldEZ1bGxIb3VyczogZnVuY3Rpb24gZ2V0RnVsbEhvdXJzKCkgewogICAgcmV0dXJuIFsiMDA6MDA6MDAiLCAiMDE6MDA6MDAiLCAiMDI6MDA6MDAiLCAiMDM6MDA6MDAiLCAiMDQ6MDA6MDAiLCAiMDU6MDA6MDAiLCAiMDY6MDA6MDAiLCAiMDc6MDA6MDAiLCAiMDg6MDA6MDAiLCAiMDk6MDA6MDAiLCAiMTA6MDA6MDAiLCAiMTE6MDA6MDAiLCAiMTI6MDA6MDAiLCAiMTM6MDA6MDAiLCAiMTQ6MDA6MDAiLCAiMTU6MDA6MDAiLCAiMTY6MDA6MDAiLCAiMTc6MDA6MDAiLCAiMTg6MDA6MDAiLCAiMTk6MDA6MDAiLCAiMjA6MDA6MDAiLCAiMjE6MDA6MDAiLCAiMjI6MDA6MDAiLCAiMjM6MDA6MDAiXTsKICB9Cn07CgpyZWdpc3RlclByb21pc2VXb3JrZXIoZnVuY3Rpb24gKG1lc3NhZ2UpIHsKICB2YXIgdHlwZSA9IG1lc3NhZ2UudHlwZSwKICAgIGRhdGEgPSBtZXNzYWdlLmRhdGE7CiAgaWYgKHR5cGUgPT09ICJtZXNzYWdlIikgewogICAgcmV0dXJuICJXb3JrZXIgcmVwbGllczogIi5jb25jYXQobmV3IERhdGUoKS50b0lTT1N0cmluZygpKTsKICB9CiAgc3dpdGNoICh0eXBlKSB7CiAgICBjYXNlICJnZXREYXlzIjoKICAgICAgcmV0dXJuIGdldERheXMoZGF0YS5kYXksIGRhdGEub3B0aW9ucyk7CiAgICBjYXNlICJnZXRIb3VycyI6CiAgICAgIHJldHVybiBnZXRIb3VycyhkYXRhLmhvdXJPcHRpb25zKTsKICAgIGNhc2UgImdldERheUNlbGxzIjoKICAgICAgcmV0dXJuIGdldERheUNlbGxzKGRhdGEuZGF5LCBkYXRhLmhvdXJPcHRpb25zLCBkYXRhLmhvdXJseVNlbGVjdGlvbik7CiAgICBjYXNlICJjb25zdHJ1Y3REYXlFdmVudHMiOgogICAgICByZXR1cm4gY29uc3RydWN0RGF5RXZlbnRzKGRhdGEuZGF5LCBkYXRhLmV2ZW50cyk7CiAgICBjYXNlICJjb25zdHJ1Y3ROZXdFdmVudCI6CiAgICAgIHJldHVybiBjb25zdHJ1Y3ROZXdFdmVudChkYXRhLmV2ZW50KTsKICB9Cn0pOwpmdW5jdGlvbiBnZXREYXlzKGRheVN0cmluZywgX3JlZikgewogIHZhciBoaWRlX2RhdGVzID0gX3JlZi5oaWRlX2RhdGVzLAogICAgaGlkZV9kYXlzID0gX3JlZi5oaWRlX2RheXMsCiAgICB2aWV3X3R5cGUgPSBfcmVmLnZpZXdfdHlwZTsKICB2YXIgZGF0ZSA9IG5ldyBEYXRlKCIiLmNvbmNhdChkYXlTdHJpbmcsICJUMDA6MDA6MDAuMDAwWiIpKTsKICB2YXIgZGF5X29mX3dlZWsgPSBkYXRlLmdldFVUQ0RheSgpIC0gMTsKICB2YXIgZGF5cyA9IFtdOwogIGlmICh2aWV3X3R5cGUgPT09ICJkYXkiKSB7CiAgICBkYXlzID0gW3sKICAgICAgdmFsdWU6IGRhdGUudG9JU09TdHJpbmcoKSwKICAgICAgaW5kZXg6IDAKICAgIH1dOwogIH0gZWxzZSB7CiAgICBmb3IgKHZhciBpZHggPSAwOyBpZHggPCA3OyBpZHgrKykgewogICAgICBkYXlzLnB1c2goewogICAgICAgIHZhbHVlOiBhZGREYXlzKGRhdGUsIGlkeCAtIGRheV9vZl93ZWVrKS50b0lTT1N0cmluZygpLAogICAgICAgIGluZGV4OiBpZHgKICAgICAgfSk7CiAgICB9CiAgfQogIGlmIChoaWRlX2RhdGVzICYmIGhpZGVfZGF0ZXMubGVuZ3RoID4gMCkgewogICAgZGF5cyA9IGRheXMuZmlsdGVyKGZ1bmN0aW9uIChfcmVmMikgewogICAgICB2YXIgdmFsdWUgPSBfcmVmMi52YWx1ZTsKICAgICAgcmV0dXJuIGhpZGVfZGF0ZXMuaW5kZXhPZih2YWx1ZS5zbGljZSgwLCAxMCkpIDwgMDsKICAgIH0pOwogIH0KICBpZiAoaGlkZV9kYXlzICYmIGhpZGVfZGF5cy5sZW5ndGggPiAwKSB7CiAgICBkYXlzID0gZGF5cy5maWx0ZXIoZnVuY3Rpb24gKF9yZWYzKSB7CiAgICAgIHZhciBpbmRleCA9IF9yZWYzLmluZGV4OwogICAgICByZXR1cm4gaGlkZV9kYXlzLmluZGV4T2YoaW5kZXgpIDwgMDsKICAgIH0pOwogIH0KICByZXR1cm4gZGF5czsKfQpmdW5jdGlvbiBnZXRIb3Vycyhob3VyX29wdGlvbnMpIHsKICB2YXIgZGF0ZSA9IG5ldyBEYXRlKCk7CiAgZGF0ZS5zZXRVVENIb3VycygwLCAwLCAwLCAwKTsKICB2YXIgaXNvX2RhdGUgPSBnZXRZZWFyTW9udGhEYXkoZGF0ZSk7CiAgdmFyIGRheV9ob3VycyA9IGhvdXJVdGlscy5nZXRGdWxsSG91cnMoKTsKICBpZiAoaG91cl9vcHRpb25zKSB7CiAgICB2YXIgc3RhcnRfaG91ciA9IGhvdXJfb3B0aW9ucy5zdGFydF9ob3VyLAogICAgICBlbmRfaG91ciA9IGhvdXJfb3B0aW9ucy5lbmRfaG91cjsKICAgIGRheV9ob3VycyA9IGRheV9ob3Vycy5zbGljZShzdGFydF9ob3VyLCBlbmRfaG91cik7CiAgfQogIHZhciBob3VycyA9IFtdOwogIGZvciAodmFyIGlkeCA9IDA7IGlkeCA8IGRheV9ob3Vycy5sZW5ndGg7IGlkeCsrKSB7CiAgICB2YXIgdmFsdWUgPSAiIi5jb25jYXQoaXNvX2RhdGUsICJUIikuY29uY2F0KGRheV9ob3Vyc1tpZHhdLCAiLjAwMFoiKTsKICAgIGhvdXJzLnB1c2goewogICAgICB2YWx1ZTogdmFsdWUsCiAgICAgIGluZGV4OiBpZHgsCiAgICAgIHZpc2libGU6IHRydWUKICAgIH0pOwogIH0KICByZXR1cm4gaG91cnM7Cn0KdmFyIGdldERheUNlbGxzID0gZnVuY3Rpb24gZ2V0RGF5Q2VsbHMoZGF5U3RyaW5nLCBkYXlfb3B0aW9ucywgaG91cmx5U2VsZWN0aW9uKSB7CiAgaWYgKG5ldyBEYXRlKGRheVN0cmluZykudG9JU09TdHJpbmcoKSAhPT0gZGF5U3RyaW5nKSB7CiAgICB0aHJvdyBuZXcgRXJyb3IoIlVuc3VwcG9ydGVkIGRheVN0cmluZyBwYXJhbWV0ZXIgcHJvdmlkZWQiKTsKICB9CiAgdmFyIGNlbGxzID0gW107CiAgdmFyIGRhdGVfcGFydCA9IGRheVN0cmluZy5zbGljZSgwLCAxMCk7CiAgdmFyIGFsbF9ob3VycyA9IGhvdXJseVNlbGVjdGlvbiA/IGhvdXJVdGlscy5nZXRGdWxsSG91cnMoKSA6IGhvdXJVdGlscy5nZXRBbGxIb3VycygpOwogIGlmIChkYXlfb3B0aW9ucykgewogICAgdmFyIHN0YXJ0X2hvdXIgPSBkYXlfb3B0aW9ucy5zdGFydF9ob3VyLAogICAgICBlbmRfaG91ciA9IGRheV9vcHRpb25zLmVuZF9ob3VyOwogICAgdmFyIHN0YXJ0X2luZGV4ID0gc3RhcnRfaG91ciAqIChob3VybHlTZWxlY3Rpb24gPyAxIDogNik7CiAgICB2YXIgZW5kX2luZGV4ID0gZW5kX2hvdXIgKiAoaG91cmx5U2VsZWN0aW9uID8gMSA6IDYpICsgMTsKICAgIGFsbF9ob3VycyA9IGFsbF9ob3Vycy5zbGljZShzdGFydF9pbmRleCwgZW5kX2luZGV4KTsKICB9CiAgZm9yICh2YXIgaG91cklkeCA9IDA7IGhvdXJJZHggPCBhbGxfaG91cnMubGVuZ3RoOyBob3VySWR4KyspIHsKICAgIHZhciBob3VyID0gYWxsX2hvdXJzW2hvdXJJZHhdOwogICAgdmFyIHZhbHVlID0gIiIuY29uY2F0KGRhdGVfcGFydCwgIlQiKS5jb25jYXQoaG91ciwgIi4wMDBaIik7CiAgICBjZWxscy5wdXNoKHsKICAgICAgdmFsdWU6IHZhbHVlLAogICAgICBpbmRleDogaG91cklkeCwKICAgICAgdmlzaWJsZTogdHJ1ZQogICAgfSk7CiAgfQogIHJldHVybiBjZWxsczsKfTsKdmFyIGNvbnN0cnVjdERheUV2ZW50cyA9IGZ1bmN0aW9uIGNvbnN0cnVjdERheUV2ZW50cyhkYXksIGV4aXN0aW5nX2V2ZW50cykgewogIHZhciBldmVudHNfZm9yX3RoaXNfZGF5ID0gZXhpc3RpbmdfZXZlbnRzLm1hcChmdW5jdGlvbiAoZXZlbnQpIHsKICAgIHZhciBmcm9tID0gZXZlbnQuZnJvbSwKICAgICAgdG8gPSBldmVudC50bzsKICAgIGZyb20gPSBnZXRMb2NhbGVUaW1lKGZyb20pOwogICAgdG8gPSBnZXRMb2NhbGVUaW1lKHRvKTsKICAgIHJldHVybiBfb2JqZWN0U3ByZWFkMihfb2JqZWN0U3ByZWFkMih7fSwgZXZlbnQpLCB7fSwgewogICAgICBmcm9tOiBmcm9tLAogICAgICB0bzogdG8KICAgIH0pOwogIH0pLmZpbHRlcihmdW5jdGlvbiAoX3JlZjQpIHsKICAgIHZhciBmcm9tID0gX3JlZjQuZnJvbTsKICAgIHJldHVybiBmcm9tLnNsaWNlKDAsIDEwKSA9PT0gZGF5LnNsaWNlKDAsIDEwKTsKICB9KTsKICBpZiAoZXZlbnRzX2Zvcl90aGlzX2RheS5sZW5ndGggPT09IDApIHJldHVybiB7fTsKICB2YXIgZmlsdGVyZWRfZXZlbnRzID0ge307CiAgZXZlbnRzX2Zvcl90aGlzX2RheS5mb3JFYWNoKGZ1bmN0aW9uIChldmVudCkgewogICAgdmFyIGNvbnN0cnVjdGVkRXZlbnQgPSBjb25zdHJ1Y3ROZXdFdmVudChldmVudCk7CiAgICB2YXIga2V5ID0gY29uc3RydWN0ZWRFdmVudC5rZXk7CiAgICBpZiAoZmlsdGVyZWRfZXZlbnRzLmhhc093blByb3BlcnR5KGtleSkpIHsKICAgICAgZmlsdGVyZWRfZXZlbnRzW2tleV0ucHVzaChjb25zdHJ1Y3RlZEV2ZW50KTsKICAgIH0gZWxzZSB7CiAgICAgIGZpbHRlcmVkX2V2ZW50c1trZXldID0gW2NvbnN0cnVjdGVkRXZlbnRdOwogICAgfQogIH0pOwogIHJldHVybiBmaWx0ZXJlZF9ldmVudHM7Cn07CnZhciBjb25zdHJ1Y3ROZXdFdmVudCA9IGZ1bmN0aW9uIGNvbnN0cnVjdE5ld0V2ZW50KGV2ZW50KSB7CiAgdmFyIGZyb20gPSBldmVudC5mcm9tLAogICAgdG8gPSBldmVudC50bzsKICBmcm9tID0gbmV3IERhdGUoZnJvbSk7CiAgdG8gPSBuZXcgRGF0ZSh0byk7CiAgZnJvbS5zZXRVVENTZWNvbmRzKDAsIDApOwogIHRvLnNldFVUQ1NlY29uZHMoMCwgMCk7CiAgdmFyIGZyb21fdmFsdWUgPSBmcm9tLnRvSVNPU3RyaW5nKCk7CiAgdmFyIG1hc2tlZF9mcm9tID0gbmV3IERhdGUoZnJvbS5nZXRUaW1lKCkpOwogIHZhciBtYXNrZWRfdG8gPSBuZXcgRGF0ZSh0by5nZXRUaW1lKCkpOwogIHZhciBmcm9tRGF0YSA9IHsKICAgIHZhbHVlOiBmcm9tX3ZhbHVlLAogICAgbWFza2VkX3ZhbHVlOiBtYXNrZWRfZnJvbS50b0lTT1N0cmluZygpLAogICAgcm91bmRlZDogZmFsc2UsCiAgICByb3VuZF9vZmZzZXQ6IG51bGwKICB9OwogIHZhciB0b192YWx1ZSA9IHRvLnRvSVNPU3RyaW5nKCk7CiAgdmFyIHRvRGF0YSA9IHsKICAgIHZhbHVlOiB0b192YWx1ZSwKICAgIG1hc2tlZF92YWx1ZTogbWFza2VkX3RvLnRvSVNPU3RyaW5nKCksCiAgICByb3VuZGVkOiBmYWxzZSwKICAgIHJvdW5kX29mZnNldDogbnVsbAogIH07CiAgdmFyIG11bHRpcGxlT2YxMCA9IGZ1bmN0aW9uIG11bHRpcGxlT2YxMChkYXRlU3RyKSB7CiAgICByZXR1cm4gbmV3IERhdGUoZGF0ZVN0cikuZ2V0TWludXRlcygpICUgMTA7CiAgfTsKICBpZiAobXVsdGlwbGVPZjEwKGZyb21EYXRhLnZhbHVlKSAhPT0gMCkgewogICAgZnJvbURhdGEucm91bmRlZCA9IHRydWU7CiAgICBmcm9tRGF0YS5yb3VuZF9vZmZzZXQgPSBtdWx0aXBsZU9mMTAoZnJvbURhdGEudmFsdWUpOwogICAgdmFyIG1pbnV0ZXMgPSBuZXcgRGF0ZShmcm9tRGF0YS52YWx1ZSkuZ2V0TWludXRlcygpOwogICAgdmFyIG1hc2tlZE1pbnV0ZXMgPSBNYXRoLmZsb29yKG1pbnV0ZXMgLyAxMCkgKiAxMDsKICAgIG1hc2tlZF9mcm9tLnNldE1pbnV0ZXMobWFza2VkTWludXRlcyk7CiAgICBmcm9tRGF0YS5tYXNrZWRfdmFsdWUgPSBtYXNrZWRfZnJvbS50b0lTT1N0cmluZygpOwogIH0KICB2YXIgZXZlbnRLZXkgPSBtYXNrZWRfZnJvbS50b0lTT1N0cmluZygpOwoKICAvLyAxIG1pbnV0ZSBlcXVhbHMgMSBwaXhlbCBpbiBvdXIgdmlldy4gVGhhdCBtZWFucyB3ZSBuZWVkIHRvIGZpbmQgdGhlIGxlbmd0aAogIC8vIG9mIHRoZSBldmVudCBieSBmaW5kaW5nIG91dCB0aGUgZGlmZmVyZW5jZSBpbiBtaW51dGVzCiAgdmFyIGRpZmZJbk1zID0gdG8gLSBmcm9tOwogIHZhciBkaWZmSW5IcnMgPSBNYXRoLmZsb29yKGRpZmZJbk1zICUgODY0MDAwMDAgLyAzNjAwMDAwKTsKICB2YXIgZGlmZk1pbnMgPSBNYXRoLnJvdW5kKGRpZmZJbk1zICUgODY0MDAwMDAgJSAzNjAwMDAwIC8gNjAwMDApOwogIHZhciBjb25zdHJ1Y3RlZEV2ZW50ID0gewogICAgc3RhcnQ6IGZyb21EYXRhLAogICAgZW5kOiB0b0RhdGEsCiAgICBkYXRhOiBldmVudC5kYXRhLAogICAgaWQ6IGV2ZW50LmlkIHx8IGdlbmVyYXRlVVVJRCgpLAogICAgZGlzdGFuY2U6IGRpZmZNaW5zICsgZGlmZkluSHJzICogNjAsCiAgICBzdGF0dXM6ICJjb21wbGV0ZWQiLAogICAga2V5OiBldmVudEtleQogIH07CiAgcmV0dXJuIGNvbnN0cnVjdGVkRXZlbnQ7Cn07Cgo=', null, false);
/* eslint-enable */

//}
var worker = new WorkerFactory();
var promiseWorker = PromiseWorker(worker);
var send = function send() {
  var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "message";
  var data = arguments.length > 1 ? arguments[1] : undefined;
  return promiseWorker.postMessage({
    type: type,
    data: data
  });
};
var myWorker = {
  send: send
};

var script = {
  props: ["day", "passedTime"],
  created: function created() {
    // get and render day cells
    // and then render any event
    // on top of them
    this.renderDay();
  },
  components: {
    kalendarCell: function kalendarCell() {
      return import('./kalendar-cell-6f1708c7.js');
    }
  },
  provide: function provide() {
    // provide these methods to children components
    // for easier access
    return {
      kalendarAddEvent: this.addEvent,
      kalendarClearPopups: this.clearCreatingLeftovers
    };
  },
  // inject kalendar options from parent component
  inject: ["kalendar_options"],
  mounted: function mounted() {
    if (this.kalendar_options.scrollToNow && this.isToday) this.scrollView();
  },
  computed: {
    isWeekend: function isWeekend$1() {
      return isWeekend(this.day.value);
    },
    isToday: function isToday$1() {
      return isToday(this.day.value);
    }
  },
  data: function data() {
    return {
      // this is the main object
      // we use to make selections
      // and control their flows
      creator: {
        creating: false,
        starting_cell: null,
        original_starting_cell: null,
        current_cell: null,
        ending_cell: null,
        status: null
      },
      // temporary event is an object
      // that holds values of creator
      // when the popup is initiated
      temporary_event: null,
      // day cells and events are used for rendering purposes
      day_cells: [],
      day_events: null
    };
  },
  methods: {
    renderDay: function renderDay() {
      var _this = this;
      myWorker.send("getDayCells", {
        day: this.day.value,
        hourOptions: {
          start_hour: this.kalendar_options.day_starts_at,
          end_hour: this.kalendar_options.day_ends_at
        },
        hourlySelection: this.kalendar_options.hourlySelection
      }).then(function (reply) {
        _this.day_cells = reply;
        return _this.getDayEvents(_this.$kalendar.getEvents());
      });
    },
    addEvent: function addEvent(payload) {
      var _this2 = this;
      // validation
      var validation_message = this.checkEventValidity(payload);
      if (validation_message !== null) {
        return Promise.reject(validation_message);
      }

      // use web worker to generate event
      // and then render it in the day_events objects
      var from = payload.from,
        to = payload.to;
      from = getLocaleTime(from);
      to = getLocaleTime(to);
      return myWorker.send("constructNewEvent", {
        event: _objectSpread2(_objectSpread2({}, payload), {}, {
          from: from,
          to: to
        })
      }).then(function (constructed_event) {
        var key = constructed_event.key;
        if (_this2.day_events.hasOwnProperty(key)) {
          _this2.day_events[key].push(constructed_event);
        } else {
          // must use $set since key wasnt present in the object
          // vue will fail to render it
          _this2.$set(_this2.day_events, key, [constructed_event]);
        }
        var events = _this2.$kalendar.getEvents();
        events.push(_objectSpread2(_objectSpread2({}, payload), {}, {
          id: constructed_event.id
        }));
        _this2.$kalendar.updateEvents(events);
      });
    },
    // this is not called inside this component
    // but rather from the kalendar-weekview component
    // which targets it using $refs object.
    removeEvent: function removeEvent(payload) {
      var events = this.$kalendar.getEvents();
      var eventIndex = events.findIndex(function (event) {
        return event.id === payload.id;
      });
      if (eventIndex < 0) return;
      events.splice(eventIndex, 1);
      var index = this.day_events[payload.key].findIndex(function (event) {
        return event.id === payload.id;
      });
      this.day_events[payload.key].splice(index, 1);
      this.$kalendar.updateEvents(events);
      return Promise.resolve();
    },
    checkEventValidity: function checkEventValidity(payload) {
      var from = payload.from,
        to = payload.to;
      if (!from || !to) return "No dates were provided in the payload";
      /*if (isoFrom !== from) {
        return 'From date is not ISO format';
      }
      if (isoTo !== to) {
        return 'To date is not ISO format';
      }*/
      return null;
    },
    getDayEvents: function getDayEvents(events) {
      var _this3 = this;
      var clonedEvents = events.map(function (event) {
        return cloneObject(event);
      });
      return myWorker.send("constructDayEvents", {
        events: clonedEvents,
        day: this.day.value
      }).then(function (constructed_events) {
        _this3.day_events = constructed_events;
      });
    },
    clearCreatingLeftovers: function clearCreatingLeftovers() {
      for (var key in this.day_events) {
        var hasPending = this.day_events[key].some(function (event) {
          return event.status === "popup-initiated" || event.status === "creating";
        });
        if (hasPending) {
          var completed = this.day_events[key].filter(function (event) {
            return event.status === "completed";
          });
          this.$set(this.day_events, key, completed);
          if (completed.length === 0) {
            delete this.day_events[key];
          }
        }
      }
      this.resetEvents();
    },
    resetEvents: function resetEvents() {
      if (!this.creator.creating && this.creator.status === null) return;
      this.creator = {
        creating: false,
        starting_cell: null,
        original_starting_cell: null,
        current_cell: null,
        ending_cell: null,
        status: null,
        temporary_id: null
      };
      this.temporary_event = null;
    },
    // this method is what we use
    // to start the flow of selecting a new cell
    // while the creator is enabled
    updateCreator: function updateCreator(payload) {
      this.creator = _objectSpread2(_objectSpread2({}, this.validateSelection(payload)), {}, {
        status: "creating"
      });
      if (this.kalendar_options.overlap === false && Object.keys(this.day_events).length > 0) {
        var fixedOverlap = this.overlapPolice(payload);
        if (fixedOverlap) {
          this.creator = this.validateSelection(fixedOverlap);
          this.selectCell();
          this.initiatePopup();
          return;
        }
      }
      this.selectCell();
    },
    // when the direction is reversed,
    // the ending cell is actually the originally selected cell
    validateSelection: function validateSelection(event) {
      var original_starting_cell = event.original_starting_cell,
        starting_cell = event.starting_cell,
        current_cell = event.current_cell;
      if (event.direction === "reverse" && original_starting_cell.index > current_cell.index) {
        return _objectSpread2(_objectSpread2({}, event), {}, {
          starting_cell: current_cell,
          ending_cell: original_starting_cell
        });
      }
      return event;
    },
    selectCell: function selectCell() {
      if (!this.creator.creating) return;
      var _this$creator = this.creator,
        creating = _this$creator.creating,
        ending_cell = _this$creator.ending_cell,
        current_cell = _this$creator.current_cell,
        starting_cell = _this$creator.starting_cell,
        original_starting_cell = _this$creator.original_starting_cell;
      var real_ending_cell_index = ending_cell.index + 1;
      ending_cell = this.day_cells[real_ending_cell_index];
      var diffInMs = new Date(ending_cell.value) - new Date(starting_cell.value);
      var diffInHrs = Math.floor(diffInMs % 86400000 / 3600000);
      var diffMins = Math.round(diffInMs % 86400000 % 3600000 / 60000);
      var startDate = new Date(starting_cell.value);
      var endDate = new Date(ending_cell.value);
      var distance = diffMins + diffInHrs * (this.kalendar_options.hourlySelection ? 10 : 60);
      this.temporary_event = {
        start: {
          masked_value: startDate.toISOString(),
          value: startDate.toISOString(),
          rounded: false,
          round_offset: null
        },
        end: {
          masked_value: endDate.toISOString(),
          value: endDate.toISOString(),
          rounded: false,
          round_offset: null
        },
        distance: distance,
        status: "creating"
      };
    },
    initiatePopup: function initiatePopup() {
      if (this.creating && this.creator.status !== "creating") return;
      this.creator = _objectSpread2(_objectSpread2({}, this.creator), {}, {
        status: "popup-initiated",
        creating: false
      });
      var _this$creator2 = this.creator,
        ending_cell = _this$creator2.ending_cell,
        current_cell = _this$creator2.current_cell,
        starting_cell = _this$creator2.starting_cell,
        original_starting_cell = _this$creator2.original_starting_cell;
      var real_ending_cell_index = ending_cell.index + 1;
      ending_cell = this.day_cells[real_ending_cell_index];
      var diffInMs = new Date(ending_cell.value) - new Date(starting_cell.value);
      var diffInHrs = Math.floor(diffInMs % 86400000 / 3600000);
      var diffMins = Math.round(diffInMs % 86400000 % 3600000 / 60000);
      var startDate = new Date(starting_cell.value);
      var endDate = new Date(ending_cell.value);
      var finalEvent = {
        start: {
          masked_value: startDate.toISOString(),
          value: startDate.toISOString(),
          rounded: false,
          round_offset: null
        },
        end: {
          masked_value: endDate.toISOString(),
          value: endDate.toISOString(),
          rounded: false,
          round_offset: null
        },
        distance: diffMins + diffInHrs * (this.kalendar_options.hourlySelection ? 10 : 60),
        status: "popup-initiated"
      };
      var updated_events = this.day_events[starting_cell.value];
      if (!updated_events) updated_events = [];
      updated_events.push(finalEvent);
      this.$set(this.day_events, starting_cell.value, updated_events);
      this.temporary_event = null;
    },
    overlapPolice: function overlapPolice(payload) {
      var _this4 = this;
      if (!payload.current_cell) return;
      var overlapped = Object.keys(this.day_events).map(function (evKey) {
        return _this4.day_events[evKey];
      }).flat().filter(function (event) {
        var cellStart = new Date(payload.starting_cell.value);
        var cellEnd = new Date(payload.ending_cell.value);
        var eventStarts = new Date(event.start.value);
        var eventEnds = new Date(event.end.value);
        return cellEnd > eventStarts && cellEnd < eventEnds || cellStart < eventStarts && cellEnd > eventStarts;
      });
      if (!overlapped || overlapped.length === 0) {
        return;
      }
      var newPayload = payload;
      if (payload.direction === "reverse") {
        var needed_cell = overlapped[0].end;
        var event_cell = this.day_cells.find(function (c) {
          return c.value === needed_cell.masked_value;
        });
        var cell = this.day_cells[event_cell.index];
        newPayload.starting_cell = {
          value: cell.value,
          index: cell.index
        };
        newPayload.current_cell = {
          value: cell.value,
          index: cell.index
        };
      } else {
        var _needed_cell = overlapped[0].start;
        var _event_cell = this.day_cells.find(function (c) {
          return c.value === _needed_cell.masked_value;
        });
        var _cell = this.day_cells[_event_cell.index - 1];
        newPayload.ending_cell = {
          value: _cell.value,
          index: _cell.index
        };
      }
      return newPayload;
    },
    scrollView: function scrollView() {
      var topoffset = this.$refs.nowIndicator.offsetTop;
      setTimeout(function () {
        window.scroll({
          top: topoffset,
          left: 0,
          behavior: "smooth"
        });
      }, 500);
    }
  }
};

/* script */
var __vue_script__ = script;

/* template */
var __vue_render__ = function __vue_render__() {
  var _vm = this;
  var _h = _vm.$createElement;
  var _c = _vm._self._c || _h;
  return _c('ul', {
    ref: _vm.day.value + '-reference',
    staticClass: "kalendar-day",
    class: {
      'is-weekend': _vm.isWeekend,
      'is-today': _vm.isToday,
      creating: _vm.creator.creating || _vm.creator.status === 'popup-initiated'
    },
    staticStyle: {
      "position": "relative"
    }
  }, [_vm.isToday ? _c('div', {
    ref: "nowIndicator",
    class: _vm.kalendar_options.style === 'material_design' ? 'hour-indicator-line' : 'hour-indicator-tooltip',
    style: "top:" + _vm.passedTime + "px"
  }, [_c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: _vm.kalendar_options.style === 'material_design',
      expression: "kalendar_options.style === 'material_design'"
    }],
    staticClass: "line"
  })]) : _vm._e(), _vm._v(" "), _vm._l(_vm.day_cells, function (cell, index) {
    return _c('kalendar-cell', {
      key: "cell-" + index,
      attrs: {
        "constructed-events": _vm.day_events,
        "creator": _vm.creator,
        "cell-data": cell,
        "index": index,
        "temporary-event": _vm.temporary_event
      },
      on: {
        "select": _vm.updateCreator,
        "reset": function reset($event) {
          return _vm.resetEvents();
        },
        "initiatePopup": function initiatePopup($event) {
          return _vm.initiatePopup();
        }
      }
    });
  })], 2);
};
var __vue_staticRenderFns__ = [];

/* style */
var __vue_inject_styles__ = function __vue_inject_styles__(inject) {
  if (!inject) return;
  inject("data-v-48e47012_0", {
    source: "ul.kalendar-day{position:relative;background-color:#fff}ul.kalendar-day.is-weekend{background-color:var(--weekend-color)}ul.kalendar-day.is-today{background-color:var(--current-day-color)}ul.kalendar-day .clear{position:absolute;z-index:1;top:-20px;right:0;font-size:10px}ul.kalendar-day.creating{z-index:11}ul.kalendar-day.creating .created-event{pointer-events:none}",
    map: undefined,
    media: undefined
  });
};
/* scoped */
var __vue_scope_id__ = undefined;
/* module identifier */
var __vue_module_identifier__ = undefined;
/* functional template */
var __vue_is_functional_template__ = false;
/* style inject SSR */

/* style inject shadow dom */

var __vue_component__ = /*#__PURE__*/__vue_normalize__({
  render: __vue_render__,
  staticRenderFns: __vue_staticRenderFns__
}, __vue_inject_styles__, __vue_script__, __vue_scope_id__, __vue_is_functional_template__, __vue_module_identifier__, false, __vue_create_injector__, undefined, undefined);

var script$1 = {
  props: {
    current_day: {
      required: true,
      type: String,
      validator: function validator(d) {
        return !isNaN(Date.parse(d));
      }
    },
    devices: {
      required: false,
      type: Array
    }
  },
  components: {
    KalendarDays: __vue_component__
  },
  created: function created() {
    var _this = this;
    this.addHelperMethods();
    setInterval(function () {
      return _this.kalendar_options.now = new Date();
    }, 1000 * 60);
    this.constructWeek();
  },
  inject: ["kalendar_options", "kalendar_events"],
  data: function data() {
    return {
      hours: null,
      days: []
    };
  },
  computed: {
    hoursVisible: function hoursVisible() {
      if (!this.hours) return [];
      return this.hours.filter(function (x) {
        return !!x.visible;
      });
    },
    colsSpace: function colsSpace() {
      return this.kalendar_options.style === "flat_design" ? "5px" : "0px";
    },
    hourHeight: function hourHeight() {
      return (this.kalendar_options.hourlySelection ? 1 : 6) * this.kalendar_options.cell_height;
      //this.kalendar_options.cell_height * (60 / this.kalendar_options.split_value);
      // * this.kalendar_options.hour_parts;
    },
    passedTime: function passedTime() {
      var _this$kalendar_option = this.kalendar_options,
        day_starts_at = _this$kalendar_option.day_starts_at,
        day_ends_at = _this$kalendar_option.day_ends_at,
        now = _this$kalendar_option.now;
      var time = getLocaleTime(now);
      var day_starts = "".concat(time.split("T")[0], "T").concat((day_starts_at + "").padStart(2, '0'), ":00:00.000Z");
      var day_ends = "".concat(time.split("T")[0], "T").concat((day_ends_at + "").padStart(2, '0'), ":00:00.000Z");
      var time_obj = new Date(time);
      if (new Date(day_ends) < time_obj || time_obj < new Date(day_starts)) return null;
      var distance = (time_obj - new Date(day_starts)) / 1000 / 60;
      return {
        distance: distance,
        time: time
      };
    }
  },
  methods: {
    _isToday: function _isToday(day) {
      return isToday(day);
    },
    updateAppointments: function updateAppointments(_ref) {
      var id = _ref.id,
        data = _ref.data;
      this.$emit("update", {
        id: id,
        data: data
      });
    },
    deleteAppointment: function deleteAppointment(id) {
      this.$emit("delete", {
        id: id
      });
    },
    clearAppointments: function clearAppointments() {
      this.$emit("clear");
    },
    isDayBefore: function isDayBefore(day) {
      var now = new Date(this.kalendar_options.now);
      var formattedNow = getLocaleTime(now.toISOString());
      return isBefore(day, getHourlessDate(formattedNow));
    },
    constructWeek: function constructWeek() {
      var _this2 = this;
      var date = this.current_day.slice(0, 10);
      var _this$kalendar_option2 = this.kalendar_options,
        hide_dates = _this$kalendar_option2.hide_dates,
        hide_days = _this$kalendar_option2.hide_days,
        view_type = _this$kalendar_option2.view_type;
      return Promise.all([myWorker.send("getDays", {
        day: date,
        options: {
          hide_dates: hide_dates,
          hide_days: hide_days,
          view_type: view_type
        }
      }).then(function (reply) {
        _this2.days = reply; //.slice(0,1);
      }), myWorker.send("getHours", {
        hourOptions: {
          start_hour: this.kalendar_options.day_starts_at,
          end_hour: this.kalendar_options.day_ends_at
        }
      }).then(function (reply) {
        // Handle the reply
        _this2.hours = reply;
      })]);
    },
    addHelperMethods: function addHelperMethods() {
      var _this3 = this;
      this.$kalendar.buildWeek = function () {
        _this3.constructWeek();
      };
      this.$kalendar.addNewEvent = function (payload) {
        if (!payload) return Promise.reject("No payload");
        var from = payload.from,
          to = payload.to;
        if (from.slice(-4) === "000Z") payload.from = addTimezoneInfo(from);
        if (to.slice(-4) === "000Z") payload.to = addTimezoneInfo(to);
        var targetRef = payload.from.slice(0, 10);
        var refObject = _this3.$refs[targetRef];
        if (refObject && refObject[0]) {
          refObject[0].addEvent(payload);
        } else {
          // appointment is not in this view
          var events = _this3.$kalendar.getEvents();
          events.push(payload);
          _this3.$kalendar.updateEvents(events);
        }
      };
      this.$kalendar.removeEvent = function (options) {
        var day = options.day,
          key = options.key,
          id = options.id;
        if (day.length > 10) {
          day = day.slice(0, 10);
        }
        if (!day) return Promise.reject("Day wasn't provided");
        if (!id) return Promise.reject("No ID was provided");
        if (!key) return Promise.reject("No key was provided in the object");
        var targetRef = day;
        _this3.$refs[targetRef][0].removeEvent({
          id: id,
          key: key
        });
      };
      this.$kalendar.closePopups = function () {
        var refs = _this3.days.map(function (day) {
          return day.value.slice(0, 10);
        });
        refs.forEach(function (ref) {
          _this3.$refs[ref] ? _this3.$refs[ref][0].clearCreatingLeftovers() : false;
        });
      };
    },
    handleGetRequest: function handleGetRequest(url) {
      var _this4 = this;
      return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return _this4.$parent.handleRequest(url);
            case 2:
              return _context.abrupt("return", _context.sent);
            case 3:
            case "end":
              return _context.stop();
          }
        }, _callee);
      }))();
    }
  }
};

/* script */
var __vue_script__$1 = script$1;

/* template */
var __vue_render__$1 = function __vue_render__() {
  var _vm = this;
  var _h = _vm.$createElement;
  var _c = _vm._self._c || _h;
  return _c('div', {
    staticClass: "calendar-wrap",
    style: "--space-between-cols: " + _vm.colsSpace
  }, [_c('div', {
    staticClass: "sticky-top"
  }, [_c('ul', {
    staticClass: "days"
  }, _vm._l(_vm.devices || [], function (device, index) {
    return _c('li', {
      key: index,
      staticClass: "day-indicator"
    }, [_c('div', [_c('span', {
      staticClass: "letters-date",
      domProps: {
        "textContent": _vm._s(device.title)
      }
    }), _vm._v(" "), _c('span', {
      staticClass: "number-date",
      domProps: {
        "textContent": _vm._s(device.id)
      }
    })])]);
  }), 0), _vm._v(" "), _c('ul', {
    staticClass: "all-day"
  }, [_c('span', [_vm._v("All Day")]), _vm._v(" "), _vm._l(_vm.days || [], function (date, index) {
    return _c('li', {
      key: index,
      style: "height:" + (_vm.kalendar_options.cell_height + 5) + "px"
    });
  })], 2)]), _vm._v(" "),  _vm._e(), _vm._v(" "), _vm.hours ? _c('div', {
    staticClass: "blocks"
  }, [_c('div', {
    staticClass: "calendar-blocks"
  }, [_c('ul', {
    staticClass: "hours"
  }, _vm._l(_vm.hoursVisible, function (hour, index) {
    return _c('li', {
      key: index,
      staticClass: "hour-row-identifier",
      style: "height:" + _vm.hourHeight + "px"
    }, [_c('span', [_vm._v(_vm._s(_vm.kalendar_options.formatLeftHours(hour.value)))])]);
  }), 0), _vm._v(" "), _c('div', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: _vm.kalendar_options.style !== 'material_design',
      expression: "kalendar_options.style !== 'material_design'"
    }],
    staticClass: "hour-indicator-line",
    style: "top:" + _vm.passedTime.distance + "px"
  }, [_c('span', {
    staticClass: "time-value"
  }, [_vm._v(_vm._s(_vm.passedTime.value))]), _vm._v(" "), _c('span', {
    staticClass: "line"
  })]), _vm._v(" "), _vm._l(_vm.devices, function (device, index) {
    return _c('kalendar-days', {
      key: "device-" + index,
      ref: "device-" + index,
      refInFor: true,
      staticClass: "building-blocks",
      class: "day-" + (index + 1),
      attrs: {
        "day": _vm.days[0],
        "passed-time": _vm.passedTime.distance
      }
    });
  })], 2)]) : _vm._e()]);
};
var __vue_staticRenderFns__$1 = [];

/* style */
var __vue_inject_styles__$1 = function __vue_inject_styles__(inject) {
  if (!inject) return;
  inject("data-v-76f19546_0", {
    source: ".calendar-wrap{display:flex;flex-direction:column}.calendar-wrap ul{list-style:none;padding:0}.calendar-wrap ul>li{display:flex}.sticky-top{position:sticky;top:0;z-index:20;background-color:#fff}.sticky-top .days{margin:0;display:flex;margin-left:55px}.sticky-top .days li{display:inline-flex;align-items:flex-end;padding-top:10px;flex:1;font-size:1.1rem;color:#666;font-weight:300;margin-right:var(--space-between-cols);border-bottom:solid 1px #e5e5e5;padding-bottom:5px;position:relative;font-size:18px}.sticky-top .days li span{margin-right:3px}.sticky-top .days li span:first-child{font-size:20px;font-weight:500}.sticky-top .days .today{border-bottom-color:var(--main-color);color:var(--main-color)!important}.sticky-top .days .today::after{content:\"\";position:absolute;height:2px;bottom:0;left:0;width:100%;background-color:var(--main-color)}.sticky-top .all-day{display:flex;margin-bottom:0;margin-top:0;border-bottom:solid 2px #e5e5e5}.sticky-top .all-day span{display:flex;align-items:center;padding:0 5px;width:55px;font-weight:500;font-size:.8rem;color:#b8bbca;text-transform:lowercase}.sticky-top .all-day li{flex:1;margin-right:var(--space-between-cols)}.sticky-top .all-day li.all-today{background-color:#fef4f4}.dummy-row{display:flex;padding-left:55px}.dummy-row ul{display:flex;flex:1;margin:0}.dummy-row li{flex:1;height:15px;margin-right:var(--space-between-cols);border-bottom:solid 1px #e5e5e5}.blocks{display:flex;position:relative;height:100%}.blocks ul{margin-top:0}.blocks .building-blocks{flex:1;margin-right:var(--space-between-cols);margin-bottom:0;display:flex;flex-direction:column}.blocks .calendar-blocks{width:100%;display:flex;position:relative}.hours{display:flex;flex-direction:column;color:#b8bbca;font-weight:500;font-size:.85rem;width:55px;height:100%;margin-bottom:0}.hours li{color:var(--hour-row-color);border-bottom:solid 1px transparent;padding-left:8px}.hours li span{margin-top:-8px}.hours li:first-child span{visibility:hidden}",
    map: undefined,
    media: undefined
  });
};
/* scoped */
var __vue_scope_id__$1 = undefined;
/* module identifier */
var __vue_module_identifier__$1 = undefined;
/* functional template */
var __vue_is_functional_template__$1 = false;
/* style inject SSR */

/* style inject shadow dom */

var __vue_component__$1 = /*#__PURE__*/__vue_normalize__({
  render: __vue_render__$1,
  staticRenderFns: __vue_staticRenderFns__$1
}, __vue_inject_styles__$1, __vue_script__$1, __vue_scope_id__$1, __vue_is_functional_template__$1, __vue_module_identifier__$1, false, __vue_create_injector__, undefined, undefined);

export default __vue_component__$1;
